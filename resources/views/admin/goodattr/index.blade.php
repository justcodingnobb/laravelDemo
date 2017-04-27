@extends('admin.right')

@if(App::make('com')->ifCan('goodattr-add'))
@section('rmenu')
	<a href="{{ url('/xyshop/goodattr/add',['id'=>$pid]) }}" class="btn btn-info">添加商品属性</a>
@endsection
@endif

@section('content')
<p class="alert alert-danger">理论上是无限级的分类，但是最好不要超过二级</p>
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="150">属性名</th>
			<th width="150">值</th>
			<th width="150">单位</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>
			@if($m->parentid == 0)
			<a href="{{ url('xyshop/goodattr/index',['pid'=>$m->id]) }}">{{ $m->name }}</a>
			<a href="{{ url('xyshop/goodattr/add',['id'=>$m->id]) }}" class="fa fa-plus-square add_submenu""></a>
			@else
			{{ $m->name }}
			@endif
			</td>
			<td>{{ $m->value }}</td>
			<td>{{ $m->unit }}</td>
			<td>
				@if(App::make('com')->ifCan('goodattr-edit'))
				<a href="{{ url('/xyshop/goodattr/edit',$m->id) }}" class="btn btn-sm btn-info">修改</a>
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
{!! $list->appends(['pid'=>$pid])->links() !!}
</div>
@endsection