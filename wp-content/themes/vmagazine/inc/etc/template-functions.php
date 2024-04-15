<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package vmagazine
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function vmagazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'vmagazine_pingback_header' );


/*-------------------------------------------------------------------------------------------------------------------------
** vmagazine template functions start
**------------------------------------------------------------------------------------------------------------------------*/


if(! function_exists('vmagazine_nav_header')){
	function vmagazine_nav_header(){
	?>
	<div class="vmagazine-nav-wrapper">
		<div class="vmagazine-container">			
			<nav id="site-navigation" class="main-navigation clearfix" >
				<div class="nav-wrapper">
					
		            <?php vmagazine_home_icon(); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary_menu','container_class'=>'menu-mmnu-container', 'fallback_cb' => 'vmagazine_menu_fallback_message' ) ); ?>
				</div><!-- .nav-wrapper -->
			</nav><!-- #site-navigation -->

			<?php
			$vmagazine_cart_show = get_theme_mod('vmagazine_cart_show','show');
			if ( function_exists( 'vmagazine_woocommerce_header_cart')  && ($vmagazine_cart_show == 'show')  ) {
				vmagazine_woocommerce_header_cart();
			}
			
			?>

		</div><!-- .vmagazine-container -->	
	</div>
	<?php	
	}
}


/*-------------------------------------------------------------------------------------------------------------------------
** vmagazine third header menu
**------------------------------------------------------------------------------------------------------------------------*/

if(! function_exists('vmagazine_nav_header_third')){
	function vmagazine_nav_header_third(){
	?>
	<div class="vmagazine-nav-wrapper">
			<nav id="site-navigation" class="main-navigation clearfix" >
				<div class="nav-wrapper">
					
		            <?php vmagazine_home_icon(); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary_menu','container_class'=>'menu-mmnu-container', 'fallback_cb' => 'vmagazine_menu_fallback_message' ) ); ?>
				</div><!-- .nav-wrapper -->
			</nav><!-- #site-navigation -->
	</div>
	<?php	
	}
}

/*-------------------------------------------------------------------------------------------------------------------------
/**
* Mobile navigation menu
*/
if(! function_exists('vmagazine_nav_mobile_header')){
	function vmagazine_nav_mobile_header(){
	?>
	<div class="vmagazine-nav-wrapper">
		<div class="vmagazine-container">			
			<nav class="main-navigation clearfix" >
				<div class="nav-wrapper">
					
		            <?php vmagazine_home_icon(); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary_menu','container_class'=>'menu-mmnu-container', 'menu_id' => 'primary-menu', 'fallback_cb' => 'vmagazine_wp_page_menu' ) ); ?>
				</div><!-- .nav-wrapper -->
			</nav><!-- #site-navigation -->

			<?php
			$vmagazine_cart_show = get_theme_mod('vmagazine_cart_show','show');
			if ( function_exists( 'vmagazine_woocommerce_header_cart')  && ($vmagazine_cart_show == 'show')  ) {
				vmagazine_woocommerce_header_cart();
			}
			
			?>

		</div><!-- .vmagazine-container -->	
	</div>
	<?php	
	}
}
/**
 * Function to display home icon
 *
 * @since 1.0.0
 */
if( !function_exists( 'vmagazine_home_icon' ) ):
    function vmagazine_home_icon() {
        $home_icon = get_theme_mod( 'vmagazine_home_icon_picker', 'fa-home');
        if( $home_icon != '' ) {
    ?>
        <div class="index-icon">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa <?php echo esc_attr($home_icon);?>"></i></a>
        </div>
    <?php
        }
    }
endif;

/**
 * Function to display social icons
 *
 * @since 1.0.0
 */

if(!function_exists('vmagazine_social_icons')){
	function vmagazine_social_icons(){
	    $vmagazine_icons_value =  get_theme_mod('vmagazine_social_icons');
	    $vmagazine_icons = json_decode($vmagazine_icons_value);
	    ?>
	    <ul class="social">
	    	<?php 
	    	if( $vmagazine_icons ):
	    	foreach( $vmagazine_icons as $vmagazine_icon ){
	    		$social_link = $vmagazine_icon->social_url;
	    		$social_icon = $vmagazine_icon->social_icons; 
	    		$social_target = $vmagazine_icon->url_target;
	    		$social_target = $social_target ? '_blank' : '_self';
	    		?>
		        <li>
		        	<a href="<?php echo esc_url($social_link);?>" target="<?php echo esc_attr($social_target); ?>">
		        		<i class="<?php echo esc_attr($social_icon);?>"></i>
		        	</a>
		        </li>
	        <?php }
	        endif; ?>
		</ul>									
	    <?php
	}
}

/**
 * Footer Section Function Area
**/

if ( ! function_exists( 'vmagazine_footer_widgets' ) ) {
	/**
	 * Display the theme footer widgets
	 * @since  1.0.0
	 * @return void
	 */
	function vmagazine_footer_widgets() {
		
		if ( is_active_sidebar( 'footer-4' ) ) {
			$widget_columns = apply_filters( 'vmagazine_footer_widget_regions', 4 );
		}
		elseif ( is_active_sidebar( 'footer-3' ) ) {
			$widget_columns = apply_filters( 'vmagazine_footer_widget_regions', 3 );
		} elseif ( is_active_sidebar( 'footer-2' ) ) {
			$widget_columns = apply_filters( 'vmagazine_footer_widget_regions', 2 );
		} elseif ( is_active_sidebar( 'footer-1' ) ) {
			$widget_columns = apply_filters( 'vmagazine_footer_widget_regions', 1 );
		} else {
			$widget_columns = apply_filters( 'vmagazine_footer_widget_regions', 0 );
		}

		if ( $widget_columns > 0 ) : ?>

			<div class="footer-widgets col-<?php echo intval( $widget_columns ); ?> clearfix">				
				<div class="top-footer-wrap">
					<div class="vmagazine-container">
						<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>		
							<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>		
								<div class="block footer-widget-<?php echo intval( $i ); ?>">
						        	<?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
								</div>		
					        <?php endif; ?>		
						<?php endwhile; ?>
					</div>
				</div>
			</div><!-- .footer-widgets  -->
	    <?php endif;
	}
}

if ( ! function_exists( 'vmagazine_credit' ) ) {
	/**
	 * Display the theme credit/button footer
	 * @since  1.0.0
	 * @return void
	 */
	function vmagazine_credit() {
		?>
				<div class="site-info">
					<?php $copyright = get_theme_mod( 'vmagazine_copyright_text' ); if( !empty( $copyright ) ) { ?>
						<?php echo apply_filters( 'vmagazine_copyright_text', $copyright ); ?>	
					<?php } else { ?>
						<?php echo esc_html( apply_filters( 'vmagazine_copyright_text', $content = '&copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' ) ) ); ?>
					<?php if ( apply_filters( 'vmagazine_credit_link', true ) ) { 
						printf( esc_html__( '%1$s By %2$s', 'vmagazine' ), ' ', '<a href=" ' . esc_url('https://accesspressthemes.com/') . ' "  title="Premium WordPress Themes & Plugins by AccessPress Themes" target="_blank">AccessPress Themes</a>' ); ?>
					<?php } } ?>
				</div><!-- .site-info -->				
		<?php
	}
}
