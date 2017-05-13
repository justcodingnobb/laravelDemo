@extends('admin.right')



@section('content')

<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th>标题</th>
			<th width="100">分类</th>
			<th width="180">修改时间</th>
			<th width="200">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>
				@if($a->isnew == 1)
				<span class="text-danger">[新品]</span>
				@endif
				@if($a->isxs == 1)
				<span class="text-primary">[限时]</span>
				@endif
				@if($a->isxl == 1)
				<span class="text-success">[限量]</span>
				@endif
				{{ $a->title }}
			</td>
			<td>{{ cache('goodcateCache')[$a->cate_id]['name'] }}</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('good-edit'))
				<a href="{{ url('/xyshop/good/edit',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('huodong-rmgood'))
				<a href="{{ url('/xyshop/huodong/rmgood',['id'=>$id,'gid'=>$a->id]) }}" class="confirm btn btn-sm btn-danger">移除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection