@extends('admin.alert')
@section('content')
<form action="" method="post">
	{{ csrf_field() }}
	<div class="form-group">
        <label for="user_money">充值金额：</label>
    	<input type="number" name="data[user_money]" value="0" class="form-control">
    	@if ($errors->has('data.user_money'))
            <span class="help-block">
            	{{ $errors->first('data.user_money') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="pwd">用户密码：</label>
        <input type="password" name="pwd" value="" class="form-control">
        @if ($errors->has('pwd'))
            <span class="help-block">
                {{ $errors->first('pwd') }}
            </span>
        @endif
    </div>
	<div class="btn-group mt10">
		<button type="reset" name="reset" class="btn btn-warning">重填</button>
		<button type="submit" name="dosubmit" class="btn btn-info">提交</button>
	</div>
</form>
<!-- 分页，appends是给分页添加参数 -->
@endsection