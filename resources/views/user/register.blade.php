
<!DOCTYPE html>
<html>
<head>
	<title>L53CMF-会员注册</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"></head>
<body>

	<div class="container">
		<form action="" method="post" class="">
			<h3 class="text-center">会员注册</h3>
			{{ csrf_field() }}
			<input type="hidden" name="ref" value="{{ $ref }}">

			<div class="form-group">
				<label for="username">用户名：</label>
				<input type="text" name="data[username]" value="{{ old('data.username') }}" class="form-control">
				@if ($errors->has('data.username'))
				<span class="help-block">{{ $errors->first('data.username') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="email">邮箱：</label>
				<input type="text" name="data[email]" value="{{ old('data.email') }}" class="form-control">
				@if ($errors->has('data.email'))
				<span class="help-block">{{ $errors->first('data.email') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="passwords">密码：</label>
				<input type="password" name="data[passwords]" value="{{ old('data.passwords') }}" class="form-control">
				@if ($errors->has('data.password'))
				<span class="help-block">{{ $errors->first('data.password') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="passwords_confirmation">重复密码：</label>
				<input type="password" name="data[passwords_confirmation]" value="{{ old('data.passwords_confirmation') }}" class="form-control">
				@if ($errors->has('data.passwords_confirmation'))
				<span class="help-block">{{ $errors->first('data.passwords_confirmation') }}</span>
				@endif
			</div>

			<div class="clearfix">
				<button type="submit" name="dosubmit" class="btn btn-primary">提交</button>
				<button type="reset" name="reset" class="btn btn-default">重填</button>
			</div>
		</form>

	</div>

</body>
</html>