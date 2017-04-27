@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('good-addformat'))
	<a href="{{ url('/xyshop/good/addformat',$id) }}" class="btn btn-info">添加属性</a>
@endif

@endsection

@section('content')

<form action="" class="" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="300">属性名称</th>
			<th width="100">属性值</th>
			<th width="80">价格</th>
			<th width="180">库存</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>{{ $a->title }}</td>
			<td>{{ $a->attr_ids }}</td>
			<td>{{ $a->price }}</td>
			<td>{{ $a->store }}</td>
			<td>
				@if(App::make('com')->ifCan('good-editformat'))
				<a href="{{ url('/xyshop/good/editformat',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('good-delformat'))
				<a href="{{ url('/xyshop/good/delformat',$a->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
</div>
@endsection