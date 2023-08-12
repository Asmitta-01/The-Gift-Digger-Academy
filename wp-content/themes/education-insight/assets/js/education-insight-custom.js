

jQuery(function($){
 	"use strict";
   	jQuery('.gb_navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
  	});
});

function education_insight_gb_Menu_open() {
	jQuery(".mobile_menu_nav").addClass('show');
}
function education_insight_gb_Menu_close() {
	jQuery(".mobile_menu_nav").removeClass('show');
}

jQuery(function($){
	$('.gb_toggle').click(function () {
        education_insight_Keyboard_loop($('.mobile_menu_nav'));
    });
});

jQuery(window).load(function() {
	jQuery(".preloader").delay(2000).fadeOut("slow");
});

jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 100) {
		jQuery('.scrollup').addClass('is-active');
	} else {
  		jQuery('.scrollup').removeClass('is-active');
	}
});

jQuery( document ).ready(function() {
	jQuery('#education-insight-scroll-to-top').click(function (argument) {
		jQuery("html, body").animate({
	       scrollTop: 0
	   	}, 600);
	})
})
// sticky header
jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 120) {
        jQuery('.fixed_header').addClass('fixed');
    } else {
            jQuery('.fixed_header').removeClass('fixed');
    }
}); 