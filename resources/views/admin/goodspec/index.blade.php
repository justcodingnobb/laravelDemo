@extends('admin.right')

@if(App::make('com')->ifCan('goodspec-add'))
@section('rmenu')
	<div data-url="{{ url('/xyshop/goodspec/add') }}" data-title="添加商品规格" data-toggle='modal' data-target='#myModal' class="btn btn-info btn_modal">添加商品规格</div>
@endsection
@endif

@section('content')
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="150">商品分类</th>
			<th width="150">名称</th>
			<th>规格项</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>@if(!is_null($m->goodcate)){{ $m->goodcate->name }}@endif</td>
			<td>{{ $m->name }}</td>
			<td>
				@foreach($m->goodspecitem as $k => $v)
				@if($k != 0)，@endif{{ $v->item }}
				@endforeach
			</td>
			<td>
				@if(App::make('com')->ifCan('goodspec-edit'))
				<div data-url="{{ url('/xyshop/goodspec/edit',$m->id) }}" data-title="修改" data-toggle='modal' data-target='#myModal' class="btn btn-sm btn-info btn_modal">修改</div>
				@endif
				@if(App::make('com')->ifCan('goodspec-del'))
				<a href="{{ url('/xyshop/goodspec/del',$m->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
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