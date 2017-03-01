@extends('admin.right')

@section('rmenu')
    @if(App::make('com')->ifCan('wx-emptycache'))<a href="{{ url('/admin/wx/emptycache') }}" class="btn-green f-l">[ 清空缓存 ]</a>@endif
    @if(App::make('com')->ifCan('wx-emptydata'))<a href="{{ url('/admin/wx/emptydata') }}" class="btn-green f-l">[ 清空数据 ]</a>@endif
@endsection

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<label for="appid">APPID：</label>
	<input type="text" name="data[appid]" class="pure-input-1-4" value="{{ $info->appid }}">
	@if ($errors->has('data.appid'))
        <span class="help-block">
        	{{ $errors->first('data.appid') }}
        </span>
    @endif
	<label for="appsecret">appsecret：</label>
	<input type="text" name="data[appsecret]" value="{{ $info->appsecret }}" class="pure-input-1-4">
	@if ($errors->has('data.appsecret'))
        <span class="help-block">
        	{{ $errors->first('data.appsecret') }}
        </span>
    @endif
    <label for="rzurl">认证网址：</label>
	<input type="text" name="data[rzurl]" value="{{ $info->rzurl }}" class="pure-input-1-4">
	@if ($errors->has('data.rzurl'))
        <span class="help-block">
        	{{ $errors->first('data.rzurl') }}
        </span>
    @endif
	<label for="token">Token：可以是字母、数字、下划线、破折号</label>
	<input type="text" name="data[token]" value="{{ $info->token }}" class="pure-input-1-4">
	@if ($errors->has('data.token'))
        <span class="help-block">
        	{{ $errors->first('data.token') }}
        </span>
    @endif
	<br />
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
@endsection