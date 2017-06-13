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
                <label for="certname">
                    证书名称：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[certname]" class="form-control" value="{{ $setting['certname'] }}">
                @if ($errors->has('set.certname'))
                <span class="help-block">{{ $errors->first('set.certname') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="pwd">
                    证书密钥：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="set[pwd]" class="form-control" value="{{ $setting['pwd'] }}">
                @if ($errors->has('set.pwd'))
                <span class="help-block">{{ $errors->first('set.pwd') }}</span>
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