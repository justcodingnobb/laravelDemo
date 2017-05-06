@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}

	<div class="row">
        <div class="col-xs-4">
        	<input type="hidden" name="ref" value="{{ $ref }}">
        	<input type="hidden" name="data[order_id]" value="{{ $id }}">
			<div class="form-group">
				<label for="shipname">快递名称：<span class="color-red">*</span></label>
				<input type="text" name="data[shipname]" class="form-control" value="{{ old('data.shipname') }}">
				@if ($errors->has('data.shipname'))
				<span class="help-block">{{ $errors->first('data.shipname') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="shipcode">快递单号：<span class="color-red">*</span></label>
				<input type="text" name="data[shipcode]" class="form-control" value="{{ old('data.shipcode') }}">
				@if ($errors->has('data.shipcode'))
				<span class="help-block">{{ $errors->first('data.shipcode') }}</span>
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