@extends('default.pc.layout')

<!-- 内容 -->
@section('content')
<div class="wrap_home">
	<h3>会员中心</h3>
	@include('default.pc.useraside')
	<article class="user_right mt10">
		<table class="pure-table pure-table-horizontal">
	        <thead>
		        <tr>
		            <th>订单号</th>
		            <th>总价</th>
		            <th>支付状态</th>
		            <th>发货状态</th>
		            <th>订单状态</th>
		            <th>下单时间</th>
		        </tr>
		    </thead>
		    <tbody>
		    @foreach($list as $l)
		        <tr>
		            <td>{{ $l->order_id }}</td>
		            <td>{{ $l->total_prices }}</td>
		            <td>
		            	@if($l->paystatus == 0)
		            	<a href="{{ url('order/pay',['oid'=>$l->id]) }}" class="color-green">去支付</a>
		            	@else
		            	<span class="color-blue">已支付</span>
		            	@endif
		            </td>
		            <td>
		            	@if($l->shipstatus == 0)
		            	<span class="color-green">未发货</span>
		            	@else
		            	<span class="color-blue">已发货</span>
		            	@endif
		            </td>
		            <td>
			            @if($l->orderstatus == 0)
		            	<span class="color-red">已关闭</span>
		            	@elseif($l->orderstatus == 1)
		            	<span class="color-green">正常</span>
		            	@else
		            	<span class="color-blue">已完成</span>
		            	@endif
		            </td>
		            <td>{{ $l->created_at }}</td>
		        </tr>
		        @foreach($l->good as $g)
		        <tr>
		        	<td colspan="6">
		        		<img src="{{ $g->good->thumb }}" width="100" height="85" alt="">
		        		<p>{{ $g->good->title }}</p>
		        		<p>{{ $g->price }}￥，{{ $g->nums }}，{{ $g->total_prices }}￥</p>
		        	</td>
		        </tr>
		        @endforeach
	       @endforeach
	        </tbody>
		</table>
	</article>
</div>
@endsection
