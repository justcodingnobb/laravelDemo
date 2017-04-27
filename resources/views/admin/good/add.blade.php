@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            	@if($id == '0')
            	<label for="catid">选择分类：<span class="color-red">*</span>必填，商品归哪个分类</label>
            	<select name="data[cate_id]" id="catid" class="form-control">
            		<option value="0">选择分类</option>
            		{!! $cate !!}
            	</select>
            	@if ($errors->has('data.catid'))
                    <span class="help-block">
                    	{{ $errors->first('data.catid') }}
                    </span>
                @endif
                @else
                <input type="hidden" name="data[catid]" value="{{ $id }}"/>
                @endif
            </div>

            <div class="form-group">
                <label for="title">商品标题：<span class="color-red">*</span>不超过255字符</label>
            	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="form-control">
            	@if ($errors->has('data.title'))
                    <span class="help-block">
                    	{{ $errors->first('data.title') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="keyword">关键字：不超过255字符</label>
                <textarea name="data[keyword]" class="form-control">{{ old('data.keyword') }}</textarea> 
                @if ($errors->has('data.keyword'))
                    <span class="help-block">
                        {{ $errors->first('data.keyword') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
            	<label for="describe">描述：不超过255字符</label>
            	<textarea name="data[describe]" class="form-control" rows="4">{{ old('data.describe') }}</textarea> 
            	@if ($errors->has('data.describe'))
                    <span class="help-block">
                    	{{ $errors->first('data.describe') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
                <div class="clearfix row">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ old('data.thumb') }}" class="form-control">
                    </div>
                    <div class="btn btn-info" id="image3">选择图片</div>
                </div>
                <img src="" class="pure-image thumb-src hidden"" alt="">
                @if ($errors->has('data.thumb'))
                    <span class="help-block">
                        {{ $errors->first('data.thumb') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="content">内容：<span class="color-red">*</span></label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[content]" class="form-control" id="editor_id">{{ old('data.content') }}</textarea> 
    	@if ($errors->has('data.content'))
            <span class="help-block">
            	{{ $errors->first('data.content') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="notice">购买须知：<span class="color-red">*</span></label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[notice]" class="form-control" id="editor_id2">{{ old('data.notice') }}</textarea> 
        @if ($errors->has('data.notice'))
            <span class="help-block">
                {{ $errors->first('data.notice') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="pack">规格包装：<span class="color-red">*</span></label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[pack]" class="form-control" id="editor_id3">{{ old('data.pack') }}</textarea> 
        @if ($errors->has('data.pack'))
            <span class="help-block">
                {{ $errors->first('data.pack') }}
            </span>
        @endif
    </div>
    
    <div class="form-group">
        <label for="price">价格：数字</label>
        <div class="row">
            <div class="col-xs-2">
                <input type="text" name="data[price]" value="{{ old('data.price') }}" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.price'))
            <span class="help-block">
                {{ $errors->first('data.price') }}
            </span>
        @endif
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
        window.editor = K.create('#editor_id',{
            minHeight:350,
            uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
        window.editor2 = K.create('#editor_id2',{
            minHeight:350,
            uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
        window.editor1 = K.create('#editor_id3',{
            minHeight:350,
            uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('user')->id }}",
            }
        });
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
</script>

@endsection