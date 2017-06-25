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
<form action="" class="form-inline form_submit" method="get">
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="30"><input type="checkbox" class="checkall"></th>
			<th width="80">排序</th>
			<th width="50">ID</th>
			<th>标题</th>
			<th width="100">分类</th>
			<th width="100">价格</th>
			<th width="100">库存</th>
			<th width="80">状态</th>
			<th width="180">修改时间</th>
			<th width="280">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td><input type="checkbox" name="sids[]" class="check_s" value="{{ $a->id }}"></td>
			<td><input type="text" min="0" name="sort[{{$a->id}}]" value="{{ $a->sort }}" class="form-control input-listorder"></td>
			<td>{{ $a->id }}</td>
			<td>
				<img src="{{ $a->thumb }}" width="100" height="auto" class="img-responsive pull-left img-rounded mr10" alt="">
				@if($a->tags == '')
				<span class="text-danger">{{ $a->tags }}</span>
				@endif
				@if($a->isxs == 1)
				<span class="text-primary">[限时]</span>
				@endif
				@if($a->isxl == 1)
				<span class="text-success">[限量]</span>
				@endif
				{{ $a->title }}
			</td>
			<td>@if(isset(cache('goodcateCache')[$a->cate_id])){{ cache('goodcateCache')[$a->cate_id]['name'] }}@endif</td>
			<td>￥{{ $a->price }}</td>
			<td>{{ $a->store }}</td>
			<td>
				@if($a->status == 1)
				<span class="color-green">在售</span>
				@elseif($a->status == 0)
				<span class="color-warning">下架</span>
				@endif
			</td>
			<td>{{ $a->updated_at }}</td>
			<td>
				@if(App::make('com')->ifCan('good-edit'))
				<a href="{{ url('/xyshop/good/edit',$a->id) }}" class="btn btn-sm btn-info">修改</a>
				@endif
				@if(App::make('com')->ifCan('manzeng-add'))
				<div data-url="{{ url('/xyshop/manzeng/add',['id'=>$a->id]) }}" class="btn btn-sm btn-success btn_manzeng" data-toggle="modal" data-target="#myModal">满赠</div>
				@endif
				@if(App::make('com')->ifCan('tuan-add'))
				<div data-url="{{ url('/xyshop/tuan/add',['id'=>$a->id]) }}" class="btn btn-sm btn-primary btn_tuan" data-toggle="modal" data-target="#myModal">团购</div>
				@endif
				<a href="{{ url('/shop/good',['id'=>$a->id]) }}" target="_blank" class="btn btn-sm btn-warning">查看</a>
				@if(App::make('com')->ifCan('good-del') && $a->status == 0)
				<a href="{{ url('/xyshop/good/del',['id'=>$a->id,'status'=>1]) }}" class="confirm btn btn-sm btn-danger">上架</a>
				@endif
				@if(App::make('com')->ifCan('good-del') && $a->status == 1)
				<a href="{{ url('/xyshop/good/del',['id'=>$a->id,'status'=>0]) }}" class="confirm btn btn-sm btn-danger">下架</a>
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
	
	<select name="cate_id" id="catid" class="form-control">
		<option value="">请选择栏目</option>
		{!! $cate !!}
	</select>
	
	@if(App::make('com')->ifCan('good-allcate'))
	<span class="btn btn-info btn_allcate">修改分类</span>
	@endif


	@if(App::make('com')->ifCan('good-sort'))
	<span class="btn btn-warning btn_sort">排序</span>
	@endif

	@if(App::make('com')->ifCan('huodong-good'))
	<span class="btn btn-success btn_huodong" data-toggle="modal" data-target="#myModal_hd">添加到活动</span>
	@endif


	@if(App::make('com')->ifCan('good-allstatus'))
	<span class="btn btn-info btn_allstatus_1">批量上架</span>
	@endif
	<input type="hidden" name="status" class="allstatus">

	@if(App::make('com')->ifCan('good-allstatus'))
	<span class="btn btn-warning btn_allstatus_2">批量下架</span>
	@endif

	@if(App::make('com')->ifCan('good-alldel'))
	<span class="btn btn-danger btn_del">批量删除</span>
	@endif
</div>
</form>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
	<div class="pull-left mr10 mt5">总共 {{ $count }} 条</div>
	{!! $list->appends(['cate_id' =>$cate_id,'q'=>$key,'status'=>$status,'starttime'=>$starttime,'endtime'=>$endtime])->links() !!}
</div>


<div class="modal fade" id="myModal_hd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      	<iframe src="" id="hd_good2" frameborder="0" width="100%" height="600" scrolling="auto" allowtransparency="true"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel_1"></h4>
      </div>
      <div class="modal-body" id="hd_good">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button class="btn btn-primary" id="dosubmit">提交</button>
      </div>
    </div>
  </div>
</div>


<!-- 选中当前栏目 -->
<script>
	$(function(){
		// 下、上架
		$('.btn_allcate').click(function(){
			if (!confirm("确实要修改分类吗?")){
				return false;
			}else{
				$('.form_submit').attr({'action':"{{ url('/xyshop/good/allcate') }}",'method':'post'}).submit();
			}
		});
		// 下、上架
		$('.btn_allstatus_2').click(function(){
			if (!confirm("确实要下架吗?")){
				return false;
			}else{
				$('.allstatus').val('0');
				$('.form_submit').attr({'action':"{{ url('/xyshop/good/allstatus') }}",'method':'post'}).submit();
			}
		});
		$('.btn_allstatus_1').click(function(){
			if (!confirm("确实要上架吗?")){
				return false;
			}else{
				$('.allstatus').val('1');
				$('.form_submit').attr({'action':"{{ url('/xyshop/good/allstatus') }}",'method':'post'}).submit();
			}
		});

		$("#dosubmit").on('click',function(){
			var postData = $('#form-tuan').serializeArray();
			var url = $("#form-tuan").attr('action');
			$.ajax({
                url: url,
                type: "POST",
                data: postData,
                success: function(d) {
	                if (!d) {
	                	alert(d)
	                }
	                else
	                {
	                	$('#myModal').modal('hide');
	                	alert('添加成功');
	                }
                },
                error: function(data){
                	// 提示信息转为json对象，并弹出提示
				    var errors = $.parseJSON(data.responseText);
				    $.each(errors, function(index, value) {
				    	alert(value);
				    	return false;
				    });
				}
            });
		});
		$('.btn_sort').click(function(){
			$('.form_submit').attr({'action':"{{ url('/xyshop/good/sort') }}",'method':'post'}).submit();
		});
		// 活动
		$('.btn_huodong').click(function(){
			// 取到商品ID
			var gids = '';
			$('.check_s').each(function(s){
				if($(this).is(":checked"))
				{
					gids += $(this).val() + '|';
				}
			});
			if (gids == '') {
				alert('请先选择商品！');
				return false;
			}
			var url = "{{ url('xyshop/huodong/good') }}" + '/' + gids;
			$('#hd_good2').attr("src","{{ url('xyshop/huodong/good') }}" + '/' + gids);
			$('#myModalLabel').text('活动');
			return;
		});
		// 满赠
		$('.btn_manzeng').click(function(){
			var url = $(this).attr('data-url');
			$('#hd_good').load(url,function(){
				laydate({
			        elem: '#laydate_t_1',
			        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
			        istime: true,
			    });
			    laydate({
			        elem: '#laydate_t_2',
			        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
			        istime: true,
			    });
			});
			$('#myModalLabel_1').text('添加满赠');
			return;
		});
		// 团购
		$('.btn_tuan').click(function(){
			var url = $(this).attr('data-url');
			$('#hd_good').load(url,function(){
				laydate({
			        elem: '#laydate_t_1',
			        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
			        istime: true,
			    });
			    laydate({
			        elem: '#laydate_t_2',
			        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
			        istime: true,
			    });
			});
			
			$('#myModalLabel_1').text('添加团购');
			return;
		});
		$('.btn_del').click(function(){
			if (!confirm("确实要删除吗?")){
				return false;
			}else{
				$('.form_submit').attr({'action':"{{ url('/xyshop/good/alldel') }}",'method':'post'}).submit();
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