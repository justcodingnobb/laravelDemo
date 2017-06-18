@extends('admin.right')

@if(App::make('com')->ifCan('section-add'))
@section('rmenu')
	<div data-url="{{ url('/xyshop/section/add') }}" data-title="添加部门" data-toggle='modal' data-target='#myModal' class="btn btn-info btn_modal">添加部门</div>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th>部门名称</th>
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
				@if(App::make('com')->ifCan('section-edit'))
				<div data-url="{{ url('/xyshop/section/edit',$m->id) }}" data-title="修改" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-info btn_modal">修改</div>
				@endif
				@if(App::make('com')->ifCan('section-del'))
				<a href="{{ url('/xyshop/section/del',$m->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
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