<?php
/*
Plugin Name: tagDiv Cloud Library
Plugin URI: http://tagdiv.com
Description: Build custom templates using tagDiv composer
Author: tagDiv
Version: 1.0 BETA | built on 27.06.2018 14:16
Author URI: http://tagdiv.com
*/

//td_cloud location (local or live) - it's set to live automatically on deploy
define('TDB_CLOUD_LOCATION', 'live');

//hash
define('TD_CLOUD_LIBRARY', 'b750612463a242d669bd59c5cf49d705');

// the deploy mode: dev or deploy  - it's set to deploy automatically on deploy
define('TDB_DEPLOY_MODE', 'deploy');


define('TDB_TEMPLATE_BUILDER_DIR', dirname( __FILE__ ));
define('TDB_URL', plugins_url('td-cloud-library'));

add_action('td_global_after', 'tdb_hook_td_global_after');
function tdb_hook_td_global_after() {
	require_once('tdb_version_check.php');

	//check PHP version
	if (tdb_version_check::is_php_compatible() === false) {
		return;
	}

	//check theme version
	if (tdb_version_check::is_theme_compatible() === false) {
		return;
	}

	add_action('tdc_init', 'tdb_on_init_template_builder');
	function tdb_on_init_template_builder() {
		require_once( 'includes/tdb_functions.php' );
	}

}

add_action( 'admin_head', 'tdb_on_admin_head' );
function tdb_on_admin_head() {
	echo '<script type="text/javascript">var tdbPluginUrl = "' . TDB_URL . '"</script>';
}

/**
 * register the custom post type CPT - this should happen regardless if we have the composer or not to maintain correct wp cpt
 */
add_action('init', 'tdb_on_init_cpt');
function tdb_on_init_cpt() {
	/**
	 * add the td_book custom post type
	 * https://codex.wordpress.org/Function_Reference/register_post_type
	 */
	$args = array(
		'public' => true,
		'label'  => 'Cloud Templates',
		'supports' => array( // here we specify what the taxonomy supports
			'title',
			'editor',
			'revisions'
		),
		'publicly_queryable' => true,
		'hierarchical' => true,
		'exclude_from_search' => true,
	);
	register_post_type( 'tdb_templates', $args );
}



/**
 * Flush permalinks
 */
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'tdb_on_register_activation_hook' );
function tdb_on_register_activation_hook() {
	tdb_on_init_cpt();      // register the cpt
	flush_rewrite_rules();  // and... flush
}









