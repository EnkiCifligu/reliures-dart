<?php 

/**
* Default values for theme typography
* @package Vmagazine
* @author Pragyan Ratna
* @since 1.0.0
*
*/

/**
* removing theme_mod for p
*/
function vmagazine_p_typography_reset(){

  remove_theme_mod('p_font_family');
  remove_theme_mod('p_font_style');
  remove_theme_mod('p_text_decoration');
  remove_theme_mod('p_text_transform');
  remove_theme_mod('p_font_size');
  remove_theme_mod('p_line_height');
  remove_theme_mod('p_color');

}
add_action( 'wp_ajax_vmagazine_p_typography_reset', 'vmagazine_p_typography_reset' );


/**
* removing theme_mod for menu
*/
function vmagazine_menu_typography_reset(){

  remove_theme_mod('menu_font_family');
  remove_theme_mod('menu_font_style');
  remove_theme_mod('menu_text_decoration');
  remove_theme_mod('menu_text_transform');
  remove_theme_mod('menu_font_size');
  remove_theme_mod('menu_line_height');
  remove_theme_mod('menu_color');

}
add_action( 'wp_ajax_vmagazine_menu_typography_reset', 'vmagazine_menu_typography_reset' );


/**
* removing theme_mod for h1
*/
function vmagazine_h1_typography_reset(){

  remove_theme_mod('h1_font_family');
  remove_theme_mod('h1_font_style');
  remove_theme_mod('h1_text_decoration');
  remove_theme_mod('h1_text_transform');
  remove_theme_mod('h1_font_size');
  remove_theme_mod('h1_line_height');
  remove_theme_mod('h1_color');

}
add_action( 'wp_ajax_vmagazine_h1_typography_reset', 'vmagazine_h1_typography_reset' );


/**
* removing theme_mod for h2
*/
function vmagazine_h2_typography_reset(){

  remove_theme_mod('h2_font_family');
  remove_theme_mod('h2_font_style');
  remove_theme_mod('h2_text_decoration');
  remove_theme_mod('h2_text_transform');
  remove_theme_mod('h2_font_size');
  remove_theme_mod('h2_line_height');
  remove_theme_mod('h2_color');

}
add_action( 'wp_ajax_vmagazine_h2_typography_reset', 'vmagazine_h2_typography_reset' );



/**
* removing theme_mod for h3
*/
function vmagazine_h3_typography_reset(){

  remove_theme_mod('h3_font_family');
  remove_theme_mod('h3_font_style');
  remove_theme_mod('h3_text_decoration');
  remove_theme_mod('h3_text_transform');
  remove_theme_mod('h3_font_size');
  remove_theme_mod('h3_line_height');
  remove_theme_mod('h3_color');

}
add_action( 'wp_ajax_vmagazine_h3_typography_reset', 'vmagazine_h3_typography_reset' );



/**
* removing theme_mod for h4
*/
function vmagazine_h4_typography_reset(){

  remove_theme_mod('h4_font_family');
  remove_theme_mod('h4_font_style');
  remove_theme_mod('h4_text_decoration');
  remove_theme_mod('h4_text_transform');
  remove_theme_mod('h4_font_size');
  remove_theme_mod('h4_line_height');
  remove_theme_mod('h4_color');

}
add_action( 'wp_ajax_vmagazine_h4_typography_reset', 'vmagazine_h4_typography_reset' );



/**
* removing theme_mod for h5
*/
function vmagazine_h5_typography_reset(){

  remove_theme_mod('h5_font_family');
  remove_theme_mod('h5_font_style');
  remove_theme_mod('h5_text_decoration');
  remove_theme_mod('h5_text_transform');
  remove_theme_mod('h5_font_size');
  remove_theme_mod('h5_line_height');
  remove_theme_mod('h5_color');

}
add_action( 'wp_ajax_vmagazine_h5_typography_reset', 'vmagazine_h5_typography_reset' );




/**
* removing theme_mod for h6
*/
function vmagazine_h6_typography_reset(){

  remove_theme_mod('h6_font_family');
  remove_theme_mod('h6_font_style');
  remove_theme_mod('h6_text_decoration');
  remove_theme_mod('h6_text_transform');
  remove_theme_mod('h6_font_size');
  remove_theme_mod('h6_line_height');
  remove_theme_mod('h6_color');

}
add_action( 'wp_ajax_vmagazine_h6_typography_reset', 'vmagazine_h6_typography_reset' );