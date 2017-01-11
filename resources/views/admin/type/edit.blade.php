@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<label for="parentid">父分类：</label>
	<select name="data[parentid]" id="parentid">
		<option value="0">选择分类</option>
		{!! $treeHtml !!}
	</select>
	@if ($errors->has('data.parentid'))
        <span class="help-block">
        	{{ $errors->first('data.parentid') }}
        </span>
    @endif
	<label for="name">分类名称：<span class="color-red">*</span>最多50字符</label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ $info->name }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
   
    <label for="listorder">排序：<span class="color-red">*</span>数字越小越靠前</label>
	<input type="text" name="data[listorder]" value="{{ $info->listorder }}" class="pure-input-1-12">
	@if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
    
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>

@endsection