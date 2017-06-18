<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="area">区域：<span class="color-red">*</span></label>
        <select name="data[area]" id="" class="form-control">
            @foreach($area as $a)
            <option value="{{ $a->name }}" @if($a->name == $info->area) selected="selected"@endif>{{ $a->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('data.area'))
            <span class="help-block">
                {{ $errors->first('data.area') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="address">地址：<span class="color-red">*</span>不超过255字符</label>
        <input type="text" name="data[address]" value="{{ $info->address }}" class="form-control">
        @if ($errors->has('data.address'))
            <span class="help-block">
                {{ $errors->first('data.address') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="phone">电话：<span class="color-red">*</span></label>
        <input type="text" name="data[phone]" value="{{ $info->phone }}" class="form-control">
        @if ($errors->has('data.phone'))
            <span class="help-block">
                {{ $errors->first('data.phone') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="sort">排序：数字</label>
        <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
        @if ($errors->has('data.sort'))
            <span class="help-block">
                {{ $errors->first('data.sort') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
            正常</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/ziti/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>