@extends('default.layout')


@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')
	<div class="container-fluid mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">优惠券</span></h3>

		<ul class="list_yhq clearfix">
			@foreach($list as $l)
			<li class="mt10">{{ $l->yhq->title }} @if($l->status &&  $l->endtime > date('Y-m-d H:i:s')) <span class="text-primary bg-danger">可用</span> @else <span class="text-danger">失效</span>@endif <a href="{{ url('user/yhq/del',['id'=>$l->id]) }}" class="btn-sm btn btn-success confirm"> 删除 </a></li>
			@endforeach
		</ul>

		<div class="pages">
            {!! $list->links() !!}
        </div>
	</div>
@endsection