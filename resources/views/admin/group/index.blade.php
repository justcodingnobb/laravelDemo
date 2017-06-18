@extends('admin.right')

@if(App::make('com')->ifCan('group-add'))
@section('rmenu')
	<div data-url="{{ url('/xyshop/group/add') }}" data-title="添加用户组" data-toggle='modal' data-target='#myModal' class="btn btn-info btn_modal">添加用户组</div>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="200">用户组</th>
			<th width="200">所需积分</th>
			<th>折扣</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->name }}</td>
			<td>{{ $m->points }}</td>
			<td class="text-success">{{ $m->discount }}%</td>
			<td>
				@if(App::make('com')->ifCan('group-edit'))
				<div data-url="{{ url('/xyshop/group/edit',$m->id) }}" data-title="修改" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-info btn_modal">修改</div>
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