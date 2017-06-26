@extends('admin.right')

@section('content')
<form action="" id="form_ajax" method="post">
	{{ csrf_field() }}
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
            	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="price">满多少元：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[price]" value="{{ old('data.price') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="lessprice">减多少元：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[lessprice]" value="{{ old('data.lessprice') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="nums">数量：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[nums]" value="{{ old('data.nums') }}" class="form-control">
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
                <label for="sort">排序：数字</label>
                <input type="text" name="data[sort]" value="0" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">状态：</label>
                <label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
                    进行中</label>
                <label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="0">关闭</label>
            </div>

        </div>
    </div>



    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/youhuiquan/add') }}")' name="dosubmit" class="btn btn-info">提交</div>
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