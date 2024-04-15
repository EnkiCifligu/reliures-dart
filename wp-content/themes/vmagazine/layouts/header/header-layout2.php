<?php
/**
 * Header layout 2
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

$vmagazine_header_search_enable = get_theme_mod('vmagazine_header_search_enable','show');

$class = 'logo-hidden';
if( get_custom_logo() ){
	$class = 'logo-shown';
}

?>

<header id="masthead" class="site-header header-layout2 <?php echo esc_attr($class); ?>">
	<div class="logo-ad-wrapper clearfix">
		<div class="vmagazine-container">
			<?php vmagazine_logo_check(); ?>
			<?php if( $vmagazine_header_search_enable == 'show' ): ?>
			<div class="middle-search">
				
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

			</div>	
			<?php endif; ?>
			
			<?php 
			$vmagazine_header_icon_show = get_theme_mod('vmagazine_header_icon_show','hide');
			if( $vmagazine_header_icon_show == 'show' ):
			?>
				<div class="social-right">
					<?php echo vmagazine_social_icons();?>
				</div>	
           <?php endif; ?>
		</div><!-- .vmagazine-container -->
	</div><!-- .logo-ad-wrapper -->	
	
	
    <?php echo vmagazine_nav_header();?>
    <?php do_action('vmagazine_news_ticker'); ?>
</header><!-- #masthead -->