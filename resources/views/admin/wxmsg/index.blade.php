@extends('admin.right')

@if(App::make('com')->ifCan('wxmsg-add'))
@section('rmenu')
	<a href="{{ url('/admin/wxmsg/add') }}" class="btn-green f-l">[ 添加回复 ]</a>
@endsection
@endif

@section('content')

<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th width="120">回复类型</th>
			<th>关键字</th>
			<th>回复标题</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>{{ $type[$a->type] }}</td>
			<td>{{ $a->con }}</td>
			<td>{{ $a->title }}</td>
			<td>
				@if(App::make('com')->ifCan('wxmsg-edit'))
				<a href="{{ url('/admin/wxmsg/edit',$a->id) }}">修改</a> | 
				@endif
				@if(App::make('com')->ifCan('wxmsg-del'))
				<a href="{{ url('/admin/wxmsg/del',$a->id) }}" class="confirm">删除</a>
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