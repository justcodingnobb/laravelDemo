@extends('admin.right')

@section('content')

	@if(App::make('com')->ifCan('index-main'))
	{{ $main }}
	@endif

@endsection