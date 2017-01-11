@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('cate-add'))
	<a href="{{ url('/admin/cate/add/0') }}" class="btn-green f-l">[ 添加栏目 ]</a>
	@endif
	@if(App::make('com')->ifCan('cate-cache'))
	<a href="{{ url('/admin/cate/cache') }}" class="btn-green f-l">[ 更新栏目缓存 ]</a>
	@endif
@endsection


@section('content')

<table class="pure-table">
	<thead>
		<tr>
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