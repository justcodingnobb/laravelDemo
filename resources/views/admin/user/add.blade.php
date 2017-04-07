@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="section_id">
                    部门：
                    <span class="color-red">*</span>
                </label>
                <select name="data[section_id]" id="data[section_id]" class="form-control">
                    <option value="">请选择</option>
                    @foreach($section as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('data.section_id'))
                <span class="help-block">{{ $errors->first('data.section_id') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="role_id">
                    角色：
                    <span class="color-red">*</span>
                </label>
                @foreach($rolelist as $r)
                <label class="checkbox-inline"><input type="checkbox" name="role_id[]" value="{{ $r->
                    id }}"> {{ $r->name }}</label>
            @endforeach
            </div>
            <div class="form-group">
                <label for="name">
                    用户名：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
                @if ($errors->has('data.name'))
                <span class="help-block">{{ $errors->first('data.name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="realname">
                    真实姓名：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[realname]" class="form-control" value="{{ old('data.realname') }}">
                @if ($errors->has('data.realname'))
                <span class="help-block">{{ $errors->first('data.realname') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">
                    邮箱：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[email]" class="form-control" value="{{ old('data.email') }}">
                @if ($errors->has('data.email'))
                <span class="help-block">{{ $errors->first('data.email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">
                    密码：
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