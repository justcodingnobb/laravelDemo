@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">会员组名称：<span class="color-red">*</span></label>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
			</div>
		</div>
		@if ($errors->has('data.name'))
	        <span class="help-block">
	        	{{ $errors->first('data.name') }}
	        </span>
	    @endif
	</div>

	<div class="form-group">
		<label for="points">所需积分：<span class="color-red">*</span></label>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<input type="number" name="data[points]" class="form-control" value="{{ old('points') }}">
			</div>
		</div>
		@if ($errors->has('data.points'))
	        <span class="help-block">
	        	{{ $errors->first('data.points') }}
	        </span>
	    @endif
	</div>

	<div class="form-group">
		<label for="discount">折扣：<span class="color-red">*</span>单位 %</label>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<input type="number" name="data[discount]" class="form-control" value="{{ old('discount') }}">
			</div>
		</div>
		@if ($errors->has('data.discount'))
	        <span class="help-block">
	        	{{ $errors->first('data.discount') }}
	        </span>
	    @endif
	</div>

	<div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
@endsection