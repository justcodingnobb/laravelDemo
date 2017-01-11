@extends('admin.right')

@if(App::make('com')->ifCan('database-import'))
@section('rmenu')
	<a href="{{ url('/admin/database/import') }}" class="btn-green f-l">[ 数据库恢复 ]</a>
@endsection
@endif

@section('content')
<form action="" method="post">
{{ csrf_field() }}
<table class="pure-table">
	<thead>
		<tr>
			<th width='50'><input type="checkbox" class="checkall"></th>
			<th width="150">名称</th>
			<th width="120">类型</th>
			<th width="180">编码</th>
			<th>大小</th>
		</tr>
	</thead>
	<tbody>
	@foreach($alltables as $a)
		<tr>
			<td><input type="checkbox" name="tables[]" class="check_s" value="{{ $a->Name }}"></td>
			<td>{{ $a->Name }}</td>
			<td>{{ $a->Engine }}</td>
			<td>{{ $a->Collation }}</td>
			<td>{{ ($a->Data_length + $a->Index_length)/1048576 }} MB</td>
		</tr>
	@endforeach
	</tbody>
</table>
<div class="clearfix mt10">
	<div class="mr10 f-l clearfix"><input type="checkbox" class="checkall"> 全选</div><button class="pure-button pure-button-primary pure-u-1-24 mr10">备份</button>
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