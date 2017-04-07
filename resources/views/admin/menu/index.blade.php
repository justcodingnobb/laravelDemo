@extends('admin.right')

@if(App::make('com')->ifCan('menu-add'))
@section('rmenu')
	<a href="{{ url('/admin/menu/add') }}" class="btn btn-info">添加菜单</a>
@endsection
@endif

@section('content')

<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>菜单名称</td>
			<td>url</td>
			<td>显示</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	{!! $treeHtml !!}
	</tbody>
</table>
@endsection