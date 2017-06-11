@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            <label for="good_cate_id">商品分类：<span class="color-red">*</span></label>
            <select name="data[good_cate_id]" id="catid" class="form-control">
                <option value="">选择栏目</option>
                {!! $treeHtml !!}
            </select>
            @if ($errors->has('data.good_cate_id'))
                <span class="help-block">
                    {{ $errors->first('data.good_cate_id') }}
                </span>
            @endif
            </div>


            <div class="form-group">
            <label for="name">名称：<span class="color-red">*</span></label>
            <input type="text" name="data[name]" class="form-control" value="{{ $info->name }}">
            @if ($errors->has('data.name'))
                <span class="help-block">
                    {{ $errors->first('data.name') }}
                </span>
            @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
               <label for="search_type">检索：</label>
               <label class="radio-inline"><input type="radio" name="data[search_type]"@if($info->search_type == 0) checked="checked"@endif class="input-radio" value="0">不需要检索 </label>
                <label class="radio-inline"><input type="radio" name="data[search_type]"@if($info->search_type == 1) checked="checked"@endif class="input-radio" value="1">关键字检索</label>
            </div>
            
            <div class="form-group">
               <label for="type">取值方式：</label>
               <label class="radio-inline"><input type="radio" name="data[type]"@if($info->type == 0) checked="checked"@endif class="input-radio" value="0">唯一属性</label>
                <label class="radio-inline"><input type="radio" name="data[type]"@if($info->type == 1) checked="checked"@endif class="input-radio" value="1">单选</label>
                <label class="radio-inline"><input type="radio" name="data[type]"@if($info->type == 2) checked="checked"@endif class="input-radio" value="2">多选</label>
            </div>

            <div class="form-group">
               <label for="input_type">录入方式：</label>
               <label class="radio-inline"><input type="radio" name="data[input_type]"@if($info->input_type == 0) checked="checked"@endif class="input-radio" value="0">手工录入</label>
                <label class="radio-inline"><input type="radio" name="data[input_type]"@if($info->input_type == 1) checked="checked"@endif class="input-radio" value="1">从列表中选择</label>
                <label class="radio-inline"><input type="radio" name="data[input_type]"@if($info->input_type == 2) checked="checked"@endif class="input-radio" value="2">多行文本框</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            <label for="value">可选值列表：<span class="text-info small">录入方式为手工或者多行文本时，此输入框不需填写。</span></label>
            <textarea name="data[value]" class="form-control" rows="5">{{ str_replace('，',PHP_EOL,$info->value) }}</textarea>
            @if ($errors->has('data.value'))
                <span class="help-block">
                    {{ $errors->first('data.value') }}
                </span>
            @endif
            </div>

            <div class="form-group">
            <label for="sort">排序：</label>
            <input type="text" name="data[sort]" class="form-control" value="{{ $info->sort }}" />
            @if ($errors->has('data.sort'))
                <span class="help-block">
                    {{ $errors->first('data.sort') }}
                </span>
            @endif
            </div>
        	
            <div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#catid option[value=' + {{ $info->good_cate_id }} + ']').prop('selected','selected');
    })
</script>
@endsection