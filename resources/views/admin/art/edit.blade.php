@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->
	<input type="hidden" name="ref" value="{!! $ref !!}">
	<label for="catid">选择栏目：<span class="color-red">*</span>必填，文章归哪个栏目</label>
	<select name="data[catid]" id="catid">
		<option value="0">选择栏目</option>
		{!! $cate !!}
	</select>
	@if ($errors->has('data.catid'))
        <span class="help-block">
        	{{ $errors->first('data.catid') }}
        </span>
    @endif


	<label for="title">文章标题：<span class="color-red">*</span>不超过255字符</label>
	<input type="text" name="data[title]" value="{{ $info->title }}" class="pure-input-1-3">
	@if ($errors->has('data.title'))
        <span class="help-block">
        	{{ $errors->first('data.title') }}
        </span>
    @endif

	<label for="describe">描述：</label>
	<textarea name="data[describe]" class="pure-input-1-3">{{ $info->describe }}</textarea> 
	@if ($errors->has('data.describe'))
        <span class="help-block">
        	{{ $errors->first('data.describe') }}
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


	
    <label for="content">内容：<span class="color-red">*</span></label>
	<textarea name="data[content]" class="pure-u-23-24" id="editor_id">{{ $info->content }}</textarea> 
	@if ($errors->has('data.content'))
        <span class="help-block">
        	{{ $errors->first('data.content') }}
        </span>
    @endif

<!--     <label for="attrs">上传附件：单个大小最好不超过5M</label>
<div class="attrs clearfix">
	@if($info->attrs != '')
		@foreach($info->attrs as $a)
	<div class="attr clearfix">
			<input type="text" readonly="readonly" name="attrs[title][]" placeholder="文件名称" class="attrtitle input-pure-input-1-4 f-l mr10" value="{{ $a->title }}" />
			<input type="text" readonly="readonly" name="attrs[url][]" placeholder="文件地址" class="attrurl input-pure-input-1-4 f-l mr10" value="{{ $a->url }}" />
			<input type="button" class="attrbtn pure-button pure-button-secondary pure-file f-l mr10" value="选择文件" />
			<span class="add_attr pure-button fa fa-plus f-l">增加</span>
		</div>
		@endforeach
		@else
		<div class="attr clearfix">
			<input type="text" readonly="readonly" name="attrs[title][]" placeholder="文件名称" class="attrtitle input-pure-input-1-4 f-l mr10" value="" />
			<input type="text" readonly="readonly" name="attrs[url][]" placeholder="文件地址" class="attrurl input-pure-input-1-4 f-l mr10" value="" />
			<input type="button" class="attrbtn pure-button pure-button-secondary pure-file f-l mr10" value="选择文件" />
			<span class="add_attr pure-button fa fa-plus f-l">增加</span>
		</div>
		@endif
</div> -->

    <label for="source">来源：<!-- <span class="color-red">*</span>必填， -->文章来源</label>
	<input type="text" name="data[source]" value="{{ $info->source }}" class="pure-input-1-4">
	@if ($errors->has('data.source'))
        <span class="help-block">
        	{{ $errors->first('data.source') }}
        </span>
    @endif
	<label for="url">来源URL：<!-- <span class="color-red">*</span>必填， -->来源网址，加http://</label>
	<input type="text" name="data[url]" value="{{ $info->url }}" class="pure-input-1-4">
	@if ($errors->has('data.url'))
        <span class="help-block">
        	{{ $errors->first('data.url') }}
        </span>
    @endif

	
	<label for="listorder">排序：<span class="color-red">*</span>数字越小越靠前</label>
	<input type="text" name="data[listorder]" value="{{ $info->listorder }}" class="pure-input-1-12">
    @if ($errors->has('data.listorder'))
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @endif
	
	@if(App::make('com')->ifCan('art-edit'))
	<button type="submit" name="dosubmit" class="pure-button pure-button-warning pure-u-1-12 mr10 sub_4">修改</button> 
	@endif
	<button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>


<script>
	$('#catid option[value=' + {{ $info->catid }} + ']').prop('selected','selected');

	// 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
	KindEditor.ready(function(K) {
		window.editor = K.create('#editor_id',{
			minHeight:350,
			uploadJson : "{{ url('admin/attr/uploadimg') }}",
            extraFileUploadParams: {
				session_id : "{{ session('user')->id }}",
            }
		});
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