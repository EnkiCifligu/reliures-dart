<?php
/**
 * Tabs test file
 *
 * @package VMagazine
 * @since 1.0.3
 */

/**
 * Hook controls for Header to Customizer.
 *
 * @since 1.0.3
 */
function vmagazine_tabs_customize_register( $wp_customize ) {

	if ( class_exists( 'Vmagazine_Customize_Control_Tabs' ) ) {

		
/**
* Header Options section Tabs
*
*/
$wp_customize->add_setting( 'vmagazine_header_potions_tabs', array(
                'sanitize_callback' => 'sanitize_text_field',
            ));

$wp_customize->add_control( new Vmagazine_Customize_Control_Tabs( $wp_customize, 'vmagazine_header_potions_tabs', array(
                    'section' => 'vmagazine_header_option',
                    'tabs'    => array(

                        'general' => array(
                            'nicename' => esc_html__( 'General', 'vmagazine' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'vmagazine_home_icon_picker',
                                'vmagazine_header_search_enable',
                                'vmagazine_ajax_search_enable',
                                'vmagazine_sticky_header_enable',
                                'vmagazine_cart_show',
                                'vmagazine_header_icon_show'
                            ),
                        ),

                        'colors' => array(
                            'nicename' => esc_html__( 'Colors', 'vmagazine' ),
                            'icon'     => 'adjust',
                            'controls' => array(
                                'vmagazine_header_top_colors_seperator',
                                'vmagazine_top_header_bg_color',
                                'vmagazine_top_header_link_color',
                                'vmagazine_top_header_link_color_hover',
                                'vmagazine_top_header_text_color',

                                'vmagazine_header_nav_color_seperator',
                                'vmagazine_header_nav_bg_color',
                                'vmagazine_header_nav_link_color',
                                'vmagazine_header_nav_link_color_hover',
                                'vmagazine_header_nav_link_bg_color_hover',
                                'vmagazine_header_submenu_link_color',
                                'vmagazine_header_submenu_link_color_hover',
                                'vmagazine_header_submenu_bg_color',

                                'vmagazine_header_mega_menu_color_seperator',
                                'vmagazine_header_mega_menu_nav_bg_color',
                                'vmagazine_header_mega_menu_nav_color',
                                'vmagazine_header_mega_menu_nav_color_hover',
                                'vmagazine_header_mega_menu_nav_bg_color_hover',

                                'vmagazine_header_logo_section_color_seperator',
                                'vmagazine_header_logo_section_bg_color',
                                'vmagazine_header_logo_section_text_color'
                               
                            ),
                        ),
                       
                    ),
                )
            )
        );

		

/**
* News Ticker Tabs
*
*/
$wp_customize->add_setting( 'vmagazine_news_ticker_tabs', array(
                'sanitize_callback' => 'sanitize_text_field',
            ));

$wp_customize->add_control( new Vmagazine_Customize_Control_Tabs( $wp_customize, 'vmagazine_news_ticker_tabs', array(
                    'section' => 'vmagazine_news_ticker_section',
                    'tabs'    => array(

                        'general' => array(
                            'nicename' => esc_html__( 'General', 'vmagazine' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'vmagazine_ticker_option',
                                'vmagazine_ticker_disp_option',
                                'vmagazine_ticker_cat',
                                'vmagazine_ticker_caption',
                                'vmagazine_top_ticker_layout',
                                'vmagazine_ticker_tags_caption',
                                'vmagazine_ticker_count'
                            ),
                        ),

                        'colors' => array(
                            'nicename' => esc_html__( 'Colors', 'vmagazine' ),
                            'icon'     => 'adjust',
                            'controls' => array(
                                'vmagazine_ticker_bg_color',
                                'vmagazine_ticker_title_text_color',
                                'vmagazine_ticker_news_color',
                                'vmagazine_ticker_news_color_hover',
                                'vmagazine_ticker_date_color',
                                'vmagazine_ticker_nav_icon_color'
                               
                            ),
                        ),
                       
                    ),
                )
            )
        );

/**
* Footer Tabs
*
*
*/

$wp_customize->add_setting( 'vmagazine_footer_settings_tabs', array(
                'sanitize_callback' => 'sanitize_text_field',
            ));

$wp_customize->add_control( new Vmagazine_Customize_Control_Tabs( $wp_customize, 'vmagazine_footer_settings_tabs', array(
                    'section' => 'vmagazine_footer_options',
                    'tabs'    => array(

                        'general' => array(
                            'nicename' => esc_html__( 'General', 'vmagazine' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'vmagazine_footer_layout',
                                'vmagazine_buttom_footer_menu',
                                'vmagazine_footer_logo',
                                'vmagazine_buttom_footer_icons',
                                'vmagazine_copyright_text',
                                'vmagazine_description_text',
                                

                            ),
                        ),

                        'background' => array(
                            'nicename' => esc_html__( 'Backgrounds', 'vmagazine' ),
                            'icon'     => 'adjust',
                            'controls' => array(
                                'vmagazine_footer_bg_color',
                                'vmagazine_footer_bg',
                                'vmagazine_footer_bg_position',
                                'vmagazine_footer_bg_position',
                                'vmagazine_footer_bg_attachment',
                                'vmagazine_footer_bg_repeat'
                               
                            ),
                        ),
                       
                    ),
                )
            )
        );








		
	}

}
add_action( 'customize_register', 'vmagazine_tabs_customize_register' );
