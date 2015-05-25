jQuery(document).ready(function($) {

	//Caching Variables for performance
	var $body						= $('body');
	var $bodyHeight 				= $body.height();
	var $supermenu					= $('.supermenu');
	var $navHeight 					= $supermenu.height();
	var $topmenuCollapseMobile		= $('#supermenu-sm-navbar-collapse-mob');
	var $topmenuToggleMobile		= $('.visible-mobile .sm-navbar-toggle');
	var $navbar_collapse			= $('.sm-navbar-collapse');
	var $navbar_collapse_height		= $navbar_collapse.height();
	var $navbar_fixed_top			= 'sm-navbar-fixed-top';
	var $superside					= $('.superside');
	var $superside_toggler			= $('.superside-toggler');
	
    // Add Classes to <body> 
	$body.addClass(supermenu_vars.body_class);

	//Toggle Topmenu
	function smToggleTopmenu() {
		$topmenuCollapseMobile.toggleClass('expand');
		$topmenuToggleMobile.toggleClass('ssclose');
	}
	$topmenuToggleMobile.on('click', function() {
		smToggleTopmenu();
	});
	
	// Topmenu Dropdowns Mobile
	$('li.smdropdown > a > .smdropdown-togglenb').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.smdropdown').toggleClass('open')
	});
	$('li.smdropdown-submenu .smdropdown-togglenb').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.smdropdown-submenu').toggleClass('open')
	});

	// Toggle Search
  $(function () {
    $('a[href="#smsearch"]').on('click', function(event) {
      $('#smsearch').toggleClass('open');
      $('.sm-searchform input[type="search"]').focus();   
      event.preventDefault();
      event.stopPropagation();
    	$(document).one('click', function (e) {
		    $('#smsearch').toggleClass('open');
		});
      
    });
  });

	//Fixed Topmenu
  if (supermenu_vars.sm_fixed_menu) { // Fixed Basic
    if (supermenu_vars.sm_after_fixed_menu === 'fixed_basic') {
      $(function() {
        $supermenu.addClass($navbar_fixed_top);
      });
    }
    else if (supermenu_vars.sm_after_fixed_menu === 'visible_up') { //Visible on Scroll up
      $(function() {
        $supermenu.addClass($navbar_fixed_top);
      });
      var myElement = document.querySelector(".supermenu");
      var headroom  = new Headroom(myElement);
      headroom.init();
    }
    else if (supermenu_vars.sm_after_fixed_menu === 'hide_then_show') { // Hide then Show
      $body.animate({ paddingTop: 0 });
        $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
          if ( supermenu_vars.sm_hide_then_show_fade ) {
            $supermenu.addClass('sm-navbar-fixed-top animated fadeInDown');
          } else {
            $supermenu.addClass('sm-navbar-fixed-top');
          }
          $body.css({ paddingTop: 100 });
          $body.addClass('notransition');
           setTimeout(function() {
               $body.removeClass('notransition');
           }, 50);
        } else {
          $supermenu.removeClass('sm-navbar-fixed-top fadeInDown');
          $body.css({ paddingTop: 0 });
          $body.addClass('notransition'); //Todo, don't like the hack
           setTimeout(function() {
               $body.removeClass('notransition');
           }, 50);
        }
      });
    }
  }
  
  // Topmenu Color & Logo Changes
  if (supermenu_vars.sm_change_color == true && supermenu_vars.sm_fixed_menu == true) {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $(".sm-navbar-brand-primary.img-logo").removeClass('logo-visible');
        $(".sm-navbar-brand-alt.img-logo").addClass('logo-visible');
        $(".sm-navbar-brand.text-logo").addClass('alt-color');
        $(".sm-navbar-brand img").removeClass('animated');
        $supermenu
          .addClass('change-color')
      } else {
        $(".sm-navbar-brand-primary.img-logo").addClass('logo-visible');
        $(".sm-navbar-brand-alt.img-logo").removeClass('logo-visible');
        $(".sm-navbar-brand.text-logo").removeClass('alt-color');
        $supermenu
          .removeClass('change-color')
      }
    });
  }
  
  //Topmenu Height Change
   if (supermenu_vars.sm_menu_change_size === 'change-size' && supermenu_vars.sm_fixed_menu == true) {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $supermenu
          .addClass(supermenu_vars.sm_menu_change_size);
      } else {
        $supermenu
          .removeClass(supermenu_vars.sm_menu_change_size);
      }
    });
  }
  
  // Topmenu Width Change
  if (supermenu_vars.sm_change_menu_width == true && supermenu_vars.sm_new_menu_width === 'full_width_then_container') {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $(".no-container").addClass('sm-container');
      } else {
        $(".no-container").removeClass('sm-container');
      }
    });
  }
  else if (supermenu_vars.sm_change_menu_width == true && supermenu_vars.sm_new_menu_width === 'container_then_full_width') {
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
        $(".supermenu > div").addClass('no-container');
      } else {
        $(".supermenu > div").removeClass('no-container');
      }
    });
  }
  
  //Topmenu Padding
  if (supermenu_vars.sm_fixed_menu == true && supermenu_vars.sm_menu_configura_padding === 'automatic' && supermenu_vars.sm_after_fixed_menu === 'fixed_basic' && supermenu_vars.sm_visible_load == false) {
    $body.animate({ paddingTop: 0 });
  }
  
  // Hide Topmenu on Load
  if (supermenu_vars.sm_visible_load == false) {
    $('.topmenu-toggler').on('click', function(e) {
      $supermenu.toggleClass("is-hidden");
      $('.topmenu-toggler').toggleClass("ssclose");
    });
  }
  
  // Superside Toggle Function
  function smToggleSuperside() {
	  	$superside.toggleClass('is-visible');
			$superside_toggler.toggleClass('ssclose');
			$body.toggleClass('superside-open');
  }
  
  // Superside Close Function
  function smCloseSuperside() {
	  $superside.removeClass('is-visible');
		$superside_toggler.removeClass('ssclose');
		$body.removeClass('superside-open');
  }
  
  // Open Superside on hash link click
  $('a[href="#togglesuperside"]').on('click', function(event) {
  	$("html, body").animate({ scrollTop: 0 }, "slow");
		event.preventDefault();
		event.stopPropagation();
  	smToggleSuperside();
  });
  
  // Open Superside on superside toggler click
  $(function () {
    $superside_toggler.on('click', function (event) {
    	$("html, body").animate({ scrollTop: 0 }, "slow");
      event.preventDefault();
      event.stopPropagation();
      smToggleSuperside();
    });
  });
  
  // Close Superside on close icon click
  $(function () {
    $('.ss-inner-close').on('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      smCloseSuperside();
    });
  });
  
  // Close Superside on Body Click
  $("body.superside-enabled").on("tap",function(event){
		smCloseSuperside();
  });
  
  // stopPropagation if clicked inside Supersid
  $superside.on('click',function(event){
		event.stopPropagation();
  });
  $superside.on('tap',function(event){
    event.stopPropagation();
  });
  
  // Toggle Superside on Mobile
  $(function () {
    $superside_toggler.on("tap",function(event){
      event.preventDefault();
      event.stopPropagation();
      smToggleSuperside();
    });
  });
  
	// Superside Dropdown on Hover
  $(function () {
    $('.superside.ss-on-hover .menu-item-has-children').on('hover', function(event) {
      $(this).children('a').toggleClass('rotate-icon');
      $(this).children('.sub-menu').toggleClass('show');
    });
  });
  
  // Superside Dropdown on Click
  $(function () {
    $('.superside.ss-on-click .menu-item-has-children > a').on('click', function(event) {
      event.preventDefault();
      $(this).toggleClass('rotate-icon');
      $(this).parent().children('.sub-menu').toggleClass('show');
    });
  });

	// Megamenu Height Fix
  $('.supermenu .megamenu .smdropdown-menu').each(function() {
    if ( $(this).has('.menu-item-has-children') ) {
      var megamenu_title_height	= $('li.menu-item-has-children', this).height();
      var megamenu_items_height	= $('.smdropdown-menu', this).height();
      $(this).css( 'minHeight', megamenu_title_height + megamenu_items_height + 20);
    }
  });

	//Style_2 hide menu items
	if (supermenu_vars.sm_style_2_hide_nav == true) {
	  $(window).scroll(function() {
	    var scroll = $(window).scrollTop();
	    if (scroll >= supermenu_vars.sm_effect_triggerpoint) {
	      $('.supermenu').addClass('sm-hide-menu-items');
	    } else {
	      //$(".supermenu > div").addClass('sm-container');
	      $('.supermenu').removeClass('sm-hide-menu-items');
	    }
	  });
	}

	/* Add is-social-icon class to menu item if it has icon */
  $(".menu-item-name:has(._mi)").parent().parent().addClass('is-social-icon');
});