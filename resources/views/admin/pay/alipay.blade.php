@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
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

                <label for="alipay_partner">
                    商户ID：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_partner]" class="form-control" value="{{ $setting['alipay_partner'] }}">
                @if ($errors->has('set.alipay_partner'))
                <span class="help-block">{{ $errors->first('set.alipay_partner') }}</span>
                @endif
            </div>
            <div class="form-group">

                <label for="alipay_key">
                    商户KEY：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_key]" class="form-control" value="{{ $setting['alipay_key'] }}">
                @if ($errors->has('set.alipay_key'))
                <span class="help-block">{{ $errors->first('set.alipay_key') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="alipay_account">
                    商户账号：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_account]" class="form-control" value="{{ $setting['alipay_account'] }}">
                @if ($errors->has('set.alipay_account'))
                <span class="help-block">{{ $errors->first('set.alipay_account') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="alipay_appid">
                    手机网站APPID：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_appid]" class="form-control" value="{{ $setting['alipay_appid'] }}">
                @if ($errors->has('set.alipay_appid'))
                <span class="help-block">{{ $errors->first('set.alipay_appid') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="alipay_privatekey">
                    商户私钥：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_privatekey]" class="form-control" value="{{ $setting['alipay_privatekey'] }}">
                @if ($errors->has('set.alipay_privatekey'))
                <span class="help-block">{{ $errors->first('set.alipay_privatekey') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="alipay_publickey">
                    支付宝公钥：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[alipay_publickey]" class="form-control" value="{{ $setting['alipay_publickey'] }}">
                @if ($errors->has('set.alipay_publickey'))
                <span class="help-block">{{ $errors->first('set.alipay_publickey') }}</span>
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