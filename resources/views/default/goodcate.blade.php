@extends('default.layout')

@section('title')
    <title>{{ $info->seotitle }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')

<section class="container overh">
	
	<div class="row">
		
		<div class="col-xs-3">
			<ul class="allcate">
				@foreach($allcate as $a)
				<li @if($a->id == $info->id) class="active" @endif><a href="{{ url('/shop/goodcate',['id'=>$a->id]) }}">{{ $a->name }}</a></li>
				@endforeach
			</ul>
		</div>

		<div class="col-xs-9">
			<div class="row subcate">
				@foreach($subcate as $l)
				<div class="col-xs-6 col-sm-4 subcate_div">
					<a href="{{ url('/shop/goodcate',['id'=>$l->id]) }}"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
					<a href="{{ url('/shop/goodcate',['id'=>$l->id]) }}" class="db mt5 text-center">{{ $l->name }}</a>
				</div>
				@endforeach
			</div>

		</div>


	</div>

</section>

	

@endsection
