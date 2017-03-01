@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $pid }}">
	<label for="name">关联名称：</label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ old('data.name') }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
	<label for="val">Val：</label>
	<input type="text" name="data[val]" value="{{ old('data.val') }}" class="pure-input-1-4">
	@if ($errors->has('data.val'))
        <span class="help-block">
        	{{ $errors->first('data.val') }}
        </span>
    @endif
	<label for="listorder">排序：</label>
	<input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="pure-input-1-12">
	@if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection