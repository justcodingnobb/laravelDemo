@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
            	@foreach($lists as $l)
                <div class="clearfix mt10">
                    <strong class="f-l">{{ $l['name'] }} ({{$l['unit']}})：</strong>
                    <div class="f-l">
                        @foreach($l['sub'] as $a)
                        <label class="radio-inline"><input type="radio" name="attr[{{ $l['name'] }}]" value="{{ $a->id }}">{{ $a->value }}</label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="form-group">
                <label for="price">价格：<span class="color-red">*</span>数字</label>
                <input type="text" name="data[price]" value="{{ old('data.price') }}" class="form-control">
                @if ($errors->has('data.price'))
                    <span class="help-block">
                        {{ $errors->first('data.price') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="store">库存：<span class="color-red">*</span>数字</label>
                <input type="number" name="data[store]" value="{{ old('data.store') }}" class="form-control">
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