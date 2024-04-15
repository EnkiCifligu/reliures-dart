<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vmagazine
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action('vmagazine_preloader'); ?>


	<?php do_action( 'vmagazine_before_header' );

	 /* Mobile Navigation **/
	 do_action('vmagazine_mobile_header_navigation'); ?>
	 <div class="vmagazine-main-wrapper">
		 
		 <?php 
		 /** Mobile header**/ 
		 do_action( 'vmagazine_mobile_header' ); ?>

		 <div class="vmagazine-header-handle">
		 	<?php do_action( 'vmagazine_header_section' ); ?>
		</div>
		
		<div id="content" class="site-content">
			
		<?php if( is_page_template() ){ ?>	
		<div class="vmagazine-home-wrapp">
		<?php } 
		/**
		* vmagazine Breadcrumbs 
		*/
		if( is_home() && is_front_page() ){
			$bread_class = 'latest_posts';
		}else{
			$bread_class = '';
		}
		if( ! is_page_template('tpl-blank.php') ){ ?>
		<div class="vmagazine-breadcrumb-wrapper <?php echo esc_attr($bread_class)?>">
			<?php vmagazine_header_title_display(); ?>
		</div>	
		<?php }

		$vmagazine_post_layout = get_theme_mod( 'vmagazine_single_posts_layout', 'post_layout1' );
		if( $vmagazine_post_layout == 'post_layout3' && is_single() ){
			echo '</div>';
		}

		
		