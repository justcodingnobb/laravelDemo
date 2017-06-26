@extends('admin.right')

@section('content')
<form action="" class="" method="post">
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
                <div class="clearfix row thumb_btn">
                    <div class="col-xs-6">
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ old('data.thumb') }}" class="form-control">
                    </div>
                    <div value="选择图片" id="image3"></div>
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
            <div class="col-xs-1">
                <input type="text" name="data[price]" value="0" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.price'))
            <span class="help-block">
                {{ $errors->first('data.price') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="store">库存：数字</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[store]" value="0" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.store'))
            <span class="help-block">
                {{ $errors->first('data.store') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="weithg">单件重量：数字</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[weithg]" value="1" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.weithg'))
            <span class="help-block">
                {{ $errors->first('data.weithg') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="sort">排序：数字</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[sort]" value="0" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.sort'))
            <span class="help-block">
                {{ $errors->first('data.sort') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="tags">标签：</label>
        <div class="row">
            <div class="col-xs-3">
                <select name="data[tags]" class="form-control">
                    <option value="">无</option>
                    @foreach($tags as $t)
                    <option value="{{ $t->name }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if ($errors->has('data.tags'))
            <span class="help-block">
                {{ $errors->first('data.tags') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="isxs">是否限时抢购：</label>
        <label class="radio-inline"><input type="radio" name="data[isxs]" class="input-radio" value="1">
            启用</label>
        <label class="radio-inline"><input type="radio" name="data[isxs]" checked="checked" class="input-radio" value="0">禁用</label>
    </div>

    <div class="form-group">
        <label for="starttime">开始时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[starttime]" class="form-control" value="" id="laydate">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="endtime">结束时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[endtime]" class="form-control" value="" id="laydate2">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="isxl">是否限量抢购：</label>
        <label class="radio-inline"><input type="radio" name="data[isxl]" class="input-radio" value="1">
            启用</label>
        <label class="radio-inline"><input type="radio" name="data[isxl]" checked="checked" class="input-radio" value="0">禁用</label>
    </div>
    
    <div class="form-group">
        <label for="xlnums">限制数量：数字，0为不限制</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[xlnums]" value="0" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.xlnums'))
            <span class="help-block">
                {{ $errors->first('data.xlnums') }}
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
    laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection