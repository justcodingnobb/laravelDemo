@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    <label for="name">用户名：{{ $info->name }}</label>
    <label for="name">新密码：<span class="color-red">*</span></label>
    <input type="password" name="data[password]" class="pure-input-1-4" value="{{ old('data.password') }}">
    @if ($errors->has('data.password'))
        <span class="help-block">
            {{ $errors->first('data.password') }}
        </span>
    @endif
    <label for="name">确认密码：<span class="color-red">*</span></label>
	<input type="password" name="data[password_confirmation]" class="pure-input-1-4" value="{{ old('data.password_confirmation') }}">
    @if ($errors->has('data.password_confirmation'))
        <span class="help-block">
            {{ $errors->first('data.password_confirmation') }}
        </span>
    @endif

    <div class="mt15">
        <button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
    </div>
</form>
@endsection