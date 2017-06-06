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
			<li class="mt10">{{ $l->title }} <span class="text-danger">剩余：{{ $l->nums }}张</span> <a href="{{ url('shop/yhq/get',['id'=>$l->id]) }}" class="btn-sm btn btn-success"> 领券 </a></li>
			@endforeach
		</ul>

		<div class="pages">
            {!! $list->links() !!}
        </div>
	</div>
@include('default.foot')
@endsection