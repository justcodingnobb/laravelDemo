@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            <label for="good_cate_id">商品分类：<span class="color-red">*</span></label>
            <select name="data[good_cate_id]" class="form-control">
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
        	<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
        	@if ($errors->has('data.name'))
                <span class="help-block">
                	{{ $errors->first('data.name') }}
                </span>
            @endif
            </div>


            <div class="form-group">
        	   <label for="search_type">筛选：</label>
        	   <label class="radio-inline"><input type="radio" name="data[search_type]" class="input-radio" value="0">否</label>
                <label class="radio-inline"><input type="radio" name="data[search_type]" checked="checked" class="input-radio" value="1">是</label>
            </div>


            <div class="form-group">
            <label for="value">规格项：<span class="text-info small">一行为一个规格项</span></label>
        	<textarea name="items" class="form-control" rows="5">{{ old('items') }}</textarea>
        	@if ($errors->has('items'))
                <span class="help-block">
                	{{ $errors->first('items') }}
                </span>
            @endif
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

        	<div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>
@endsection