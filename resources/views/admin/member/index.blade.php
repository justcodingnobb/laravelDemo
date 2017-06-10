@extends('admin.right')


@section('content')

<div class="clearfix">
	<form action="" class="form-inline" method="get">
		<input type="text" name="q" class="form-control" placeholder="请输入用户名、邮箱、电话查询..">
		<button class="btn btn-sm btn-info">搜索</button>
	</form>
</div>

<table class="table table-striped table-hover mt10">
	<thead>
		<tr class="success">
			<th width="50">ID</th>
			<th width="100">会员名</th>
			<th width="140">OpenID</th>
			<th width="120">昵称</th>
			<th width="220">邮箱</th>
			<th width="220">电话</th>
			<th>余额</th>
			<th>积分</th>
			<th>最后登陆时间</th>
			<th>修改状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $m)
		<tr>
			<td>{{ $m->id }}</td>
			<td>{{ $m->username }}</td>
			<td>{{ $m->openid }}</td>
			<td>{{ $m->nickname }}</td>
			<td>{{ $m->email }}</td>
			<td>{{ $m->phone }}</td>
			<td>{{ $m->user_money }} ￥</td>
			<td>{{ $m->points }}</td>
			<td>{{ $m->last_time }}</td>
			<td>
				@if($m->status == 0)
				<span class="color-red">禁用</span> -> <a href="{{ url('/xyshop/user/status',['id'=>$m->id,'status'=>1]) }}" class="color-green">正常</a>
				@else
				<span class="color-green">正常</span> -> <a href="{{ url('/xyshop/user/status',['id'=>$m->id,'status'=>0]) }}" class="color-red">禁用</a>
				@endif
			</td>
			<td>
				@if(App::make('com')->ifCan('user-chong'))
				<div data-url="{{ url('/xyshop/user/chong',$m->id) }}" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-success btn_chong">充值</div>
				@endif
				@if(App::make('com')->ifCan('user-edit'))
				<a href="{{ url('/xyshop/user/edit',$m->id) }}" class="btn btn-sm btn-info">改密码</a>
				@endif
				@if(App::make('com')->ifCan('user-consume'))
				<a href="{{ url('/xyshop/user/consume',$m->id) }}" class="btn btn-sm btn-warning">消费记录</a>
				@endif
				@if(App::make('com')->ifCan('user-address'))
				<a href="{{ url('/xyshop/user/address',$m->id) }}" class="btn btn-sm btn-info">收货地址</a>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">充值</h4>
      </div>
      <div class="modal-body">
      	<iframe src="" id="hd_good" frameborder="0" width="100%" height="600" scrolling="auto" allowtransparency="true"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(function(){
		// 满赠
		$('.btn_chong').click(function(){
			var url = $(this).attr('data-url');
			$('#hd_good').attr("src",url);
			return;
		});
	})
</script>
@endsection