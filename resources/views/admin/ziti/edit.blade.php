@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">
            
            <div class="form-group">
                <label for="area">区域：<span class="color-red">*</span></label>
                <select name="data[area]" id="" class="form-control">
                    @foreach($area as $a)
                    <option value="{{ $a->name }}" @if($a->name == $info->area) selected="selected"@endif>{{ $a->name }}</option>
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
                <input type="text" name="data[address]" value="{{ $info->address }}" class="form-control">
                @if ($errors->has('data.address'))
                    <span class="help-block">
                        {{ $errors->first('data.address') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone">电话：<span class="color-red">*</span></label>
                <input type="text" name="data[phone]" value="{{ $info->phone }}" class="form-control">
                @if ($errors->has('data.phone'))
                    <span class="help-block">
                        {{ $errors->first('data.phone') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="sort">排序：数字</label>
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
                @if ($errors->has('data.sort'))
                    <span class="help-block">
                        {{ $errors->first('data.sort') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="status">状态：</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
                    正常</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
            </div>
        </div>
    </div>



    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>


@endsection