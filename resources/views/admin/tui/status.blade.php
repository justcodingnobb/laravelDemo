<form action="" method="post" id="form_ajax">
    {{ csrf_field() }}
    <div class="form-group">
        <textarea name="data[shopmark]" placeholder="处理意见" class="form-control" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
            退货</label>
        <label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="2">不退货</label>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/returngood/status',['id'=>$id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>