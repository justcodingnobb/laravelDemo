@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('cate-add'))
	<a href="{{ url('/xycmf/cate/add/0') }}" class="btn btn-info">添加栏目</a>
	@endif
	@if(App::make('com')->ifCan('cate-cache'))
	<a href="{{ url('/xycmf/cate/cache') }}" class="btn btn-info">更新栏目缓存</a>
	@endif
@endsection


@section('content')

<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>菜单名称</td>
			<td>类型</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	{!! $treeHtml !!}
	</tbody>
</table>
@endsection