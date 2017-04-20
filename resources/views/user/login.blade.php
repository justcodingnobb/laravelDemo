
<!DOCTYPE html>
<html>
<head>
	<title>L53CMF-会员登陆</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"></head>
<body>
	<div class="container">
		@if(session('message'))
		<h2 class="text-center text-danger">{{ session('message') }}</h2>
		@endif
		<form action="" method="post">
			<h3 class="text-center">会员登陆</h3>
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

</body>
</html>

