@extends('admin.right')


@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="120">支付方式</th>
			<th width="120">Code</th>
			<th>介绍</th>
			<th width="120">状态</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->name }}</td>
			<td>{{ $m->code }}</td>
			<td>{{ $m->content }}</td>
			<td>
				@if($m->paystatus == 1)
				<span class="color-green">开启</span>
				@else
				<span class="color-red">关闭</span>
				@endif
			</td>
			<td>
				@if(App::make('com')->ifCan('pay-edit'))
				<a href="{{ url('/admin/pay/edit',$m->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection