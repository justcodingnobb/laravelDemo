@extends('default.layout')

@section('title')
    <title>会员登陆-吉鲜商城</title>
@endsection

@section('banner')
    @include('default.banner')
@endsection

@section('content')
	<div class="container mt20">
		<form action="" method="post">
			<h3 class="h3_cate"><span class="h3_cate_span">会员登陆</span></h3>
			{{ csrf_field() }}
			<input type="hidden" name="ref" value="{{ $ref }}">

			<div class="form-group">
				<label for="username">用户名：</label>
				<input type="text" name="data[username]" value="" class="form-control">
				@if ($errors->has('data.username'))
				<span class="help-block">{{ $errors->first('data.username') }}</span>
				@endif
			</div>


			<div class="form-group">
				<label for="password">密码：</label>
				<input type="password" name="data[password]" value="" class="form-control">
				@if ($errors->has('data.password'))
				<span class="help-block">{{ $errors->first('data.password') }}</span>
				@endif
			</div>

			<div class="clearfix">
				<button type="submit" name="dosubmit" class="btn btn-primary">提交</button>
				<button type="reset" name="reset" class="btn btn-default">重填</button>
			</div>
		</form>
	</div>
	<div class="container mt20">
		<a href="{{ url('oauth/wx') }}" class="btn btn-success">微信登录</a>
	</div>
@endsection