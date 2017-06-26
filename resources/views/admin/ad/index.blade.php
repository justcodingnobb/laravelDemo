@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('ad-add'))
	<a href="{{ url('/xyshop/ad/add') }}" class="btn btn-info">添加广告</a>
@endif

@endsection

@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="status" id="status" class="form-control mr10">
			<option value="">请选择状态</option>
			<option value="1">进行中</option>
			<option value="0">关闭</option>
		</select>
		开始时间：<input type="text" name="starttime" class="form-control mr10" value="" id="laydate">
		到：<input type="text" name="endtime" class="form-control" value="" id="laydate2">
		<button class="btn btn-info">查找</button>
	</form>

	<form action="" class="form-inline pull-right" method="get">
		<input type="text" name="q" class="form-control" placeholder="请输入标题关键字..">
		<button class="btn btn-info">搜索</button>
	</form>
</div>
<form action="" class="form-inline form_submit" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="30"><input type="checkbox" class="checkall"></th>
			<th width="80">排序</th>
			<th width="50">ID</th>
			<th>标题</th>
			<th width="200">图片</th>
			<th width="150">url</th>
			<th width="80">状态</th>
			<th width="160">修改时间</th>
			<th width="180">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td><input type="checkbox" name="sids[]" class="check_s" value="{{ $a->id }}"></td>
			<td><input type="text" min="0" name="sort[{{$a->id}}]" value="{{ $a->sort }}" class="form-control input-listorder"></td>
			<td>{{ $a->id }}</td>
			<td>
				<span class="text-danger">[{{ cache('typeCache')[$a->pos_id]['name'] }}]</span> {{ $a->title }}
			</td>
			<td><img src="{{ $a->thumb }}" width="200" height="auto" alt=""></td>
			<td><a href="{{ $a->url }}" target="_blank">{{ $a->url }}</a></td>
			<td>
				@if($a->status == 1)
				<span class="color-green">进行中</span>
				@else
				<span class="color-warning">关闭</span>
				@endif
			</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('ad-edit'))
				<a href="{{ url('/xyshop/ad/edit',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('ad-del'))
				<a href="{{ url('/xyshop/ad/del',$a->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pull-left" data-toggle="buttons">
	<label class="btn btn-primary">
	<input type="checkbox" autocomplete="off" class="checkall">全选</label>
	
	@if(App::make('com')->ifCan('ad-sort'))
	<span class="btn btn-warning btn_sort">排序</span>
	@endif

	@if(App::make('com')->ifCan('ad-alldel'))
	<span class="btn btn-danger btn_del">批量删除</span>
	@endif
</div>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->appends(['q'=>$key,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>
<!-- 选中当前栏目 -->
<script>
	$(function(){
		$('.btn_sort').click(function(){
			$('.form_submit').attr({'action':"{{ url('/xyshop/ad/sort') }}",'method':'post'}).submit();
		});
		$('.btn_del').click(function(){
			if (!confirm("确实要删除吗?")){
				return false;
			}else{
				$('.form_submit').attr({'action':"{{ url('/xyshop/ad/alldel') }}",'method':'post'}).submit();
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
	});
	laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>
@endsection