@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('huodong-add'))
	<a href="{{ url('/xyshop/huodong/add') }}" class="btn btn-info">添加活动</a>
@endif

@endsection


@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="status" id="status" class="form-control">
			<option value="">请选择状态</option>
			<option value="1">进行中</option>
			<option value="0">关闭</option>
		</select>
		开始时间：<input type="text" name="starttime" class="form-control" value="" id="laydate">
		结束时间：<input type="text" name="endtime" class="form-control" value="" id="laydate2">
		<button class="btn btn-info">查找</button>
	</form>

	<form action="" class="form-inline pull-right" method="get">
		<input type="text" name="q" class="form-control" placeholder="请输入标题关键字..">
		<button class="btn btn-info">搜索</button>
	</form>
</div>
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th>标题</th>
			<th width="80">状态</th>
			<th width="160">开始时间</th>
			<th width="160">结束时间</th>
			<th width="160">修改时间</th>
			<th width="180">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>
				{{ $a->title }}
			</td>
			<td>
				@if($a->status == 1)
				<span class="color-green">进行中</span>
				@else
				<span class="color-warning">关闭</span>
				@endif
			</td>
			<td>{{ $a->starttime }}</td>
			<td>{{ $a->endtime }}</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('huodong-goodlist'))
				<a href="{{ url('/xyshop/huodong/goodlist',$a->id) }}" class="btn btn-sm btn-success">商品</a>
				@endif
				@if(App::make('com')->ifCan('huodong-edit'))
				<a href="{{ url('/xyshop/huodong/edit',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('huodong-del'))
				<a href="{{ url('/xyshop/huodong/del',$a->id) }}" class="confirm btn btn-sm btn-danger">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->appends(['q'=>$key,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>
<!-- 选中当前栏目 -->
<script>
	laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>
@endsection