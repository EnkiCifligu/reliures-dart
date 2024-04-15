<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme VMagazine for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'vmagazine_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function vmagazine_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		

		// Install plugin from an arbitrary external source.
		array(
			'name'         => esc_html__('AccessPress Social Pro', 'vmagazine'), // The plugin name.
			'slug'         => 'accesspress-social-pro', // The plugin slug (typically the folder name).
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/accesspress-social-pro.zip',
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => esc_html__('Ultimate Form Builder', 'vmagazine'),
			'slug'         => 'ultimate-form-builder',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/ultimate-form-builder.zip',
			'required'     => false,
		),
		array(
			'name'         => esc_html__('Ultimate Author Box', 'vmagazine'),
			'slug'         => 'ultimate-author-box',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/ultimate-author-box.zip',
			'required'     => false,
		),	
		array(
			'name'         => esc_html__('Slider Revolution', 'vmagazine'),
			'slug'         => 'revslider',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/revslider.zip',
			'required'     => false,
		),		
		array(
			'name'         => esc_html__('Everest Coming Soon', 'vmagazine'),
			'slug'         => 'everest-coming-soon',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/everest-coming-soon.zip',
			'required'     => false,
		),
		array(
			'name'         => esc_html__('AccessPress Instagram Feed Pro', 'vmagazine'),
			'slug'         => 'accesspress-instagram-feed-pro',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/accesspress-instagram-feed-pro.zip',
			'required'     => false,
		),
		array(
			'name'         => esc_html__('AccessPress Anonymous Post Pro', 'vmagazine'),
			'slug'         => 'accesspress-anonymous-post-pro',
			'source'       => 'https://accesspressthemes.com/vmagazine-plugins/accesspress-anonymous-post-pro.zip',
			'required'     => false,
		),

		// Bundled plugins
		array(
			'name'         =>  esc_html__('Vmagazine Demo Importer', 'vmagazine'),
			'slug'         => 'access-demo-importer',
			'source'       => get_template_directory().'/inc/welcome/plugins/access-demo-importer.zip',
			'required'     => false,
		),
		array(
			'name'         => esc_html__('Vmagazine Companion', 'vmagazine'),
			'slug'         => 'vmagazine-companion',
			'source'       => get_template_directory().'/inc/welcome/plugins/vmagazine-companion.zip',
			'required'     => false,
		),

		// Include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => esc_html__('Page Builder by SiteOrigin','vmagazine'),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('Newsletter','vmagazine'),
			'slug'      => 'newsletter',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('Regenerate Thumbnails','vmagazine'),
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('WooCommerce','vmagazine'),
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('Theme Auto Update','vmagazine'),
			'slug'      => 'wp-envato-market',
			'source'    => 'https://github.com/envato/wp-envato-market/archive/master.zip',
		),

		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'vmagazine',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		
	);

	tgmpa( $plugins, $config );
}
