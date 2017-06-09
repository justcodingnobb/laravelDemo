@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('card-add'))
<div data-url="{{ url('/xyshop/card/add') }}" class="btn btn-info btn_tuan" data-toggle="modal" data-target="#myModal">添加新卡</div>
@endif

@endsection

@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="status" id="status" class="form-control mr10">
			<option value="">请选择状态</option>
			<option value="0">未激活</option>
			<option value="1">已激活</option>
		</select>
		开卡时间：<input type="text" name="starttime" class="form-control mr10" value="" id="laydate">
		到：<input type="text" name="endtime" class="form-control" value="" id="laydate2">
		<button class="btn btn-info">查找</button>
	</form>
</div>
<form action="" class="form-inline form_submit" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="30"><input type="checkbox" class="checkall"></th>
			<th width="50">ID</th>
			<th width="100">卡号</th>
			<th width="50">密码</th>
			<th width="50">金额</th>
			<th width="200">会员</th>
			<th width="80">状态</th>
			<th width="160">激活时间</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td><input type="checkbox" name="sids[]" class="check_s" value="{{ $a->id }}"></td>
			<td>{{ $a->id }}</td>
			<td>{{ $a->card_id }}</td>
			<td>{{ $a->card_pwd }}</td>
			<td>{{ $a->price }}</td>
			<td>@if(!is_null($a->user)){{ $a->user->username }}<br />{{ $a->user->nickname }}@endif</td>
			<td>
				@if($a->status == 0)
				<span class="text-warning">未激活</span>
				@else
				<span class="text-success">已激活</span>
				@endif
			</td>
			<td>{{ $a->init_time }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pull-left" data-toggle="buttons">
	<label class="btn btn-primary">
	<input type="checkbox" autocomplete="off" class="checkall">全选</label>

	@if(App::make('com')->ifCan('card-del'))
	<span class="btn btn-danger btn_del">批量删除</span>
	@endif
</div>
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

		$('.btn_del').click(function(){
			if (!confirm("确实要删除吗?")){
				return false;
			}else{
				$('.form_submit').attr({'action':"{{ url('/xyshop/card/del') }}",'method':'post'}).submit();
			}
		});
		$(".checkall").bind('change',function(){
			if($(this).is(":checked"))
			{
				$(".check_s").each(function(s){
					$(".check_s").eq(s).prop("checked",true);
				});
			}
			else
			{
				$(".check_s").each(function(s){
					$(".check_s").eq(s).prop("checked",false);
				});
			}
		});

		$("#dosubmit").on('click',function(){
			$('#form-tuan').submit();
		});

		// 添加新卡
		$('.btn_tuan').click(function(){
			var url = $(this).attr('data-url');
			$('#hd_good').load(url);
			$('#myModalLabel_1').text('添加新卡');
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