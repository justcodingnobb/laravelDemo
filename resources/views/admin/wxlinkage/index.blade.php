@extends('admin.right')

@if(App::make('com')->ifCan('wxlinkage-add'))
@section('rmenu')
	<a href="{{ url('/admin/wxlinkage/add',$pid) }}" class="btn-green f-l">[ 添加关联 ]</a>
@endsection
@endif

@section('content')

<table class="pure-table">
	<thead>
		<tr>
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>菜单名称</td>
			<td>值</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	@foreach($all as $l)
		<tr>
			<td>{{ $l->listorder }}</td>
			<td>{{ $l->id }}</td>
			<td><a href="{{ url('/admin/wxlinkage/index',$l->id) }}">{{ $l->name }}</a>
				@if(App::make('com')->ifCan('wxlinkage-add'))
				<a href="{{ url('/admin/wxlinkage/add',$l->id) }}" class="fa fa-plus-square add_submenu"></a>
				@endif
			</td>
			<td>{{ $l->val }}</td>
			<td>
				@if(App::make('com')->ifCan('wxlinkage-edit'))
				<a href="{{ url('/admin/wxlinkage/edit',$l->id) }}">修改</a> | 
				@endif
				@if(App::make('com')->ifCan('wxlinkage-del'))
				<a href="{{ url('/admin/wxlinkage/del',$l->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection