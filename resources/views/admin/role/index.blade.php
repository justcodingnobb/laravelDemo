@extends('admin.right')

@if(App::make('com')->ifCan('role-add'))
@section('rmenu')
	<div data-url="{{ url('/xyshop/role/add') }}" data-title="添加角色" data-toggle='modal' data-target='#myModal' class="btn btn-info btn_modal">添加角色</div>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th>角色名</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->name }}</td>
			<td>
				@if($m->status == 1)
				<span class="color-green">正常</span>
				@else
				<span class="color-red">禁用</span>
				@endif
			</td>
			<td>
				<!-- 超管有所有权限 -->
				@if((session('user')->id == 1 || App::make('com')->ifCan('role-priv')) && $m->id != 1)
				<a href="{{ url('/xyshop/role/priv',$m->id) }}" class="btn btn-sm btn-info">权限管理</a>
				@endif
				<!-- @if(App::make('com')->ifCan('role-catepriv') && $m->id != 1)
				<a href="{{ url('/xyshop/role/catepriv',$m->id) }}" class="btn btn-sm btn-info">栏目权限</a>
				@endif -->
				@if(App::make('com')->ifCan('role-edit'))
				<div data-url="{{ url('/xyshop/role/edit',$m->id) }}" data-title="修改" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-warning btn_modal">修改</div>
				@endif
				@if(App::make('com')->ifCan('role-del') && $m->id != 1)
				<a href="{{ url('/xyshop/role/del',$m->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
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