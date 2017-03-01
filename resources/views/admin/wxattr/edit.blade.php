@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="ref" value="{{ $ref }}">
	<label for="type">回复类型：</label>
	<select name="data[type]" id="typelist">
		@foreach($typelist as $t)
		<option value="{{ $t->val }}"@if($info->type == $t->val) selected="selected"@endif>{{ $t->name }}</option>
		@endforeach
	</select>
	@if ($errors->has('data.type'))
        <span class="help-block">
        	{{ $errors->first('data.type') }}
        </span>
    @endif
	<label for="con">关键字：</label>
	<input type="text" name="data[con]" class="pure-input-1-4" value="{{ $info->con }}">
	@if ($errors->has('data.con'))
        <span class="help-block">
        	{{ $errors->first('data.con') }}
        </span>
    @endif
	<label for="title">回复标题：</label>
	<input type="text" name="data[title]" value="{{ $info->title }}" class="pure-input-1-4">
	@if ($errors->has('data.title'))
        <span class="help-block">
        	{{ $errors->first('data.title') }}
        </span>
    @endif
    <div class="images hidden">
		<label for="mediaid" class="item-label">多媒体素材：<span class="color_9"> 回复图片消息时填写图片地址，其它消息填写微信mediaid，都可以在素材管理中找到</span></label>
		<input type="text" name="data[mediaid]" value="{{ $info->mediaid }}" class="pure-input-1-4">
		@if ($errors->has('data.mediaid'))
	        <span class="help-block">
	        	{{ $errors->first('data.mediaid') }}
	        </span>
	    @endif
	</div>
	<!-- 音乐 -->
	<div class="music_div hidden">
		<label for="music_url" class="item-label">音乐链接：<span class="color_9"> 直接填写URL</span></label>
		<input type="text" name="data[music_url]" value="{{ $info->music_url }}" class="pure-input-1-4">
		@if ($errors->has('data.music_url'))
	        <span class="help-block">
	        	{{ $errors->first('data.music_url') }}
	        </span>
	    @endif
		<label for="hq_music_url" class="item-label">高品质音乐链接：<span class="color_9"> 直接填写URL</span></label>
		<input type="text" name="data[hq_music_url]" value="{{ $info->hq_music_url }}" class="pure-input-1-4">
		@if ($errors->has('data.hq_music_url'))
	        <span class="help-block">
	        	{{ $errors->first('data.hq_music_url') }}
	        </span>
	    @endif
	</div>
	<label for="content" class="item-label">回复内容：<span class="color_9"> 当普通文本框，必须填写</span></label>
	<textarea name="data[content]" id="content_edit" style="width:46%" rows="5">{{ $info->content }}</textarea>
	@if ($errors->has('data.content'))
        <span class="help-block">
        	{{ $errors->first('data.content') }}
        </span>
    @endif
	<div class="url hidden">
		<label for="url" class="item-label">回复链接：<span class="color_9"> url，必须填写</span></label>
		<input type="text" name="data[url]" value="{{ $info->url }}" class="pure-input-1-4">
		@if ($errors->has('data.url'))
	        <span class="help-block">
	        	{{ $errors->first('data.url') }}
	        </span>
	    @endif
	</div>
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
<script>
	$(function(){
		$('#typelist').change(function(){
			$('.music_div ,.url ,.images').hide();
			switch($(this).val()){
				case 'music':
					$('.music_div ,.images').show();
					break;
				case 'news':
					$('.url ,.images').show();
					break;
				case 'image':
					$('.images').show();
					break;
				case 'voice':
					$('.images').show();
					break;
				case 'video':
					$('.images').show();
					break;
				default:
					$('.music_div ,.url ,.images').hide();
					break;
			}
		});
	});
</script>
@endsection