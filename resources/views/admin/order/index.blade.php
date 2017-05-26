@extends('admin.right')


@section('content')

<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="status" id="status" class="form-control">
			<option value="">订单状态</option>
			<option value="0">关闭</option>
			<option value="1">正常</option>
			<option value="2">完成</option>
			<option value="3">申请退货</option>
		</select>
		开始时间：
		<input name="starttime" class="form-control" id="laydate">
		结束时间：
		<input name="endtime" class="form-control" id="laydate2">
		<button class="btn btn-sm btn-info">查找</button>
	</form>

	<form action="" class="form-inline pull-right" method="get">
		<input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="请输入单号查询..">
		<button class="btn btn-sm btn-info">搜索</button>
	</form>
</div>

<table class="table table-bordered table-striped mt15">
	<tr>
		<th>订单状态</th>
		<th>操作</th>
		<th>订单号</th>
		<th>总价</th>
		<th>支付状态</th>
		<th>发货状态</th>
		<th>下单时间</th>
	</tr>
	@foreach($orders as $o)
    <tr>
    	<td>
            @if($o->orderstatus == 0)
        	<span class="color-red">已关闭</span>
        	@elseif($o->orderstatus == 1)
        	<span class="color-blue">正常</span>
        	@elseif($o->orderstatus == 3)
        	<span class="text-danger">申请退货</span>
	        	@if(App::make('com')->ifCan('order-ship'))
		    	<a href="{{ url('/xyshop/order/tui',['id'=>$o->id]) }}" class="btn btn-sm btn-warning confirm">同意</a>
				@endif
    		@else
        	<span class="color-green">已完成</span>
        	@endif
        </td>
    	<td>
    	@if($o->orderstatus != 0)
		@if(App::make('com')->ifCan('order-del'))
    	<a href="{{ url('/xyshop/order/del',['id'=>$o->id]) }}" class="btn btn-sm btn-danger confirm">关闭</a> 
		@endif
		@if(App::make('com')->ifCan('order-ship'))
    	<a href="{{ url('/xyshop/order/ship',['id'=>$o->id]) }}" class="btn btn-sm btn-success confirm">发货</a>
		@endif
		@endif
    	</td>
        <td>{{ $o->order_id }}</td>
        <td><span class="color_2">￥{{ $o->total_prices }}</span></td>
        <td>
        	@if($o->paystatus == 0)
        	<span class="color-blue">未支付</span>
        	@else
        	<span class="color-green">已支付</span>
        	@endif
        </td>
        <td>
        	@if($o->shipstatus == 0)
        	<span class="color-blue">未发货</span>
        	@else
        	<span class="color-green">已发货</span>
        	@endif
        </td>
        <td>{{ $o->created_at }}</td>
    </tr>
    <tr>
    	<td colspan="7">
    		<table class="table">
    		@foreach($o->good as $l)
			<tr>
				<td width="55%">
					<div class="media">
						<a href="{{ url('/shop/good',['id'=>$l->good->id,'format'=>$l->format['format']]) }}" class="pull-left"><img src="{{ $l->good->thumb }}" width="100" class="media-object" alt=""></a>
						<div class="media-body">
							<h4 class="mt5 cart_h4"><a href="{{ url('/shop/good',['id'=>$l->good->id,'format'=>$l->format['format']]) }}">{{ $l->good->title }}</a></h4>
							@if($l->format['format_name'] != '')<span class="btn btn-sm btn-info mt10">{{ $l->format['format_name'] }}</span>@endif
						</div>
					</div>
				</td>
				<td width="15%">{{ $l->nums }} 件</td>
				<td width="15%"><span class="good_prices color_1">￥{{ $l->price }}</span></td>
				<td width="15%"><span class="color_2">￥<span class="one_total_price total_price_{{ $l->id }}_{{ $l->format['fid'] }}">{{ $l->total_prices }}</span></span></td>
			</tr>
			@endforeach
			</table>
    	</td>
    </tr>
		@endforeach
</table>
<div class="pages">
    {!! $orders->appends(['q'=>$q,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>
<script>
	laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>
@endsection