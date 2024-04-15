<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

get_header(); 
$vmagazine_post_layout = get_post_meta( get_the_ID(), 'vmagazine_post_layout', true );
if( $vmagazine_post_layout == 'post_layout' || empty( $vmagazine_post_layout ) ) {
	$vmagazine_post_layout = get_theme_mod( 'vmagazine_single_posts_layout', 'post_layout1' );
}


if( $vmagazine_post_layout == 'post_layout3'){ 
	$post_wrapper = '';
	$post_close = '';
}else{
	$post_wrapper = '<div class="vmagazine-container container-wrapp-inner">';
	$post_close = '</div>';
}	
	
echo wp_kses_post($post_wrapper); //container div starting
	 
		do_action( 'vmagazine_before_body_content' );

		while ( have_posts() ) : 
			the_post();
			$post_id = get_the_ID();
			

			if( $vmagazine_post_layout == 'post_layout3' ) {
				get_template_part( 'layouts/post/single', 'layout3' );
			} elseif( $vmagazine_post_layout == 'post_layout2' ) {
				get_template_part( 'layouts/post/single', 'layout2' );
			} else {
				get_template_part( 'layouts/post/single', 'layout1' );
			}

			/**
			 * Set post view
			 */
			if( function_exists('vmagazine_setPostViews')){
				vmagazine_setPostViews( get_the_ID() );	
			}
			

		endwhile; // End of the loop.

		do_action( 'vmagazine_after_body_content' );

echo wp_kses_post($post_close); //container div ending



get_footer();
