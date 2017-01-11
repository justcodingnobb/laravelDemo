@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <label for="name">真实姓名：<span class="color-red">*</span></label>
    <input type="text" name="datas[realname]" class="pure-input-1-4" value="{{ $info->realname }}">
    @if ($errors->has('datas.realname'))
        <span class="help-block">
            {{ $errors->first('datas.realname') }}
        </span>
    @endif
    <label for="name">邮箱：<span class="color-red">*</span></label>
    <input type="text" name="datas[email]" class="pure-input-1-4" value="{{ $info->email }}">
    @if ($errors->has('datas.email'))
        <span class="help-block">
            {{ $errors->first('datas.email') }}
        </span>
    @endif
    <label for="name">电话：<span class="color-red">*</span></label>
    <input type="text" name="datas[phone]" class="pure-input-1-4" value="{{ $info->phone }}">
    @if ($errors->has('datas.phone'))
        <span class="help-block">
            {{ $errors->first('datas.phone') }}
        </span>
    @endif
    
    <div class="mt15">
        <button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
    </div>
</form>
@endsection