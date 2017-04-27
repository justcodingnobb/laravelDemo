@extends('admin.right')


@section('content')

<div class="clearfix">
	<form action="" class="form-inline" method="get">
		<input type="text" name="q" class="form-control" placeholder="请输入用户名、邮箱、电话查询..">
		<button class="btn btn-sm btn-info">搜索</button>
	</form>
</div>

<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th>会员名</th>
			<th>昵称</th>
			<th>邮箱</th>
			<th>电话</th>
			<th>最后登陆时间</th>
			<th>最后登陆IP</th>
			<th>修改状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->username }}</td>
			<td>{{ $m->nickname }}</td>
			<td>{{ $m->email }}</td>
			<td>{{ $m->phone }}</td>
			<td>{{ $m->last_time }}</td>
			<td>{{ $m->last_ip }}</td>
			<td>
				@if($m->status == 0)
				<span class="color-red">禁用</span> -> <a href="{{ url('/xycmf/user/status',['id'=>$m->id,'status'=>1]) }}" class="color-green">正常</a>
				@else
				<span class="color-green">正常</span> -> <a href="{{ url('/xycmf/user/status',['id'=>$m->id,'status'=>0]) }}" class="color-red">禁用</a>
				@endif
			</td>
			<td>
				@if(App::make('com')->ifCan('user-edit'))
				<a href="{{ url('/xycmf/user/edit',$m->id) }}" class="btn btn-sm btn-info">修改</a>
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