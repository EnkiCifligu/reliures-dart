<?php
/**
 * Sanizitation for all fields
 * 
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

//Text
function vmagazine_sanitize_text( $input ) {
    return wp_kses_post($input);
}

// Number
function vmagazine_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

//Checkbox
function vmagazine_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

// Number Float-val
function vmagazine_floatval( $input ) {
    $output = floatval( $input );
     return $output;
}

// site layout
function vmagazine_sanitize_site_layout( $input ) {
    $valid_keys = array(
            'fullwidth_layout' => esc_html__( 'FullWidth Layout', 'vmagazine' ),
            'boxed_layout'     => esc_html__( 'Boxed Layout', 'vmagazine' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//switch option
function vmagazine_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'vmagazine' ),
            'hide'  => esc_html__( 'Hide', 'vmagazine' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//switch option for cats or tags list
function vmagazine_sanitize_cat_tag_switch_option( $input ) {
    $valid_keys = array(
            'cats'  => esc_html__( 'Category', 'vmagazine' ),
            'tags'  => esc_html__( 'Tags', 'vmagazine' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//switch option for enable/disable
function vmagazine_sanitize_switch_enable_option( $input ) {
    $valid_keys = array(
            'enable'  => esc_html__( 'Enable', 'vmagazine' ),
            'disable'  => esc_html__( 'Disable', 'vmagazine' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}


// page sidebar
function vmagazine_sanitize_page_sidebar( $input ) {
    $valid_keys = array(
            'right_sidebar' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'left_sidebar' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'both_sidebar' => get_template_directory_uri() . '/assets/images/both-sidebar.png',
            'no_sidebar' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
            
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//archive layout
function vmagazine_sanitize_archive_layout( $input ) {
    $valid_keys = array(
            'layout1' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'layout2' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'layout3' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
            'layout4' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png'
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//single post layout
function vmagazine_sanitize_single_post_layout( $input ) {
    $valid_keys = array(
            'post_layout1' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'post_layout2' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'post_layout3' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png'
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}


// news ticker layout
function vmagazine_sanitize_ticker_layout( $input ) {
    $valid_keys = array(
            'default-layout' => esc_html__( 'Layout One', 'vmagazine' ),
            'layout-two' => esc_html__( 'Layout Two', 'vmagazine' ),
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// news ticker control layout
function vmagazine_sanitize_ticker_control_layout( $input ) {
    $valid_keys = array(
            'default' => esc_html__( 'Default layout: (Same as free version.)', 'vmagazine' ),
            'layout1' => esc_html__( 'Layout 1: (Control box direction left and right.) ', 'vmagazine' ),
            'layout2' => esc_html__( 'Layout 2: (Control box replaced bye thin arrow.)', 'vmagazine' ),
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// header layout
function vmagazine_sanitize_header_layout( $input ) {
    $valid_keys = array(
            'header_layout_1' => esc_html__( 'Header Layout 1', 'vmagazine' ),
            'header_layout_2' => esc_html__( 'Header Layout 2', 'vmagazine' ),
            'header_layout_3' => esc_html__( 'Header Layout 3', 'vmagazine' ),
            'header_layout_4' => esc_html__( 'Header Layout 4', 'vmagazine' ),
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// footer layout
function vmagazine_sanitize_footer_layout( $input ) {
    $valid_keys = array(
            'footer_layout_1' => esc_html__( 'Footer Layout 1', 'vmagazine' ),
            'footer_layout_2' => esc_html__( 'Footer Layout 2', 'vmagazine' ),
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//Related Post type
function vmagazine_sanitize_related_type( $input ) {
    $valid_keys = array(
            'related_cat'   => esc_html__( 'Related Posts by Category', 'vmagazine' ),
            'related_tag'   => esc_html__( 'Related Posts by Tags', 'vmagazine' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}



/**
 * Callback functions
 */

function vmagazine_review_post_option_callback( $control ) {
    if ( $control->manager->get_setting('vmagazine_post_review_option')->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}

function vmagazine_related_post_option_callback( $control ) {
    if ( $control->manager->get_setting('vmagazine_related_posts_option')->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}

function vmagazine_fallback_option_callback( $control ) {
    if ( $control->manager->get_setting('post_fallback_img_option')->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}



function vmagazine_random_post_callback( $control ) {
    if ( $control->manager->get_setting('vmagazine_menu_random_option')->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}

function vmagazine_footer_type(){
  $footer_type = get_theme_mod('vmagazine_footer_layout');
    if( $footer_type == 'footer_layout_1') {
      return true;
    }
  return false;
}

function vmagazine_ticker_disp_typ(){
    $vmagazine_ticker_disp_option = get_theme_mod('vmagazine_ticker_disp_option','latest-post');
    if( $vmagazine_ticker_disp_option == 'cat-post' ){
        return true;
    }
    return false;
}

function vmagazine_ticker_layouts(){
    $vmagazine_ticker_tags_caption = get_theme_mod('vmagazine_top_ticker_layout','default-layout');
    if( $vmagazine_ticker_tags_caption == 'layout-two' ){
        return true;
    }
    return false;
}

function vmagazine_footer_layout_switcher(){
    $vmagazine_footer_layout = get_theme_mod('vmagazine_footer_layout','footer_layout_1');
    if( $vmagazine_footer_layout == 'footer_layout_1' ){
        return true;
    }
    return false;
}

/**
 * Select sanitization callback
 *
 * @since 1.0.3
 */
function vmagazine_sanitize_select( $input, $setting ) {
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


function vmagazine_site_layout_width_framed(){

    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( ($vmagazine_site_layout_width == 'framed') || ($vmagazine_site_layout_width == 'wide') ){
        return true;
    }
    return false;
}

function vmagazine_site_layout_width_boxed(){

    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( $vmagazine_site_layout_width == 'boxed' ){
        return true;
    }
    return false;
}

function vmagazine_site_layout_width_full(){

    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( ($vmagazine_site_layout_width == 'boxed') ||  ($vmagazine_site_layout_width == 'framed') ){
        return true;
    }
    return false;
}



function vmagazine_site_layout_width_frm(){

    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( $vmagazine_site_layout_width == 'framed' ){
        return true;
    }
    return false;
}

/**
* Title layout callback functions
*/
function vmagazine_title_layout_five_title_bg_color(){
    $title_layout = get_theme_mod('vmagazine_template_layout_setting','template-one');
    if( ($title_layout == 'template-five') || ($title_layout == 'template-four') || ($title_layout == 'template-three') ){
        return true;
    }
    return false;
}

function vmagazine_title_layout_one_title_bg_color(){
    $title_layout = get_theme_mod('vmagazine_template_layout_setting','template-one');
    if( ($title_layout == 'template-one' ) || ( $title_layout == 'template-two' ) ){
        return true;
    }
    return false;
}