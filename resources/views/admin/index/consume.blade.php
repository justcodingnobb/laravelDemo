@extends('admin.right')


@section('content')
<style>
	.todays .label {
		padding: 10px;
		font-weight: normal;
		display: inline-block;
	}
	.nums {font-size: 16px;font-weight: bold;}
</style>

<div class="todays">
	<span class="label label-info">今日已收款数：<span class="nums">{{ $today_inc }}</span> 元</span>
	<span class="label label-warning">今日充值数：<span class="nums">{{ $today_dec }}</span> 元</span>
	<span class="label label-danger">今日结余：<span class="nums">{{ $today_over }}</span> 元</span>
</div>

<div class="todays mt10">
	<form action="" class="form-inline form_excel" method="get">
		开始时间：<input type="text" name="starttime" class="form-control mr10" value="{{ $starttime }}" id="laydate">
		到：<input type="text" name="endtime" class="form-control" value="{{ $endtime }}" id="laydate2">
		<button class="btn btn-success">查询</button>
		<button class="btn btn-primary btn_order">导出表格</button>
	</form>
</div>

<!-- 今日销售统计表 -->
<div class="good_ship mt10">
	<table class="table table-striped">
		<tr>
			<th width="120">用户</th>
			<th width="200">备注</th>
			<th width="110">金额</th>
			<th>时间</th>
		</tr>
		@foreach($consume as $g)
		<tr>
			<td>{{ $g->user->nickname }}</td>
			<td>{{ $g->mark }}</td>
			<td><span class="text-danger">@if($g->type == 1)+@else-@endif</span> {{ $g->price }}</td>
			<td>{{ $g->created_at }}</td>
		</tr>
		@endforeach
	</table>
</div>

<script>
	$(function(){
		$('.btn_order').click(function(){
			$('.form_excel').attr('action',"{{ url('/xyshop/index/excel_consume') }}").submit();
		});
	})
	laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:mm:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection