@extends('admin.right')

@section('content')
<form action="" class="" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
	<div class="form-group">
        <label for="password">密码：<span class="color-red">*</span>6位及以上</label>
    	<div class="row">
            <div class="col-xs-6 col-md-3">
                <input type="password" name="data[name]" class="form-control" value="">
            </div>
        </div>
    	@if ($errors->has('data.password'))
            <span class="help-block">
            	{{ $errors->first('data.password') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="repassword">重复密码：<span class="color-red">*</span>6位及以上</label>
    	<div class="row">
            <div class="col-xs-6 col-md-3">
                <input type="password" name="data[name]" class="form-control" value="">
            </div>
        </div>
    	@if ($errors->has('data.repassword'))
            <span class="help-block">
            	{{ $errors->first('data.repassword') }}
            </span>
        @endif
    </div>

	<div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
@endsection