<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="prices">金额：<span class="color-red">*</span>数字，每张多少钱</label>
        <input type="number" min="0" name="data[prices]" value="{{ old('data.prices') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="nums">数量：<span class="color-red">*</span>数字，生成多少张</label>
        <input type="number" min="0" name="data[nums]" value="{{ old('data.nums') }}" class="form-control">
    </div>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/card/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>