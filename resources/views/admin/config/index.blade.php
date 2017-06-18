@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" id="form_ajax" method="post">
	{{ csrf_field() }}

	<div class="row">
	    <div class="col-xs-4">
			<div class="form-group">
				<label for="sitename">站点名称：<span class="color-red">*</span></label>
				<input type="text" name="data[sitename]" class="form-control" value="{{ $config->sitename }}">
				@if ($errors->has('data.sitename'))
				<span class="help-block">{{ $errors->first('data.sitename') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="title">SEO标题：<span class="color-red">*</span></label>
				<input type="text" name="data[title]" class="form-control" value="{{ $config->title }}">
				@if ($errors->has('data.title'))
				<span class="help-block">{{ $errors->first('data.title') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="keyword">关键字：<span class="color-red">*</span></label>
				<input type="text" name="data[keyword]" class="form-control" value="{{ $config->keyword }}">
				@if ($errors->has('data.keyword'))
				<span class="help-block">{{ $errors->first('data.keyword') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="describe">描述：<span class="color-red">*</span></label>
				<textarea name="data[describe]" class="form-control">{{ $config->describe }}</textarea> 
				@if ($errors->has('data.describe'))
				<span class="help-block">{{ $errors->first('data.describe') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="theme">主题：<span class="color-red">*</span></label>
				<input type="text" name="data[theme]" class="form-control" value="{{ $config->theme }}">
				@if ($errors->has('data.theme'))
				<span class="help-block">{{ $errors->first('data.theme') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="person">联系人：<span class="color-red">*</span></label>
				<input type="text" name="data[person]" class="form-control" value="{{ $config->person }}">
				@if ($errors->has('data.person'))
				<span class="help-block">{{ $errors->first('data.person') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="phone">电话：<span class="color-red">*</span></label>
				<input type="text" name="data[phone]" class="form-control" value="{{ $config->phone }}">
				@if ($errors->has('data.phone'))
				<span class="help-block">{{ $errors->first('data.phone') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="email">邮箱：<span class="color-red">*</span></label>
				<input type="text" name="data[email]" class="form-control" value="{{ $config->email }}">
				@if ($errors->has('data.email'))
				<span class="help-block">{{ $errors->first('data.email') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="address">地址：<span class="color-red">*</span></label>
				<textarea name="data[address]" class="form-control">{{ $config->address }}</textarea>
				@if ($errors->has('data.address'))
				<span class="help-block">{{ $errors->first('data.address') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="content">介绍：<span class="color-red">*</span></label>
				<textarea name="data[content]" class="form-control">{{ $config->content }}</textarea> 
				@if ($errors->has('data.content'))
				<span class="help-block">{{ $errors->first('data.content') }}</span>
				@endif
			</div>
		</div>
	</div>
	<div class="btn-group mt10">
		<button type="reset" name="reset" class="btn btn-warning">重填</button>
		<div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/config/index') }}")' name="dosubmit" class="btn btn-info">提交</div>
	</div>
</form>
@endsection