@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="content">
            支付方式：
            <span class="color-red">*</span>
        </label>
        <img src="{{ $info['thumb'] }}" alt=""></div>
    <div class="form-group">
        <label for="content">
            支付介绍：
            <span class="color-red">*</span>
        </label>
        {{ $info['content'] }}
    </div>

    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="appid">
                    APPID：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[appid]" class="form-control" value="{{ $setting['appid'] }}">
                @if ($errors->has('set.appid'))
                <span class="help-block">{{ $errors->first('set.appid') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="appsecret">
                    AppSecret：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[appsecret]" class="form-control" value="{{ $setting['appsecret'] }}">
                @if ($errors->has('set.appsecret'))
                <span class="help-block">{{ $errors->first('set.appsecret') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="mchid">
                    商户ID：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[mchid]" class="form-control" value="{{ $setting['mchid'] }}">
                @if ($errors->has('set.mchid'))
                <span class="help-block">{{ $errors->first('set.mchid') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="appkey">
                    商户密钥：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[appkey]" class="form-control" value="{{ $setting['appkey'] }}">
                @if ($errors->has('set.appkey'))
                <span class="help-block">{{ $errors->first('set.appkey') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="paystatus">状态：</label>
                <label class="radio-inline"><input type="radio" name="data[paystatus]" checked="checked" class="input-radio" value="1">
                    启用</label>
                <label class="radio-inline"><input type="radio" name="data[paystatus]" class="input-radio" value="0">禁用</label>
            </div>
        </div>
    </div>
    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
@endsection