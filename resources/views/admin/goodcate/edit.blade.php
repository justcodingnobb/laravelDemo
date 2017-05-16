@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
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
                    <span class="help-block">
                    	{{ $errors->first('data.parentid') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="name">分类名称：<span class="color-red">*</span>最多100字符</label>
            	<input type="text" name="data[name]" class="form-control" value="{{ $info->name }}">
            	@if ($errors->has('data.name'))
                    <span class="help-block">
                    	{{ $errors->first('data.name') }}
                    </span>
                @endif
            </div>  

            <div class="form-group">
                <label for="seotitle">seo标题：</label>
                <input type="text" name="data[seotitle]" class="form-control" value="{{ $info->seotitle }}">
                @if ($errors->has('data.seotitle'))
                    <span class="help-block">
                        {{ $errors->first('data.seotitle') }}
                    </span>
                @endif
            </div>


            <div class="form-group">
                <label for="keyword">Keyword：</label>
                <input type="text" name="data[keyword]" class="form-control" value="{{ $info->keyword }}">
                @if ($errors->has('data.keyword'))
                    <span class="help-block">
                        {{ $errors->first('data.keyword') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
            	<label for="describe">描述：</label>
            	<textarea name="data[describe]" class="form-control" rows="4">{{ $info->describe }}</textarea> 
            	@if ($errors->has('data.describe'))
                    <span class="help-block">
                    	{{ $errors->first('data.describe') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="thumb">缩略图：图片类型jpg/jpeg/gif/png，大小不超过2M</label>
                <div class="clearfix row thumb_btn">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control">
                    </div>
                    <div value="选择图片" id="image3"></div>
                </div>
                <img src="{{ $info->thumb }}" class="mt10 thumb-src" width="200" height="160" alt="">
                @if ($errors->has('data.thumb'))
                    <span class="help-block">
                        {{ $errors->first('data.thumb') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="sort">排序：<span class="color-red">*</span>数字越小越靠前</label>
            	<input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
            	@if ($errors->has('data.sort'))
                    <span class="help-block">
                    	{{ $errors->first('data.sort') }}
                    </span>
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