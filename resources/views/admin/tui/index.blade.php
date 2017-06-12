@extends('admin.right')


@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="status" id="status" class="form-control mr10">
			<option value="">请选择状态</option>
			<option value="0">未处理</option>
			<option value="1">已退货</option>
			<option value="2">不退货</option>
		</select>
		开始时间：<input type="text" name="starttime" class="form-control mr10" value="" id="laydate">
		到：<input type="text" name="endtime" class="form-control" value="" id="laydate2">
		<button class="btn btn-info">查找</button>
	</form>
</div>
<form action="" class="form-inline form_submit" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="150">用户</th>
			<th width="200">商品名</th>
			<th width="200">备注</th>
			<th width="200">处理意见</th>
			<th width="50">数量</th>
			<th width="50">总价</th>
			<th width="80">状态</th>
			<th width="160">提交时间</th>
			<th width="160">退货时间</th>
			<th width="180">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>@if(!is_null($a->user)){{ $a->user->username }}<br />{{ $a->user->nickname }}@endif</td>
			<td>
				{{ $a->good_title }} —— {{ $a->good_spec_name }}
			</td>
			<td>{{ $a->mark }}</td>
			<td>{{ $a->shopmark }}</td>
			<td>{{ $a->nums }}</td>
			<td>￥{{ $a->total_prices }}</td>
			<td>
				@if($a->status == 0)
				<span class="text-primary">未处理</span>
				@elseif($a->status == 1)
				<span class="text-success">已退货</span>
				@else
				<span class="text-warning">不退货</span>
				@endif
			</td>
			<td>{{ $a->starttime }}</td>
			<td>{{ $a->return_time }}</td>
			<td>
				@if(App::make('com')->ifCan('returngood-status') && $a->status == 0)
				<div data-url="{{ url('/xyshop/returngood/status',$a->id) }}" class="btn btn-sm btn-primary btn_tuan" data-toggle="modal" data-target="#myModal">处理</div>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->appends(['status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel_1"></h4>
      </div>
      <div class="modal-body" id="hd_good">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button class="btn btn-primary" id="dosubmit">提交</button>
      </div>
    </div>
  </div>
</div>
<!-- 选中当前栏目 -->
<script>
	$(function(){
		$("#dosubmit").on('click',function(){
			$('#form-tuan').submit();
		});

		// 处理退货请求
		$('.btn_tuan').click(function(){
			var url = $(this).attr('data-url');
			$('#hd_good').load(url);
			$('#myModalLabel_1').text('处理退货请求');
			return;
		});
	});
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