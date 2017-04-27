@extends('admin.right')


@section('rmenu')
	@if(App::make('com')->ifCan('goodcate-add'))
	<a href="{{ url('/xyshop/goodcate/add/0') }}" class="btn btn-info">添加商品分类</a>
	@endif
	@if(App::make('com')->ifCan('goodcate-cache'))
	<a href="{{ url('/xyshop/goodcate/cache') }}" class="btn btn-info">更新分类缓存</a>
	@endif
@endsection


@section('content')

<p class="alert alert-danger">理论上是无限级的分类，但是最好不要超过二级</p>

<table class="table table-striped table-hover">
	<thead>
		<tr class="success">
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>分类名称</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	{!! $treeHtml !!}
	</tbody>
</table>
@endsection