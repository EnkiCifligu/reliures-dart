<?php 
/**
* Lists all required files for the customizer reset option
*
* @package Vmagazine
* @author Pragyan Ratna
* @since 1.0.0
*
*/
if( ! function_exists('vmagazine_customizer_reset_scripts') ){
	
	function vmagazine_customizer_reset_scripts(){

		wp_enqueue_script( 'vmagazine-reset-script', get_template_directory_uri() .'/inc/customizer/customizer-reset/reset.js', array( 'jquery','jquery-ui-button','customize-controls' ),1256, true );
    	wp_localize_script( 'vmagazine-reset-script', 'vmagazine_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php') ) );
	}
}
add_action( 'admin_enqueue_scripts', 'vmagazine_customizer_reset_scripts' );


/**
* File containing functions to reset customizer
*/
require get_template_directory() . '/inc/customizer/customizer-reset/vmagazine-reset-functions.php';


/**
*
* File for customizer 
*/
require get_template_directory() . '/inc/customizer/customizer-reset/customizer-reset.php';