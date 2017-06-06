@extends('default.layout')


@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')
	<div class="container-fluid mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">领券成功</span></h3>
		
		<a href="{{ url('/') }}" class="btn btn-success">继续购物</a>
		
		<a href="{{ session('homeurl') }}" class="btn btn-primary">继续领券</a>

	</div>
@include('default.foot')
@endsection