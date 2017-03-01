@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('wxuser-update'))
	<a href="{{ url('/admin/wxuser/update') }}" class="btn-green f-l">[ 同步用户 ]</a>
@endif
@endsection

@section('content')

<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th width="80">组名</th>
			<th width="180">昵称</th>
			<th width="180">备注</th>
			<th width="80">性别</th>
			<th>地址</th>
			<th width="200">关注时间</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>
				@if($a->group_id == 0)
				<span class="color-green">未分组</span>
				@else
				<span class="color-blue">{{ $a->group->name }}</span>
				@endif
			</td>
			<td>{{ $a->nickname }}</td>
			<td>{{ $a->remark }}</td>
			<td>
				@if($a->sex == 1)
				<span class="color-green">男</span>
				@else
				<span class="color-blue">女</span>
				@endif
			</td>
			<td>{{ $a->country }} - {{ $a->province }} - {{ $a->city }}</td>
			<td>{{ date('Y-m-d H:i:s',$a->subscribe_time) }}</td>
			<td>
				@if(App::make('com')->ifCan('wxuser-remark'))
				<a href="{{ url('/admin/wxuser/remark',$a->id) }}">备注</a>
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