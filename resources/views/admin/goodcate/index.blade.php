@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('goodcate-add'))
	<a href="{{ url('/xyshop/goodcate/add/0') }}" class="btn btn-info">添加商品分类</a>
	@endif
	@if(App::make('com')->ifCan('goodcate-cache'))
	<a href="{{ url('/xyshop/goodcate/cache') }}" class="btn btn-info">更新分类缓存</a>
	@endif
@endsection


@section('content')
<p class="alert alert-danger">理论上是无限级的分类，但是最好不要超过二级</p>
<form action="{{ url('/xyshop/goodcate/sort') }}" class="form_submit" method="post">
{{ csrf_field() }}
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="30"><input type="checkbox" class="checkall"></th>
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>分类名称</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	{!! $treeHtml !!}
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pull-left" data-toggle="buttons">
	<label class="btn btn-primary">
	<input type="checkbox" autocomplete="off" class="checkall">全选</label>
	@if(App::make('com')->ifCan('goodcate-sort'))
	<button type="submit" class="btn btn-warning btn_sort">排序</button>
	@endif
</div>
</form>
<script>
	$(function(){
		$('.btn_sort').click(function(){
			$('.form_submit').submit();
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
</script>
@endsection