@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('type-add'))
	<a href="{{ url('/admin/type/add/0') }}" class="btn-green f-l">[ 添加分类 ]</a>
	@endif
@endsection


@section('content')

<table class="pure-table">
	<thead>
		<tr>
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
@endsection