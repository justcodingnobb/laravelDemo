@extends('admin.right')

@if(App::make('com')->ifCan('log-del'))
@section('rmenu')
	<a href="{{ url('/admin/log/del') }}" class="btn-green f-l">[ 清除七天前日志 ]</a>
@endsection
@endif

@section('content')
@if(session('user')->id == session('user')->saas_id)
<!-- 按用户查看 -->
<div class="select-cat clearfix">
	<form action="" class="pure-form" method="get">
		<select name="admin_id" id="admin_id">
			<option value="">请选择</option>
			@foreach($admins as $a)
			<option value="{{ $a->id }}">{{ $a->name }} - {{ $a->realname }}</option>
			@endforeach
		</select>
		<button class="pure-button pure-button-secondary">查找</button>
	</form>
</div>
@endif
<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th width="120">用户</th>
			<th>url</th>
			<th width="180">插入时间</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>{{ $a->user }}</td>
			<td>{{ $a->url }}</td>
			<td>{{ $a->created_at }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
</div>
@endsection