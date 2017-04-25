@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
	<div class="form-group">
		<label for="name">会员组名称：<span class="color-red">*</span></label>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<input type="text" name="data[name]" class="form-control" value="{{ $info['name'] }}">
			</div>
		</div>
		@if ($errors->has('data.name'))
	        <span class="help-block">
	        	{{ $errors->first('data.name') }}
	        </span>
	    @endif
	</div>

	<div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
@endsection