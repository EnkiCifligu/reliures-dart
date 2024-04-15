<?php

/*Footer layout 2 */


 
  $social_enable = get_theme_mod('vmagazine_buttom_footer_icons','hide');
  $vmagazine_footer_logo = get_theme_mod('vmagazine_footer_logo');
  $vmagazine_description_text = get_theme_mod('vmagazine_description_text');
?>
<div class="buttom-footer footer_one">
        
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
