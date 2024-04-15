<?php

/*Footer layout 1 */


 
  $social_enable = get_theme_mod('vmagazine_buttom_footer_icons','hide');
  $vmagazine_footer_logo = get_theme_mod('vmagazine_footer_logo');
  $vmagazine_description_text = get_theme_mod('vmagazine_description_text');
?>
<div class="buttom-footer footer_one">
	<?php  if( $vmagazine_footer_logo || $vmagazine_description_text || $social_enable == 'show' ){ ?>
		<div class="middle-footer-wrap">
			<div class="vmagazine-container">
				<div class="middle-ftr-wrap">
					<?php if( $vmagazine_footer_logo ): ?>
				     <div class="footer-logo-wrap">
	        			<a href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($vmagazine_footer_logo);?>" alt="<?php the_title_attribute()?>"></a>
	        		</div>
				    <?php endif; 
				    if( $vmagazine_description_text ): ?>
				    <div class="footer-desc">
				    	<?php echo esc_html($vmagazine_description_text); ?>
				    </div>
				    <?php endif; ?>
				    <?php if( $social_enable == 'show' ): ?>
				    <div class="footer-social">
						<?php vmagazine_social_icons();?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } ?>
		<div class="footer-btm-wrap">
			<div class="vmagazine-container">
				<div class="vmagazine-btm-ftr">
					<div class="footer-credit">
	            		<?php vmagazine_credit();?>
	            	</div>
	            	<?php 
                    $vmagazine_buttom_footer_menu = get_theme_mod('vmagazine_buttom_footer_menu','hide');
                    if( $vmagazine_buttom_footer_menu == 'show' ):
                     ?>
		            	<div class="footer-nav">
		            	<nav class="footer-navigation">
			        		<?php
							wp_nav_menu( array( 
									'theme_location' => 'footer_menu', 
									'menu_id' => 'footer-menu',
									'fallback_cb' => 'false',
									'depth' => '1'
									) 
							);        		
			        		?>
			        		</nav>
		        		</div>
		        	<?php endif; ?>
        		</div>
            </div>
		</div>
</div>
