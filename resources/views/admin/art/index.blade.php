@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('art-add'))
	<a href="{{ url('/admin/art/add',$catid) }}" class="btn-green f-l">[ 添加文章 ]</a>
@endif

@endsection


@section('content')
<!-- 选出栏目 -->
<div class="select-cat clearfix">
	<form action="" class="pure-form f-l" method="get">
		<select name="catid" id="catid">
			<option value="">请选择栏目</option>
			{!! $cate !!}
		</select>
		<select name="status" id="status">
			<option value="">请选择状态</option>
			<option value="0">删除</option>
			<option value="1">发布</option>
		</select>
		开始时间：<input type="text" name="starttime" value="" id="laydate">
		结束时间：<input type="text" name="endtime" value="" id="laydate2">
		<button class="pure-button pure-button-secondary">查找</button>
	</form>

	<form action="" class="pure-form f-r" method="get">
		<input type="hidden" name="catid" value="{{ $catid }}">
		<input type="text" name="q" placeholder="请输入文章标题关键字..">
		<button class="pure-button pure-button-secondary">搜索</button>
	</form>
</div>
<form action="" class="pure-form form_status pure-form-stacked" method="get">
{{ csrf_field() }}
<table class="pure-table">
	<thead>
		<tr>
			<th width="30"><input type="checkbox" class="checkall"></th>
			<th width="60">排序</th>
			<th width="50">ID</th>
			<th>标题</th>
			<th width="100">栏目</th>
			<th width="80">状态</th>
			<th width="180">修改时间</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td><input type="checkbox" name="sids[]" class="check_s" value="{{ $a->id }}"></td>
			<td><input type="text" name="listorder[{{ $a->id }}]" class="input-listorder" value="{{ $a->listorder }}"></td>
			<td>{{ $a->id }}</td>
			<td><a href="{{ url('/admin/art/show',$a->id) }}" target="_blank">{{ $a->title }}</a>@if($a->thumb != '') <span class="color-red">图</span>@endif @if($a->ispos == 1) <span class="color-green">荐</span>@endif</td>
			<td>{{ $a->cate->name }}</td>
			<td>
				@if($a->status == 1)
				<span class="color-secondary">发布</span>
				@elseif($a->status == 0)
				<span class="color-warning">删除</span>
				@endif
			</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('art-edit'))
				<a href="{{ url('/admin/art/edit',$a->id) }}">修改</a> | 
				@endif
				@if(App::make('com')->ifCan('art-del'))
				<a href="{{ url('/admin/art/del',$a->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 添加进专题功能 -->
<div class="special_div f-l clearfix">
	<span class="f-l mr10"><input type="checkbox" class="checkall"> 全选</span>

	@if(App::make('com')->ifCan('art-listorder'))
	<button type="submit" name="dosubmit" class="pure-button btn_listrorder pure-button-success pure-button-small" data-status="0">排序</button> 
	@endif

	@if(App::make('com')->ifCan('art-alldel'))
	<span class="pure-button pure-button-error btn_del pure-button-small">批量删除</span>
	@endif
</div>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
<span class="f-r">共 {{ $list->total() }} 篇文章</span>
<!-- 页面跳转 -->
<div class="f-r page-div">
<form action="" method="get">
<input type="hidden" name="catid" value="{{ $catid }}">
<input type="text" name="page" class="page-submit">
<button class="pure-button pure-button-small">跳转</button>
</form>
</div>
{!! $list->appends(['catid' =>$catid,'q'=>$key,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>
<!-- 选中当前栏目 -->
<script src="{{ $sites['url'] }}{{ $sites['static']}}common/laydate/laydate.js"></script>
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
		$('#catid option[value=' + {{ $catid }} + ']').prop('selected','selected');
	})
	laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        festival: true,
        istoday: false,
        max: laydate.now(), //最大日期
        start: laydate.now('0, "YYYY-MM-DD hh:00:00"'),
        istime: false,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        festival: true,
        istoday: false,
        max: laydate.now(), //最大日期
        start: laydate.now('0, "YYYY-MM-DD hh:00:00"'),
        istime: false,
    });
</script>
@endsection