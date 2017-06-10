@extends('admin.right')


@section('content')


<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="100">姓名</th>
			<th width="120">电话</th>
			<th>地址</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->people }}</td>
			<td>{{ $m->phone }}</td>
			<td>{{ $m->area }}{{ $m->address }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
</div>

@endsection