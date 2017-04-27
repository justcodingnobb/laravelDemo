@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    <div class="row">
        <div class="col-xs-4">
            <input type="hidden" name="ref" value="{{ $ref }}">
            

            <div class="form-group">
                <label for="title">名称：</label>
                <p>{{ $info->title }}</p>
            </div>

            <div class="form-group">
                <label for="value">值：</label>
                <p>{{ $info->attr_ids }}</p>
            </div>

            <div class="form-group">
                <label for="price">价格：<span class="color-red">*</span>数字</label>
                <input type="text" name="data[price]" value="{{ $info->price }}" class="form-control">
                @if ($errors->has('data.price'))
                    <span class="help-block">
                        {{ $errors->first('data.price') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="store">库存：<span class="color-red">*</span>数字</label>
                <input type="number" name="data[store]" value="{{ $info->store }}" class="form-control">
                @if ($errors->has('data.store'))
                    <span class="help-block">
                        {{ $errors->first('data.store') }}
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
@endsection