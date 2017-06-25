$(function(){
	// 初始化弹出框
	$('.alert_shop').delay(1500).slideUp(300);
	// 取购物车数量
	cartnum();
	// 修改数量时更新产品总价及所有总价
	$('.change_cart').on('change',function(event) {
		var that = $(this);
    	var gid = that.attr('data-gid');
		var num = that.val();
		var price = that.attr('data-price');
    	var new_prices = parseFloat(price) * parseInt(num);
    	// 更新购物车
		$.post(host+'shop/changecart',{gid:gid,num:num,price:price},function(d){
			if (d != 0) {
				cartnum();
		    	// 更新end
		    	$('.total_price_' + gid).html(new_prices.toFixed(2));
		    	$('.total_price_' + gid).attr('data-price',new_prices.toFixed(2));
		    	that.val(d);
		    	total_prices();
			}
			else
			{
				alert('修改数量失败，请稍后再试！');
			}
		});
		return;
	});
	// 点选择及取消时改价格
	$('.selected_checkbox').change(function(event) {
		var that = $(this);
    	var gid = that.attr('data-gid');
		// 判断是选中还是没选中
		if (that.is(':checked')) {
			var price = $('.total_price_' + gid).attr('data-price');
			$('.total_price_' + gid).text(price);
		}
		else
		{
    		$('.total_price_' + gid).text('0');
		}
    	total_prices();
		return;
	});
	/*打开添加购物车*/
	$('.good_addcart').on('click',function(){
		$('#myModal').modal('show');
	});
	/*打开直接购买*/
	$('.good_firstorder').on('click',function(){
		$('#myModal_order').modal('show');
	});
	// 移除购物车
	$(".remove_cart").on('click',function(){
		var that = $(this);
    	var gid = that.attr('data-gid');
    	var fid = that.attr('data-fid');
		$.post(host+'shop/removecart',{id:gid,fid:fid},function(d){
			if (d == 1) {
    			that.parents('.good_cart_list_div').remove();
    			// 重新取购物车数量，计算总价
				cartnum();
    			total_prices();
			}
			else
			{
				alert('移除失败，请稍后再试！');
			}
		});
	});
	// 确认功能
	$(".confirm").click(function(){
		if (!confirm("确实要进行此操作吗?")){
			return false;
		}else{
			return true;
		}
	});
	// 购物车数量变化
	$('.cart_dec').click(function(event) {
		var num = parseInt($('.cart_num').text());
		if (num > 1) {
			$('.cart_num').text(num - 1);
			$('.cartnum').val(num - 1);
		}
	});
	$('.cart_inc').click(function(event) {
		var num = parseInt($('.cart_num').text());
		$('.cart_num').text(num + 1);
		$('.cartnum').val(num + 1);
	});
	// 购物车页面
	$('.cart_dec_cart').on('click',function(event) {
		var gid = $(this).attr('data-gid');
		var num = parseInt($('.cart_num_cart_' + gid).text());
		if (num > 1) {
			$('.cart_num_cart_' + gid).text(num - 1);
			$('.cart_num_' + gid).val(num - 1);
		}
		// 计算总价
		$('.cart_num_' + gid).trigger('change');
		return;
	});
	$('.cart_inc_cart').on('click',function(event) {
		var gid = $(this).attr('data-gid');
		var num = parseInt($('.cart_num_cart_' + gid).text());
		$('.cart_num_cart_' + gid).text(num + 1);
		$('.cart_num_' + gid).val(num + 1);
		// 计算总价
		$('.cart_num_' + gid).trigger('change');
		return;
	});
	// 添加到购物车
	$('.addcart').click(function(event) {
		var gid = $('input[name="gid"]').val();
		var num = $('input[name="num"]').val();
		var spec_key = $('.spec_key').val();
		var gp = $('input[name="gp"]').val();
		var token = $('input[name="_token"]').val();
		var url = $('.form_addcart').attr('action');
		$.post(url,{gid:gid,spec_key:spec_key,num:num,gp:gp,_token:token},function(d){
			if (d == 1) {
    			// 重新取购物车数量，计算总价
				cartnum();
				$('#myModal').modal('hide');
				/*alert('添加成功！');*/
				$('.alert_good').slideToggle().delay(1500).slideToggle();
			}
			else
			{
				alert(d);
				$('#myModal').modal('hide');
			}
		});
	});
	// 直接购买
	$('.firstorder').click(function(event) {
		var gid = $('input[name="gid"]').val();
		var num = $('input[name="num"]').val();
		var spec_key = $('.spec_key').val();
		var gp = $('input[name="gp"]').val();
		var token = $('input[name="_token"]').val();
		var url = $('.form_addcart').attr('data-firstorder');
		$('.form_addcart').attr('action',url).submit();
	});
	// 直接购买数量
	// 购物车数量变化
	$('.first_cart_dec').click(function(event) {
		var num = parseInt($('.first_cart_num').text());
		if (num > 1) {
			$('.first_cart_num').text(num - 1);
			$('.cartnum').val(num - 1);
		}
	});
	$('.first_cart_inc').click(function(event) {
		var num = parseInt($('.first_cart_num').text());
		$('.first_cart_num').text(num + 1);
		$('.cartnum').val(num + 1);
	});
	// 添加到团购
	$('.tuan_addcart').click(function(event) {
		$('#myModal').modal('show');
		// var gid = $('input[name="gid"]').val();
		// var num = $('input[name="num"]').val();
		// var tid = $('input[name="tid"]').val();
		// var gp = $('input[name="gp"]').val();
		// var token = $('input[name="_token"]').val();
		// var url = $('.form_addcart').attr('action');
		// $.post(url,{gid:gid,tid:tid,num:num,gp:gp,_token:token},function(d){
		// 	if (d == 1) {
  //   			// 重新取购物车数量，计算总价
		// 		cartnum();
		// 		// $('#myModal').modal('hide');
		// 		/*alert('添加成功！');*/
		// 		$('.alert_good').slideToggle().delay(1500).slideToggle();
		// 	}
		// 	else
		// 	{
		// 		alert(d);
		// 		$('#myModal').modal('hide');
		// 	}
		// });
	});
	/*
	图片高度调整
	 */
	$(document).ready(function(){
		var imgs = $('.good_thumb img').first();
		var imgW = imgs.width();
		imgW = imgW == 0 ? '400' : imgW;
		var imgH = imgW == 400 ? 'auto' : imgW;
		$('.good_thumb img').width(imgW).height(imgH);
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
		$('.good_alert_num').html(data);
	});
}