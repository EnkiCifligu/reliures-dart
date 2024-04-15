	<?php
/**
 * Header layout 4
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

$vmagazine_header_icon_show = get_theme_mod('vmagazine_header_icon_show','hide');
$vmagazine_header_search_enable = get_theme_mod('vmagazine_header_search_enable','show');
?>


<header id="masthead" class="site-header header-layout4">



<div class="site-main-nav-wrapper">
	<?php echo vmagazine_nav_header();?>
</div>

<div class="logo-wrapper-section clearfix">
	<div class="vmagazine-container">
		<div class="head-four-no-pad">
		
		<?php if( $vmagazine_header_icon_show == 'show' ): ?>
			<div class="social-icon-togggle">
				<i class="fa fa-share-alt" aria-hidden="true"></i>
			</div>
			<div class="social-icons">
				<div class="social-icons-close">
					<i class="fa fa-times" aria-hidden="true"></i>
				</div>
				<?php echo vmagazine_social_icons(); ?>
			</div>
		<?php endif; ?>

		<?php vmagazine_logo_check(); ?>

		<?php if( $vmagazine_header_search_enable == 'show' ): ?>
			<div class="search-toggle">
			  	<i class="fa fa-search" aria-hidden="true"></i>	
			</div>
			<div class="header-search-wrapper">
				<div class="search-close">
				<i class="fa fa-times" aria-hidden="true"></i>
				</div>

				<div class="vmagazine-search-form-primary"><?php get_search_form(); ?>
					
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
			</div>
		<?php endif; ?>
	</div>
	</div><!-- .vmagazine-container -->
</div><!-- .logo-ad-wrapper -->

	

    <?php do_action('vmagazine_news_ticker'); ?>
</header><!-- #masthead -->

