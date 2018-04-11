jQuery(function(){
	jQuery(window).scroll(function(){
	var sh = 190 - jQuery(window).scrollTop();
	var bottom_pos = (jQuery("#wrapper").width() - 1162)/2 - 380;
	var lheight = wrapper_left_bg_top == 0 ? '100%' : '100px';
	var rheight = wrapper_right_bg_top == 0 ? '100%' : '100px';
	if(jQuery(window).scrollTop() <= 190){
		jQuery("#wrapper").attr("style","background:url('"+back_img+"') no-repeat center "+sh+"px; background-attachment:fixed;");
		var lh = wrapper_left_bg_top + sh;
		var rh = wrapper_right_bg_top + sh;

		jQuery("#wrapper_left_bg").attr('style','width:380px;height:'+lheight+';position:fixed;display:block;top:'+lh+'px;left:'+bottom_pos+"px;");
		jQuery("#wrapper_right_bg").attr('style','width:380px;height:'+rheight+';position:fixed;display:block;top:'+rh+'px;right:'+bottom_pos+"px;");
	}else{
		jQuery("#wrapper").attr("style","background:url('"+back_img+"') no-repeat center 0;background-attachment:fixed;");
		jQuery("#wrapper_left_bg").attr('style','width:380px;height:'+lheight+';position:fixed;display:block;top:'+wrapper_left_bg_top+'px;left:'+bottom_pos+"px;");
		jQuery("#wrapper_right_bg").attr('style','width:380px;height:'+rheight+';position:fixed;display:block;top:'+wrapper_right_bg_top+'px;right:'+bottom_pos+"px;");
	}
	}).trigger("scroll");
});