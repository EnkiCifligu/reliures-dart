/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/**
 * Dynamic Internal/Embedded Style for a Control
 */
function vmagazine_add_dynamic_css( control, style ) {
	control = control.replace( '[', '-' );
	control = control.replace( ']', '' );
	jQuery( 'style#' + control ).remove();

	jQuery( 'head' ).append(
		'<style id="' + control + '">' + style + '</style>'
	);
}



( function( $ ) {
	"use strict";

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

function vmagazine_hexToRGB(hex, alpha) {
    var r = parseInt(hex.slice(1, 3), 16),
        g = parseInt(hex.slice(3, 5), 16),
        b = parseInt(hex.slice(5, 7), 16);

    if (alpha) {
        return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
    } else {
        return "rgb(" + r + ", " + g + ", " + b + ")";
    }
}

/**
* Mobile navigation background position
*
*/
var mobileNavOverlay = $('.vmagazine-mobile-navigation-wrapper').find('.img-overlay').length;
if( mobileNavOverlay ){

	wp.customize( 'vmagazine_mobile_header_bg_position_x', function( value ) {
			value.bind( function( to ) {
				$( '.mob-search-form,.mobile-navigation' ).css('background-position-x', to );
			} );
		} );
	wp.customize( 'vmagazine_mobile_header_bg_position_y', function( value ) {
		value.bind( function( to ) {
			$( '.mob-search-form,.mobile-navigation' ).css('background-position-y', to );
		} );
	} );
	wp.customize( 'vmagazine_mobile_header_bg_repeat', function( value ) {
			value.bind( function( to ) {
				$( '.mob-search-form,.mobile-navigation' ).css('background-repeat', to );
			} );
		} );
	wp.customize( 'vmagazine_mobile_header_bg_attachment', function( value ) {
			value.bind( function( to ) {
				$( '.mob-search-form,.mobile-navigation' ).css('background-attachment', to );
			} );
		} );
	wp.customize( 'vmagazine_mobile_header_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.mob-search-form .img-overlay,.mobile-navigation .img-overlay' ).css('background-color', to );
		} );
	} );

}else{
	wp.customize( 'vmagazine_mobile_header_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.mob-search-form,.mobile-navigation' ).css('background-color', to );
		} );
	} );
}
/**
* Footer Background options
*/	
var footerOverlay = $('.site-footer').find('.img-overlay').length;

if( footerOverlay > 0 ){
	wp.customize( 'vmagazine_footer_bg_position_x', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css('background-position-x', to );
		} );
	} );
	wp.customize( 'vmagazine_footer_bg_position_y', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css('background-position-y', to );
		} );
	} );
	wp.customize( 'vmagazine_footer_bg_repeat', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css('background-repeat', to );
		} );
	} );
	wp.customize( 'vmagazine_footer_bg_attachment', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css('background-attachment', to );
		} );
	} );

	wp.customize( 'vmagazine_footer_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .img-overlay' ).css('background-color', to );
		} );
	} );

}else{

	wp.customize( 'vmagazine_footer_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css('background-color', to );
		} );
	} );
}

//News ticker title
wp.customize( 'vmagazine_ticker_caption', function( value ) {
	value.bind( function( to ) {
		$( '.vmagazine-ticker-caption span' ).text( to );
	} );
} );


/**
* Additional color options
* @since 1.0.3
*/

/**
* Top header
*/	
//bg color
wp.customize( 'vmagazine_top_header_bg_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout1 .vmagazine-top-header,header.header-layout3 .vmagazine-top-header,header.header-layout4 .vmagazine-top-header' ).css('background', to );
	} );
} );

//link color
wp.customize( 'vmagazine_top_header_link_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout1 .vmagazine-top-header .top-menu ul li a,header.header-layout3 .vmagazine-top-header .top-menu ul li a,header.header-layout1 .vmagazine-top-header .top-left ul.social li a,header.header-layout3 .vmagazine-top-header .top-right ul.social li a' ).css('color', to );
	} );
} );

//link color:hover
wp.customize( 'vmagazine_top_header_link_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout1 .vmagazine-top-header .top-left ul.social li a:hover,header.header-layout3 .vmagazine-top-header .top-right ul.social li a:hover,header.header-layout1 .vmagazine-top-header .top-menu ul li a:hover,header.header-layout3 .vmagazine-top-header .top-menu ul li a:hover { color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_top_header_link_color_hover', dynamicStyle );
		}

	} );
} );

//top header text color
wp.customize( 'vmagazine_top_header_text_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var transColor = vmagazine_hexToRGB(color, 0.5);
			var dynamicStyle = 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field, header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field,header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field, header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field,header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form.search-form:after, header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form.search-form:after { color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-moz-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-webkit-input-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-ms-input-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-moz-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-webkit-input-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-ms-input-placeholder{ color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary:before{ background: ' + transColor + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_top_header_text_color', dynamicStyle );
		}

	} );
} );

/**
* Main menu colors
*/

//header navigation bg color
wp.customize( 'vmagazine_header_nav_bg_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = '.boxed-width header.header-layout3 .site-main-nav-wrapper,header.header-layout3 .site-main-nav-wrapper,.site-main-nav-wrapper,header.header-layout2 .vmagazine-nav-wrapper,header.header-layout1 .vmagazine-nav-wrapper, header.header-layout4 nav.main-navigation .nav-wrapper,.vmagazine-mob-outer { background: ' + color + '; } ';
				dynamicStyle += 'header.header-layout4 nav.main-navigation .nav-wrapper { border-bottom: none;}';
			vmagazine_add_dynamic_css( 'vmagazine_header_nav_bg_color', dynamicStyle );
		}

	} );
} );

//menu link color
wp.customize( 'vmagazine_header_nav_link_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = '.sidebar-icon i,.search-toggle i,.site-header-cart i,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,.main-navigation i,header.header-layout2 .vmagazine-nav-wrapper.menu-fixed-triggered nav.main-navigation .nav-wrapper, header.header-layout2 .vmagazine-nav-wrapper.menu-fixed-triggered nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a { color: ' + color + '; } ';
				dynamicStyle += 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:after{ background: ' + color+';}';
			vmagazine_add_dynamic_css( 'vmagazine_header_nav_link_color', dynamicStyle );
		}

	} );
} );



//menu link colors:hover
wp.customize( 'vmagazine_header_nav_link_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,.site-header i:hover:not(ul.social) { color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_nav_link_color_hover', dynamicStyle );
		}

	} );
} );


//menu link bg color: hover	
wp.customize( 'vmagazine_header_nav_link_bg_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover { background: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_nav_link_bg_color_hover', dynamicStyle );
		}

	} );
} );

/**
* Submenu color options
*
*/

//submenu link colors
wp.customize( 'vmagazine_header_submenu_link_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a' ).css('color', to );
	} );
} );
//submenu link colors dropdown icons
wp.customize( 'vmagazine_header_submenu_link_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after { color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_submenu_link_color', dynamicStyle );
		}

	} );
} );

//submenu link colors:hover
wp.customize( 'vmagazine_header_submenu_link_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover { color: ' + color + ' !important; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_submenu_link_color_hover', dynamicStyle );
		}

	} );
} );


//submenu background color
wp.customize( 'vmagazine_header_submenu_bg_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu' ).css('background', to );
	} );
} );

/**
* Mega-Menu color options
*/

//navigation bg color
wp.customize( 'vmagazine_header_mega_menu_nav_bg_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap' ).css('background', to );
	} );
} );

//mega menu navigation colors
wp.customize( 'vmagazine_header_mega_menu_nav_color', function( value ) {
	value.bind( function( to ) {
		$( 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a' ).css('color', to );
	} );
} );

//mega menu navigation colors:hover
wp.customize( 'vmagazine_header_mega_menu_nav_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var dynamicStyle = 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat { color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_mega_menu_nav_color_hover', dynamicStyle );
		}

	} );
} );

//mega menu navigation bg colors:hover
wp.customize( 'vmagazine_header_mega_menu_nav_bg_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = 'header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat { background: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_header_mega_menu_nav_bg_color_hover', dynamicStyle );
		}

	} );
} );

/**
* Logo section area
*/

//logo area bg color
wp.customize( 'vmagazine_header_logo_section_bg_color', function( value ) {
	value.bind( function( to ) {
		$( '.site-header .logo-wrapper,.site-header .logo-ad-wrapper,.site-header .logo-wrapper-section,header.header-layout4 .logo-wrapper-section .vmagazine-container .social-icons,header.header-layout4 .logo-wrapper-section .vmagazine-container .header-search-wrapper .vmagazine-search-form-primary,header.header-layout4 .logo-wrapper-section .vmagazine-container .vmagazine-search-form-primary form.search-form input.search-field,header.header-layout1 .logo-ad-wrapper, header.header-layout3 .logo-ad-wrapper,header.header-layout2 .logo-ad-wrapper .middle-search input.search-field' ).css('background', to );
	} );
} );

//text colors
wp.customize( 'vmagazine_header_logo_section_text_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.site-header .logo-wrapper,.site-header .logo-ad-wrapper,.site-header .logo-wrapper-section,header.header-layout2 .logo-ad-wrapper .middle-search input.search-field,header.header-layout4 .logo-wrapper-section .vmagazine-container .social-icons ul.social li a,header.header-layout4 .logo-wrapper-section .vmagazine-container .header-search-wrapper .search-close,header.header-layout4 .logo-wrapper-section .vmagazine-container .search-toggle i { color: ' + color + '; } ';
                dynamicStyle += 'header.header-layout2 .logo-ad-wrapper .middle-search input.search-field::placeholder { color: ' + color + ' !important; } ';                
			vmagazine_add_dynamic_css( 'vmagazine_header_logo_section_text_color', dynamicStyle );
		}

	} );
} );

/**
* Ticker color Options
* @since 1.0.3
*/

//bg color
wp.customize( 'vmagazine_ticker_bg_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.vmagazine-ticker-wrapper { background: ' + color + '; } ';                
			vmagazine_add_dynamic_css( 'vmagazine_ticker_bg_color', dynamicStyle );
		}

	} );
} );
//ticker title color
wp.customize( 'vmagazine_ticker_title_text_color', function( value ) {
	value.bind( function( to ) {
		$( '.vmagazine-ticker-wrapper .default-layout .vmagazine-ticker-caption, .vmagazine-ticker-wrapper .layout-two .vmagazine-ticker-caption' ).css('color', to );
	} );
} );

//ticker news color
wp.customize( 'vmagazine_ticker_news_color', function( value ) {
	value.bind( function( to ) {
		$( '.ticker-wrapp ul li a' ).css('color', to );
	} );
} );

//ticker news color:hover
wp.customize( 'vmagazine_ticker_news_color_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.ticker-wrapp ul li a:hover { color: ' + color + ' !important; } ';
			vmagazine_add_dynamic_css( 'vmagazine_ticker_news_color_hover', dynamicStyle );
		}

	} );
} );

//ticker date color
wp.customize( 'vmagazine_ticker_date_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date, .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lslide .single-news .date, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lslide .single-news .date { color: ' + color + '; } ';
				dynamicStyle += ' .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date:before, .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lslide .single-news .date:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lslide .single-news .date:before { background: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_ticker_date_color', dynamicStyle );
		}

	} );
} );

//ticker navigation border color
//ticker nav icon color
wp.customize( 'vmagazine_ticker_nav_icon_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev:before,.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext:before { color: ' + color + '; } ';
				dynamicStyle =+ '.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev,.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSNex { border-color: '+ color + ';}';
			vmagazine_add_dynamic_css( 'vmagazine_ticker_nav_icon_color', dynamicStyle );
		}

	} );
} );

/**
* Container Width
* @since 1.0.3
*/
//container width for full width
wp.customize( 'vmagazine_container_width', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var	dynamicStyle = '.vmagazine-home-wrapp,.vmagazine-container,.boxed-width .vmagazine-main-wrapper,.boxed-width header.header-layout3 .site-main-nav-wrapper.menu-fixed-triggered, .boxed-width header .vmagazine-nav-wrapper.menu-fixed-triggered,.boxed-width .vmagazine-container,.vmagazine-fullwid-slider .vmagazine-container { max-width: ' + color + 'px; } ';
			vmagazine_add_dynamic_css( 'vmagazine_container_width', dynamicStyle );
		}

	} );
} );



//boxed inner bg color
wp.customize( 'vmagazine_boxed_bg_color_inside', function( value ) {
	value.bind( function( to ) {
		$( '.boxed-width .vmagazine-main-wrapper' ).css('background', to );
	} );
} );

// widget bg colors
wp.customize( 'vmagazine_framed_widget_bg_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.block-post-wrapper.block_layout_3 .single-post .content-wrapper,.vmagazine-post-col.block_layout_1,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper,.vmagazine-rec-posts.recent-post-widget,.vmagazine-featured-slider.featured-slider-wrapper .section-wrapper,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper,.block-post-wrapper.list,.widget .tagcloud, .top-footer-wrap .vmagazine-container .widget.widget_tag_cloud .tagcloud,.block-post-wrapper.grid,.vmagazine-mul-cat-tabbed .block-content-wrapper,.widget.widget_categories ul, .top-footer-wrap .vmagazine-container .widget_pages > ul,.widget_vmagazine_block_posts_column .block-post-wrapper.block_layout_4 .single-post,.widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper,.vmagazine-block-post-slider .block-content-wrapper,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel,.vmagazine-grid-list.grid-two,.vmagazine-post-carousel .block-carousel,.vmagazine-timeline-post .timeline-post-wrapper,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner,.vmagazine-block-post-car-small .lSSlideOuter .carousel-wrap .single-post,.vmagazine-mul-cat.layout-one .block-content-wrapper,.vmagazine-container .vmagazine-sidebar .widget.widget_archive ul,.top-footer-wrap .vmagazine-container .widget select, .vmagazine-container .vmagazine-sidebar .widget.widget_archive select, .top-footer-wrap .vmagazine-container .widget.widget_archive select,.vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap, .top-footer-wrap .vmagazine-container .widget.widget_calendar .calendar_wrap,.vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar th, .vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar td,.vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul, .top-footer-wrap .vmagazine-container .widget.widget_meta ul, .top-footer-wrap .vmagazine-container .widget.widget_pages ul, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul, .top-footer-wrap .vmagazine-container .widget.widget_rss ul,.search-field,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget form select,body.right-sidebar .container-wrapp-inner #primary,.vmagazine-container #primary .entry-content nav.post-navigation .nav-links a p,.vertical .ap_tab_content,.widget .custom-html-widget,.vmagazine-container #primary .comment-respond .comment-form input, .vmagazine-container #primary .comment-respond .comment-form textarea,.search-res-wrap';
			var	dynamicStyle = selector+'{ background: ' + color + '; } ';
			var borderStyles = '.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .small-thumbs-wrapper .small-thumbs-inner .slider-smallthumb,.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slider-item-wrapper .slider-bigthumb { border-color:'+ color +';}';
			vmagazine_add_dynamic_css( 'vmagazine_framed_widget_bg_color', dynamicStyle );
		}

	} );
} );


//elements heading title colors
wp.customize( 'vmagazine_elements_title_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.vmagazine-container #primary .entry-header h1.entry-title,.vmagazine-container #primary .vmagazine-related-wrapper .single-post h3.small-font,.vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title,.block-post-wrapper.block_layout_3 .single-post .content-wrapper .small-font a,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .large-font a,.vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content a,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font a,.vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption h3.small-font a,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post h3.small-font a,.vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption h3,.block-post-wrapper.list .single-post .post-content-wrapper .large-font,.block-post-wrapper.grid .posts-wrap .single-post .post-content-wrapper h3.large-font,.vmagazine-mul-cat-tabbed .block-content-wrapper .top-post-wrapper .single-post .post-caption-wrapper h3.large-font,.vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .single-post .post-caption-wrapper h3.small-font,.widget_vmagazine_block_posts_column .block-post-wrapper.block_layout_4 .single-post h3.small-font,.widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper .single-post .post-caption h3.small-font,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel .post-caption h3,.vmagazine-grid-list.grid-two .single-post.first-post h3.large-font,.vmagazine-grid-list.grid-two .single-post h3.large-font,.vmagazine-block-post-car-small h3.extra-large-font,.vmagazine-mul-cat.layout-one .block-cat-content .right-posts-wrapper .single-post .post-caption-wrapper h3.small-font,.vmagazine-mul-cat.layout-one .block-cat-content .left-post-wrapper .post-caption-wrapper h3.large-font,.element-has-desc .vmagazine-grid-list.grid-two .single-post.first-post h3.large-font,.element-has-desc .vmagazine-grid-list.grid-two .single-post h3.large-font,.search-content .search-content-wrap .cont-search-wrap .title a,.vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper h2.entry-title,.vmagazine-archive-layout2.right-sidebar .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title, .vmagazine-archive-layout2.left-sidebar .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper h3.small-font';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_elements_title_colors', dynamicStyle );
		}

	} );
} );

//elements heading title colors:hover
wp.customize( 'vmagazine_elements_title_colors_hover', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.block-post-wrapper.block_layout_3 .single-post .content-wrapper .small-font a:hover,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .large-font a:hover,.vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content a:hover, .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content span a:hover,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font a:hover,.vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption h3.small-font a:hover,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post h3.small-font a:hover,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .left-post-wrapper .single-post:hover .post-caption-wrapper .small-font a,.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slider-item-wrapper .slider-bigthumb:hover .post-captions h3.large-font a, .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .small-thumbs-wrapper .small-thumbs-inner .slider-smallthumb:hover .post-captions h3.large-font a,.vmagazine-post-carousel .block-carousel .single-post:hover .post-caption h3.large-font a,h3 a:hover,h2 a:hover';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_elements_title_colors_hover', dynamicStyle );
		}

	} );
} );

//elements content color
wp.customize( 'vmagazine_elements_content_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = ".vmagazine-post-col.block_layout_1 .single-post .content-wrapper p,.vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption .post-content,.block-post-wrapper.list .single-post .post-content-wrapper .post-content p,.vmagazine-mul-cat-tabbed .block-content-wrapper .top-post-wrapper .single-post .post-caption-wrapper p,.vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner span.posted-month, .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner span.posted-year,.element-has-desc .vmagazine-grid-list.grid-two .single-post .post-content p,.vmagazine-mul-cat.layout-one .block-cat-content .left-post-wrapper .post-caption-wrapper p,.vmagazine-container #primary .entry-content p,.ap-dropcaps.ap-square,.entry-content h3,.entry-content h2,.entry-content h1,.entry-content h4,.entry-content h5,.entry-content h6,.entry-content,.vmagazine-container #primary .vmagazine-related-wrapper .single-post .post-contents,.vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .entry-content p,.apss-share-text,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget p, .top-footer-wrap .vmagazine-container .widget.widget_text .textwidget p,.vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li cite,.widget_calendar,.vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar caption, .top-footer-wrap .vmagazine-container .widget.widget_calendar .calendar_wrap table#wp-calendar caption,input[type='text'], input[type='email'], input[type='url'], input[type='password'], input[type='search'],.vmagazine-container .vmagazine-sidebar .widget.widget_categories select, .vmagazine-container .vmagazine-sidebar .widget.widget_archive select,.vmagazine-container .vmagazine-sidebar .widget.widget_te2xt .textwidget form select,.vmagazine-container #primary .comment-respond .comment-form p.logged-in-as,.vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .prev-link .prev-text h2, .vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .next-link .next-text h2,.navigation.pagination .nav-links a.page-numbers, .widget .tagcloud a,.widget.widget_categories ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li a,.widget_calendar a,.vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget.widget_meta ul li a, .top-footer-wrap .vmagazine-container .widget.widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul li a, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul li a, .top-footer-wrap .vmagazine-container .widget.widget_rss ul li a, .top-footer-wrap .vmagazine-container .widget.widget_archive ul li a,.vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more,.vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:after,.vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper .entry-content p";
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_elements_content_colors', dynamicStyle );
		}

	} );
} );
//element post meta colors
wp.customize( 'vmagazine_elements_meta_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.vmagazine-container #primary .entry-meta,.post-meta,.vmagazine-block-post-car-small .post-content-wrapper .date,.vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content span a,.search-content .search-content-wrap .cont-search-wrap .post-meta,.vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-meta,.posted-date';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
				dynamicStyle += '.post-meta span:after,.vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption .post-meta span:after,.vmagazine-container #primary .entry-meta span:after { background: ' + color + ';} ';
			vmagazine_add_dynamic_css( 'vmagazine_elements_meta_colors', dynamicStyle );
		}

	} );
} );



//widgets border colors
wp.customize( 'vmagazine_elements_border_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li, .widget.widget_categories ul li,.vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget form select,.widget .tagcloud a,.navigation .nav-links a,.vmagazine-container #primary .vmagazine-related-wrapper .single-post,.vmagazine-container #primary .comment-respond .comment-form,.ap-dropcaps.ap-square,.vmagazine-grid-list.grid-two .single-post,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post,.vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .second-col-wrapper,.vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .single-post,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font,.vmagazine-rec-posts.recent-post-widget .recent-posts-content,.vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide,.block-post-wrapper.list .single-post,.block-post-wrapper.grid .posts-wrap .single-post,.widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper .single-post,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper,.vmagazine-mul-cat.layout-one .block-cat-content .right-posts-wrapper .single-post,.vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post,.navigation.pagination .nav-links a.page-numbers,.navigation.pagination .nav-links .page-numbers.current';
			var	dynamicStyle = selector+'{ border-color: ' + color + '; } ';
				dynamicStyle +='.vmagazine-container #primary .comment-respond .comment-form textarea { border: 1px solid '+ color +';}';
				dynamicStyle +='.vmagazine-timeline-post .timeline-post-wrapper .single-post:before { background: '+ color +';}';
				dynamicStyle +='.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper:before { border-color: transparent '+ color +' transparent transparent;}';
			vmagazine_add_dynamic_css( 'vmagazine_elements_border_colors', dynamicStyle );
		}

	} );
} );







/**
* Breadcrumbs colors
*/

//current page/post
wp.customize( 'vmagazine_post_current_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.vmagazine-breadcrumb-wrapper .vmagazine-bread-home li.current';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_post_current_colors', dynamicStyle );
		}

	} );
} );

//page/post color
wp.customize( 'vmagazine_post_link_colors', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.vmagazine-breadcrumb a,.vmagazine-breadcrumb-wrapper .vmagazine-bread-home li:after';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_post_link_colors', dynamicStyle );
		}

	} );
} );


/**
* Widget title colors 
* @since 1.0.3
*/

//template five title bg color
wp.customize( 'vmagazine_title_layout_five_title_bg_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = ' .template-five .widget-title span, .template-five .block-title span,.template-five .widget-title:before, .template-five .block-title:before,.template-four .widget-title span, .template-four .block-title span, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg, .template-four .comment-respond h4.comment-reply-title span, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span,.template-four .vmagazine-mul-cat-tabbed .block-header h4.block-title:before, .template-four .vmagazine-mul-cat.layout-one .block-header h4.block-title:before, .template-four .vmagazine-block-post-slider .block-header h4.block-title:before, .template-four .vmagazine-slider-tab-carousel .block-post-wrapper h4.block-title:before, .template-four .slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-header h4.block-title:before, .template-four .vmagazine-mul-cat.block-post-wrapper.layout-two .block-title::before,.template-three .widget-title span, .template-three .block-title span,.template-three .widget-title:before, .template-three .block-title:before';
			var	dynamicStyle = selector+'{ background: ' + color + '; } ';
				dynamicStyle += '.template-four .widget-title span:after, .template-four .block-title span:after, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg:after, .template-four .comment-respond h4.comment-reply-title span:after, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span:after { border-color: '+ color +' transparent transparent transparent; }';
				dynamicStyle += '.template-four .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs .vmagazine-tabbed-links li.active a:before, .template-four .vmagazine-mul-cat.layout-one .block-header .child-cat-tabs .vmagazine-tab-links li.active a:before, .template-four .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li.active a:before, .template-four .vmagazine-slider-tab-carousel .slider-cat-tabs-carousel .slider-tab-links-carousel li.active a:before, .template-four .slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-header .slider-cat-tabs ul.slider-tab-links li.active a:before, .template-four .vmagazine-mul-cat.block-post-wrapper.layout-two .block-header .child-cat-tabs .vmagazine-tab-links li.active a:before { border-color: transparent transparent ' + color + ' transparent; }';
				dynamicStyle += '.template-three .widget-title span:after, .template-three .block-title span:after { border-color: transparent transparent transparent '+ color +'; }';
			vmagazine_add_dynamic_css( 'vmagazine_title_layout_five_title_bg_color', dynamicStyle );
		}

	} );
} );

wp.customize( 'vmagazine_title_layout_one_title_bg_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var newColor = vmagazine_hexToRGB(color,0.2);
			var selector = '.template-two .widget-title:before, .template-two .block-title:before';
			var	dynamicStyle = selector+'{ background: ' + newColor + '; } ';
				dynamicStyle += '.widget-title:after, .block-title:after { background: '+ color +';}';
			vmagazine_add_dynamic_css( 'vmagazine_title_layout_one_title_bg_color', dynamicStyle );
		}

	} );
} );


//widget title color
wp.customize( 'vmagazine_widget_title_color', function( value ) {
	value.bind( function( color ) {
		if (color == '') {
			wp.customize.preview.send( 'refresh' );
		}
		if ( color ) {
			var selector = '.template-five .widget-title span, .template-five .block-title span,.template-four .widget-title span, .template-four .block-title span, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg, .template-four .comment-respond h4.comment-reply-title span, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span,.template-three .widget-title span, .template-three .block-title span,.template-two .widget-title, .template-two .block-title,.widget-title, .block-title';
			var	dynamicStyle = selector+'{ color: ' + color + '; } ';
			vmagazine_add_dynamic_css( 'vmagazine_widget_title_color', dynamicStyle );
		}

	} );
} );


} )( jQuery );
