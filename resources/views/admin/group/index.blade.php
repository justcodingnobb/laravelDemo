@extends('admin.right')

@if(App::make('com')->ifCan('group-add'))
@section('rmenu')
	<a href="{{ url('/xyshop/group/add') }}" class="btn btn-info">添加用户组</a>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="200">用户组</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->name }}</td>
			<td>
				@if(App::make('com')->ifCan('group-edit'))
				<a href="{{ url('/xyshop/group/edit',$m->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('group-del'))
				<a href="{{ url('/xyshop/group/del',$m->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
</div>
@endsection