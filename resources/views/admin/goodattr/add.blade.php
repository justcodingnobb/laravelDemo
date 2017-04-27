@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" value="{{ $id }}" name="data[parentid]">
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
        	<label for="name">名称：<span class="color-red">*</span></label>
        	<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
        	@if ($errors->has('data.name'))
                <span class="help-block">
                	{{ $errors->first('data.name') }}
                </span>
            @endif
            </div>

            <div class="form-group">
        	<label for="value">值：</label>
        	<input type="text" name="data[value]" class="form-control" value="{{ old('data.value') }}">
        	@if ($errors->has('data.value'))
                <span class="help-block">
                	{{ $errors->first('data.value') }}
                </span>
            @endif
            </div>

            <div class="form-group">
            <label for="unit">单位：</label>
        	<input type="text" name="data[unit]" class="form-control" value="{{ old('data.unit') }}">
        	@if ($errors->has('data.unit'))
                <span class="help-block">
                	{{ $errors->first('data.unit') }}
                </span>
            @endif
            </div>

        	<div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>
@endsection