<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
	<div class="form-group">
        <label for="user_money">消费金额：</label>
    	<input type="number" name="data[user_money]" value="0" class="form-control">
    </div>
    <div class="form-group">
        <label for="pwd">用户密码：</label>
        <input type="password" name="pwd" value="" class="form-control">
    </div>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/user/consumed',['id'=>$id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>