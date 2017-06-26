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
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
                <div class="clearfix row thumb_btn">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control">
                    </div>
                    <div value="选择图片" id="image3"></div>
                </div>
                <img src="{{ $info->thumb }}" class="thumb-src"" alt="">
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
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
            进行中</label>
        <label class="radio-inline"><input type="radio" name="data[status]"@if($info->statue == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
    </div>
    

    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/huodong/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    // 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
    KindEditor.ready(function(K) {
        var uploadbutton = K.uploadbutton({
            button : K('#image3')[0],
            fieldName : 'imgFile',
            url : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            },
            afterUpload : function(data) {
                if (data.error === 0) {
                    var url = K.formatUrl(data.url, 'absolute');
                    K('#url3').val(url);
                    $('.thumb-src').attr('src',url).removeClass('hidden');
                } else {
                    alert(data.message);
                }
            },
            afterError : function(str) {
                alert('自定义错误信息: ' + str);
            }
        });
        uploadbutton.fileBox.change(function(e) {
            uploadbutton.submit();
        });
    });
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