@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<label for="parentid">父栏目：</label>
	<select name="data[parentid]" id="parentid">
		<option value="0">选择栏目</option>
		{!! $treeHtml !!}
	</select>
	@if ($errors->has('data.parentid'))
        <span class="help-block">
        	{{ $errors->first('data.parentid') }}
        </span>
    @endif
	<label for="name">栏目名称：<span class="color-red">*</span>最多50字符</label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ $info->name }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
        </span>
    @endif
    
	<label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
    <div class="clearfix">
		<input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="input-pure-input-1-4 f-l mr10">
		<div class="pure-button pure-button-secondary pure-file f-l" id="image3">选择图片</div>
	</div>
	@if($info->thumb != '')
	<img src="{{ $info->thumb }}" class="pure-image thumb-src" width="200" height="160" alt="">
	@if ($errors->has('data.thumb'))
        <span class="help-block">
        	{{ $errors->first('data.thumb') }}
        </span>
    @endif
    @else
    <img src="" class="pure-image thumb-src hidden" width="200" height="160" alt="">
    @endif
	
   
	<label for="describe">描述：</label>
	<textarea name="data[describe]" class="pure-input-1-3">{{ $info->describe }}</textarea> 
	@if ($errors->has('data.describe'))
        <span class="help-block">
        	{{ $errors->first('data.describe') }}
        </span>
    @endif
   
    <label for="listorder">排序：<span class="color-red">*</span>数字越小越靠前</label>
	<input type="text" name="data[listorder]" value="{{ $info->listorder }}" class="pure-input-1-12">
	@if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
    
	<div class="pure-radio">
		<label for="type">类型：</label>
		@if ($info['type'] == 1)
		<input type="radio" name="data[type]" class="input-radio" value="0"> 栏目
		<input type="radio" name="data[type]" checked="checked" class="input-radio" value="1"> 外链
		@else
		<input type="radio" name="data[type]" checked="checked" class="input-radio" value="0"> 栏目
		<input type="radio" name="data[type]" class="input-radio" value="1"> 外链
		@endif
	</div>
	<label for="url">Url：标准网址如：http://www.aaa.com/</label>
	<input type="text" name="data[url]" class="pure-input-1-4" value="{{ $info->url }}">
	@if ($errors->has('data.url'))
        <span class="help-block">
        	{{ $errors->first('data.url') }}
        </span>
    @endif
	
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>

<script>
	// 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
	KindEditor.ready(function(K) {
		window.editor3 = K.editor({
			uploadJson : "{{ url('admin/attr/uploadimg') }}",
            extraFileUploadParams: {
				session_id : "{{ session('user')->id }}",
				thumb : 1,
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