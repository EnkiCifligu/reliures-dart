<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vmagazine
 */


?>
<?php if( is_page_template() ){ ?>	
</div><!-- .vmagazine-home-wrapp -->
<?php } ?>
</div><!-- #content -->

	<?php do_action( 'vmagazine_before_footer' ); ?>
	<?php 
	if (  is_active_sidebar( 'footer-1' ) || 
		  is_active_sidebar( 'footer-2' ) || 
		  is_active_sidebar( 'footer-3' ) || 
		  is_active_sidebar( 'footer-4' ) ) {

	$class = "footer-widgets-exists";
	}else{
		$class = "no-footer-widgets";
	}

	$vmagazine_footer_layout = get_theme_mod('vmagazine_footer_layout','footer_layout_1'); 
	if( ($vmagazine_footer_layout == 'footer_layout_1') && ($class == 'footer-widgets-exists') ){
		$ftr_class = 'footer-one';
	}elseif( ($vmagazine_footer_layout == 'footer_layout_2')  && ($class == 'footer-widgets-exists') ){
		$ftr_class = 'footer-two';
	}else{
		$ftr_class = 'footer-three';
	}?>
	
		<footer id="colophon" class="site-footer <?php echo  esc_attr($ftr_class);?>">

				<?php
				$vmagazine_footer_bg = get_theme_mod('vmagazine_footer_bg');
				
				if( $vmagazine_footer_bg ){ ?>
					<div class="img-overlay"></div>
				<?php } 

					/**
					 * @hooked vmagazine_footer_widgets - 0
					 * @hooked vmagazine_button_footer - 10
					 */
					do_action( 'vmagazine_footer' ); 
				?>		
			
		</footer><!-- #colophon -->
		
	<?php do_action( 'vmagazine_before_footer' ); ?>

<a href="#" class="scrollup">
	<i class="fa fa-angle-up" aria-hidden="true"></i>
</a>
</div><!-- .vmagazine-main-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
