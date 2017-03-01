@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('wxgroup-add'))
	<a href="{{ url('/admin/wxgroup/add') }}" class="btn-green f-l">[ 添加用户组 ]</a>
@endif
@if(App::make('com')->ifCan('wxgroup-update'))
	<a href="{{ url('/admin/wxgroup/update') }}" class="btn-green f-l">[ 同步用户组 ]</a>
@endif
@endsection

@section('content')

<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th>组名</th>
			<th>用户数量</th>
			<th width="200">创建时间</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>{{ $a->name }}</td>
			<td>{{ $a->count }}</td>
			<td>{{ $a->created_at }}</td>
			<td>
				@if(App::make('com')->ifCan('wxgroup-edit'))
				<a href="{{ url('/admin/wxgroup/edit',$a->id) }}">修改</a> | 
				@endif
				@if(App::make('com')->ifCan('wxgroup-del'))
				<a href="{{ url('/admin/wxgroup/del',$a->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
<span class="f-r">共 {!! $list->count() !!} 页</span>
</div>
@endsection