@extends('admin.right')

@section('content')
<form action="" method="post">
	{{ csrf_field() }}

	<div class="row">
        <div class="col-xs-4">
			<div class="form-group">
				<label for="parentid">父分类：</label>
				<select name="data[parentid]" id="parentid" class="form-control">
					<option value="0">选择分类</option>
					{!! $treeHtml !!}
				</select>
				@if ($errors->has('data.parentid'))
				<span class="help-block">{{ $errors->first('data.parentid') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="name">
					分类名称：
					<span class="color-red">*</span>
					最多50字符
				</label>
				<input type="text" name="data[name]" class="form-control" value="{{ $info->
				name }}">
				@if ($errors->has('data.name'))
				<span class="help-block">{{ $errors->first('data.name') }}</span>
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
			<div class="btn-group mt10">
				<button type="reset" name="reset" class="btn btn-warning">重填</button>
				<button type="submit" name="dosubmit" class="btn btn-info">提交</button>
			</div>
		</div>
	</div>
</form>
@endsection