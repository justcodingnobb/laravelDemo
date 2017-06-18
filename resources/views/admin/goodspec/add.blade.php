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
	   <label for="search_type">筛选：</label>
	   <label class="radio-inline"><input type="radio" name="data[search_type]" class="input-radio" value="0">否</label>
        <label class="radio-inline"><input type="radio" name="data[search_type]" checked="checked" class="input-radio" value="1">是</label>
    </div>


    <div class="form-group">
        <label for="value">规格项：<span class="text-info small">一行为一个规格项</span></label>
    	<textarea name="items" class="form-control" rows="5">{{ old('items') }}</textarea>
    </div>
            
    <div class="form-group">
        <label for="sort">排序：</label>
        <input type="text" name="data[sort]" class="form-control" value="0" />
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/goodspec/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>