@extends('admin.right')

@section('content')
<form action="" class="" method="post">
	{{ csrf_field() }}

	<div class="row">
        <div class="col-xs-4">
			<div class="form-group">
				<label for="parentid">父栏目：</label>
				<select name="data[parentid]" id="parentid" class="form-control">
					<option value="0">选择栏目</option>
					{!! $treeHtml !!}
				</select>
				@if ($errors->has('data.parentid'))
				<span class="help-block">{{ $errors->first('data.parentid') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="name">
					栏目名称：
					<span class="color-red">*</span>
					最多50字符
				</label>
				<input type="text" name="data[name]" class="form-control" value="{{ $info->name }}">
				@if ($errors->has('data.name'))
					<span class="help-block">{{ $errors->first('data.name') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
				<div class="clearfix row">
					<div class="col-xs-6">
						<input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control">
					</div>
					<span class="btn btn-info" id="image3">选择图片</span>
				</div>
				@if($info->thumb != '')
				<img src="{{ $info->thumb }}" class="thumb-src" width="200" height="160" alt="">
				@if ($errors->has('data.thumb'))
					<span class="help-block">{{ $errors->first('data.thumb') }}</span>
					@endif
			    @else
				<img src="" class="thumb-src hidden" width="200" height="160" alt="">@endif</div>
			<div class="form-group">
				<label for="describe">描述：</label>
				<textarea name="data[describe]" class="form-control" rows="5">{{ $info->describe }}</textarea>
				@if ($errors->has('data.describe'))
				<span class="help-block">{{ $errors->first('data.describe') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="listorder">
					排序：
					<span class="color-red">*</span>
					数字越小越靠前
				</label>
				<input type="text" name="data[listorder]" value="{{ $info->listorder }}" class="form-control">
				@if ($errors->has('data.listorder'))
					<span class="help-block">{{ $errors->first('data.listorder') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="type">类型：</label>
				@if ($info['type'] == 1)
				<label class="radio-inline"><input type="radio" name="data[type]" class="input-radio" value="0">
					栏目</label>
				<label class="radio-inline"><input type="radio" name="data[type]" checked="checked" class="input-radio" value="1">
					外链</label>
				@else
				<label class="radio-inline"><input type="radio" name="data[type]" checked="checked" class="input-radio" value="0">
					栏目</label>
				<label class="radio-inline"><input type="radio" name="data[type]" class="input-radio" value="1">
					外链</label>
				@endif
			</div>

			<div class="form-group">
				<label for="url">Url：标准网址如：http://www.aaa.com/</label>
				<input type="text" name="data[url]" class="form-control" value="{{ $info->
				url }}">
			@if ($errors->has('data.url'))
				<span class="help-block">{{ $errors->first('data.url') }}</span>
				@endif
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