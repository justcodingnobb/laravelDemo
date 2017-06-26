@extends('admin.right')

@if(App::make('com')->ifCan('goodattr-add'))
@section('rmenu')
	<div data-url="{{ url('/xyshop/goodattr/add') }}" data-title="添加商品属性" data-toggle='modal' data-target='#myModal' class="btn btn-info btn_modal">添加商品属性</div>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="150">商品分类</th>
			<th width="150">属性名</th>
			<th>值</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>@if(!is_null($m->goodcate)){{ $m->goodcate->name }}@endif</td>
			<td>{{ $m->name }}</td>
			<td>{{ $m->value }}</td>
			<td>
				@if(App::make('com')->ifCan('goodattr-edit'))
				<div data-url="{{ url('/xyshop/goodattr/edit',$m->id) }}" data-title="修改" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-info btn_modal">修改</div>
				@endif
				@if(App::make('com')->ifCan('goodattr-del'))
				<a href="{{ url('/xyshop/goodattr/del',$m->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
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