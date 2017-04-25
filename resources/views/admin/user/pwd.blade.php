@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="name">用户名：{{ $info->name }}</label>
            </div>
            <div class="form-group">
                <label for="name">
                    新密码：
                    <span class="color-red">*</span>
                </label>
                <input type="password" name="data[password]" class="form-control" value="{{ old('data.password') }}">
                @if ($errors->has('data.password'))
                <span class="help-block">{{ $errors->first('data.password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">
                    确认密码：
                    <span class="color-red">*</span>
                </label>
                <input type="password" name="data[password_confirmation]" class="form-control" value="{{ old('data.password_confirmation') }}">
                @if ($errors->has('data.password_confirmation'))
                <span class="help-block">{{ $errors->first('data.password_confirmation') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
@endsection