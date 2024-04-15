<?php
//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Theme Functions.
 */

add_action( 'wp_enqueue_scripts', 'ts_mobile_app_enqueue_styles' );
	function ts_mobile_app_enqueue_styles() {
    	$parent_style = 'bb-mobile-application-basic-style'; // Style handle of parent theme.
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'ts-mobile-app-style', get_stylesheet_uri(), array( $parent_style ) );
}

// Customizer Section
function ts_mobile_app_customizer ( $wp_customize ) {

	/*Service Section*/
	$wp_customize->add_section( 'ts_mobile_app_category_post_section' , array(
    	'title'      => __( 'Service Section', 'ts-mobile-app' ),
		'priority'   => null,
		'panel' => 'bb_mobile_application_panel_id'
	) );

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('ts_mobile_app_category_post',array(
		'default'	=> 'select',
		'sanitize_callback' => 'ts_mobile_app_sanitize_choices',
	));
	$wp_customize->add_control('ts_mobile_app_category_post',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display post','ts-mobile-app'),
		'section' => 'ts_mobile_app_category_post_section',
	));

	/*About Section*/
	$wp_customize->add_section( 'ts_mobile_app_about_mobile_section' , array(
    	'title'      => __( 'About Section', 'ts-mobile-app' ),
		'priority'   => null,
		'panel' => 'bb_mobile_application_panel_id'
	) );

	$post_list = get_posts();
 	$i = 0;
	$pst[]='Select';  
	foreach($post_list as $post){
	$pst[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('ts_mobile_app_post',array(
	   'sanitize_callback' => 'ts_mobile_app_sanitize_choices',
	));
	$wp_customize->add_control('ts_mobile_app_post',array(
	  'type'    => 'select',
	  'choices' => $pst,
	  'label' => __('Select post','ts-mobile-app'),
	  'section' => 'ts_mobile_app_about_mobile_section',
	));

}
add_action( 'customize_register', 'ts_mobile_app_customizer' );


/* Theme Font URL */
function ts_mobile_app_font_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Ubuntu:300,300i,400,400i,500,500i,700,700i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

/*radio button sanitization*/
function ts_mobile_app_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function ts_mobile_app_odd_or_even($counter){
    if($counter % 2 == 0)
    {
        return "even";
    }
    else
    {
        return "odd";
    }
}

?>