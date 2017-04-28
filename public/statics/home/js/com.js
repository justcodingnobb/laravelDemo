$(function(){
	// 初始化弹出框
	$('.alert_shop').delay(1500).slideUp(300);
	// 取购物车数量
	cartnum();
	// 修改数量时更新产品总价及所有总价
	$('.change_cart').change(function(event) {
		var that = $(this);
    	var gid = that.attr('data-gid');
    	var fid = that.attr('data-fid');
		var num = that.val();
		var price = that.attr('data-price');
    	var new_prices = parseFloat(price) * parseInt(num);
    	// 更新购物车
		$.post(host+'shop/changecart',{gid:gid,num:num,price:price,fid:fid},function(d){
			if (d == 1) {
				cartnum();
		    	// 更新end
		    	$('.total_price_' + gid + '_' + fid).html(new_prices.toFixed(2));
		    	total_prices();
			}
			else
			{
				alert('修改数量失败，请稍后再试！');
			}
		});
	});
	// 移除购物车
	$(".remove_cart").on('click',function(){
		var that = $(this);
    	var gid = that.attr('data-gid');
    	var fid = that.attr('data-fid');
		$.post(host+'shop/removecart',{id:gid,fid:fid},function(d){
			if (d == 1) {
    			that.parent('td').parent('tr').remove();
    			// 重新取购物车数量，计算总价
				cartnum();
    			total_prices();
			}
			else
			{
				alert('删除失败，请稍后再试！');
			}
		});
	});
})
// 更新总价
function total_prices()
{
	var total_price = 0;
	$('.one_total_price').each(function(index, el) {
		var v = $(el).text();
		total_price = total_price + parseFloat(v);
	});
	$('.total_prices').html('￥' + total_price.toFixed(2));
}
// 取购物车数量
function cartnum()
{
	$.get(host + 'shop/cartnums',function(data){
		$('.cart_nums').html(data);
	});
}