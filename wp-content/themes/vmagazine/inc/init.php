<?php
/**
 * Include all required files
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */



/** 
**Include vmagazine functions
**/

require get_template_directory().'/inc/vmagazine-functions.php';

/** 
*Include vmagazine hooks
*/

require get_template_directory().'/inc/etc/hooks.php';

/** 
* Include metaboxes
*/
require get_template_directory().'/inc/metabox/vmagazine-author-metabox.php';


/**
* Preloaders
*/
$vmagazine_preloader_show = get_theme_mod('vmagazine_preloader_show','hide');
if( $vmagazine_preloader_show == 'show' ){

	require get_template_directory().'/inc/etc/preloader/preloader.php';

}




/** 
**Include vmagazine breadcrumb,shortcode,mega-menu
**/

require get_template_directory().'/inc/etc/vmagazine-breadcrumbs.php';

/**
* Include mega menu for the theme
*
*/
require get_template_directory().'/inc/etc/vmagazine-mega-menu.php';

/** 
**Include vmagazine widgets
**/

require get_template_directory().'/inc/widgets/widget-functions.php';



/**
*
* Include customizer value reset file
*/
require get_template_directory().'/inc/customizer/customizer-reset/init.php';



/**
*
* Include ajax functions for home blocks
*/
require get_template_directory().'/inc/vmagazine-ajax-functions.php';


/**
*
* Dynamic CSS
*/
require get_template_directory().'/inc/etc/dynamic-css.php';

/**
* Load WooCommerce compatibility file.
*/
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory().'/inc/etc/woocommerce-hooks.php';
}


/**
* Theme welcome page
*
*/
require get_template_directory().'/inc/welcome/welcome.php';

/**
* Customizer tabs controllers
*
*/
require get_template_directory().'/inc/customizer/customizer-tabs/init.php';

/**
* TGMPA plugins installation
* 
*/
require get_template_directory().'/inc/tgmpa/plugins.php';