@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="data[parentid]" value="{{ $pid }}" />
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="name">
                    栏目名称：
                    <span class="color-red">*</span>
                    最多50字符
                </label>
                <input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
                @if ($errors->has('data.name'))
                <span class="help-block">{{ $errors->first('data.name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
                <div class="clearfix row">
                    <div class="col-xs-6">
                    <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ old('data.thumb') }}" class="form-control">
                    </div>
                    <span class="btn btn-info" id="image3">选择图片</span>
                </div>
                <img src="" class="thumb-src hidden" alt="">
                @if ($errors->has('data.thumb'))
                <span class="help-block">{{ $errors->first('data.thumb') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="title">SEO标题：<span class="color-red">*</span>最多255字符</label>
                <input type="text" name="data[title]" class="form-control" value="{{ old('data.title') }}">
                @if ($errors->has('data.title'))
                <span class="help-block">{{ $errors->first('data.title') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="keyword">关键字：最多255字符</label>
                <input type="text" name="data[keyword]" class="form-control" value="{{ old('data.keyword') }}">
                @if ($errors->has('data.keyword'))
                <span class="help-block">{{ $errors->first('data.keyword') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="describe">描述：</label>
                <textarea name="data[describe]" class="form-control" rows="5">{{ old('data.describe') }}</textarea>
                @if ($errors->has('data.describe'))
                <span class="help-block">{{ $errors->first('data.describe') }}</span>
                @endif
            </div>

        </div>

        <div class="form-group col-xs-12">
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
        
        <div class="col-xs-4">

            <div class="form-group">
                <label for="theme">模板：默认list</label>
                <input type="text" name="data[theme]" class="form-control" value="list">
                @if ($errors->has('data.theme'))
                <span class="help-block">{{ $errors->first('data.theme') }}</span>
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
                <input type="text" name="data[listorder]" value="0" class="form-control">@endif</div>
            <div class="form-group">
                <label for="type">类型：</label>
                <label class="radio-inline"><input type="radio" name="data[type]" checked="checked" class="input-radio" value="0">
                    栏目</label>
                <label class="radio-inline"><input type="radio" name="data[type]" class="input-radio" value="1">单页</label>
            </div>
            <div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>
<script>
     // 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id',{
            minHeight:350,
            uploadJson : "{{ url('xycmf/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
        window.editor3 = K.editor({
            uploadJson : "{{ url('xycmf/attr/uploadimg') }}",
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
</script>
@endsection