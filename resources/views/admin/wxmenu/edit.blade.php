@extends('admin.right')

@section('content')
<p>注意：一级菜单最多三个，二级菜单最多五个</p>
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $info->parentid }}">
	<label for="name">菜单名称：</label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ $info->name }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
    <label for="type">菜单类型：</label>
    <select name="data[type]" id="menutype">
    	@foreach($type as $t)
    	<option value="{{ $t->val }}"@if($info->type == $t->val) selected="selected"@endif>{{ $t->name }}</option>
    	@endforeach
    </select>
    @if ($errors->has('data.type'))
        <span class="help-block">
            {{ $errors->first('data.type') }}
        </span>
    @endif
	<label for="key">Key：设置关键字回复</label>
	<input type="text" name="data[key]" value="{{ $info->key }}" class="pure-input-1-4">
	@if ($errors->has('data.key'))
        <span class="help-block">
        	{{ $errors->first('data.key') }}
        </span>
    @endif
    <label for="url">Url：设置链接回复</label>
	<input type="text" name="data[url]" value="{{ $info->url }}" class="pure-input-1-4">
	@if ($errors->has('data.url'))
        <span class="help-block">
        	{{ $errors->first('data.url') }}
        </span>
    @endif
	<label for="listorder">排序：</label>
	<input type="text" name="data[listorder]" value="{{ $info->listorder }}" class="pure-input-1-12">
	@if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection