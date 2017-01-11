@extends('admin.right')

@if(App::make('com')->ifCan('admin-add'))
@section('rmenu')
	<a href="{{ url('/admin/admin/add') }}" class="btn-green f-l">[ 添加用户 ]</a>
@endsection
@endif

@section('content')

<!-- 选出栏目 -->
<div class="select-cat clearfix">
	<form action="" class="pure-form f-l" method="get">
		<input type="text" name="q" placeholder="请输入用户名或姓名..">
		<button class="pure-button pure-button-secondary">搜索</button>
	</form>
</div>

<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th>用户名</th>
			<th>部门</th>
			<th>角色</th>
			<th>真实姓名</th>
			<th>Email</th>
			<th>电话</th>
			<th>最后登陆</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->name }}</td>
			<td>{{ $m->section->name }}</td>
			<td>
				@if($m->role->count() > 0 )
				@foreach($m->role as $r)
				{{ $r->name }} | 
				@endforeach
				@endif
			</td>
			<td>{{ $m->realname }}</td>
			<td>{{ $m->email }}</td>
			<td>{{ $m->phone }}</td>
			<td>{{ $m->lasttime }}</td>
			<td>
				@if($m->status == 1)
				<span class="color-green">正常</span>
				@else
				<span class="color-red">禁用</span>
				@endif
			</td>
			<td>
				@if(App::make('com')->ifCan('admin-edit'))
				<a href="{{ url('/admin/admin/edit',$m->id) }}">修改资料</a>
				@endif
				@if(App::make('com')->ifCan('admin-pwd'))
				 | <a href="{{ url('/admin/admin/pwd',$m->id) }}">修改密码</a>
				@endif
				@if($m->id != 1 && App::make('com')->ifCan('admin-del'))
				 | <a href="{{ url('/admin/admin/del',$m->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->appends(['q'=>$key])->links() !!}
</div>
@endsection