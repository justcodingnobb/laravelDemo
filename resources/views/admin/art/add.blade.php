@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	@if($catid == '0')
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
    @else
    <input type="hidden" name="data[catid]" value="{{ $catid }}"/>
    @endif


	<label for="title">文章标题：<span class="color-red">*</span>不超过255字符</label>
	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="pure-input-1-3">
	@if ($errors->has('data.title'))
        <span class="help-block">
        	{{ $errors->first('data.title') }}
        </span>
    @endif

	<label for="describe">描述：</label>
	<textarea name="data[describe]" class="pure-input-1-3">{{ old('data.describe') }}</textarea> 
	@if ($errors->has('data.describe'))
        <span class="help-block">
        	{{ $errors->first('data.describe') }}
        </span>
    @endif
    
    <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
    <div class="clearfix">
        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ old('data.thumb') }}" class="input-pure-input-1-4 f-l mr10"><div class="pure-button pure-button-secondary pure-file f-l" id="image3">选择图片</div>
    </div>
    <img src="" class="pure-image thumb-src hidden" width="200" height="160" alt="">
    @if ($errors->has('data.thumb'))
        <span class="help-block">
            {{ $errors->first('data.thumb') }}
        </span>
    @endif


    <label for="content">内容：<span class="color-red">*</span></label>
    <!-- 加载编辑器的容器 -->
    <textarea name="data[content]" class="pure-u-23-24" id="editor_id">{{ old('data.content') }}</textarea> 
	@if ($errors->has('data.content'))
        <span class="help-block">
        	{{ $errors->first('data.content') }}
        </span>
    @endif


    <label for="source">来源：<!-- <span class="color-red">*</span>必填， -->文章来源</label>
	<input type="text" name="data[source]" value="{{ old('data.source') }}" class="pure-input-1-4">
	@if ($errors->has('data.source'))
        <span class="help-block">
        	{{ $errors->first('data.source') }}
        </span>
    @endif
	<label for="url">来源URL：<!-- <span class="color-red">*</span>必填， -->来源网址，加http://</label>
	<input type="text" name="data[url]" value="{{ old('data.url') }}" class="pure-input-1-4">
	@if ($errors->has('data.url'))
        <span class="help-block">
        	{{ $errors->first('data.url') }}
        </span>
    @endif
	
	<label for="listorder">排序：<span class="color-red">*</span>数字越小越靠前</label>
	@if ($errors->has('data.listorder'))
	<input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="pure-input-1-12">
        <span class="help-block">
        	{{ $errors->first('data.listorder') }}
        </span>
    @else
    <input type="text" name="data[listorder]" value="0" class="pure-input-1-12">
    @endif
	

	@if(App::make('com')->ifCan('art-add'))
	<button type="submit" name="dosubmit" class="sub_1 pure-button pure-button-secondary pure-u-1-12 mr10">保存</button> 
	@endif
	<button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
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
/*	laydate({
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