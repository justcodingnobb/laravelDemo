var host = 'http://www.lshop.com/';
$(function(){
	cartnum();
	// 添加到购物车功能
	$('.good_addcart').on('click',function(){
		var id = $(this).attr('data-id');
		var num = 1;
		var price = $(this).attr('data-price');
		$.post(host+'addcart',{id:id,num:num,price:price},function(d){
			if (d == 1) {
				cartnum();
				alert('添加成功！');
			}
			else
			{
				alert('添加失败，请稍后再试！');
			}
		});
	});
	// 移除订单
	$(".order_clear").on('click',function(){
		var id = $(this).attr('data-id');
		var that = $(this);
		that.parent('li').remove();
	});
	// 移除购物车
	$(".cart_clear").on('click',function(){
		var id = $(this).attr('data-id');
		var that = $(this);
		$.post(host+'removecart',{id:id},function(d){
			if (d == 1) {
				cartnum();
				that.parent('li').remove();
				alert('删除成功！');
			}
			else
			{
				alert('删除失败，请稍后再试！');
			}
		});
	});
	// 算价格
	$(".good_num").on('change',function(){
		var num = $(this).val();
		var price = $(this).parent('.good_nums').siblings('.good_price').children('.good_prices').text();
		$(this).parent('.good_nums').siblings('.total_prices').children('.total_price').text(num*price);
	});
})

// 取购物车数量
function cartnum()
{
	$.get(host + 'cartnums',function(data){
		$('.cart_nums').html(data);
	});
}