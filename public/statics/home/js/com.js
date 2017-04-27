$(function() {
	// 计算高度及宽度
	/*document.load = resizeH();
	$(window).resize(function(){
		resizeH();
	});*/
});
// 防止上拉下拉出现 浏览器滑动
function stopScrolling(touchEvent) {
	touchEvent.preventDefault();
}
// 计算高度及宽度
function resizeH(){
	var w = $('.b_img').width();
	var ww = $('body').width();
	if (ww < 1100) {
		var h = w*130/375;
		$('.b_img').height(h + 'px');
	}
	else
	{
		$('.b_img').height('360px');
	}
}
