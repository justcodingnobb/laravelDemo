@extends('admin.right')

@if(App::make('com')->ifCan('section-add'))
@section('rmenu')
	<a href="{{ url('/admin/section/add') }}" class="btn-green f-l">[ 添加部门 ]</a>
@endsection
@endif

@section('content')
<table class="pure-table">
	<thead>
		<tr>
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
				<a href="{{ url('/admin/section/edit',$m->id) }}">修改</a>
				@endif
				@if(App::make('com')->ifCan('section-del'))
				 | <a href="{{ url('/admin/section/del',$m->id) }}" class="confirm">删除</a>
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