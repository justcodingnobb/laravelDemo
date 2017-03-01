@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	
	<label for="name">用户组名称：<span class="color-9">30个字符以内</span></label>
	<input type="text" name="data[name]" value="{{ old('data.name') }}" class="pure-input-1-4">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
    
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection