@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<label for="name">角色名称：<span class="color-red">*</span></label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ old('data.name') }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
	<div class="pure-radio">
		<label for="status">状态：</label>
		<input type="radio" name="data[status]" checked="checked" class="input-radio" value="1"> 启用
		<input type="radio" name="data[status]" class="input-radio" value="0"> 禁用
	</div>
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection