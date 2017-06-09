
<form action="{{ url('/xyshop/returngood/status',['id'=>$id]) }}" id="form-tuan" method="post">
	{{ csrf_field() }}
    <div class="form-group">
        <textarea name="data[shopmark]" placeholder="处理意见" class="form-control" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="status">状态：</label>
        <label class="radio-inline"><input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
            退货</label>
        <label class="radio-inline"><input type="radio" name="data[status]" class="input-radio" value="2">不退货</label>
    </div>
</form>
