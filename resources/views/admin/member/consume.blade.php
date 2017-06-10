@extends('admin.right')


@section('content')


<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="220">备注</th>
			<th>金额变动情况</th>
			<th>消费时间</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->mark }}</td>
			<td><span class="text-danger">@if($m->type == 1)+@else-@endif</span>{{ $m->price }}</td>
			<td>{{ $m->created_at }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
</div>

@endsection