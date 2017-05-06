@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('good-add'))
	<a href="{{ url('/xyshop/good/add',$cate_id) }}" class="btn btn-info">添加商品</a>
@endif

@endsection


@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form-inline pull-left" method="get">
		<select name="cate_id" id="catid" class="form-control">
			<option value="">请选择栏目</option>
			{!! $cate !!}
		</select>
		<select name="status" id="status" class="form-control">
			<option value="">请选择状态</option>
			<option value="0">下架</option>
			<option value="1">在售</option>
		</select>
		开始时间：<input type="text" name="starttime" class="form-control" value="" id="laydate">
		结束时间：<input type="text" name="endtime" class="form-control" value="" id="laydate2">
		<button class="btn btn-info">查找</button>
	</form>

	<form action="" class="form-inline pull-right" method="get">
		<input type="hidden" name="cate_id" value="{{ $cate_id }}">
		<input type="text" name="q" class="form-control" placeholder="请输入商品标题关键字..">
		<button class="btn btn-info">搜索</button>
	</form>
</div>
<form action="" class="form-inline" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="30"><input type="checkbox" class="checkall"></th>
			<th width="50">ID</th>
			<th>标题</th>
			<th width="100">分类</th>
			<th width="80">状态</th>
			<th width="180">修改时间</th>
			<th width="200">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td><input type="checkbox" name="sids[]" class="check_s" value="{{ $a->id }}"></td>
			<td>{{ $a->id }}</td>
			<td>{{ $a->title }}</td>
			<td>{{ cache('goodcateCache')[$a->cate_id]['name'] }}</td>
			<td>
				@if($a->status == 1)
				<span class="color-green">在售</span>
				@elseif($a->status == 0)
				<span class="color-warning">下架</span>
				@endif
			</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('good-format'))
				<a href="{{ url('/xyshop/good/format',['id'=>$a->id]) }}" class="btn btn-sm btn-warning">属性</a>
				@endif
				@if(App::make('com')->ifCan('good-edit'))
				<a href="{{ url('/xyshop/good/edit',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('good-del'))
				<a href="{{ url('/xyshop/good/del',$a->id) }}" class="confirm btn btn-sm btn-danger">下架</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 添加进专题功能 -->
<div class="pull-left" data-toggle="buttons">
	<label class="btn btn-primary">
			<input type="checkbox" autocomplete="off" class="checkall">全选</label>

	@if(App::make('com')->ifCan('good-alldel'))
	<span class="btn btn-danger">批量删除</span>
	@endif
</div>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
<div class="pull-right page-div">
<form action="" class="form-inline" method="get">
<input type="hidden" name="cate_id" value="{{ $cate_id }}">
<input type="text" name="page" class="form-control input-listorder">
<button class="btn btn-info">跳转</button>
</form>
</div>
{!! $list->appends(['cate_id' =>$cate_id,'q'=>$key,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>
<!-- 选中当前栏目 -->
<script>
	$(function(){
		$('.btn_listrorder').click(function(){
			$('.form_status').attr({'action':"{{ url('admin/art/listorder') }}",'method':'post'}).submit();
		});
		$('.btn_del').click(function(){
			if (!confirm("确实要删除吗?")){
				return false;
			}else{
				$('.form_status').attr({'action':"{{ url('admin/art/alldel') }}",'method':'post'}).submit();
			}
		});
		$(".checkall").bind('change',function(){
			if($(this).is(":checked"))
			{
				$(".check_s").each(function(s){
					$(".check_s").eq(s).prop("checked",true);
				});
			}
			else
			{
				$(".check_s").each(function(s){
					$(".check_s").eq(s).prop("checked",false);
				});
			}
		});
		$('#catid option[value=' + {{ $cate_id }} + ']').prop('selected','selected');
	})
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