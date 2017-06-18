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
		</select>
		<select name="shipstatus" id="shipstatus" class="form-control">
			<option value="">发货状态</option>
			<option value="0">未发货</option>
			<option value="1">已发货</option>
		</select>
		<select name="ziti" id="ziti" class="form-control">
			<option value="">自提状态</option>
			<option value="0">不自提</option>
			<option value="1">自提</option>
		</select>
		开始时间：
		<input name="starttime" class="form-control" id="laydate">
		结束时间：
		<input name="endtime" class="form-control" id="laydate2">
		<button class="btn btn-sm btn-info">查找</button>
	</form>

	<form action="" class="form-inline pull-right" method="get">
		<input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="请输入手机号或昵称查询..">
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
    		@else
        	<span class="color-green">已完成</span>
        	@endif
        </td>
    	<td>
    	@if($o->orderstatus == 1)
		@if(App::make('com')->ifCan('order-del'))
    	<a href="{{ url('/xyshop/order/del',['id'=>$o->id]) }}" class="btn btn-sm btn-danger confirm">关闭</a> 
		@endif
		@if(App::make('com')->ifCan('order-ziti') && $o->ziti != 0)
    	<a href="{{ url('/xyshop/order/ziti',['id'=>$o->id]) }}" class="btn btn-sm btn-warning confirm">已自提</a>
		@endif
		@if(App::make('com')->ifCan('order-ship') && $o->ziti == 0 && $o->shipstatus == 0)
		<div data-url="{{ url('/xyshop/order/ship',['id'=>$o->id]) }}" data-title="发货" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-success btn_modal">发货</div>
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
			@if(!is_null($o->address))
    		<p>{{ $o->address->area }}{{ $o->address->address }}</p>
    		<p>{{ $o->address->people }}：{{ $o->address->phone }}</p>
    		@endif
    		@if(!is_null($o->zitidian))
    		<p>{{ $o->zitidian->area }}{{ $o->zitidian->address }}</p>
    		<p>{{ $o->zitidian->phone }}</p>
    		@endif
    	</td>
	</tr>
    <tr>
    	<td colspan="7">
    		<table class="table">
    		@foreach($o->good as $l)
			<tr>
				<td width="55%">
					<img src="{{ $l->good->thumb }}" class="img-responsive img-thumbnail mr10 pull-left" width="100" alt="">
					<h5 class="mt10">
						<a href="{{ url('/shop/good',['id'=>$l->good->id]) }}">{{ $l->good_title }}</a>
						@if($l->good_spec_name != '')<span class="label label-warning">{{ $l->good_spec_name }}</span>@endif
					</h5>
				</td>
				<td width="15%">{{ $l->nums }} 件</td>
				<td width="15%"><span class="good_prices color_1">￥{{ $l->price }}</span></td>
				<td width="15%"><span class="color_2">￥<span class="one_total_price">{{ $l->total_prices }}</span></span></td>
			</tr>
			@endforeach
			</table>
    	</td>
    </tr>
		@endforeach
</table>
<div class="pages">
    {!! $orders->appends(['q'=>$q,'status'=>$status,'ziti'=>$ziti,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
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