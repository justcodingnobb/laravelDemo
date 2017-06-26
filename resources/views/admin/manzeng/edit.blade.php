@extends('admin.right')

@section('content')
<form action="" id="form_ajax" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
                <input type="text" name="data[title]" value="{{ $info->title }}" class="form-control">
            </div>


            <div class="form-group">
                <label for="price">满多少赠：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[price]" value="{{ $info->price }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="store">库存：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[store]" value="{{ $info->store }}" class="form-control">
            </div>


            <div class="form-group">
                <label for="starttime">开始时间：</label>
                <input type="text" name="data[starttime]" class="form-control" value="{{ $info->starttime }}" id="laydate">
            </div>

            <div class="form-group">
                <label for="endtime">结束时间：</label>
                <input type="text" name="data[endtime]" class="form-control" value="{{ $info->endtime }}" id="laydate2">
            </div>
            
            
            <div class="form-group">
                <label for="sort">排序：</label>
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">状态：</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
                    进行中</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
            </div>

            
            <div class="form-group">
                <label for="good_id">赠品：</label>
                <p>{{ $info->good->title }}</p>
                <img src="{{ $info->good->thumb }}" alt="">
            </div>
        </div>
    </div>



    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/manzeng/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection