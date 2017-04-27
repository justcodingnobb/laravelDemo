@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
	{{ csrf_field() }}
	
	<input type="hidden" value="{{$id}}" name="cate_id">
	<div class="clearfix">
		@foreach($all as $a)
		<label class="checkbox-inline">
				<input type="checkbox" autocomplete="off" class="check-mr" value="{{ $a->id }}" name="attr[]">{{ $a->name }}</label>
	    @endforeach
	</div>
	
	<div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>
<script>
	$(function(){
		var urlArr = [{!! $aids !!}];
		$(".check-mr").each(function(s){
			var thisVal = $(this).val();
			$.each(urlArr,function(i){
				if(urlArr[i] == thisVal){
					$(".check-mr").eq(s).prop('checked',true);
				}
			});
		});
	})
</script>
@endsection