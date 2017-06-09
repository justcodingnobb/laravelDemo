
<form action="{{ url('/xyshop/card/add') }}" id="form-tuan" method="post">
	{{ csrf_field() }}
    <div class="form-group">
        <label for="prices">金额：<span class="color-red">*</span>数字，每张多少钱</label>
        <input type="number" min="0" name="data[prices]" value="{{ old('data.prices') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="nums">数量：<span class="color-red">*</span>数字，生成多少张</label>
        <input type="number" min="0" name="data[nums]" value="{{ old('data.nums') }}" class="form-control">
    </div>
</form>
