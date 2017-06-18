<form action="" method="post" id="form_ajax">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">
            用户名：
            <span class="color-red">*</span>
        </label>
        {{ $info->name }}
    </div>
    
    <div class="form-group">
        <label for="name">新密码：<span class="color-red">*</span></label>
        <input type="password" name="data[password]" class="form-control" value="{{ old('data.password') }}">
    </div>
    <div class="form-group">
        <label for="name">确认密码：<span class="color-red">*</span></label>
        <input type="password" name="data[password_confirmation]" class="form-control" value="{{ old('data.password_confirmation') }}">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xycmf/admin/pwd',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>