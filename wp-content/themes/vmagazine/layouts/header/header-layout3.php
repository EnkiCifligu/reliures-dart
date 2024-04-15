<?php
/**
 * Header layout 3
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

$vmagazine_header_icon_show = get_theme_mod('vmagazine_header_icon_show','hide');
?>

<?php 
/**
* Sidebar menu
*
*/?>
<div class="sidebar-wrapper">
	<div class="sidebar-close">
		<i class="fa fa-times"></i>
	</div>
	<?php vmagazine_logo_check(); ?>

	<div class="sidebar-widget-area">
		<?php
        	if( is_active_sidebar( 'vmagazine_sidebar_area' ) ) {
            	if ( !dynamic_sidebar( 'vmagazine_sidebar_area' ) ):
            	endif;
         	}
        ?>
	</div>
</div>


<header id="masthead" class="site-header header-layout3">

<?php if( has_nav_menu('top_menu') || $vmagazine_header_icon_show == 'show' ): ?>
<div class="vmagazine-top-header clearfix">
	<div class="vmagazine-container">
		<div class="top-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'top_menu','container_class'=>'top-men-wrapp', 'menu_id' => 'top-menu', 'fallback_cb' => 'false', 'depth' => '1' ) ); ?>
		</div>
		<?php 
		
		if( $vmagazine_header_icon_show == 'show' ){ ?>
			<div class="top-right">
				<?php echo vmagazine_social_icons();?>
			</div>
		<?php } ?>
			
	</div>
</div><!-- .vmagazine-top-header -->
<?php endif; ?>

<div class="logo-wrapper clearfix">
	<div class="vmagazine-container">
		<div class="site-branding">					
			<?php the_custom_logo(); ?>
			<div class="site-title-wrapper">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div>
		</div><!-- .site-branding -->
	</div><!-- .vmagazine-container -->
</div><!-- .logo-ad-wrapper -->

<div class="site-main-nav-wrapper">
	<div class="vmagazine-container">
		<div class="sidebar-icon">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>
	    <?php echo vmagazine_nav_header_third();?>
	   
	    <div class="top-right">
	    	 <?php
	    	 $vmagazine_header_search_enable = get_theme_mod('vmagazine_header_search_enable','show');
	    	 $vmagazine_cart_show = get_theme_mod('vmagazine_cart_show','show');
			if ( function_exists( 'vmagazine_woocommerce_header_cart' )  && ($vmagazine_cart_show == 'show') ) {
				vmagazine_woocommerce_header_cart();
			} ?>
			<?php if( $vmagazine_header_search_enable == 'show' ): ?>
		    	<div class="search-toggle">
		    		<i class="fa fa-search" aria-hidden="true"></i>	
		    	</div>
				<div class="vmagazine-search-form-primary"><?php get_search_form(); ?></div>
				
				<div class="search-content"></div>
				<div class="block-loader" style="display:none;">
	        		<div class="sampleContainer">
					    <div class="loader">
					        <span class="dot dot_1"></span>
					        <span class="dot dot_2"></span>
					        <span class="dot dot_3"></span>
					        <span class="dot dot_4"></span>
					    </div>
					</div>
	    		</div>
    	<?php endif; ?>

		</div>
	</div>
</div>

    <?php do_action('vmagazine_news_ticker'); ?>
</header><!-- #masthead -->

