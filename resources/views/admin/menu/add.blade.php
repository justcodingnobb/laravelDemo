<form action="javascript:ajax_submit();" method="post" id="form_ajax">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $pid }}">
	<div class="form-group">
		<label for="name">
			菜单名称：
			<span class="color-red">*</span>
		</label>
		<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
		@if ($errors->has('data.name'))
		<span class="help-block">{{ $errors->first('data.name') }}</span>
		@endif
	</div>

	<div class="form-group">
		<label for="url">
			URL：
			<span class="color-red">*</span>
			不用添加admin，路由分组名修改时方便修改
		</label>
		<input type="text" name="data[url]" value="{{ old('data.url') }}" class="form-control">
		@if ($errors->has('data.url'))
		<span class="help-block">{{ $errors->first('data.url') }}</span>
		@endif
	</div>
	<div class="form-group">
		<label for="label">
			权限名称：
			<span class="color-red">*</span>
			如 menu-addmenu
		</label>
		<input type="text" name="data[label]" value="{{ old('data.label') }}" class="form-control">
		@if ($errors->has('data.label'))
		<span class="help-block">{{ $errors->first('data.label') }}</span>
		@endif
	</div>

	<div class="form-group">
		<label for="listorder">
			排序：
			<span class="color-red">*</span>
			数字越小越靠前
		</label>
		<input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="form-control">
		@if ($errors->has('data.listorder'))
		<span class="help-block">{{ $errors->first('data.listorder') }}</span>
		@endif
	</div>
	<div class="form-group">
		<label for="display">是否显示：</label>
		<label class="radio-inline"><input type="radio" name="data[display]" checked="checked" class="input-radio" value="1">
			是</label>
		<label class="radio-inline"><input type="radio" name="data[display]" class="input-radio" value="0">否</label>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/menu/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>