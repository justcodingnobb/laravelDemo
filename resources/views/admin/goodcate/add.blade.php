@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $pid }}" />
	<div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            	<label for="name">分类名称：<span class="color-red">*</span>最多100字符</label>
            	<input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
            	@if ($errors->has('data.name'))
                    <span class="help-block">
                    	{{ $errors->first('data.name') }}
                    </span>
                @endif
            </div>
                

            <div class="form-group">
                <label for="seotitle">seo标题：</label>
                <input type="text" name="data[seotitle]" class="form-control" value="{{ old('data.seotitle') }}">
                @if ($errors->has('data.seotitle'))
                    <span class="help-block">
                        {{ $errors->first('data.seotitle') }}
                    </span>
                @endif
            </div>


            <div class="form-group">
                <label for="keyword">Keyword：</label>
                <input type="text" name="data[keyword]" class="form-control" value="{{ old('data.keyword') }}">
                @if ($errors->has('data.keyword'))
                    <span class="help-block">
                        {{ $errors->first('data.keyword') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
            	<label for="describe">描述：</label>
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
                <img src="" class="pure-image thumb-src hidden" width="200" height="160" alt="">
                @if ($errors->has('data.thumb'))
                    <span class="help-block">
                        {{ $errors->first('data.thumb') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="sort">排序：<span class="color-red">*</span>数字越小越靠前</label>
            	@if ($errors->has('data.sort'))
            	<input type="text" name="data[sort]" value="{{ old('data.sort') }}" class="form-control">
                    <span class="help-block">
                    	{{ $errors->first('data.sort') }}
                    </span>
                @else
                <input type="text" name="data[sort]" value="0" class="form-control">
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