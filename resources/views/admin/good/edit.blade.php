@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<!-- 提交返回用的url参数 -->
	<input type="hidden" name="ref" value="{!! $ref !!}">

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
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
            </div>

            <div class="form-group">
                <label for="title">商品标题：<span class="color-red">*</span>不超过255字符</label>
                <input type="text" name="data[title]" value="{{ $info->title }}" class="form-control">
                @if ($errors->has('data.title'))
                    <span class="help-block">
                        {{ $errors->first('data.title') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="keyword">关键字：不超过255字符</label>
                <textarea name="data[keyword]" class="form-control">{{ $info->keyword }}</textarea> 
                @if ($errors->has('data.keyword'))
                    <span class="help-block">
                        {{ $errors->first('data.keyword') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="describe">描述：不超过255字符</label>
                <textarea name="data[describe]" class="form-control" rows="4">{{ $info->describe }}</textarea> 
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
                        <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control">
                    </div>
                    <div class="btn btn-info" id="image3">选择图片</div>
                </div>
                <img src="{{ $info->thumb }}" class="pure-image thumb-src" alt="">
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
        <textarea name="data[content]" class="form-control" id="editor_id">{{ $info->content }}</textarea> 
        @if ($errors->has('data.content'))
            <span class="help-block">
                {{ $errors->first('data.content') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="notice">购买须知：<span class="color-red">*</span></label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[notice]" class="form-control" id="editor_id2">{{ $info->notice }}</textarea> 
        @if ($errors->has('data.notice'))
            <span class="help-block">
                {{ $errors->first('data.notice') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="pack">规格包装：<span class="color-red">*</span></label>
        <!-- 加载编辑器的容器 -->
        <textarea name="data[pack]" class="form-control" id="editor_id3">{{ $info->pack }}</textarea> 
        @if ($errors->has('data.pack'))
            <span class="help-block">
                {{ $errors->first('data.pack') }}
            </span>
        @endif
    </div>
    
    <div class="form-group">
        <label for="price">价格：数字</label>
        <div class="row">
            <div class="col-xs-2">
                <input type="text" name="data[price]" value="{{ $info->price }}" class="form-control">
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
                <input type="text" name="data[store]" value="{{ $info->store }}" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.store'))
            <span class="help-block">
                {{ $errors->first('data.store') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="sort">排序：</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
            </div>
        </div>
        @if ($errors->has('data.sort'))
            <span class="help-block">
                {{ $errors->first('data.sort') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="isnew">新品：</label>
        <label class="radio-inline"><input type="radio" name="data[isnew]"@if($info->isnew == 1) checked="checked"@endif class="input-radio" value="1">
            启用</label>
        <label class="radio-inline"><input type="radio" name="data[isnew]"@if($info->isnew == 0) checked="checked"@endif class="input-radio" value="0">禁用</label>
    </div>


    <div class="form-group">
        <label for="isxs">是否限时抢购：</label>
        <label class="radio-inline"><input type="radio" name="data[isxs]"@if($info->isxs == 1) checked="checked"@endif class="input-radio" value="1">
            启用</label>
        <label class="radio-inline"><input type="radio" name="data[isxs]"@if($info->isxs == 0) checked="checked"@endif class="input-radio" value="0">禁用</label>
    </div>

    <div class="form-group">
        <label for="starttime">开始时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[starttime]" class="form-control" value="{{ $info->starttime }}" id="laydate">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="endtime">结束时间：</label>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" name="data[endtime]" class="form-control" value="{{ $info->endtime }}" id="laydate2">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="isxl">是否限量抢购：</label>
        <label class="radio-inline"><input type="radio" name="data[isxl]"@if($info->isxl == 1) checked="checked"@endif class="input-radio" value="1">
            启用</label>
        <label class="radio-inline"><input type="radio" name="data[isxl]"@if($info->isxl == 0) checked="checked"@endif class="input-radio" value="0">禁用</label>
    </div>
    
    <div class="form-group">
        <label for="xlnums">限制数量：数字，0为不限制</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="data[xlnums]" value="{{ $info->xlnums }}" class="form-control">
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


<script>
	$('#catid option[value=' + {{ $info->cate_id }} + ']').prop('selected','selected');

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
		window.editor3 = K.editor({
			uploadJson : "{{ url('xyshop/attr/uploadimg') }}",
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
						$('.thumb-src').attr('src',url).removeClass('hidden');
						editor3.hideDialog();
					}
				});
			});
		});
		
	});

    laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection