@extends('admin.right')

@section('content')


<style>
	.main_title {display: none;}
	.todays .label {
		padding: 10px;
		font-weight: normal;
		display: inline-block;
	}
	.nums {font-size: 16px;font-weight: bold;}
	.good_ship {margin-top: 20px;}
</style>

<div class="todays">
	<span class="label label-primary">今日总订单量：<span class="nums">{{ $data['today_ordernum'] }}</span>个</span>
	<span class="label label-success">今日销售额：<span class="nums">{{ $data['today_prices'] }}</span> 元</span>
	<span class="label label-info">今日已收款数：<span class="nums">{{ $data['today_prices_real'] }}</span> 元</span>
	<span class="label label-warning">今日未收款数：<span class="nums">{{ $data['today_prices_no'] }}</span> 元</span>
	<span class="label label-danger">今日待发货：<span class="nums">{{ $data['today_ship'] }}</span> 件</span>
	<a href="{{ url('/xyshop/index/goodship') }}" class="label label-success">导出今日销售统计表</a>
</div>

<!-- 今日销售统计表 -->
<div class="good_ship">
	<table class="table table-striped">
		<tr>
			<th>标题</th>
			<th>货号</th>
			<th>数量</th>
			<th>单件重量</th>
			<th>总重量</th>
		</tr>
		@foreach($good_ship as $g)
		<tr>
			<td>{{ $g['title'] }}</td>
			<td>{{ $g['pronums'] }}</td>
			<td>{{ $g['nums'] }} 件</td>
			<td>{{ $g['weight'] }} 斤</td>
			<td><strong class="text-primary">{{ $g['total_weight'] }} 斤</strong></td>
		</tr>
		@endforeach
	</table>
</div>


@endsection