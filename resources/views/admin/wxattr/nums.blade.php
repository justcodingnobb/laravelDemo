@extends('admin.right')

@section('rmenu')
@if(App::make('com')->ifCan('wxattr-add'))
	<a href="{{ url('/admin/wxattr/add') }}" class="btn-green f-l">[ 添加素材 ]</a>
@endif
@if(App::make('com')->ifCan('wxattr-nums'))
	<a href="{{ url('/admin/wxattr/nums') }}" class="btn-green f-l">[ 素材总数 ]</a>
@endif
@endsection

@section('content')

<p>有使用次数限制，不要总是点击！</p>
<p>图片：{{ $nums['image_count'] }}，语音：{{$nums['voice_count']}}，视频：{{$nums['video_count']}}，图文：{{$nums['news_count']}} 。</p>

@endsection