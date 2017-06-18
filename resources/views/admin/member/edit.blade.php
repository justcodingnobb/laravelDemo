<form action="javascript:ajax_submit();" method="post" id="form_ajax">
	{{ csrf_field() }}
	
	<div class="form-group">
        <label for="password">密码：<span class="color-red">*</span>6位及以上</label>
        <input type="password" name="data[password]" class="form-control" value="">
    </div>
    <div class="form-group">
        <label for="repassword">重复密码：<span class="color-red">*</span>6位及以上</label>
        <input type="password" name="data[repassword]" class="form-control" value="">
    </div>

	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xycmf/user/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>