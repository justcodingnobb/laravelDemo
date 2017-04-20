@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('type-add'))
	<a href="{{ url('/admin/type/add',['pid'=>$pid]) }}" class="btn btn-info">添加分类</a>
	@endif
@endsection


@section('content')

<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>分类名称</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $l)
		<tr>
			<td>{{ $l->listorder }}</td>
			<td>{{ $l->id }}</td>
			<td><a href="{{ url('/admin/type/index',['id'=>$l->id]) }}">{{ $l->name }}</a>
				@if(App::make('com')->ifCan('type-add'))
				<a href="{{ url('/admin/type/add',['id'=>$l->id]) }}" class="glyphicon glyphicon-plus add_submenu"></a>
				@endif
			</td>
			<td>
				@if(App::make('com')->ifCan('type-edit'))
				<a href="{{ url('/admin/type/edit',['id'=>$l->id]) }}" class="btn btn-info">修改</a> 
				@endif
				@if(App::make('com')->ifCan('type-del'))
				<a href="{{ url('/admin/type/del',['id'=>$l->id]) }}" class="btn btn-danger confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection