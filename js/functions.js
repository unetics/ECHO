
jQuery( window ).scroll(function() {
		$('#header').toggleClass('sticky-header', $(document).scrollTop() > 0);
});

var $ = jQuery.noConflict();
var SEMICOLON = SEMICOLON || {};

(function($){

	// USE STRICT
	"use strict";

	SEMICOLON.initialize = {

		init: function(){
			SEMICOLON.initialize.stickyElements();
			SEMICOLON.initialize.goToTop();
			SEMICOLON.initialize.verticalMiddle();

			$('.fslider').addClass('preloader2');

		},


		verticalMiddle: function(){
			if( $verticalMiddleEl.length > 0 ) {
				$verticalMiddleEl.each( function(){
					var element = $(this),
						verticalMiddleH = element.outerHeight();

					if( element.parents('#slider').length > 0 ) {
						if( $header.hasClass('transparent-header') && ( $('body').hasClass('device-lg') || $('body').hasClass('device-md') ) ) {
							verticalMiddleH = verticalMiddleH - 70;
							if( $slider.next('#header').length > 0 ) { verticalMiddleH = verticalMiddleH + 100; }
						}
					}

					if( $('body').hasClass('device-xs') || $('body').hasClass('device-xxs') ) {
						if( element.parents('.full-screen').length && !element.parents('.force-full-screen').length ){
							element.css({ position: 'relative', top: '0', width: 'auto', marginTop: '0', padding: '60px 0' }).addClass('clearfix');
						} else {
							element.css({ position: 'absolute', top: '50%', width: '100%', marginTop: -(verticalMiddleH/2)+'px' });
						}
					} else {
						element.css({ position: 'absolute', top: '50%', width: '100%', marginTop: -(verticalMiddleH/2)+'px' });
					}
				});
			}
		},

		stickyElements: function(){
			if( $siStickyEl.length > 0 ) {
				var siStickyH = $siStickyEl.outerHeight();
				$siStickyEl.css({ marginTop: -(siStickyH/2)+'px' });
			}

			if( $dotsMenuEl.length > 0 ) {
				var opmdStickyH = $dotsMenuEl.outerHeight();
				$dotsMenuEl.css({ marginTop: -(opmdStickyH/2)+'px' });
			}
		},

		goToTop: function(){
			$goToTopEl.click(function() {
				$('body,html').stop(true).animate({scrollTop:0},400);
				return false;
			});
		},

		goToTopScroll: function(){
				if($window.scrollTop() > 40) {
					$goToTopEl.fadeIn();
				} else {
					$goToTopEl.fadeOut();
				}
		}

	};

	SEMICOLON.header = {

		init: function(){

			SEMICOLON.header.menufunctions();
			SEMICOLON.header.stickyMenu();
			SEMICOLON.header.darkLogo();
			SEMICOLON.header.topsearch();
			SEMICOLON.header.topcart();
			SEMICOLON.header.splitmenu();

		},


		menuInvert: function() {

			$('#primary-menu .mega-menu-content, #primary-menu ul ul').each( function( index, element ){
				var $menuChildElement = $(element);
				var windowWidth = $window.width();
				var menuChildOffset = $menuChildElement.offset();
				var menuChildWidth = $menuChildElement.width();
				var menuChildLeft = menuChildOffset.left;

				if(windowWidth - (menuChildWidth + menuChildLeft) < 0) {
					$menuChildElement.addClass('menu-pos-invert');
				}
			});

		},

		menufunctions: function(){

			$( '#primary-menu ul li:has(ul)' ).addClass('sub-menu');
			$( '.top-links ul li:has(ul) > a' ).append( ' <i class="icon-angle-down"></i>' );
			$( '.top-links > ul' ).addClass( 'clearfix' );

		},

		stickyMenu: function( headerOffset ){
			if ($window.scrollTop() > headerOffset) {
					$('#header').addClass('sticky-header');
					SEMICOLON.header.stickyMenuClass();
			} else {
				SEMICOLON.header.removeStickyness();
			}
		},

		removeStickyness: function(){
			if( $header.hasClass('sticky-header') ){
				$('body:not(.side-header) #header:not(.no-sticky)').removeClass('sticky-header');
				$('#page-menu:not(.dots-menu,.no-sticky)').removeClass('sticky-page-menu');
				$header.removeClass().addClass(oldHeaderClasses);
				$headerWrap.removeClass().addClass(oldHeaderWrapClasses);
				if( !$headerWrap.hasClass('force-not-dark') ) { $headerWrap.removeClass('not-dark'); }
				SEMICOLON.slider.swiperSliderMenu();
				SEMICOLON.slider.revolutionSliderMenu();
				var t=setTimeout(function(){ SEMICOLON.header.splitmenu(); },450);
			}
			if( $header.hasClass('responsive-sticky-header') ){
				$('body.sticky-responsive-menu #header').removeClass('responsive-sticky-header');
			}
		},

		darkLogo: function(){
			if( ( $header.hasClass('dark') || $('body').hasClass('dark') ) && !$headerWrap.hasClass('not-dark') ) {
				if( defaultDarkLogo ){ defaultLogo.find('img').attr('src', defaultDarkLogo); }
				if( retinaDarkLogo ){ retinaLogo.find('img').attr('src', retinaDarkLogo); }
			} else {
				if( defaultLogoImg ){ defaultLogo.find('img').attr('src', defaultLogoImg); }
				if( retinaLogoImg ){ retinaLogo.find('img').attr('src', retinaLogoImg); }
			}
		},

		stickyMenuClass: function(){
			if( stickyMenuClasses ) { var newClassesArray = stickyMenuClasses.split(/ +/); } else { var newClassesArray = ''; }
			var noOfNewClasses = newClassesArray.length;

			if( noOfNewClasses > 0 ) {
				var i = 0;
				for( i=0; i<noOfNewClasses; i++ ) {
					if( newClassesArray[i] == 'not-dark' ) {
						$header.removeClass('dark');
						$headerWrap.addClass('not-dark');
					} else if( newClassesArray[i] == 'dark' ) {
						$headerWrap.removeClass('not-dark force-not-dark');
						if( !$header.hasClass( newClassesArray[i] ) ) {
							$header.addClass( newClassesArray[i] );
						}
					} else if( !$header.hasClass( newClassesArray[i] ) ) {
						$header.addClass( newClassesArray[i] );
					}
				}
			}

		},

		fullWidthMenu: function(){
			if( $('body').hasClass('stretched') ) {
				if( $header.find('.container-fullwidth').length > 0 ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 120 }); }
				if( $header.hasClass('full-header') ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 60 }); }
			} else {
				if( $header.find('.container-fullwidth').length > 0 ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 120 }); }
				if( $header.hasClass('full-header') ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 80 }); }
			}
		},

		topsocial: function(){
			if( $topSocialEl.length > 0 ){
				if( $('body').hasClass('device-md') || $('body').hasClass('device-lg') ) {
					$topSocialEl.show();
					$topSocialEl.find('a').css({width: 40});

					$topSocialEl.find('.ts-text').each( function(){
						var $clone = $(this).clone().css({'visibility': 'hidden', 'display': 'inline-block', 'font-size': '13px', 'font-weight':'bold'}).appendTo($('body')),
							cloneWidth = $clone.innerWidth() + 52;
						$(this).parent('a').attr('data-hover-width',cloneWidth);
						$clone.remove();
					});

					$topSocialEl.find('a').hover(function() {
						if( $(this).find('.ts-text').length > 0 ) {
							$(this).css({width: $(this).attr('data-hover-width')});
						}
					}, function() {
						$(this).css({width: 40});
					});
				} else {
					$topSocialEl.show();
					$topSocialEl.find('a').css({width: 40});

					$topSocialEl.find('a').each(function() {
						var topIconTitle = $(this).find('.ts-text').text();
						$(this).attr('title', topIconTitle);
					});

					$topSocialEl.find('a').hover(function() {
						$(this).css({width: 40});
					}, function() {
						$(this).css({width: 40});
					});

					if( $('body').hasClass('device-xxs') ) {
						$topSocialEl.hide();
						$topSocialEl.slice(0, 8).show();
					}
				}
			}
		},

		topsearch: function(){
			$("#top-search-trigger").click(function(e){
				$("body").toggleClass('top-search-open');
				$topCart.toggleClass('top-cart-open', false);
				$( '#primary-menu > ul, #primary-menu > div > ul' ).toggleClass("show", false);
				$pagemenu.toggleClass('pagemenu-active', false);
				if ($("body").hasClass('top-search-open')){
					$('#top-search').find('input').focus();
				}

				e.stopPropagation();
				e.preventDefault();
			});

		},

		topcart: function(){

			$("#top-cart-trigger").click(function(e){
				$('#page-menu').toggleClass('pagemenu-active', false);
				$topCart.toggleClass('top-cart-open');
				e.stopPropagation();
				e.preventDefault();
			});

		},

		splitmenu: function(){

			if( ( $('body').hasClass('device-lg') || $('body').hasClass('device-md') ) && $header.hasClass('split-menu') ) {
				var element = $('#logo'),
					logoWidth = defaultLogo.find('img').outerWidth(),
					logoPosition = logoWidth/2,
					menuPadding = logoPosition + 30;

				element.css({ 'margin-left': -logoPosition+'px' });

				$('#primary-menu').find('.menu-left').css({ 'padding-right': menuPadding+'px' });
				$('#primary-menu').find('.menu-right').css({ 'padding-left': menuPadding+'px' });
			}

		}

	};

	SEMICOLON.documentOnResize = {

		init: function(){

			var t = setTimeout( function(){
				SEMICOLON.header.topsocial();
				SEMICOLON.header.fullWidthMenu();
				SEMICOLON.initialize.verticalMiddle();
			}, 500 );

		}

	};

	SEMICOLON.documentOnReady = {

		init: function(){
			SEMICOLON.initialize.init();
			SEMICOLON.header.init();
			SEMICOLON.documentOnReady.windowscroll();
		},

		windowscroll: function(){

			var headerOffset = $header.offset();
			var headerWrapOffset = $headerWrap.offset();

			$window.on( 'scroll', function(){
				SEMICOLON.initialize.goToTopScroll();
			});
		}

	};

	SEMICOLON.documentOnLoad = {

		init: function(){
			SEMICOLON.initialize.verticalMiddle();
			SEMICOLON.header.topsocial();
		}

	};

	var $window = $(window),
		$wrapper = $('#wrapper'),
		$header = $('#header'),
		$headerWrap = $('#header-wrap'),
		oldHeaderClasses = $header.attr('class'),
		oldHeaderWrapClasses = $headerWrap.attr('class'),
		stickyMenuClasses = $header.attr('data-sticky-class'),
		defaultLogo = $('#logo').find('.standard-logo'),
		defaultLogoWidth = defaultLogo.find('img').outerWidth(),
		retinaLogo = $('#logo').find('.retina-logo'),
		defaultLogoImg = defaultLogo.find('img').attr('src'),
		retinaLogoImg = retinaLogo.find('img').attr('src'),
		defaultDarkLogo = defaultLogo.attr('data-dark-logo'),
		retinaDarkLogo = retinaLogo.attr('data-dark-logo'),
		$pagemenu = $('#page-menu'),
		$onePageMenuEl = $('.one-page-menu'),
		onePageGlobalOffset = 0,
		$portfolio = $('#portfolio'),
		$slider = $('#slider'),
		$sliderParallaxEl = $('.slider-parallax'),
		$pageTitle = $('#page-title'),
		$portfolioItems = $('.portfolio-ajax').find('.portfolio-item'),
		$portfolioDetails = $('#portfolio-ajax-wrap'),
		$portfolioDetailsContainer = $('#portfolio-ajax-container'),
		$portfolioAjaxLoader = $('#portfolio-ajax-loader'),
		prevPostPortId = '',
		$topCart = $('#top-cart'),
		$verticalMiddleEl = $('.vertical-middle'),
		$topSocialEl = $('#top-social').find('li'),
		$siStickyEl = $('.si-sticky'),
		$dotsMenuEl = $('.dots-menu'),
		$goToTopEl = $('#gotoTop'),
		$fullScreenEl = $('.full-screen'),
		$commonHeightEl = $('.common-height'),
		$testimonialsGridEl = $('.testimonials-grid'),
		$pageSectionEl = $('.page-section'),
		$parallaxEl = $('.parallax'),
		$parallaxPageTitleEl = $('.page-title-parallax'),
		$youtubeBgPlayerEl = $('.yt-bg-player'),
		$textRotaterEl = $('.text-rotater');

	$(document).ready( SEMICOLON.documentOnReady.init );
	$window.load( SEMICOLON.documentOnLoad.init );
	$window.on( 'resize', SEMICOLON.documentOnResize.init );
	
	$(document).keyup(function(e) {
		if(e.keyCode === 27 && $('#top-search input').is( ":focus" )){
			$("body").removeClass( 'top-search-open');
		}
	});

})(jQuery);


