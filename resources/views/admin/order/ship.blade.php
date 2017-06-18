<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
	<div class="form-group">
    	<input type="hidden" name="data[order_id]" value="{{ $id }}">
		<textarea name="data[shopmark]" class="form-control" placeholder="商家备注" rows="5"></textarea>
	</div>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/order/ship',['id'=>$id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>