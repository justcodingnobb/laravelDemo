@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="data[parentid]" value="{{ $pid }}" />
	
	<label for="name">分类名称：<span class="color-red">*</span>最多50字符</label>
	<input type="text" name="data[name]" class="pure-input-1-4" value="{{ old('data.name') }}">
	@if ($errors->has('data.name'))
        <span class="help-block">
        	{{ $errors->first('data.name') }}
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
	
	<button type="submit" name="dosubmit" class="pure-button pure-button-primary pure-u-1-12 mr10">提交</button> <button type="reset" name="reset" class="pure-button pure-u-1-12">重填</button>
</form>
<script>

</script>

@endsection