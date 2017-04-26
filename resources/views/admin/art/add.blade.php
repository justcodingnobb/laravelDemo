@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    
    <div class="row">
        <div class="col-xs-4">
            @if($catid == '0')
            <label for="catid">
                选择栏目：
                <span class="color-red">*</span>
                必填，文章归哪个栏目
            </label>
            <div class="form-group row">
                <div class="col-xs-6">
                <select name="data[catid]" id="catid" class="form-control">
                    <option value="0">选择栏目</option>
                    {!! $cate !!}
                </select>
                </div>
                @if ($errors->has('data.catid'))
                <span class="help-block">{{ $errors->first('data.catid') }}</span>
                @endif
            </div>
            @else
            <input type="hidden" name="data[catid]" value="{{ $catid }}"/>
            @endif
            <div class="form-group">
                <label for="title">
                    文章标题：
                    <span class="color-red">*</span>
                    不超过255字符
                </label>
                <input type="text" name="data[title]" value="{{ old('data.title') }}" class="form-control">
                @if ($errors->has('data.title'))
                <span class="help-block">{{ $errors->first('data.title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="describe">描述：</label>
                <textarea name="data[describe]" class="form-control" rows="6">{{ old('data.describe') }}</textarea>
                @if ($errors->has('data.describe'))
                <span class="help-block">{{ $errors->first('data.describe') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M，尺寸：230*125 PX</label>
                <div class="clearfix row">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ old('data.thumb') }}" class="form-control">
                    </div>
                    <div class="btn btn-info col-xs-2" id="image3">选择图片</div>
                </div>
                <img src="" class="pure-image thumb-src hidden" alt="">
                @if ($errors->has('data.thumb'))
                <span class="help-block">{{ $errors->first('data.thumb') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="content">
            内容：
            <span class="color-red">*</span>
        </label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[content]" class="form-control" id="editor_id">{{ old('data.content') }}</textarea>
        @if ($errors->has('data.content'))
        <span class="help-block">{{ $errors->first('data.content') }}</span>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">

                <label for="source">
                    来源：
                    <!-- <span class="color-red">*</span>
                    必填， -->文章来源
                </label>
                <input type="text" name="data[source]" value="{{ old('data.source') }}" class="form-control">
                @if ($errors->has('data.source'))
                <span class="help-block">{{ $errors->first('data.source') }}</span>
                @endif
            </div>
            <div class="form-group">

                <label for="listorder">
                    排序：
                    <span class="color-red">*</span>
                    数字越小越靠前
                </label>
                @if ($errors->has('data.listorder'))
                <input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="form-control">
                <span class="help-block">{{ $errors->first('data.listorder') }}</span>
                @else
                <input type="text" name="data[listorder]" value="0" class="form-control">@endif
                </div>

            <div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>

<!-- 实例化编辑器 -->
<script type="text/javascript">
    // 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id',{
            minHeight:350,
            uploadJson : "{{ url('xycms/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
        window.editor3 = K.editor({
            uploadJson : "{{ url('xycms/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
                // thumb : 1,
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
/*  laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        festival: true,
        istoday: true,
        max: laydate.now(), //最大日期
        start: laydate.now('0, "YYYY-MM-DD hh:00:00"'),
        istime: true,
    });*/
</script>
@endsection