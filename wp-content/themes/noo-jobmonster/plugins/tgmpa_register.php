<?php
/**
 * This file register the required and recommended plugins to used in this theme.
 *
 *
 * @package    NOO Blank
 * @subpackage Plugin Registration
 * @version    1.0.0
 * @author     NooTheme Team
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://www.nootheme.com
 */

if ( ! function_exists( 'noo_register_theme_plugins' ) ) :
	function noo_register_theme_plugins() {

		$plugins = array(
			array(
				'name'               => 'Visual Composer',
				'slug'               => 'js_composer',
				'source'             => 'http://wp.nootheme.com/plugin-files/js_composer.zip',
				'required'           => false,
				'version'            => '5.5.4',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => 'Front-End PM',
				'slug'               => 'front-end-pm',
				'required'           => false,
			),			
			array(
				'name'               => 'Slider Revolution',
				'slug'               => 'revslider',
				'source'             => 'http://wp.nootheme.com/plugin-files/revslider.zip',
				'required'           => false,
				'version'            => '5.4.8',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => 'Contact Form 7',
				'slug'               => 'contact-form-7',
				'required'           => false,
			),
			array(
				'name'               => 'WooCommerce',
				'slug'               => 'woocommerce',
				'required'           => false,
			),
				// array(
				// 	'name'               => 'Noo Indeed Integration',
				// 	'slug'               => 'noo-import-indeed',
				// 	'source'             => get_template_directory_uri() . '/plugins/noo-import-indeed.zip',
				// 	'required'           => false,
				// 	'version'            => '',
				// 	'force_activation'   => false,
				// 	'force_deactivation' => false,
				// 	'external_url'       => '',
				// ),
		);

		if( is_plugin_active( 'front-end-pm-pro/front-end-pm-pro.php' ) ) {
			unset( $plugins[1] );
		}

		$config = array(
				'domain'            => 'noo',              // Text domain - likely want to be the same as your theme.
				'default_path'      => '',                           // Default absolute path to pre-packaged plugins
				'menu'              => 'install-required-plugins',   // Menu slug
				'has_notices'       => true,                         // Show admin notices or not
				'is_automatic'      => false,            // Automatically activate plugins after installation or not
				'message'           => '',               // Message to output right before the plugins table
				'strings'           => array(
				  	'page_title'                          => __( 'Install Required Plugins', 'noo' ),
				  	'menu_title'                          => __( 'Install Plugins', 'noo' ),
					'installing'                          => __( 'Installing Plugin: %s', 'noo' ), // %1$s = plugin name
					'oops'                                => __( 'Something went wrong with the plugin API.', 'noo' ),
					'notice_can_install_required'         => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'noo' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'noo' ), // %1$s = plugin name(s)
					'notice_cannot_install'               => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'noo' ), // %1$s = plugin name(s)
					'notice_can_activate_required'        => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'noo' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'noo' ), // %1$s = plugin name(s)
					'notice_cannot_activate'              => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'noo' ), // %1$s = plugin name(s)
					'notice_ask_to_update'            => _n_noop(
						'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
						'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
						'noo'
					), // %1$s = plugin name(s).
					'notice_ask_to_update_maybe'      => _n_noop(
						'There is an update available for: %1$s.',
						'There are updates available for the following plugins: %1$s.',
						'noo'
					), // %1$s = plugin name(s).
					'notice_cannot_update'                => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'noo' ), // %1$s = plugin name(s)
					'install_link'                        => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'noo' ),
					'activate_link'                       => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'noo' ),
					'return'                              => __( 'Return to Required Plugins Installer', 'noo' ),
					'plugin_activated'                    => __( 'Plugin activated successfully.', 'noo' ),
					'complete'                            => __( 'All plugins installed and activated successfully. %s', 'noo' ) // %1$s = dashboard link
				)
		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'noo_register_theme_plugins' );
endif;

function noo_enable_vc_auto_theme_update() {
	if( function_exists('vc_updater') ) {
		$vc_updater = vc_updater();
		remove_filter( 'upgrader_pre_download', array( $vc_updater, 'preUpgradeFilter' ), 10 );
		if( function_exists( 'vc_license' ) ) {
			if( !vc_license()->isActivated() ) {
				remove_filter( 'pre_set_site_transient_update_plugins', array( $vc_updater->updateManager(), 'check_update' ), 10 );
			}
		}

		remove_filter( 'admin_notices', array( vc_license(), 'adminNoticeLicenseActivation' ) );
	}
}
add_action('vc_after_init', 'noo_enable_vc_auto_theme_update');
