@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}

	<div class="row">
        <div class="col-xs-4">
			<div class="form-group">
				<label for="name">
					角色名称：
					<span class="color-red">*</span>
				</label>
				<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
				@if ($errors->has('data.name'))
				<span class="help-block">{{ $errors->first('data.name') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="status">状态：</label>
				<label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
					启用</label>
					<label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="0">禁用</label>
			</div>
		</div>
	</div>
	<div class="btn-group mt10">
		<button type="reset" name="reset" class="btn btn-warning">重填</button>
		<button type="submit" name="dosubmit" class="btn btn-info">提交</button>
	</div>
</form>
@endsection