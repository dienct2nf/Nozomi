"use strict";

jQuery(document).on('ready', function() {

	initEvents();
	initStyles();
	initCollapseMenu();
	checkCountUp();
	initCountDown();
});

jQuery(window).on('scroll', function (event) {

	checkNavbar();
	checkGoTop();
	checkScrollAnimation();
}).scroll();

jQuery(window).on("resize", function () {

	setResizeStyles();
}).resize();

/* Navbar menu initialization */
function initCollapseMenu() {

	var navbar = jQuery('#navbar'),
		navbar_toggle = jQuery('.navbar-toggle'),
		navbar_wrapper = jQuery("#nav-wrapper");

    navbar_wrapper.on('click', '.navbar-toggle', function (e) {

        navbar_toggle.toggleClass('collapsed');
        navbar.toggleClass('collapse');
        navbar_wrapper.toggleClass('mob-visible');
    });

	// Anchor mobile menu
	navbar.on('click', '.menu-item-type-custom > a', function(e) {

		if ( typeof jQuery(this).attr('href') !== 'undefined' && jQuery(this).attr('href') !== '#' && jQuery(this).attr('href').charAt(0) === '#' )  {

	        navbar_toggle.addClass('collapsed');
	        navbar.addClass('collapse');
	        navbar_wrapper.removeClass('mob-visible');
    	}
    });

    navbar.on('click', '.menu-item-has-children > a', function(e) {

    	var el = jQuery(this);

    	if (!el.closest('#navbar').hasClass('collapse')) {

    		if ((el.attr('href') === undefined || el.attr('href') === '#') || e.target.tagName == 'A') {

		    	el.next().toggleClass('show');
		    	el.parent().toggleClass('show');

		    	return false;
		    }
	    }
    });

    var lastWidth;
    jQuery(window).on("resize", function () {

    	checkNavbar();

    	var winWidth = jQuery(window).width(),
    		winHeight = jQuery(window).height();

       	lastWidth = winWidth;
    });
}

/* Navbar attributes depends on resolution and scroll status */
function checkNavbar() {

	var navbar = jQuery('#navbar'),
		scroll = jQuery(window).scrollTop(),
    	navBar = jQuery('nav.navbar:not(.no-dark)'),
    	topBar = jQuery('.ltx-topbar-block'),
    	navbar_toggle = jQuery('.navbar-toggle'),
    	navbar_wrapper = jQuery("#nav-wrapper"),
	    slideDiv = jQuery('.slider-full'),
	    winWidth = jQuery(window).width(),
    	winHeight = jQuery(window).height(),
		navbar_mobile_width = navbar.data('mobile-screen-width');

   	if ( winWidth < navbar_mobile_width ) {

		navbar.addClass('navbar-mobile').removeClass('navbar-desktop');
	}
		else {

		navbar.addClass('navbar-desktop').removeClass('navbar-mobile');
	}

	navbar_wrapper.addClass('inited');

	if ( topBar.length ) {

		navBar.data('offset-top', topBar.height());
	}

    if (winWidth > navbar_mobile_width && navbar_toggle.is(':hidden')) {

        navbar.addClass('collapse');
        navbar_toggle.addClass('collapsed');
        navbar_wrapper.removeClass('mob-visible');
    }

    jQuery("#nav-wrapper.navbar-layout-transparent + .page-header, #nav-wrapper.navbar-layout-transparent + .main-wrapper").css('margin-top', '-' + navbar_wrapper.height() + 'px');


    if (scroll > 1) navBar.addClass('dark'); else navBar.removeClass('dark');
}


/* Check GoTop Visibility*/
function checkGoTop() {

	var gotop = jQuery('.ltx-go-top'),
		scrollBottom = jQuery(document).height() - jQuery(window).height() - jQuery(window).scrollTop();

	if ( gotop.length ) {

		if ( jQuery(window).scrollTop() > 400 ) {

			gotop.addClass('show');
		}
			else {

			gotop.removeClass('show');
    	}

    	if ( scrollBottom < 50 ) {

    		gotop.addClass('scroll-bottom');
    	}
    		else {

    		gotop.removeClass('scroll-bottom');
   		}
	}
}

/* All keyboard and mouse events */
function initEvents() {

	jQuery('.menu-types').on('click', 'a', function() {

		var el = jQuery(this);

		el.addClass('active').siblings('.active').removeClass('active');
		el.parent().find('.type-value').val(el.data('value'));

		return false;
	});

	/* Scrolling to navbar from "go top" button in footer */
    jQuery('.ltx-go-top').on('click', function() {

	    jQuery('html, body').animate({ scrollTop: 0 }, 1200);

	    return false;
	});


    jQuery('.alert').on('click', '.close', function() {

	    jQuery(this).parent().fadeOut();
	    return false;
	});

	jQuery(".topbar-icons.mobile, .topbar-icons.icons-hidden")
		.mouseover(function() {

			jQuery('.topbar-icons.icons-hidden').addClass('show');
			jQuery('#navbar').addClass('muted');
		})
		.mouseout(function() {
			jQuery('.topbar-icons.icons-hidden').removeClass('show');
			jQuery('#navbar').removeClass('muted');
	});

	// TopBar Search
    var searchHandler = function(event){

        if (jQuery(event.target).is(".top-search, .top-search *")) return;
        jQuery(document).off("click", searchHandler);
        jQuery('.top-search').removeClass('show-field');
        jQuery('#navbar').removeClass('muted');
    }

    jQuery('.top-search-ico-close').on('click', function (e) {

		jQuery(this).parent().toggleClass('show-field');
		jQuery('#navbar').toggleClass('muted');
    });

	jQuery('.top-search-ico').on('click', function (e) {

		e.preventDefault();
		jQuery(this).parent().toggleClass('show-field');
		jQuery('#navbar').toggleClass('muted');

        if (jQuery(this).parent().hasClass('show-field')) {

        	jQuery(document).on("click", searchHandler);
        }
        	else {

        	jQuery(document).off("click", searchHandler);
        }
	});

	jQuery('#top-search-ico-mobile').on('click', function() {

		window.location = '/?s=' + jQuery(this).next().val();
		return false;
	});

	var search_href = jQuery('.top-search').data('base-href');

	jQuery('.top-search input').keypress(function (e) {
		if (e.which == 13) {
			window.location = search_href + '?s=' + jQuery('.top-search input').val();
			return false;
		}
	});

	jQuery('.ltx-navbar-search span').on('click', function (e) {
		window.location = search_href + '?s=' + jQuery('.ltx-navbar-search input').val();
	});

	jQuery('.woocommerce').on('click', 'div.quantity > span', function(e) {

		var f = jQuery(this).siblings('input');
		if (jQuery(this).hasClass('more')) {
			f.val(Math.max(0, parseInt(f.val()))+1);
		} else {
			f.val(Math.max(1, Math.max(0, parseInt(f.val()))-1));
		}
		e.preventDefault();

		jQuery(this).siblings('input').change();

		return false;
	});

	jQuery('.ltx-arrow-down').on('click', function() {

		var next = jQuery(this).closest('.slider-zoom').closest('.vc_row').next();
		jQuery("html, body").animate({ scrollTop: jQuery(next).offset().top - 100 }, 500);
	});

	if ( jQuery("#ltx-modal").length && !ltxGetCookie('ltx-modal-cookie') ) {

		jQuery("#ltx-modal").modal("show");
	}

	setTimeout(function() { if ( typeof Pace !== 'undefined' && jQuery('body').hasClass('paceloader-enabled') ) { Pace.stop(); }  }, 3000);

	jQuery('#ltx-modal').on('click', '.ltx-modal-yes', function() {

    	jQuery('body').removeClass('modal-open');
	    jQuery('#ltx-modal').remove();
	    jQuery('.modal-backdrop').remove();
	    ltxSetCookie('ltx-modal-cookie', 1, jQuery(this).data('period'));
	});

	jQuery('#ltx-modal').on('click', '.ltx-modal-no', function() {

	    window.location.href = jQuery(this).data('no');
	    return false;
	});

	jQuery('.navbar').on( 'affix.bs.affix', function(){

	    if (!jQuery( window ).scrollTop()) return false;
	});

	jQuery('.ltx-mouse-move .vc_column-inner')
    .on('mouseover', function(){
   	  if ( typeof jQuery(this).data('bg-size') === 'undefined' ) {
   	  	jQuery(this).data('bg-size', jQuery(this).css('background-size'));
   	  }

      jQuery(this)[0].style.setProperty( 'background-size', parseInt(jQuery(this).data('bg-size')) + 10 + '%', 'important' );
    })
    .on('mouseout', function(){
      jQuery(this)[0].style.setProperty( 'background-size', jQuery(this).data('bg-size'), 'important' );
    })
	.on('mousesmove', function(e){

		jQuery(this)[0].style.setProperty( 'background-position', ((e.pageX - jQuery(this).offset().left) / jQuery(this).width()) * 100 + '% ' + ((e.pageY - jQuery(this).offset().top) / jQuery(this).height()) * 100 + '%', 'important' );
	});

	jQuery('.ltx-slider-fc .swiper-slide')
	.on('mouseover', function(){

		jQuery(this).prev().prev().addClass('hovered');
	})
	.on('mouseout', function(){

		jQuery(this).prev().prev().removeClass('hovered');
	});
}

function initCountDown() {

	var countDownEl = jQuery('.ltx-countdown');

	if (jQuery(countDownEl).length) {

			jQuery(countDownEl).each(function(i, el) {

			jQuery(el).countdown(jQuery(el).data('date'), function(event) {

				jQuery(this).html(event.strftime('' + jQuery(countDownEl).data('template')));
			});
		});
	}
}


function ltxUrlDecode(str) {

   return decodeURIComponent((str+'').replace(/\+/g, '%20'));
}


/* Adding custom classes to element */
function initStyles() {

	jQuery('form:not(.checkout, .woocommerce-shipping-calculator) select:not(#rating), aside select, .footer-widget-area select').wrap('<div class="select-wrap"></div>');
	jQuery('.wpcf7-checkbox').parent().addClass('margin-none');

	jQuery('input[type="submit"], button[type="submit"]').not('.btn').addClass('btn btn-xs');
	jQuery('#send_comment').removeClass('btn-xs');
	jQuery('#searchsubmit').removeClass('btn');

	jQuery('.woocommerce .ltx-item-descr .button').append('<span class="ltx-btn-after"></span>').addClass('btn btn-black-bordered').removeClass('button');
	jQuery('.woocommerce .button').addClass('btn btn-main color-hover-black').removeClass('button');

	jQuery('.woocommerce .wc-forward:not(.checkout)').removeClass('btn-black').addClass('btn-main');
	jQuery('.woocommerce-message .btn, .woocommerce-info .btn').addClass('btn-xs');
	jQuery('.woocommerce .price_slider_amount .btn').removeClass('btn-black color-hover-white').addClass('btn btn-main btn-xs color-hover-black');
	jQuery('.woocommerce .checkout-button').removeClass('btn-black color-hover-white').addClass('btn btn-main btn-xs color-hover-black');
	jQuery('button.single_add_to_cart_button').removeClass('btn-xs color-hover-white').addClass('color-hover-main');
	jQuery('.woocommerce .coupon .btn').removeClass('color-hover-white').addClass('color-hover-main');

	jQuery('.woocommerce .product .wc-label-new').closest('.product').addClass('ltx-wc-new');


	jQuery('.widget_product_search button').removeClass('btn btn-xs');
	jQuery('.input-group-append .btn').removeClass('btn-xs');

	jQuery('.ltx-hover-logos img').each(function(i, el) { jQuery(el).clone().addClass('ltx-img-hover').insertAfter(el); });

	jQuery(".container input[type=\"submit\"], .container input[type=\"button\"], .container .btn").wrap('<span class="ltx-btn-wrap"></span');
	jQuery('.search-form .ltx-btn-wrap').removeClass('ltx-btn-wrap');
	jQuery('.ltx-btn-wrap > .btn-main').parent().addClass('ltx-btn-wrap-main');
	jQuery('.ltx-btn-wrap > .btn-black').parent().addClass('ltx-btn-wrap-black');
	jQuery('.ltx-btn-wrap > .btn-white').parent().addClass('ltx-btn-wrap-white');

	jQuery('.ltx-btn-wrap > .color-hover-main').parent().addClass('ltx-btn-wrap-hover-main');
	jQuery('.ltx-btn-wrap > .color-hover-black').parent().addClass('ltx-btn-wrap-hover-black');
	jQuery('.ltx-btn-wrap > .color-hover-white').parent().addClass('ltx-btn-wrap-hover-white');

	jQuery('.ltx-btn-wrap > *').append('<span class="ltx-btn-overlay ltx-btn-overlay-top"></span><span class="ltx-btn-overlay ltx-btn-overlay-bottom"></span>');

	jQuery('.woocommerce .products .item .ltx-btn-wrap .btn');

	jQuery(".container .wpcf7-submit").removeClass('btn-xs').wrap('<span class="ltx-btn-wrap"></span');

	jQuery('.woocommerce-result-count, .woocommerce-ordering').wrapAll('<div class="ltx-wc-order"></div>');

	jQuery('.blog-post .nav-links > a').wrapInner('<span></span>');
	jQuery('.blog-post .nav-links > a[rel="next"]').wrap('<span class="next"></span>');
	jQuery('.blog-post .nav-links > a[rel="prev"]').wrap('<span class="prev"></span>');

	jQuery('section.bg-overlay-white, .wpb_row.bg-overlay-white, .wpb_column.bg-overlay-white').prepend('<div class="ltx-overlay-white"></div>');
	jQuery('section.bg-overlay-black, .wpb_row.bg-overlay-black, .wpb_column.bg-overlay-black .vc_column-inner').prepend('<div class="ltx-overlay-black"></div>');
	jQuery('section.bg-overlay-gray, .wpb_row.bg-overlay-gray').prepend('<div class="ltx-overlay-gray"></div>');
	jQuery('section.bg-overlay-dark, .wpb_row.bg-overlay-dark').prepend('<div class="ltx-overlay-dark"></div>');
	jQuery('section.bg-overlay-xblack, .wpb_row.bg-overlay-xblack').prepend('<div class="ltx-overlay-xblack"></div>');
	jQuery('section.bg-overlay-gradient, .wpb_row.bg-overlay-gradient').prepend('<div class="ltx-overlay-gradient"></div>');
	jQuery('section.bg-overlay-waves, .wpb_row.bg-overlay-waves').prepend('<div class="ltx-overlay-waves"></div>');
	jQuery('section.bg-overlay-half, .wpb_row.bg-overlay-half').prepend('<div class="ltx-overlay-half"></div>');
	jQuery('section.bg-overlay-divider, .wpb_row.bg-overlay-divider').prepend('<div class="ltx-overlay-divider"></div>');
	jQuery('section.bg-overlay-highlight, .wpb_row.bg-overlay-highlight, .wpb_column.bg-overlay-highlight > .vc_column-inner').prepend('<div class="ltx-overlay-highlight"></div>');
	jQuery('section.white-space-top, .wpb_row.white-space-top').prepend('<div class="ltx-white-space-top"></div>');

	var header_icon_class = jQuery('#ltx-header-icon').data('icon');

	var update_width = jQuery('.woocommerce-cart-form__contents .product-subtotal').outerWidth();
	jQuery('button[name="update_cart"]').css('width', update_width);

	jQuery('.wp-searchform .btn').removeClass('btn');

	if ( jQuery('.woocommerce .products').length ) {

		jQuery('.woocommerce .products .product').each(function(i, el) {

			var href = jQuery(el).find('a').attr('href'),
				img = jQuery(el).find('.image img'),
				btn = jQuery(el).find('.ltx-btn-wrap');

			jQuery(img).wrap('<a href="'+ href +'">');
			btn.clone().appendTo(jQuery(el).find('.image'));
		});
	}

	// Settings copyrights overlay for non-default heights
	var copyrights = jQuery('.copyright-block.copyright-layout-copyright-transparent'),
		footer = jQuery('#ltx-widgets-footer + .copyright-block'),
		widgets_footer = jQuery('#ltx-widgets-footer'),
		footerHeight = footer.outerHeight();

	widgets_footer.css('padding-bottom', 0 + footerHeight + 'px');
	footer.css('margin-top', '-' + (footerHeight - 1) + 'px');

	copyrights.css('margin-top', '-' + (copyrights.outerHeight() + 3) + 'px')

	// Cart quanity change
	jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').append('<span class="more"></span><span class="less"></span>');
	jQuery(document).off('updated_wc_div').on('updated_wc_div', function () {

		jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').append('<span class="more"></span><span class="less"></span>');
		initStyles();
	});
}

/* Styles reloaded then page has been resized */
function setResizeStyles() {

	var videos = jQuery('.blog-post article.format-video iframe'),
		container = jQuery('.blog-post'),
		bodyWidth = jQuery(window).outerWidth(),
		contentWrapper = jQuery('.ltx-content-wrapper.ltx-footer-parallax'),
		footerWrapper = jQuery('.ltx-content-wrapper.ltx-footer-parallax + .ltx-footer-wrapper');

		contentWrapper.css('margin-bottom', footerWrapper.outerHeight() + 'px');

	jQuery.each(videos, function(i, el) {

		var height = jQuery(el).height(),
			width = jQuery(el).width(),
			containerW = jQuery(container).width(),
			ratio = containerW / width;

		jQuery(el).css('width', width * ratio);
		jQuery(el).css('height', height * ratio);
	});

	if ( jQuery('.woocommerce .products').length ) {

		jQuery('.woocommerce .products .product').css('height', 'auto');

		jQuery('.woocommerce .products .product').each(function(i, el) {

			jQuery(el).css('height', jQuery(el).height() + 'px');
		});
	}

	document.documentElement.style.setProperty( '--fullwidth', bodyWidth + 'px' );
}

/* Starting countUp function */
function checkCountUp() {

	if (jQuery(".countUp").length){

		jQuery('.countUp').counterUp();
	}
}

function ltxGetCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

/* Scroll animation used for homepages */
function checkScrollAnimation() {

	var scrollBlock = jQuery('.ltx-check-scroll');
    if (scrollBlock.length) {

	    var scrollTop = scrollBlock.offset().top - window.innerHeight;

	    if (!scrollBlock.hasClass('done') && jQuery(window).scrollTop() > scrollTop) {

	    	scrollBlock.addClass('done');
	    }
	}
}

