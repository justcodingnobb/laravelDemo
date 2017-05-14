@extends('admin.alert')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    <input type="hidden" name="data[good_id]" value="{{ $id }}">
    <div class="form-group">
        <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
    	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="form-control">
    	@if ($errors->has('data.title'))
            <span class="help-block">
            	{{ $errors->first('data.title') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="price">满多少赠：<span class="color-red">*</span>数字</label>
        <input type="number" min="0" name="data[price]" value="{{ old('data.price') }}" class="form-control">
        @if ($errors->has('data.price'))
            <span class="help-block">
                {{ $errors->first('data.price') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="store">库存：<span class="color-red">*</span>数字</label>
        <input type="number" min="0" name="data[store]" value="{{ old('data.store') }}" class="form-control">
        @if ($errors->has('data.store'))
            <span class="help-block">
                {{ $errors->first('data.store') }}
            </span>
        @endif
    </div>


    <div class="form-group">
        <label for="starttime">开始时间：<span class="color-red">*</span></label>
        <input type="text" name="data[starttime]" class="form-control" value="" id="laydate">
    </div>

    <div class="form-group">
        <label for="endtime">结束时间：<span class="color-red">*</span></label>
        <input type="text" name="data[endtime]" class="form-control" value="" id="laydate2">
    </div>


    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
            进行中</label>
        <label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="0">关闭</label>
    </div>

    <div class="btn-group">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection