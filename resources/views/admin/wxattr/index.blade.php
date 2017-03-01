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

<table class="pure-table">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th width="80">类型</th>
			<th>本地url</th>
			<th>media_id</th>
			<th>微信url</th>
			<th width="150">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($list as $a)
		<tr>
			<td>{{ $a->id }}</td>
			<td>{{ $a->type }}</td>
			<td><textarea readonly="readonly" class="pure-u-11-12">{{ $a->localurl }}</textarea></td>
			<td><textarea readonly="readonly" class="pure-u-11-12">{{ $a->media_id }}</textarea></td>
			<td><textarea readonly="readonly" class="pure-u-11-12">{{ $a->url }}</textarea></td>
			<td>
				@if(App::make('com')->ifCan('wxattr-del'))
				<a href="{{ url('/admin/wxattr/del',$a->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<!-- 分页，appends是给分页添加参数 -->
<div class="pages clearfix">
{!! $list->links() !!}
<span class="f-r">共 {!! $list->count() !!} 页</span>
</div>
@endsection