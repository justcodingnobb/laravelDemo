<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">
            用户名：
            <span class="color-red">*</span>
        </label>
        {{ $info->name }}
    </div>


    <div class="form-group">
        <label for="section_id">
            部门：
            <span class="color-red">*</span>
        </label>
        <select name="data[section_id]" id="data[section_id]" class="form-control">
            <option value="">请选择</option>
            @foreach($section as $r)
            <option value="{{ $r->id }}"@if($r->id == $info->section_id) selected="selected"@endif>{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="role_id">
            角色：
            <span class="color-red">*</span>
        </label>
        @foreach($rolelist as $r)
        <label class="checkbox-inline"><input type="checkbox" class="check-mr" name="role_id[]" value="{{ $r->
            id }}"> {{ $r->name }}</label>
        @endforeach
    </div>
    
    <div class="form-group">
        <label for="realname">
            真实姓名：
            <span class="color-red">*</span>
        </label>
        <input type="text" name="data[realname]" class="form-control" value="{{ old('data.realname',$info->realname) }}">
    </div>
    <div class="form-group">
        <label for="name">
            邮箱：
            <span class="color-red">*</span>
        </label>
        <input type="text" name="data[email]" class="form-control" value="{{ old('data.email',$info->email) }}">
    </div>

    <div class="form-group">
        <label for="name">
            电话：
            <span class="color-red">*</span>
        </label>
        <input type="text" name="data[phone]" class="form-control" value="{{ old('data.phone',$info->phone) }}">
    </div>
    
    <div class="form-group">
        <!-- 初始用户不能被禁用及删除 -->
        @if($info['id'] != 1)
        <label for="name">状态：</label>
        <input type="radio" name="data[status]"@if ($info['status'] == 1) checked="checked"@endif class="input-radio" value="1">
        启用
        <input type="radio" name="data[status]"@if ($info['status'] != 1) checked="checked"@endif class="input-radio" value="0">禁用
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/admin/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>

<script>
    $(function(){
        var rids = [{!! $rids !!}];
        $(".check-mr").each(function(s){
            var thisVal = $(this).val();
            $.each(rids,function(i){
                if(rids[i] == thisVal){
                    $(".check-mr").eq(s).prop("checked",true);
                }
            });
        });
    })
</script>