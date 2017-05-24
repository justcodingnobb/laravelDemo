@extends('default.layout')


@section('title')
    <title>购物车-希夷SHOP</title>
@endsection


@section('content')
<div class="container-fluid mt20">
	<h3 class="h3_cate"><span class="h3_cate_span">订单中心</span></h3>
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>订单号</th>
				<th>总价</th>
				<th>支付状态</th>
				<th>发货状态</th>
				<th>订单状态</th>
				<th>下单时间</th>
			</tr>
			@foreach($orders as $o)
	        <tr>
	            <td>{{ $o->order_id }}</td>
	            <td><span class="color_2">￥{{ $o->total_prices }}</span></td>
	            <td>
	            	@if($o->paystatus == 0)
	            	<a href="{{ url('shop/order/pay',['oid'=>$o->id]) }}" class="btn btn-sm btn-success">去支付</a>
	            	@else
	            	<span class="color-blue">已支付</span>
	            	@endif
	            </td>
	            <td>
	            	@if($o->shipstatus == 0)
	            	<span class="color-green">未发货</span>
	            	@else
	            	<span class="color-blue">已发货</span>
	            	@endif
	            </td>
	            <td>
		            @if($o->orderstatus == 0)
	            	<span class="color-red">已关闭</span>
	            	@elseif($o->orderstatus == 1)
	            	<span class="color-green">正常</span> <a href="{{ url('shop/order/over',['id'=>$o->id]) }}" class="btn btn-sm btn-danger confirm">取消</a>
	            	@else
	            	<span class="color-blue">已完成</span>
	            	@endif
	            </td>
	            <td>{{ $o->created_at }}</td>
	        </tr>
	        <tr>
	        	<td colspan="6">
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
	</div>
	<div class="pages">
	    {!! $orders->links() !!}
	</div>
</div>
@endsection