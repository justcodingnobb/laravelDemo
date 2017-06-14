@extends('default.layout')


@section('title')
    <title>购物车-{{ cache('config')['sitename'] }}</title>
@endsection


@section('content')
	<div class="container mt20">
			<h3 class="h3_cate"><span class="h3_cate_span">购物车</span></h3>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th width="40%">产品</th>
						<th width="15%">数量</th>
						<th width="15%">价格</th>
						<th width="15%">总价</th>
						<th>操作</th>
					</tr>
					@foreach($goodlists as $l)
					<tr>
						<td>
							<div class="media">
								<a href="{{ url('/shop/good',['id'=>$l->id,'format'=>$l->format['format']]) }}" class="pull-left"><img src="{{ $l->thumb }}" width="100" class="media-object" alt=""></a>
								<div class="media-body">
									<h4 class="mt5 cart_h4"><a href="{{ url('/shop/good',['id'=>$l->id,'format'=>$l->format['format']]) }}">{{ $l->title }}</a></h4>
									@if($l->format['format_name'] != '')<span class="btn btn-sm btn-info mt10">{{ $l->format['format_name'] }}</span>@endif
								</div>
							</div>
						</td>
						<td><input type="number" min="0" name="num[]" value="{{ $l->num }}" data-gid="{{ $l->id }}" data-fid="{{ $l->format['fid'] }}" data-price="{{ $l->price }}" class="form-control input-nums change_cart"></td>
						<td><span class="good_prices color_1">￥{{ $l->price }}</span></td>
						<td><span class="color_2">￥<span class="one_total_price total_price_{{ $l->id }}_{{ $l->format['fid'] }}">{{ $l->total_prices }}</span></span></td>
						<td><span class="remove_cart btn btn-sm btn-danger" data-gid="{{ $l->id }}" data-fid="{{ $l->format['fid'] }}">删除</span></td>
					</tr>
					@endforeach
				</table>
			</div>
			<h4 class="total_prices text-right color_2">￥{{ $total_prices }}</h4>
			<div class="mt20 clearfix pull-right">
				<form action="{{ url('shop/addorder') }}">
					{{ csrf_field() }}
					<input type="hidden" name="tt" value="{{ microtime(true) }}">
					<button type="submit" class="btn btn-primary">提交</button> 
					<button type="reset" name="reset" class="btn btn-default">重填</button>
				</form>
			</div>
	</div>
@endsection