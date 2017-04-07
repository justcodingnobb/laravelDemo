@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            <label for="name">真实姓名：<span class="color-red">*</span></label>
            <input type="text" name="datas[realname]" class="form-control" value="{{ $info->realname }}">
            @if ($errors->has('datas.realname'))
                <span class="help-block">
                    {{ $errors->first('datas.realname') }}
                </span>
            @endif
            </div>
            <div class="form-group">
            <label for="name">邮箱：<span class="color-red">*</span></label>
            <input type="text" name="datas[email]" class="form-control" value="{{ $info->email }}">
            @if ($errors->has('datas.email'))
                <span class="help-block">
                    {{ $errors->first('datas.email') }}
                </span>
            @endif
            </div>
            <div class="form-group">
            <label for="name">电话：<span class="color-red">*</span></label>
            <input type="text" name="datas[phone]" class="form-control" value="{{ $info->phone }}">
            @if ($errors->has('datas.phone'))
                <span class="help-block">
                    {{ $errors->first('datas.phone') }}
                </span>
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