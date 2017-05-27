@extends('default.layout')

@section('title')
    <title>添加收货地址-希夷SHOP</title>
@endsection

@section('banner')
    @include('default.banner')
@endsection

@section('content')
	<div class="container-fluid mt20">
		<a href="{{ url('user/order') }}" class="btn btn-sm btn-primary">我的订单</a>
		<a href="{{ url('user/yhq') }}" class="btn btn-sm btn-success">优惠券</a>
		<a href="{{ url('user/address') }}" class="btn btn-sm btn-info">收货地址</a>
	</div>

	<div class="container mt20">
		<form action="" class="pure-form pure-form-stacked" method="post">
			{{ csrf_field() }}
				
				<div class="form-group">
	                <label for="people">联系人：<span class="color-red">*</span>不超过50字符</label>
	            	<input type="text" name="data[people]" value="{{ old('data.people') }}" class="form-control">
	            	@if ($errors->has('data.people'))
	                    <span class="help-block">
	                    	{{ $errors->first('data.people') }}
	                    </span>
	                @endif
	            </div>

	            <div class="form-group">
	                <label for="phone">手机号：<span class="color-red">*</span></label>
	            	<input type="text" name="data[phone]" value="{{ old('data.phone') }}" class="form-control">
	            	@if ($errors->has('data.phone'))
	                    <span class="help-block">
	                    	{{ $errors->first('data.phone') }}
	                    </span>
	                @endif
	            </div>
				
				<div class="form-group">
	                <label for="area">区域：<span class="color-red">*</span></label>
	                <select name="data[area]" id="" class="form-control">
	                    @foreach($area as $a)
	                    <option value="{{ $a->name }}">{{ $a->name }}</option>
	                    @endforeach
	                </select>
	                @if ($errors->has('data.area'))
	                    <span class="help-block">
	                        {{ $errors->first('data.area') }}
	                    </span>
	                @endif
	            </div>

	            <div class="form-group">
	                <label for="address">地址：<span class="color-red">*</span>不超过255字符</label>
	            	<input type="text" name="data[address]" value="{{ old('data.address') }}" class="form-control">
	            	@if ($errors->has('data.address'))
	                    <span class="help-block">
	                    	{{ $errors->first('data.address') }}
	                    </span>
	                @endif
	            </div>

	            <div class="form-group">
	                <label for="default">默认：</label>
	                <label class="radio-inline"><input type="radio" name="data[default]" checked="checked" class="input-radio" value="1">
	                    是</label>
	                <label class="radio-inline"><input type="radio" name="data[default]" class="input-radio" value="0">否</label>
	            </div>


		    <div class="btn-group">
		        <button type="reset" name="reset" class="btn btn-warning">重填</button>
		        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
		    </div>
		</form>
	</div>
@endsection