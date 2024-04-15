	<?php
/**
 * Header layout 1
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

$vmagazine_header_icon_show = get_theme_mod('vmagazine_header_icon_show','hide');
$vmagazine_header_search_enable = get_theme_mod('vmagazine_header_search_enable','show');

$top_men_class = ( $vmagazine_header_icon_show == 'hide' ) ? 'menu-full' : 'menu-half';


$class = 'logo-hidden';
if( get_custom_logo() ){
	$class = 'logo-shown';
}
 ?>

<header id="masthead" class="site-header header-layout1 <?php echo esc_attr($class); ?>">

<?php if( has_nav_menu('top_menu') || $vmagazine_header_icon_show == 'show' || $vmagazine_header_search_enable == 'show' ): ?>
	<div class="vmagazine-top-header clearfix <?php echo esc_attr($top_men_class);?>">
		<div class="vmagazine-container">
			
			<div class="top-men-wrap">
				
				<div class="top-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'top_menu','container_class'=>'top-men-wrapp', 'menu_id' => 'top-menu', 'fallback_cb' => 'false','depth' => '1' ) ); ?>
				</div>
				
				
			</div>
			<?php if( ($vmagazine_header_search_enable == 'show') || ($vmagazine_header_icon_show == 'show')  ){ ?>
			<div class="top-right">
				<?php if( $vmagazine_header_icon_show == 'show' ){ ?>
					<div class="top-left">
						<?php echo vmagazine_social_icons();?>
					</div>
				<?php } ?>
				<?php if( $vmagazine_header_search_enable == 'show' ): ?>
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
		<?php }; ?>
		
		</div>
	</div><!-- .vmagazine-top-header -->
<?php endif; ?>	

	<div class="logo-ad-wrapper clearfix ">
		<div class="vmagazine-container">
			<?php vmagazine_logo_check(); ?>
				<?php
		        	if( is_active_sidebar( 'vmagazine_header_ads_area' ) ) { ?>
		        	<div class="header-ad-wrapper">
		        		<?php 
		            	if ( !dynamic_sidebar( 'vmagazine_header_ads_area' ) ):
		            	endif;
		            	?>
		            </div><!-- .header-ad-wrapper -->
		            <?php } ?>
		</div><!-- .vmagazine-container -->
	</div><!-- .logo-ad-wrapper -->
    <?php echo vmagazine_nav_header();?>
   
    <?php do_action('vmagazine_news_ticker'); ?>
</header><!-- #masthead -->
