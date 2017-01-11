@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    
    <label for="section_id">部门：<span class="color-red">*</span></label>
    <select name="data[section_id]" id="data[section_id]" class="">
        <option value="">请选择</option>
        @foreach($section as $r)
        <option value="{{ $r->id }}">{{ $r->name }}</option>
        @endforeach
    </select>
    @if ($errors->has('data.section_id'))
        <span class="help-block">
            {{ $errors->first('data.section_id') }}
        </span>
    @endif

    <label for="role_id">角色：<span class="color-red">*</span></label>
    @foreach($rolelist as $r)
    <input type="checkbox" name="role_id[]" value="{{ $r->id }}"> {{ $r->name }}
    @endforeach

	<label for="name">用户名：<span class="color-red">*</span></label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ old('data.name') }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
    <label for="realname">真实姓名：<span class="color-red">*</span></label>
    <input type="text" name="data[realname]" class="pure-input-1-4" value="{{ old('data.realname') }}">
    @if ($errors->has('data.realname'))
        <span class="help-block">
            {{ $errors->first('data.realname') }}
        </span>
    @endif
    <label for="name">邮箱：<span class="color-red">*</span></label>
	<input type="text" name="data[email]" class="pure-input-1-4" value="{{ old('data.email') }}">
	@if ($errors->has('data.email'))
        <span class="help-block">
        	{{ $errors->first('data.email') }}
        </span>
    @endif
    <label for="name">密码：<span class="color-red">*</span></label>
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