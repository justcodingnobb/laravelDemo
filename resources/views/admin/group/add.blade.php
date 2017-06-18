<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
	<div class="form-group">
		<label for="name">会员组名称：<span class="color-red">*</span></label>
		<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
	</div>

	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xycmf/group/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>