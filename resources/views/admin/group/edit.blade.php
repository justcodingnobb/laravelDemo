<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
	<div class="form-group">
		<label for="name">会员组名称：<span class="color-red">*</span></label>
		<input type="text" name="data[name]" class="form-control" value="{{ $info['name'] }}">
	</div>

	<div class="form-group">
		<label for="points">所需积分：<span class="color-red">*</span></label>
		<input type="number" name="data[points]" class="form-control" value="{{ $info['points'] }}">
	</div>

	<div class="form-group">
		<label for="discount">折扣：<span class="color-red">*</span>单位 %</label>
		<input type="number" name="data[discount]" class="form-control" value="{{ $info['discount'] }}">
	</div>

	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/group/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>