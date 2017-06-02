<form action="{{ url('/xyshop/manzeng/add',['id'=>$id]) }}" class="pure-form-stacked" id="form-tuan" method="post">
	{{ csrf_field() }}
    <input type="hidden" name="data[good_id]" value="{{ $id }}">
    <div class="form-group">
        <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
    	<input type="text" name="data[title]" value="{{ old('data.title') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="price">满多少赠：<span class="color-red">*</span>数字</label>
        <input type="number" min="0" name="data[price]" value="{{ old('data.price') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="store">库存：<span class="color-red">*</span>数字</label>
        <input type="number" min="0" name="data[store]" value="{{ old('data.store') }}" class="form-control">
    </div>


    <div class="form-group">
        <label for="starttime">开始时间：<span class="color-red">*</span></label>
        <input type="text" name="data[starttime]" class="form-control" value="" id="laydate_t_1">
    </div>

    <div class="form-group">
        <label for="endtime">结束时间：<span class="color-red">*</span></label>
        <input type="text" name="data[endtime]" class="form-control" value="" id="laydate_t_2">
    </div>

    <div class="form-group">
        <label for="sort">排序：数字</label>
        <input type="text" name="data[sort]" value="0" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
            进行中</label>
        <label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="0">关闭</label>
    </div>
</form>