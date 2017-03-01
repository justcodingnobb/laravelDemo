@extends('admin.right')

@section('rmenu')
	@if(App::make('com')->ifCan('wxmenu-add'))<a href="{{ url('/admin/wxmenu/add',$pid) }}" class="btn-green f-l">[ 添加菜单 ]</a>@endif
	@if(App::make('com')->ifCan('wxmenu-update'))<a href="{{ url('/admin/wxmenu/update') }}" class="btn-green f-l">[ 刷新菜单 ]</a>@endif
@endsection


@section('content')
<table class="pure-table">
	<thead>
		<tr>
			<td width="60">排序</td>
			<td width="60">ID</td>
			<td>菜单名称</td>
			<td>类型</td>
			<td>值</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	@foreach($all as $l)
		<tr>
			<td>{{ $l->listorder }}</td>
			<td>{{ $l->id }}</td>
			<td><a href="{{ url('/admin/wxmenu/index',$l->id) }}">{{ $l->name }}</a>
				@if(App::make('com')->ifCan('wxmenu-add'))
				<a href="{{ url('/admin/wxmenu/add',$l->id) }}" class="fa fa-plus-square add_submenu"></a>
				@endif
			</td>
			<td>{{ $linkname[$l->type] }}</td>
			<td>{{ $l->key }}{{ $l->url }}</td>
			<td>
				@if(App::make('com')->ifCan('wxmenu-edit'))
				<a href="{{ url('/admin/wxmenu/edit',$l->id) }}">修改</a> | 
				@endif
				@if(App::make('com')->ifCan('wxmenu-del'))
				<a href="{{ url('/admin/wxmenu/del',$l->id) }}" class="confirm">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection