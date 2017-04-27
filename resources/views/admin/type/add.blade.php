@extends('admin.right')

@section('content')
<form action="" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="data[parentid]" value="{{ $pid }}" />

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="name">
                    分类名称：
                    <span class="color-red">*</span>
                    最多50字符
                </label>
                <input type="text" name="data[name]" class="form-control" value="{{ old('data.name') }}">
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
                @if ($errors->has('data.listorder'))
                <input type="text" name="data[listorder]" value="{{ old('data.listorder') }}" class="form-control">
                <span class="help-block">{{ $errors->first('data.listorder') }}</span>
                @else
                <input type="text" name="data[listorder]" value="0" class="form-control">@endif</div>
            <div class="btn-group mt10">
                <button type="reset" name="reset" class="btn btn-warning">重填</button>
                <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
            </div>
        </div>
    </div>
</form>
<script></script>
@endsection