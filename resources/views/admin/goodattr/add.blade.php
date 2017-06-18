<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="good_cate_id">商品分类：<span class="color-red">*</span></label>
        <select name="data[good_cate_id]" class="form-control">
            <option value="">选择栏目</option>
            {!! $treeHtml !!}
        </select>
    </div>


    <div class="form-group">
    	<label for="name">名称：<span class="color-red">*</span></label>
    	<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
    </div>
    <div class="form-group">
	   <label for="search_type">检索：</label>
	   <label class="radio-inline"><input type="radio" name="data[search_type]" class="input-radio" value="0">不需要检索 </label>
        <label class="radio-inline"><input type="radio" name="data[search_type]" checked="checked" class="input-radio" value="1">关键字检索</label>
    </div>
    
    <div class="form-group">
       <label for="type">取值方式：</label>
       <label class="radio-inline"><input type="radio" name="data[type]" checked="checked" class="input-radio" value="0">唯一属性</label>
        <label class="radio-inline"><input type="radio" name="data[type]" class="input-radio" value="1">单选</label>
        <label class="radio-inline"><input type="radio" name="data[type]" class="input-radio" value="2">多选</label>
    </div>

    <div class="form-group">
       <label for="input_type">录入方式：</label>
       <label class="radio-inline"><input type="radio" name="data[input_type]" checked="checked" class="input-radio" value="0">手工录入</label>
        <label class="radio-inline"><input type="radio" name="data[input_type]" class="input-radio" value="1">从列表中选择</label>
        <label class="radio-inline"><input type="radio" name="data[input_type]" class="input-radio" value="2">多行文本框</label>
    </div>
    
    <div class="form-group">
        <label for="value">可选值列表：<span class="text-info small">录入方式为手工或者多行文本时，此输入框不需填写。</span></label>
    	<textarea name="data[value]" class="form-control" rows="5">{{ old('data.value') }}</textarea>
    </div>
            
    <div class="form-group">
        <label for="sort">排序：</label>
        <input type="text" name="data[sort]" class="form-control" value="0" />
        @if ($errors->has('data.sort'))
            <span class="help-block">
                {{ $errors->first('data.sort') }}
            </span>
        @endif
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/goodattr/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>