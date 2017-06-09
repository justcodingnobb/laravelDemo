@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}

	<div class="row">
        <div class="col-xs-4">
        	<input type="hidden" name="ref" value="{{ $ref }}">
        	<input type="hidden" name="data[order_id]" value="{{ $id }}">
			<textarea name="data[shopmark]" class="form-control" placeholder="商家备注" rows="5"></textarea>
		</div>
	</div>
	<div class="btn-group mt10">
		<button type="reset" name="reset" class="btn btn-warning">重填</button>
		<button type="submit" name="dosubmit" class="btn btn-info">提交</button>
	</div>
</form>
@endsection