@extends('admin.right')

@if(App::make('com')->ifCan('database-import'))
@section('rmenu')
	<a href="{{ url('/admin/database/import') }}" class="btn-green f-l">[ 数据库恢复 ]</a>
@endsection
@endif

@section('content')
<form action="{{ url('admin/database/delfile') }}" method="post">
{{ csrf_field() }}
<table class="pure-table">
	<thead>
		<tr>
			<th width='50'><input type="checkbox" class="checkall"></th>
			<th width="260">文件名称</th>
			<th width="120">文件大小</th>
			<th width="180">备份时间</th>
			<th width="150">卷号</th>
			<th>恢复</th>
		</tr>
	</thead>
	<tbody>
	@foreach($infos as $a)
		<tr>
			<td><input type="checkbox" name="tables[]" class="check_s" value="{{ $a['filename'] }}"></td>
			<td>{{ $a['filename'] }}</td>
			<td>{{ ceil(($a['filesize'])/1024) }} KB</td>
			<td>{{ $a['maketime'] }}</td>
			<td>{{ $a['number'] }}</td>
			<td><a href="{{ url('admin/database/import',['pre'=>$a['pre']]) }}" class="confirm">恢复</a></td>
		</tr>
	@endforeach
	</tbody>
</table>
<div class="clearfix mt10">
	<div class="mr10 f-l clearfix"><input type="checkbox" class="checkall"> 全选</div>
	@if(App::make('com')->ifCan('database-delfile'))
	<button class="pure-button pure-button-primary pure-u-1-24 mr10 confirm">删除</button>
	@endif
</div>
</form>
<script>
	$(".checkall").bind('change',function(){
		if($(this).is(":checked"))
		{
			$(".check_s").each(function(s){
				$(".check_s").eq(s).prop("checked",true);
			});
		}
		else
		{
			$(".check_s").each(function(s){
				$(".check_s").eq(s).prop("checked",false);
			});
		}
	});
</script>
@endsection