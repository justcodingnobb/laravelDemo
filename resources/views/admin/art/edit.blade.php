@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->

	<div class="row">
        <div class="col-xs-4">
			<input type="hidden" name="ref" value="{!! $ref !!}">
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
			<div class="form-group">
				<label for="title">
					文章标题：
					<span class="color-red">*</span>
					不超过255字符
				</label>
				<input type="text" name="data[title]" value="{{ $info->
				title }}" class="form-control">
			@if ($errors->has('data.title'))
				<span class="help-block">{{ $errors->first('data.title') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="describe">描述：</label>
				<textarea name="data[describe]" class="form-control" rows="4">{{ $info->describe }}</textarea>
				@if ($errors->has('data.describe'))
				<span class="help-block">{{ $errors->first('data.describe') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M，尺寸：230*125 PX</label>
				<div class="clearfix row thumb_btn">
					<div class="col-xs-6">
					<input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->
					thumb }}" class="form-control">
					</div>
					<div value="选择图片" id="image3"></div>
				</div>
				@if($info->thumb != '')
				<img src="{{ $info->
				thumb }}" class="pure-image thumb-src" alt="">
			@if ($errors->has('data.thumb'))
				<span class="help-block">{{ $errors->first('data.thumb') }}</span>
				@endif
		    @else
				<img src="" class="pure-image thumb-src hidden" width="200" height="160" alt="">@endif</div>
		</div>
	</div>
	<div class="form-group">
		<label for="content">
			内容：
			<span class="color-red">*</span>
		</label>
		<textarea name="data[content]" class="form-control" id="editor_id">{{ $info->content }}</textarea>
		@if ($errors->has('data.content'))
		<span class="help-block">{{ $errors->first('data.content') }}</span>
		@endif
		<!--     <label for="attrs">上传附件：单个大小最好不超过5M</label>
	<div class="attrs clearfix">
		@if($info->attrs != '')
		@foreach($info->attrs as $a)
		<div class="attr clearfix">
			<input type="text" readonly="readonly" name="attrs[title][]" placeholder="文件名称" class="attrtitle input-form-control f-l mr10" value="{{ $a->
			title }}" />
			<input type="text" readonly="readonly" name="attrs[url][]" placeholder="文件地址" class="attrurl input-form-control f-l mr10" value="{{ $a->
			url }}" />
			<input type="button" class="attrbtn pure-button pure-button-secondary pure-file f-l mr10" value="选择文件" />
			<span class="add_attr pure-button fa fa-plus f-l">增加</span>
		</div>
		@endforeach
		@else
		<div class="attr clearfix">
			<input type="text" readonly="readonly" name="attrs[title][]" placeholder="文件名称" class="attrtitle input-form-control f-l mr10" value="" />
			<input type="text" readonly="readonly" name="attrs[url][]" placeholder="文件地址" class="attrurl input-form-control f-l mr10" value="" />
			<input type="button" class="attrbtn pure-button pure-button-secondary pure-file f-l mr10" value="选择文件" />
			<span class="add_attr pure-button fa fa-plus f-l">增加</span>
		</div>
		@endif
	</div>
	-->
</div>

<div class="row">
        <div class="col-xs-4">
		<div class="form-group">
			<label for="source">
				来源：
				<!-- <span class="color-red">*</span>
			必填， -->文章来源
		</label>
		<input type="text" name="data[source]" value="{{ $info->
		source }}" class="form-control">
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
		<input type="text" name="data[listorder]" value="{{ $info->
		listorder }}" class="form-control">
		    @if ($errors->has('data.listorder'))
		<span class="help-block">{{ $errors->first('data.listorder') }}</span>
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
	$('#catid option[value=' + {{ $info->catid }} + ']').prop('selected','selected');

	// 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
	KindEditor.ready(function(K) {
		window.editor = K.create('#editor_id',{
			minHeight:350,
			uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
            extraFileUploadParams: {
				session_id : "{{ session('user')->id }}",
            }
		});
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
</script>
@endsection