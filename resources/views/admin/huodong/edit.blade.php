@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
                <input type="text" name="data[title]" value="{{ $info->title }}" class="form-control">
                @if ($errors->has('data.title'))
                    <span class="help-block">
                        {{ $errors->first('data.title') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
                <div class="clearfix row">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control">
                    </div>
                    <div class="btn btn-info" id="image3">选择图片</div>
                </div>
                <img src="{{ $info->thumb }}" class="thumb-src"" alt="">
                @if ($errors->has('data.thumb'))
                    <span class="help-block">
                        {{ $errors->first('data.thumb') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="starttime">开始时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[starttime]" class="form-control" value="{{ $info->starttime }}" id="laydate">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="endtime">结束时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[endtime]" class="form-control" value="{{ $info->endtime }}" id="laydate2">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="sort">排序：</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.sort'))
            <span class="help-block">
                {{ $errors->first('data.sort') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
            进行中</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->statue == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
    </div>
    

    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    // 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
    KindEditor.ready(function(K) {
        window.editor3 = K.editor({
            uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
        // 上传图片
        K('#image3').click(function() {
            editor3.loadPlugin('image', function() {
                editor3.plugin.imageDialog({
                    showRemote : false,
                    fieldName : 'imgFile',
                    imageUrl : K('#url3').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#url3').val(url);
                        $('.thumb-src').attr('src',url).removeClass('hidden');
                        editor3.hideDialog();
                    }
                });
            });
        });
    });
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