jQuery(document).ready(function($){
	//open popup
	$('.cd-popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
});
jQuery(document).ready(function($){
	//open popup
	$('.a2').on('click', function(event){
		event.preventDefault();
		$('.a2-popup').addClass('is-visible');
	});
	
	//close popup
	$('.a2-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.a2-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.a2-popup').removeClass('is-visible');
	    }
    });
});

jQuery(document).ready(function($){
	//open popup
		$('.tc').addClass('is-visible');
	//close popup
	$('.tc').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.tc') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.tc').removeClass('is-visible');
	    }
    });
});