@extends('default.layout')

@section('title')
    <title>{{ $info->seotitle }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')

<section class="container mt20">
	<!-- 下级分类 -->
	@if($subcate->count() > 0)
	<h3 class="h3_cate"><span class="h3_cate_span">所有子分类</span></h3>
	<div class="clearfix">
	@foreach($subcate as $m)
		<a href="{{ url('/shop/cate',$m->id) }}" class="btn btn-sm btn-default">{{ $m->name }}</a>
	@endforeach
	</div>
	@endif
	

	<!-- 筛选 -->
	@if(count($all_attr_list) > 0)
	<h3 class="h3_cate mt20"><span class="h3_cate_span">筛选</span></h3>
	@foreach($all_attr_list as $m)
	<dl class="clearfix sx_row">
		<dt class="pull-left text-right sx_left">{{ $m['filter_attr_name'] }}：</dt>
		<dd class="pull-left sx_right">
			@foreach($m['attr_list'] as $s)
			<a href="{{ $s['url'] }}" class="btn btn-sm btn-default @if($s['selected']) btn-primary @endif">{{$s['attr_value']}}</a>
			@endforeach
		</dd>
	</dl>
	@endforeach
	@endif

	<h3 class="h3_cate mt20"><span class="h3_cate_span">{{ $info->name }}</span></h3>
	<div class="good_list row">
		@foreach($list as $l)
		<div class="col-xs-6 col-sm-4 col-md-3">
			<a href="{{ url('/shop/good',['id'=>$l->id,'format'=>$format]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
			<div class="good_info clearfix">
				<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id,'format'=>$format]) }}">{{ $l->title }}</a></h4>
				<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
			</div>
		</div>
		@endforeach
	</div>
	<div class="pages">
        {!! $list->links() !!}
    </div>

</section>

	

@endsection
