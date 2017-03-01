@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<p>图片（image）: 2M，支持png/jpeg/jpg格式</p>
		<p>语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式</p>
		<p>视频（video）：10MB，支持MP4格式</p>
		<p>缩略图（thumb）：64KB，支持JPG格式</p>
	</div>

	<label for="type">请选择类型：</label>
	<select name="data[type]" id="type">
		<option value="">请选择上传的素材类型</option>
		<option value="image">图片</option>
		<option value="voice">语音</option>
		<option value="video">视频</option>
		<option value="thumb">缩略图</option>
	</select>
	@if ($errors->has('data.type'))
        <span class="help-block">
        	{{ $errors->first('data.type') }}
        </span>
    @endif
	<label for="image">上传素材：</label>
	<div class="clearfix">
		<input type="text" readonly="readonly" name="data[image]" id="url3" value="{{ old('data.image') }}" class="input-pure-input-1-4 f-l mr10"><div class="pure-button pure-button-secondary pure-file f-l" id="image3">选择</div>
	</div>
	@if ($errors->has('data.image'))
        <span class="help-block">
        	{{ $errors->first('data.image') }}
        </span>
    @endif

	<label for="title">视频标题：</label>
	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="pure-input-1-4">
	@if ($errors->has('data.title'))
        <span class="help-block">
        	{{ $errors->first('data.title') }}
        </span>
    @endif

	<label for="introduction" class="item-label">视频描述：</label>
	<textarea name="data[introduction]" class="pure-input-1-4">{{ old('data.introduction') }}</textarea>
	@if ($errors->has('data.introduction'))
        <span class="help-block">
        	{{ $errors->first('data.introduction') }}
        </span>
    @endif
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
<script>
	KindEditor.ready(function(K) {
       		window.editor3 = K.editor({
	            uploadJson : "{{ url('admin/wxattr/uploadimg') }}",
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
	                        editor3.hideDialog();
	                    }
	                });
	            });
	        });
    });
</script>
@endsection