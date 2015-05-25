(function ($) {
	function responsiveMobileMenu() {	
		$('.rmm').each(function() {
			$(this).children('ul').addClass('rmm-main-list');	// mark main menu list
		
			var $width = 0;
			$(this).children('ul').children('li').each(function() {
				$width += $(this).outerWidth();
			});
			
			$(this).attr('data-width', $width+'px');	
	 	});
	}
	function getMobileMenu() {
	
		/* 	build toggled dropdown menu list */
		$('.rmm').each(function() {	
			var menutitle = $(this).attr("data-menu-title");
			if ( menutitle === "" ) {
				menutitle = "Menu";
			}
			else if ( menutitle === undefined ) {
				menutitle = "Menu";
			}
			var $menulist = $(this).children('.rmm-main-list').html();
			var $menucontrols ="<div class='rmm-toggled-controls'><div class='rmm-toggled-title'>" + menutitle + "</div><div class='rmm-button'><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div></div>";
			$(this).prepend("<div class='rmm-toggled rmm-closed'>"+$menucontrols+"<div class='rmm-toggled-items'><ul>"+$menulist+"</ul></div></div>");
	
		});
	}
	
	function adaptMenu() {	
		/* 	toggle menu on resize */
		$('.rmm').each(function() {
			var $width = $(this).attr('data-width');
			$width = $width.replace('px', ''); 
			if ($(this).parent().width() < $width*1.01 ) {
				$(this).children('.rmm-main-list').hide(0);
				$(this).children('.rmm-toggled').show(0);
			}
			else {
				$(this).children('.rmm-main-list').show(0);
				$(this).children('.rmm-toggled').hide(0);
			}
		});
		//  Set scroll if menu too tall	
		var $height = $(window).height() - $('.rmm-toggled-controls').height();	
		$('.rmm-toggled-items').css('maxHeight', $height+'px');
		$('.rmm-toggled-items').css('overflow', 'scroll');
	}
	
	jQuery(function() {
		 responsiveMobileMenu();
		 getMobileMenu();
		 adaptMenu();

		 /* slide down mobile menu on click */	 
		 $('.rmm-toggled-controls .rmm-button, #primary-menu-trigger').click(function(){
			 var $thisMenu =  $(this).parents('.rmm-toggled:first');
		 	if ( $($thisMenu).is(".rmm-closed")) {
			 	 $($thisMenu).find('ul').stop().slideDown(300);
			 	 $($thisMenu).removeClass("rmm-closed");
			 	 submenuItems();
		 	}
		 	else {
				$($thisMenu).find('ul').stop().slideUp(300);
				$($thisMenu).addClass("rmm-closed");
		 	}		
		});	
	});
	
	function submenuItems() {
		$('.rmm-toggled ul>li:has(ul)').each(function() {
			$(this).append('<div class="sub-toggle"><div class="icon-plus"></div></div>');
			$(this).find('ul').slideToggle(500);
			});
		$('.sub-toggle').click(function(){
			$(this).siblings('ul').slideToggle(500);
			$(this).children('div').toggleClass( 'icon-plus icon-minus' );
		});	

	}
	
	
	/* 	hide mobile menu on resize */
	jQuery(window).resize(function() {
	 	adaptMenu();
	});
	
	$(document).ready(function() {
		$('.current-menu-item').each(function() {
			$(this).parents("li").last().addClass('current-parent-item');
		});
	});
	
})( jQuery );