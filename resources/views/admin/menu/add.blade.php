@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $pid }}">
	<label for="name">菜单名称：<span class="color-red">*</span></label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ old('data.name') }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
	<label for="url">URL：<span class="color-red">*</span>不用添加admin，路由分组名修改时方便修改</label>
	<input type="text" name="data[url]" value="{{ old('data.url') }}" class="pure-input-1-4">
	@if ($errors->has('data.url'))
        <span class="help-block">
        	{{ $errors->first('data.url') }}
        </span>
    @endif
    <label for="label">权限名称：<span class="color-red">*</span> 如 menu-addmenu</label>
	<input type="text" name="data[label]" value="{{ old('data.label') }}" class="pure-input-1-4">
	@if ($errors->has('data.label'))
        <span class="help-block">
        	{{ $errors->first('data.label') }}
        </span>
    @endif
	<label for="listorder">排序：<span class="color-red">*</span>数字越小越靠前</label>
	<input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="pure-input-1-12">
	@if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
	<div class="pure-radio">
		<label for="display">是否显示：</label>
		<input type="radio" name="data[display]" checked="checked" class="input-radio" value="1"> 是
		<input type="radio" name="data[display]" class="input-radio" value="0"> 否
	</div>
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection