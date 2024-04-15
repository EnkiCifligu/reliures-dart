<?php
/**
 * Customizer  Settings
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */


add_action( 'customize_register', 'vmagazine_customizer_register' );

if( !function_exists( 'vmagazine_customizer_register' ) ):
function vmagazine_customizer_register( $wp_customize ) { 

  

  // Load customize control classes
  require VMAG_DIR . '/inc/customizer/range/class-control-range.php';
  require VMAG_DIR . '/inc/customizer/buttonset/class-control-buttonset.php';

  // Register JS control types
  $wp_customize->register_control_type( 'Vmagazine_Customizer_Range_Control');
  $wp_customize->register_control_type( 'Vmagazine_Customizer_Buttonset_Control');

/**
 * Add General Settings panel
 */

$wp_customize->add_panel( 'general_settings', array(
    'priority'         =>      1,
    'capability'       =>      'edit_theme_options',
    'theme_supports'   =>      '',
    'title'            =>      esc_html__( 'General Settings', 'vmagazine' ),
    'description'      =>      esc_html__( 'This allows to edit general theme settings', 'vmagazine' ),
));

$wp_customize->get_section('static_front_page')->panel = 'general_settings';
$wp_customize->get_section('title_tagline')->panel = 'vmagazine_header_settings_panel';
$wp_customize->get_control('background_color')->section = 'vmagazine_additional_conf';
$wp_customize->get_control('background_image')->section = 'vmagazine_additional_conf';

$wp_customize->get_section('colors')->section = 'general_settings';
$wp_customize->get_section('background_image')->panel = 'general_settings';
$wp_customize->remove_section('header_image');
$wp_customize->remove_section('colors');
$wp_customize->remove_section('background_image');

$wp_customize->get_section('static_front_page')->priority = 1;
$wp_customize->get_section('title_tagline')->priority = 1;

$wp_customize->get_control('background_color')->priority = 10;
$wp_customize->get_control('background_image')->priority = 15;

$wp_customize->get_setting( 'background_color' )->default = '#f1f1f1';



/*--------------------------------------------------------------------------------------------------*/

/* social Icons */

$wp_customize->add_section( 'vmagazine_header_icons', array(
  'title'           => esc_html__('Social Icons', 'vmagazine'),
  'priority'        => 35
));

/*--------------------------------------------------------------------------------------------------*/

/**
* Preloader options
*/
 $wp_customize->add_section( 'vmagazine_preloader_option', array(
	'title'           =>      esc_html__('Preloader Options', 'vmagazine'),
  'panel'           => 'general_settings'
));

$wp_customize->add_setting( 'vmagazine_preloader_show', array(
  'default'           => 'hide',
  'sanitize_callback' => 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_preloader_show',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Hide / Show Preloader', 'vmagazine' ),
  'section'   => 'vmagazine_preloader_option',
  'choices'   => array(
        'show'  => esc_html__( 'Show', 'vmagazine' ),
        'hide'  => esc_html__( 'Hide', 'vmagazine' )
      )
) ) ); 

$wp_customize->add_setting( 'vmagazine_preloaders_lists' , array(
      'default'           => 'preloader1',
      'sanitize_callback' => 'esc_html'
    ) );

$wp_customize->add_control('vmagazine_preloaders_lists',array(
               'label'      => esc_html__( 'Preloader', 'vmagazine' ),
               'section'    => 'vmagazine_preloader_option',
               'type'       => 'select',
               'choices'    => array(
                  'preloader1' => esc_html__( 'Preloader 1', 'vmagazine' ),
                  'preloader2' => esc_html__( 'Preloader 2', 'vmagazine' ),
                  'preloader3' => esc_html__( 'Preloader 3', 'vmagazine' ),
                  'preloader4' => esc_html__( 'Preloader 4', 'vmagazine' ),
                  'preloader5' => esc_html__( 'Preloader 5', 'vmagazine' ),
                  'preloader6' => esc_html__( 'Preloader 6', 'vmagazine' ),
                  'preloader7' => esc_html__( 'Preloader 7', 'vmagazine' ),
                  'preloader8' => esc_html__( 'Preloader 8', 'vmagazine' ),
                  'preloader9' => esc_html__( 'Preloader 9', 'vmagazine' ),
                  'preloader10' => esc_html__( 'Preloader 10', 'vmagazine' ),
                  'preloader11' => esc_html__( 'Preloader 11', 'vmagazine' ),
                  'preloader12' => esc_html__( 'Preloader 12', 'vmagazine' ),
                  'preloader13' => esc_html__( 'Preloader 13', 'vmagazine' ),
                  'preloader14' => esc_html__( 'Preloader 14', 'vmagazine' ),
                  'preloader15' => esc_html__( 'Preloader 15', 'vmagazine' ),
                  'preloader16' => esc_html__( 'Preloader 16', 'vmagazine' ),
                  'preloader17' => esc_html__( 'Preloader 17', 'vmagazine' ),
                  'preloader18' => esc_html__( 'Preloader 18', 'vmagazine' ),
                )

           ));


$wp_customize->add_setting( 'vmagazine_preloaders_bg_color' , array(
      'default'           => '#fff',
      'sanitize_callback' => 'sanitize_hex_color'
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_preloaders_bg_color', array(
            'label'         => esc_html__( 'Preloader Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_preloader_option',
)));


$wp_customize->add_setting( 'vmagazine_preloader_color' , array(
      'default'           => '#e52d6d',
      'sanitize_callback' => 'sanitize_hex_color'
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_preloader_color', array(
            'label'         => esc_html__( 'Preloader Color', 'vmagazine' ),
            'section'       => 'vmagazine_preloader_option',
)));



/**
* General options
*
*/
$wp_customize->add_section( 'vmagazine_general_options', array(
  'title'           => esc_html__('General Options', 'vmagazine'),
  'panel'           => 'general_settings'
));

/* Theme color option */
$wp_customize->add_setting('vmagazine_theme_color', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_theme_color', array(
            'label'         => esc_html__( 'Theme color', 'vmagazine' ),
            'section'       => 'vmagazine_general_options',
)));


/* Wow animation at home */
$wp_customize->add_setting( 'vmagazine_wow_animation_option', array(
        'default'       => 'enable',
        'sanitize_callback' => 'vmagazine_sanitize_switch_enable_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_wow_animation_option', array(
            'type'      => 'switch',                  
            'label'     => esc_html__( 'Animation Option', 'vmagazine' ),
            'description'   => esc_html__( 'Enable/Disable wow animation on homepage.', 'vmagazine' ),
            'section'     => 'vmagazine_general_options',
            'choices'     => array(
                'enable'  => esc_html__( 'Enable', 'vmagazine' ),
                'disable'   => esc_html__( 'Disable', 'vmagazine' )
                ),
        )               
    )
);


/* Lazyload images */
$wp_customize->add_setting( 'vmagazine_lazyload_option', array(
        'default'       => 'enable',
        'sanitize_callback' => 'vmagazine_sanitize_switch_enable_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize,'vmagazine_lazyload_option', 
        array(
            'type'      => 'switch',                  
            'label'     => esc_html__( 'Lazy Load Images', 'vmagazine' ),
            'description'   => esc_html__( 'Enable/Disable lazy load for images.', 'vmagazine' ),
            'section'     => 'vmagazine_general_options',
            'choices'     => array(
                'enable'  => esc_html__( 'Enable', 'vmagazine' ),
                'disable'   => esc_html__( 'Disable', 'vmagazine' )
                ),
        )               
    )
);





//section seperator
$wp_customize->add_setting( 'vmagazine_fallback_image_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_fallback_image_seperator',  array(
  'label'     => esc_html__( 'Fallback Image Options', 'vmagazine' ),
  'section'   => 'vmagazine_general_options',
) ) ); 


/**
* Fallback image option
*
* @since 1.0.0
*/
$wp_customize->add_setting( 'post_fallback_img_option',array(
        'default'       => 'show',
        'sanitize_callback' => 'vmagazine_sanitize_switch_option',
    )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize, 'post_fallback_img_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Fallback Image Option', 'vmagazine' ),
            'description'   => esc_html__( 'Show/Hide option of fallback image.', 'vmagazine' ),
            'section'     => 'vmagazine_general_options',
            'choices'     => array(
                'show'    => esc_html__( 'Show', 'vmagazine' ),
                'hide'    => esc_html__( 'Hide', 'vmagazine' )
            ),
        )
    )
);

/**
 * Upload image control for fallback image
 *
 * @since 1.0.0
 */
$wp_customize->add_setting('post_fallback_image',array(
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'post_fallback_image',
      array(
          'label'         => esc_html__( 'Fallback Image', 'vmagazine' ),
            'section'       => 'vmagazine_general_options',
            'active_callback' => 'vmagazine_fallback_option_callback'
        )
    )
);

/**
* Image hover options
* @since 1.0.3
*/
//section seperator
$wp_customize->add_setting( 'vmagazine_image_hover_setting_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_image_hover_setting_seperator',  array(
  'label'     => esc_html__( 'Image Hover Options', 'vmagazine' ),
  'section'   => 'vmagazine_general_options',
) ) ); 


$wp_customize->add_setting('vmagazine_img_hover_layouts', array(
          'default'           => 'hover-effect-1',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
$wp_customize->add_control('vmagazine_img_hover_layouts',array(
    'section'      => 'vmagazine_general_options',
    'type'         => 'select',
    'label'        => esc_html__( 'Choose Template', 'vmagazine' ),
    'description'  => esc_html__( 'Choose styles for image hover effects', 'vmagazine' ),
    'choices'      => array(
      'no-hover-effect'   => esc_html__('No Effect','vmagazine'),
      'hover-effect-1'    => esc_html__('Hover Effect One','vmagazine'),
      'hover-effect-2'    => esc_html__('Hover Effect Two','vmagazine'),
      'hover-effect-3'    => esc_html__('Hover Effect Three','vmagazine'),
      'hover-effect-4'    => esc_html__('Hover Effect Four','vmagazine'),
    )
  )
);

/**
* Additional Configurations
* @since 1.0.3
*/
$wp_customize->add_section( 'vmagazine_additional_conf', array(
  'title'           => esc_html__('Additional Configurations', 'vmagazine'),
  'panel'           => 'general_settings'
));
/**
* Main Layout Style
*/
$wp_customize->add_setting( 'vmagazine_site_layout_width', array(
  'default'             => 'framed',
  'sanitize_callback'   => 'vmagazine_sanitize_select',
) );

$wp_customize->add_control( new Vmagazine_Customizer_Buttonset_Control( $wp_customize, 'vmagazine_site_layout_width', array(
  'label'           => esc_html__( 'Layout Style', 'vmagazine' ),
  'section'         => 'vmagazine_additional_conf',
  'priority'        => 1,
  'choices'         => array(
    'wide'        => esc_html__( 'Full', 'vmagazine' ),
    'boxed'       => esc_html__( 'Boxed', 'vmagazine' ),
    'framed'      => esc_html__( 'Framed', 'vmagazine' ),
  ),
) ) );


/* Container width*/
$wp_customize->add_setting( 'vmagazine_container_width', array(
        'transport'       => 'postMessage',
        'default'             => 1200,
        'sanitize_callback'   => 'absint',
      ) );

$wp_customize->add_control( new Vmagazine_Customizer_Range_Control( $wp_customize, 'vmagazine_container_width', array(
      'label'           => esc_html__( 'Container Width (px)', 'vmagazine' ),
      'section'         => 'vmagazine_additional_conf',
      'priority'        => 2,
        'input_attrs'       => array(
            'min'   => 1000,
            'max'   => 1800,
            'step'  => 10,
        ),
) ) );

/* Widget bg colors*/
$wp_customize->add_setting('vmagazine_framed_widget_bg_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_framed_widget_bg_color', array(
            'label'           => esc_html__( 'Frame Background Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'active_callback' => 'vmagazine_site_layout_width_frm',
            'priority'        => 5,
)));


//boxed inner bg color
$wp_customize->add_setting('vmagazine_boxed_bg_color_inside', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_boxed_bg_color_inside', array(
            'label'           => esc_html__( 'Inner Background Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'active_callback' => 'vmagazine_site_layout_width_boxed',
            'priority'        => 3,
)));

/**
* Additional stylings
*/
//site bg seperator
$wp_customize->add_setting( 'vmagazine_site_bg_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_site_bg_seperator',  array(
  'label'     => esc_html__( 'Site Background', 'vmagazine' ),
  'section'   => 'vmagazine_additional_conf',
  'priority'  => 8,
) ) ); 

/* here default background color and background image will be displayed */




//elements color seperator
$wp_customize->add_setting( 'vmagazine_elements_colors_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_elements_colors_seperator',  array(
  'label'     => esc_html__( 'Elements/Widgets Colors', 'vmagazine' ),
  'section'   => 'vmagazine_additional_conf',
  'priority'  => 25,
) ) ); 

//elements heading title colors
$wp_customize->add_setting('vmagazine_elements_title_colors', array(
        'default'           => '#252525',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_elements_title_colors', array(
            'label'           => esc_html__( 'Elements Title Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 26,
)));

//elements heading title colors:hover
$wp_customize->add_setting('vmagazine_elements_title_colors_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_elements_title_colors_hover', array(
            'label'           => esc_html__( 'Elements Title Color: Hover', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 27,
)));

//elements content color
$wp_customize->add_setting('vmagazine_elements_content_colors', array(
        'default'           => '#666 ',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_elements_content_colors', array(
            'label'           => esc_html__( 'Elements Content Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 28,
)));

//element post meta colors
$wp_customize->add_setting('vmagazine_elements_meta_colors', array(
        'default'           => '#777777',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_elements_meta_colors', array(
            'label'           => esc_html__( 'Elements Post Meta Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 29,
)));



//widgets border colors
$wp_customize->add_setting('vmagazine_elements_border_colors', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_elements_border_colors', array(
            'label'           => esc_html__( 'Seperator Border Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 30,
)));



/*------------------------------------------------------------------------------------*/
//Widget title layouts
$wp_customize->add_setting( 'vmagazine_widget_title_layout_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_widget_title_layout_seperator',  array(
  'label'     => esc_html__( 'Elements/Widgets Title Layouts', 'vmagazine' ),
  'section'   => 'vmagazine_additional_conf',
  'priority'  => 40,
) ) ); 


$wp_customize->add_setting('vmagazine_template_layout_setting', array(
          'default'           => 'template-one',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
$wp_customize->add_control('vmagazine_template_layout_setting',array(
    'section'      => 'vmagazine_additional_conf',
    'type'         => 'select',
    'label'        => esc_html__( 'Choose Template', 'vmagazine' ),
    'description'  => esc_html__( 'change the template for widgets', 'vmagazine' ),
    'priority'     => 41,
    'choices'      => array(
      'template-one'    => esc_html__('Template One','vmagazine'),
      'template-two'    => esc_html__('Template Two','vmagazine'),
      'template-three'  => esc_html__('Template Three','vmagazine'),
      'template-four'   => esc_html__('Template Four','vmagazine'),
      'template-five'   => esc_html__('Template Five','vmagazine'),
    )
  )
);


//widget title colors

$wp_customize->add_setting('vmagazine_title_layout_five_title_bg_color', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_title_layout_five_title_bg_color', array(
            'label'           => esc_html__( 'Title Background Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 42,
            'active_callback' => 'vmagazine_title_layout_five_title_bg_color'
)));


$wp_customize->add_setting('vmagazine_title_layout_one_title_bg_color', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_title_layout_one_title_bg_color', array(
            'label'           => esc_html__( 'Title Border Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 42,
            'active_callback' => 'vmagazine_title_layout_one_title_bg_color'
)));

$wp_customize->add_setting('vmagazine_widget_title_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_widget_title_color', array(
            'label'           => esc_html__( 'Title Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 42,
)));


/*------------------------------------------------------------------------------------*/
/**
* Breadcrumbs colors
*/
$wp_customize->add_setting( 'vmagazine_breadcrumb_colors_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_breadcrumb_colors_seperator',  array(
  'label'     => esc_html__( 'Breadcrumb Colors', 'vmagazine' ),
  'section'   => 'vmagazine_additional_conf',
  'priority'  => 60,
) ) );


//current page/post
$wp_customize->add_setting('vmagazine_post_current_colors', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_post_current_colors', array(
            'label'           => esc_html__( 'Current Page/Post Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 61,
)));

//page/post color
$wp_customize->add_setting('vmagazine_post_link_colors', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_post_link_colors', array(
            'label'           => esc_html__( 'Page/Post Color', 'vmagazine' ),
            'section'         => 'vmagazine_additional_conf',
            'priority'        => 62,
)));


/*------------------------------------------------------------------------------------*/
/**
 * Add Header Settings panel
 */
$wp_customize->add_panel('vmagazine_header_settings_panel',array(
    		  'priority'       => 2,
        	'capability'     => 'edit_theme_options',
        	'title'          => esc_html__( 'Header Settings', 'vmagazine' ),
));

$wp_customize->add_section( 'vmagazine_header_option', array(
	'title'           =>      esc_html__('Header Option', 'vmagazine'),
	'priority'        =>      3,
  'panel'           =>      'vmagazine_header_settings_panel'
));


	    
	
/**
 * Home Icon
*/
$wp_customize->add_setting( 'vmagazine_home_icon_picker', array(
    'default'           => 'fa-home',
    'sanitize_callback' => 'esc_attr',
    'transport'         => 'postMessage'
) );
$wp_customize->add_control( new Vmagazine_Customize_Icons_Control( $wp_customize, 'vmagazine_home_icon_picker', array(
      'type'        => 'vmagazine_icons',                 
      'label'       => esc_html__( 'Home Icon', 'vmagazine' ),
      'description' => esc_html__( 'Choose your desired home icons from the available icon lists', 'vmagazine' ),
      'section'     => 'vmagazine_header_option',
  ) ) );

$wp_customize->selective_refresh->add_partial( 'vmagazine_home_icon_picker', array(
      'selector'            => '.index-icon',
      'container_inclusive' => true,
      'render_callback'     => 'vmagazine_home_icon',
    ) );

/** Enable/Disable header search */
$wp_customize->add_setting( 'vmagazine_header_search_enable', array(
  'default'           => 'show',
  'sanitize_callback' => 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_header_search_enable',array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Enable/Disable Header Search', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
  'choices'   => array(
        'show'  => esc_html__( 'Enable', 'vmagazine' ),
        'hide'  => esc_html__( 'Disable', 'vmagazine' )
      )
) ) ); 

/** Enable/Disable ajax search */
$wp_customize->add_setting( 'vmagazine_ajax_search_enable', array(
  'default'				    => 'show',
  'sanitize_callback'	=> 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_ajax_search_enable',array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Enable/Disable Ajax Search', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
  'choices'   => array(
        'show'  => esc_html__( 'Enable', 'vmagazine' ),
        'hide'  => esc_html__( 'Disable', 'vmagazine' )
      )
) ) ); 

/** Enable/Disable sticky header **/
$wp_customize->add_setting( 'vmagazine_sticky_header_enable', array(
  'default'           => 'show',
  'sanitize_callback' => 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_sticky_header_enable',array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Enable/Disable Sticky Header', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
  'choices'   => array(
        'show'  => esc_html__( 'Enable', 'vmagazine' ),
        'hide'  => esc_html__( 'Disable', 'vmagazine' )
      )
) ) );

/*
* show/hide WooCommerce Cart
*/
$wp_customize->add_setting( 'vmagazine_cart_show', array(
  'default'           => 'show',
  'sanitize_callback' => 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_cart_show',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Hide/Show Shopping Cart', 'vmagazine' ),
  'description'=> esc_html__( 'Install and activate WooCommerce plugin to make shopping cart working', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
  'choices'   => array(
        'show'  => esc_html__( 'Show', 'vmagazine' ),
        'hide'  => esc_html__( 'Hide', 'vmagazine' )
      )
) ) ); 

//Show/Hide social icons from header
$wp_customize->add_setting( 'vmagazine_header_icon_show', array(
  'default'           => 'hide',
  'sanitize_callback' => 'vmagazine_sanitize_switch_option',
) );

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_header_icon_show',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Hide/Show Social Icons', 'vmagazine' ),
  'description'=> esc_html__( 'To add social icons go to "Social Icons" section', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
  'choices'   => array(
        'show'  => esc_html__( 'Show', 'vmagazine' ),
        'hide'  => esc_html__( 'Hide', 'vmagazine' )
      )
) ) ); 

/**
* Header color options
*
*/

//top header color options
$wp_customize->add_setting( 'vmagazine_header_top_colors_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_header_top_colors_seperator',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Top Header Color Options', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
) ) ); 

//top header  bg color
$wp_customize->add_setting('vmagazine_top_header_bg_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_top_header_bg_color', array(
            'label'         => esc_html__( 'Top Header Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//top header link colors
$wp_customize->add_setting('vmagazine_top_header_link_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_top_header_link_color', array(
            'label'         => esc_html__( 'Top Header Link Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//top header link colors:hover
$wp_customize->add_setting('vmagazine_top_header_link_color_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_top_header_link_color_hover', array(
            'label'         => esc_html__( 'Top Header Link Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//top header text color
$wp_customize->add_setting('vmagazine_top_header_text_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_top_header_text_color', array(
            'label'         => esc_html__( 'Top Header Text Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//main header color options
$wp_customize->add_setting( 'vmagazine_header_nav_color_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_header_nav_color_seperator',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Main Header Color Options', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
) ) ); 

//header navigation bg color
$wp_customize->add_setting('vmagazine_header_nav_bg_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_nav_bg_color', array(
            'label'         => esc_html__( 'Menu Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//menu link colors
$wp_customize->add_setting('vmagazine_header_nav_link_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_nav_link_color', array(
            'label'         => esc_html__( 'Menu Link Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//menu link colors:hover
$wp_customize->add_setting('vmagazine_header_nav_link_color_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_nav_link_color_hover', array(
            'label'         => esc_html__( 'Menu Link Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//link hover bg color(only works on header layout three)
$wp_customize->add_setting('vmagazine_header_nav_link_bg_color_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_nav_link_bg_color_hover', array(
            'label'         => esc_html__( 'Menu Link Background Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
            'description'   => esc_html__( 'This option only works on fourth header layout', 'vmagazine' )

)));

/**
* Submenus color options
*/

//submenu link colors
$wp_customize->add_setting('vmagazine_header_submenu_link_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_submenu_link_color', array(
            'label'         => esc_html__( 'Submenu Link Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));


//submenu link colors:hover
$wp_customize->add_setting('vmagazine_header_submenu_link_color_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_submenu_link_color_hover', array(
            'label'         => esc_html__( 'Submenu Link Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));


//submenu background color
$wp_customize->add_setting('vmagazine_header_submenu_bg_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_submenu_bg_color', array(
            'label'         => esc_html__( 'Submenu Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

/**
* Mega Menu color options
*/
//seperator
$wp_customize->add_setting( 'vmagazine_header_mega_menu_color_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_header_mega_menu_color_seperator',  array(
  'label'     => esc_html__( 'Mega Menu Color Options', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
) ) ); 

//navigation bg color
$wp_customize->add_setting('vmagazine_header_mega_menu_nav_bg_color', array(
        'default'           => '#F6F6F6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_mega_menu_nav_bg_color', array(
            'label'         => esc_html__( 'Navigation Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//mega menu navigation colors
$wp_customize->add_setting('vmagazine_header_mega_menu_nav_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_mega_menu_nav_color', array(
            'label'         => esc_html__( 'Navigation Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//mega menu navigation colors:hover
$wp_customize->add_setting('vmagazine_header_mega_menu_nav_color_hover', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_mega_menu_nav_color_hover', array(
            'label'         => esc_html__( 'Navigation Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//mega menu navigation bg colors:hover
$wp_customize->add_setting('vmagazine_header_mega_menu_nav_bg_color_hover', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_mega_menu_nav_bg_color_hover', array(
            'label'         => esc_html__( 'Navigation Background Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));


/**
*
* Logo section area
*/
//seperator
$wp_customize->add_setting( 'vmagazine_header_logo_section_color_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_header_logo_section_color_seperator',  array(
  'label'     => esc_html__( 'Logo Area Color Options', 'vmagazine' ),
  'section'   => 'vmagazine_header_option',
) ) ); 

//logo area bg color
$wp_customize->add_setting('vmagazine_header_logo_section_bg_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_logo_section_bg_color', array(
            'label'         => esc_html__( 'Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

//Text colors
$wp_customize->add_setting('vmagazine_header_logo_section_text_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_header_logo_section_text_color', array(
            'label'         => esc_html__( 'Text Color', 'vmagazine' ),
            'section'       => 'vmagazine_header_option',
)));

/**
 * Header Layout
 */
$wp_customize->add_section( 'vmagazine_header_layouts', array(
	'title'           => esc_html__('Header Layouts', 'vmagazine'),
	'priority'        => 2,
  'panel'           => 'vmagazine_header_settings_panel'
));


$wp_customize->add_setting('vmagazine_header_layout',array(
		'default'			      => 'header_layout_1',
		'sanitize_callback' => 'vmagazine_sanitize_header_layout',
       )
);

$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize, 'vmagazine_header_layout', array(
		'type'          => 'radio',
		'label'			    => esc_html__( 'Available Layouts', 'vmagazine' ),
    'description'	  => esc_html__( 'Select header layout from available layouts', 'vmagazine' ),
		'section'       => 'vmagazine_header_layouts',
    'priority'      => 5,
		'choices'       => array(
          'header_layout_1' => get_template_directory_uri() . '/assets/images/header-one.png',
          'header_layout_2' => get_template_directory_uri() . '/assets/images/header-two.png',
          'header_layout_3' => get_template_directory_uri() . '/assets/images/header-three.png',
          'header_layout_4' => get_template_directory_uri() . '/assets/images/header-four.png',
        )
       )
    )
);



/**
* Mobile navigation settings
*
*/
$wp_customize->add_section( 'vmagazine_mobile_header_options', array(
	'title'           =>      esc_html__('Mobile Navigation Option', 'vmagazine'),
  'panel'           => 'vmagazine_header_settings_panel'
));

 /** BG color **/
 $wp_customize->add_setting('vmagazine_mobile_header_bg_color', array(
    'sanitize_callback' => 'esc_html',
    'transport' 		    => 'postMessage'

));

$wp_customize->add_control( new Vmagazine_Bg_Color_Picker( $wp_customize,'vmagazine_mobile_header_bg_color', array(
    'section'  		=> 'vmagazine_mobile_header_options',
    'label'    		=> esc_html__('Background Color', 'vmagazine'),
    'description'	=> esc_html__('This will change image overlay color if background image exists', 'vmagazine'),
)));

//mobile navigation logo
$wp_customize->add_setting('vmagazine_mobile_header_logo', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'vmagazine_mobile_header_logo', array(
    'section'     => 'vmagazine_mobile_header_options',
    'label'       => esc_html__('Logo', 'vmagazine'),
    'description' => esc_html__('Add logo to display on mobile devices', 'vmagazine'),
    'type'        => 'image'
)));

//mobile navigation background image
$wp_customize->add_setting('vmagazine_mobile_header_bg', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'vmagazine_mobile_header_bg', array(
    'section'  		=> 'vmagazine_mobile_header_options',
    'label'    		=> esc_html__('Background Image', 'vmagazine'),
    'description'	=> esc_html__('Add background image for navigation menu and search to display on mobile view', 'vmagazine'),
    'type'     		=> 'image'
)));

/** Background Image Position **/
$wp_customize->add_setting( 'vmagazine_mobile_header_bg_position_x', array(
        'default'           => 'center',
        'sanitize_callback' => 'esc_html',
        'transport' 		    => 'postMessage'
    )
);
$wp_customize->add_setting( 'vmagazine_mobile_header_bg_position_y', array(
        'default'           => 'center',
        'sanitize_callback' => 'esc_html',
        'transport' 		    => 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'vmagazine_mobile_header_bg_position', array(
            'label'           => esc_html__( 'Background Position', 'vmagazine' ),
            'section'         => 'vmagazine_mobile_header_options',
            'settings'        => array(
                'x' => 'vmagazine_mobile_header_bg_position_x',
                'y' => 'vmagazine_mobile_header_bg_position_y',
            ),
            
        )
    )
);
/** background attachment */
$wp_customize->add_setting( 'vmagazine_mobile_header_bg_attachment',array(
                  'sanitize_callback'   => 'esc_html',
                  'transport'           => 'postMessage',
                  'default'             => 'scroll'
                ));

$wp_customize->add_control( 'vmagazine_mobile_header_bg_attachment', array(
            'label' 	  => esc_html__('Background Attachment','vmagazine'),
            'section'   => 'vmagazine_mobile_header_options',
            'type'      => 'select',
            'choices'   => array(
                'scroll'    => esc_html__('Scroll','vmagazine'),
                'fixed'     => esc_html__('Fixed','vmagazine'),
            )
));
//bg repeat
$wp_customize->add_setting( 'vmagazine_mobile_header_bg_repeat',array(
                  'sanitize_callback'   => 'esc_html',
                  'transport'           => 'postMessage',
                  'default'             => 'no-repeat'
                ));

$wp_customize->add_control( 'vmagazine_mobile_header_bg_repeat', array(
            'label' 	  => esc_html__('Background Repeat','vmagazine'),
            'section'   => 'vmagazine_mobile_header_options',
            'type'      => 'select',
            'choices'   => array(
                'no-repeat' =>  esc_html__('No Repeat','vmagazine'),
                'repeat-x'  => esc_html__('Repeat-X','vmagazine'),
                'repeat-y'  => esc_html__('Repeat-Y','vmagazine'),
                'repeat'    =>  esc_html__('Repeat','vmagazine'),
            )
));


/**
 * Add Design Settings panel
 */
$wp_customize->add_panel('vmagazine_design_settings_panel',array(
    		'priority'       => 30,
        'title'          => esc_html__( 'Design Settings', 'vmagazine' ),
        ) 
);

/*------------------------------------------------------------------------------------*/
    /**
     * Categories Color
     */
    $wp_customize->add_section('vmagazine_categories_color_section',array(
              'title'   => esc_html__( 'Categories Color', 'vmagazine' ),
              'panel'     => 'vmagazine_design_settings_panel',
              'priority'  => 1,
          )
      );

      global $vmagazine_cat_array;
      foreach ( $vmagazine_cat_array as $key => $value ) {
        /**
           * Theme color option
           */
          $wp_customize->add_setting('vmagazine_cat_color_'.$key, array(
                  'default'           => '#e52d6d',
                  'sanitize_callback' => 'sanitize_hex_color',
              )
          );
          $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
              'vmagazine_cat_color_'.$key,
                  array(
                      'label'         => esc_html( $value ),
                      'section'       => 'vmagazine_categories_color_section',
                      'priority'      => 5
                  )
              )
          );
      }

/*------------------------------------------------------------------------------------*/
/**
 * Archive Settings
 */
$wp_customize->add_section('vmagazine_archive_settings_section', array(
        'title'		=> esc_html__( 'Archive Settings', 'vmagazine' ),
        'panel'     => 'vmagazine_design_settings_panel',
        'priority'  => 5,
    )
);


/**
 * Archive Layouts
 */
$wp_customize->add_setting( 'vmagazine_archive_layout',array(
		'default'			      => 'layout1',
    'capability' 		    => 'edit_theme_options',
		'sanitize_callback' => 'vmagazine_sanitize_archive_layout'
       )
);
$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize, 'vmagazine_archive_layout', array(
		'type'			    => 'radio',
		'label'			    => esc_html__( 'Available Layouts', 'vmagazine' ),
    'description' 	=> esc_html__( 'Select layouts for whole site archives, categories, search page etc.', 'vmagazine' ),
		'section' 		  => 'vmagazine_archive_settings_section',
    'priority'  	  => 10,
		'choices' 		  => array(
	      'layout1' => get_template_directory_uri() . '/assets/images/archive1.png',
        'layout2' => get_template_directory_uri() . '/assets/images/archive2.png',
        'layout3' => get_template_directory_uri() . '/assets/images/archive3.png',
        'layout4' => get_template_directory_uri() . '/assets/images/archive4.png'
    		)
       )
    )
);

/**
 * Length of archive excerpt
 */
$wp_customize->add_setting( 'vmagazine_archive_excerpt_lenght', array(
        'default' 			    => '150',
        'sanitize_callback' => 'vmagazine_sanitize_number',
    )
);
$wp_customize->add_control('vmagazine_archive_excerpt_lenght', array(
        'type'			    => 'number',
        'priority'		  => 15,
        'label'			    => esc_html__( 'Excerpt length', 'vmagazine' ),
        'description'   => esc_html__( 'Choose number of letters in archive pages.', 'vmagazine' ),
        'section'		    => 'vmagazine_archive_settings_section',
        'input_attrs'	  => array(
            'min'   => 10,
            'max'   => 100,
            'step'  => 1
        )
    )
);

/**
 * Archive read more button text
 */
$wp_customize->add_setting( 'vmagazine_archive_read_more_text', array(
        'default'			      => esc_html__( 'Read More', 'vmagazine' ),
        'transport'			    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_text'	                
   	)
);    
$wp_customize->add_control( 'vmagazine_archive_read_more_text', array(
        'type'		  => 'text',
        'label' 	  => esc_html__( 'Read More Button', 'vmagazine' ),
        'section' 	=> 'vmagazine_archive_settings_section',
        'priority' 	=> 20
    )
);

/*------------------------------------------------------------------------------------*/
/**
 * Post Settings
 */
$wp_customize->add_section('vmagazine_posts_settings_section',array(
        'title'		  => esc_html__( 'Single Post Settings', 'vmagazine' ),
        'panel'     => 'vmagazine_design_settings_panel',
        'priority'  => 10,
    )
);



/**
* Posts Layouts
*/
$wp_customize->add_setting('vmagazine_single_posts_layout', array(
		'default' 			    => 'post_layout1',
    'capability' 		    => 'edit_theme_options',
		'sanitize_callback' => 'vmagazine_sanitize_single_post_layout'
       )
);
$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize, 'vmagazine_single_posts_layout', array(
	    		'type' 			  => 'radio',
	    		'label' 		  => esc_html__( 'Available Layouts', 'vmagazine' ),
	        'description' => esc_html__( 'Select layouts for whole posts.', 'vmagazine' ),
	    		'section' 		=> 'vmagazine_posts_settings_section',
	        'priority'  	=> 10,
	    		'choices' 		=> array(
  			      'post_layout1' => get_template_directory_uri() . '/assets/images/postlayout1.jpg',
              'post_layout2' => get_template_directory_uri() . '/assets/images/postlayout2.jpg',
              'post_layout3' => get_template_directory_uri() . '/assets/images/postlayout3.jpg'
	        		)
		       )
	        )
	    );

/**
 * Option about post review
 */
$wp_customize->add_setting('vmagazine_post_review_option',array(
        'default' 			    => 'show',
        'sanitize_callback' => 'vmagazine_sanitize_switch_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize, 'vmagazine_post_review_option', array(
            'type' 			  => 'switch',	                
            'label' 		  => esc_html__( 'Post Review', 'vmagazine' ),
            'description' => esc_html__( 'Enable/Disable single post review in details.', 'vmagazine' ),
            'section' 		=> 'vmagazine_posts_settings_section',
            'choices'   	=> array(
                'show' 		=> esc_html__( 'Show', 'vmagazine' ),
                'hide' 		=> esc_html__( 'Hide', 'vmagazine' )
                ),
            'priority'  	=> 10,
        )
    )
);

//Social Share options
$wp_customize->add_setting('vmagazine_post_share_option',array(
        'default'           => 'hide',
        'sanitize_callback' => 'vmagazine_sanitize_switch_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize, 'vmagazine_post_share_option', array(
            'type'        => 'switch',                  
            'label'       => esc_html__( 'Show/Hide Post Share', 'vmagazine' ),
            'description' => esc_html__( 'First install and activate the plugin AccessPress Social Pro.', 'vmagazine' ),
            'section'     => 'vmagazine_posts_settings_section',
            'choices'     => array(
                'show'    => esc_html__( 'Show', 'vmagazine' ),
                'hide'    => esc_html__( 'Hide', 'vmagazine' )
                ),
            'priority'    => 11,
        )
    )
);

/**
 * Review section title
 */
$wp_customize->add_setting('vmagazine_review_sec_title',array(
        'default' 			    => esc_html__( 'Review Overview', 'vmagazine' ),
        'transport' 		    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_text'	                
   	)
);
$wp_customize->add_control('vmagazine_review_sec_title',array(
        'type'				    => 'text',
        'label' 			    => esc_html__( 'Review Section Heading', 'vmagazine' ),
        'section' 			  => 'vmagazine_posts_settings_section',
        'priority' 			  => 15,
        'active_callback'	=> 'vmagazine_review_post_option_callback'
    )
);

/**
 * Review summary title
 */
$wp_customize->add_setting('vmagazine_review_summary_title',array(
        'default' 			    => esc_html__( 'Summary', 'vmagazine' ),
        'transport' 		    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_text'	                
   	)
);
$wp_customize->add_control('vmagazine_review_summary_title',array(
        'type'				    => 'text',
        'label' 			    => esc_html__( 'Review Summary Title', 'vmagazine' ),
        'section' 			  => 'vmagazine_posts_settings_section',
        'priority' 			  => 20,
        'active_callback'	=> 'vmagazine_review_post_option_callback'
    )
);

/**
 * Option about post author
 */
$wp_customize->add_setting('vmagazine_author_info_option',array(
        'default' 			    => 'hide',
        'sanitize_callback' => 'vmagazine_sanitize_switch_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize, 'vmagazine_author_info_option', array(
            'type' 			=> 'switch',	                
            'label' 		=> esc_html__( 'Author Info.', 'vmagazine' ),
            'description' 	=> esc_html__( 'Enable/Disable post author information.', 'vmagazine' ),
            'section' 		=> 'vmagazine_posts_settings_section',
            'choices'   	=> array(
                'show' 		=> esc_html__( 'Show', 'vmagazine' ),
                'hide' 		=> esc_html__( 'Hide', 'vmagazine' )
                ),
            'priority'  	=> 25,
        )
    )
);

/**
 * Switch for related post section
 */
$wp_customize->add_setting('vmagazine_related_posts_option',array(
        'default' 			     => 'hide',
        'sanitize_callback'  => 'vmagazine_sanitize_switch_option',
        )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize,'vmagazine_related_posts_option', array(
            'type' 			  => 'switch',	                
            'label' 		  => esc_html__( 'Related Posts', 'vmagazine' ),
            'description' => esc_html__( 'Enable/Disable related posts section in single post page.', 'vmagazine' ),
            'section' 		=> 'vmagazine_posts_settings_section',
            'choices'   	=> array(
                'show' 		=> esc_html__( 'Show', 'vmagazine' ),
                'hide' 		=> esc_html__( 'Hide', 'vmagazine' )
                ),
            'priority'  	=> 30,
        )
    )
);

/**
 * Related section title
 */
$wp_customize->add_setting('vmagazine_related_posts_title', array(
        'default' 			    => esc_html__( 'Related Articles', 'vmagazine' ),
        'transport' 		    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_text'	                
   	)
);
$wp_customize->add_control('vmagazine_related_posts_title',array(
        'type'				    => 'text',
        'label' 			    => esc_html__( 'Related Section Title', 'vmagazine' ),
        'section' 			  => 'vmagazine_posts_settings_section',
        'priority' 			  => 35,
        'active_callback'	=> 'vmagazine_related_post_option_callback'
    )
);

/**
 * Types of related posts
 */
$wp_customize->add_setting('vmagazine_related_post_type',array(
        'default'           => 'related_cat',
        'sanitize_callback' => 'vmagazine_sanitize_related_type',
    )
);
$wp_customize->add_control('vmagazine_related_post_type',array(
        'type'        		=> 'radio',
        'label'       		=> esc_html__( 'Types of Related Posts', 'vmagazine' ),
        'description' 		=> esc_html__( 'Option to display related posts from category or tags.', 'vmagazine' ),
        'section'     		=> 'vmagazine_posts_settings_section',            
        'choices' 			  => array(
            'related_cat' => esc_html__( 'Related Posts by Category', 'vmagazine' ),
            'related_tag' => esc_html__( 'Related Posts by Tags', 'vmagazine' )
        ),
        'active_callback'	=> 'vmagazine_related_post_option_callback',
        'priority' 			  => 40
    )
);

/**
* Related post numbers
*
*/
$wp_customize->add_setting( 'vmagazine_related_post_count', array(
		'default' 			    => 3,
		'sanitize_callback' => 'absint'
	));
$wp_customize->add_control( 'vmagazine_related_post_count', array(
	'section'      => 'vmagazine_posts_settings_section', 
	'priority'		 => 41,
	'label' 		   => esc_html__('Number of related posts to show','vmagazine'),
	'type'			   => 'number'

));

//Related post exerpt length
$wp_customize->add_setting( 'vmagazine_related_post_excerpt', array(
    'default'           => 200,
    'sanitize_callback' => 'absint'
  ));
$wp_customize->add_control( 'vmagazine_related_post_excerpt', array(
  'section'      => 'vmagazine_posts_settings_section', 
  'priority'     => 42,
  'label'        => esc_html__('Related Post Excerpt','vmagazine'),
  'description'  => esc_html__('Enter number of letters for related posts','vmagazine'),
  'type'         => 'number'

));




/*------------------------------------------------------------------------------------*/

/**
 * Add Footer Settings
 */
$wp_customize->add_section( 'vmagazine_footer_options', array(
  'title'           => esc_html__('Footer Settings', 'vmagazine'),
  'priority'        => 10
));


/**
* Footer Background options
*
*/

/** BG color **/
 $wp_customize->add_setting('vmagazine_footer_bg_color', array(
    'sanitize_callback' => 'esc_html',
    'transport' 		    => 'postMessage'

));

$wp_customize->add_control( new Vmagazine_Bg_Color_Picker( $wp_customize,'vmagazine_footer_bg_color', array(
    'section'  		=> 'vmagazine_footer_options',
    'label'    		=> esc_html__('Footer Background Color', 'vmagazine'),
    'description'	=> esc_html__('This will change image overlay color if background image exists', 'vmagazine'),
)));

/* bg Image */
$wp_customize->add_setting('vmagazine_footer_bg', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'vmagazine_footer_bg', array(
    'section'  => 'vmagazine_footer_options',
    'label'    => esc_html__('Footer Background Image', 'vmagazine'),
    'type'     => 'image'
)));

 /** Background Image Position **/
$wp_customize->add_setting( 'vmagazine_footer_bg_position_x', array(
        'default'           => 'center',
        'sanitize_callback' => 'esc_html',
        'transport' 		=> 'postMessage'
    )
);
$wp_customize->add_setting( 'vmagazine_footer_bg_position_y', array(
        'default'           => 'center',
        'sanitize_callback' => 'esc_html',
        'transport' 		=> 'postMessage'
    )
);
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'vmagazine_footer_bg_position',array(
            'label'           => esc_html__( 'Background Position', 'vmagazine' ),
            'section'         => 'vmagazine_footer_options',
            'settings'        => array(
                'x' => 'vmagazine_footer_bg_position_x',
                'y' => 'vmagazine_footer_bg_position_y',
            ),
            
        )
    )
);

/** background attachment */
$wp_customize->add_setting( 'vmagazine_footer_bg_attachment',array(
                  'sanitize_callback'   => 'esc_html',
                  'transport'           => 'postMessage',
                  'default'             => 'scroll'
                ));

$wp_customize->add_control( 'vmagazine_footer_bg_attachment', array(
            'label' 	  => esc_html__('Background Attachment','vmagazine'),
            'section'   => 'vmagazine_footer_options',
            'type'      => 'select',
            'choices'   => array(
                'scroll'    => esc_html__('Scroll','vmagazine'),
                'fixed'     => esc_html__('Fixed','vmagazine'),
            )
));
//bg repeat
$wp_customize->add_setting( 'vmagazine_footer_bg_repeat',array(
                  'sanitize_callback'   => 'esc_html',
                  'transport'           => 'postMessage',
                  'default'             => 'no-repeat'
                ));

$wp_customize->add_control( 'vmagazine_footer_bg_repeat', array(
            'label'     => esc_html__('Background Repeat','vmagazine'),
            'section'   => 'vmagazine_footer_options',
            'type'      => 'select',
            'choices'   => array(
                'no-repeat' =>  esc_html__('No Repeat','vmagazine'),
                'repeat-x'  => esc_html__('Repeat-X','vmagazine'),
                'repeat-y'  => esc_html__('Repeat-Y','vmagazine'),
                'repeat'    =>  esc_html__('Repeat','vmagazine'),
            )
));


/* Footer section */

$wp_customize->add_setting('vmagazine_footer_layout', array(
		'default' 			    => 'footer_layout_1',
    'capability' 		    => 'edit_theme_options',
		'sanitize_callback' => 'vmagazine_sanitize_footer_layout'
       )
);

$wp_customize->add_control('vmagazine_footer_layout', array(
		'type' 			    => 'radio',
		'label' 		    => esc_html__( 'Available Layouts', 'vmagazine' ),
    'description' 	=> esc_html__( 'Select footer layout from available layouts', 'vmagazine' ),
		'section' 		  => 'vmagazine_footer_options',
    'priority'  	  => 2,
		'choices' 		  => array(
    		'footer_layout_1' => esc_html__( 'Footer Layout 1', 'vmagazine' ),
        'footer_layout_2' => esc_html__( 'Footer Layout 2', 'vmagazine' ),
    		)
    )
); 	    

$wp_customize->add_setting( 'vmagazine_buttom_footer_menu', array(
	  'default' 			      => 'hide',
	  'sanitize_callback' 	=> 'vmagazine_sanitize_switch_option',
));

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_buttom_footer_menu',  array(
	  'type'      => 'switch',                    
	  'label'     => esc_html__( 'Hide / Show Footer Menu', 'vmagazine' ),
	  'section'   => 'vmagazine_footer_options',
	  'priority'  => 7,
	  'choices'   => array(
	        'show'  => esc_html__( 'Show', 'vmagazine' ),
	        'hide'  => esc_html__( 'Hide', 'vmagazine' )
	      )
) ) ); 

$wp_customize->add_setting('vmagazine_footer_logo', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'vmagazine_footer_logo', array(
    'section'  => 'vmagazine_footer_options',
    'label'    => esc_html__('Upload Footer Logo', 'vmagazine'),
    'type'     => 'image'
)));

$wp_customize->add_setting( 'vmagazine_buttom_footer_icons', array(
  'default' 			      => 'hide',
  'sanitize_callback' 	=> 'vmagazine_sanitize_switch_option',
));

$wp_customize->add_control( new Vmagazine_Customize_Switch_Control( $wp_customize, 'vmagazine_buttom_footer_icons',  array(
  'type'      => 'switch',                    
  'label'     => esc_html__( 'Hide / Show Social Icons', 'vmagazine' ),
  'section'   => 'vmagazine_footer_options',
  'priority'  => 5,
  'choices'   => array(
        'show'  => esc_html__( 'Show', 'vmagazine' ),
        'hide'  => esc_html__( 'Hide', 'vmagazine' )
      )
) ) ); 

/** 
 * copyright textarea
 */
$wp_customize->add_setting('vmagazine_copyright_text',array(
        'default' 			    => esc_html__( '2016 Vmagazine', 'vmagazine' ),
        'capability' 		    => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control( new Vmagazine_Textarea_Custom_Control($wp_customize,'vmagazine_copyright_text',array(
            'type' 		  => 'vmagazine_textarea',
            'label' 	  => esc_html__( 'Copyright Info', 'vmagazine' ),
            'section' 	=> 'vmagazine_footer_options'
        )
    )
);

/**
* Footer information
*/
$wp_customize->add_setting('vmagazine_description_text',array(
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control( new Vmagazine_Textarea_Custom_Control($wp_customize,'vmagazine_description_text',array(
            'type'      => 'vmagazine_textarea',
            'label'     => esc_html__( 'Footer Description Text', 'vmagazine' ),
            'section'   => 'vmagazine_footer_options'
        )
    )
);

	

/*------------------------------------------------------------------------------------*/
/**
 * News Ticker
 */
$wp_customize->add_section( 'vmagazine_news_ticker_section',array(
        'title'		  => esc_html__( 'News Ticker', 'vmagazine' ),
        'panel'     => 'vmagazine_header_settings_panel',
        'priority'  => 15,
    )
);

// News ticker option
$wp_customize->add_setting('vmagazine_ticker_option',array(
    	'default'			        => 'show',
        'sanitize_callback' => 'vmagazine_sanitize_switch_option'
    )
);
$wp_customize->add_control( new Vmagazine_Customize_Switch_Control($wp_customize, 'vmagazine_ticker_option', array(
            'type' 			    => 'switch',
            'label' 		    => esc_html__( 'News Ticker', 'vmagazine' ),
            'description' 	=> esc_html__( 'Enable/Disable news ticker ', 'vmagazine' ),
            'section' 		=> 'vmagazine_news_ticker_section',
            'choices'   	=> array(
                'show' 		=> esc_html__( 'Show', 'vmagazine' ),
                'hide' 		=> esc_html__( 'Hide', 'vmagazine' )
                ),
            'priority'  	=> 5,
        )	            	
    )
);

$wp_customize->add_setting( 'vmagazine_ticker_disp_option', array(
    	'default'			=> 'latest-post',
      'sanitize_callback' => 'vmagazine_sanitize_text'
    ) );
$wp_customize->add_control( 'vmagazine_ticker_disp_option', array(
		'section'			=> 'vmagazine_news_ticker_section',
		'label'				=> esc_html__( 'Select News Display Type', 'vmagazine' ),
		'type'				=> 'radio',
		'choices'			=> array(
			'latest-post'	=> esc_html__('Display From Latest Posts','vmagazine'),
			'cat-post'		=> esc_html__('Display From Selected Category','vmagazine')
		),

	));


$cat_list = vmagazine_category_lists();

$wp_customize->add_setting( 'vmagazine_ticker_cat', array(
    	'default'			      => 0,
      'sanitize_callback' => 'absint'
    ) );
$wp_customize->add_control( 'vmagazine_ticker_cat', array(
		'section'			    => 'vmagazine_news_ticker_section',
		'label'				    => esc_html__( 'Select News Category', 'vmagazine' ),
		'type'				    => 'select',
		'active_callback'	=> 'vmagazine_ticker_disp_typ',
		'choices'			    => $cat_list

	));

//News ticker caption
$wp_customize->add_setting( 'vmagazine_ticker_caption',  array(
        'default' 			      => esc_html__( 'Recent News', 'vmagazine' ),
        'transport' 		      => 'postMessage',
        'sanitize_callback'   => 'vmagazine_sanitize_text'
   	) );    
$wp_customize->add_control( 'vmagazine_ticker_caption', array(
        'type'		  => 'text',
        'label' 	  => esc_html__( 'Ticker Title', 'vmagazine' ),
        'section' 	=> 'vmagazine_news_ticker_section',
       
    ));
//News Tags Title
 $wp_customize->add_setting( 'vmagazine_ticker_tags_caption',  array(
        'default' 			    => esc_html__( 'Trending', 'vmagazine' ),
        'transport' 		    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_text'
   	) );    
$wp_customize->add_control( 'vmagazine_ticker_tags_caption', array(
        'type'		        => 'text',
        'label' 	        => esc_html__( 'Tags Title Text', 'vmagazine' ),
        'section' 	      => 'vmagazine_news_ticker_section',
       
    ));


// News Ticker Layout
$wp_customize->add_setting( 'vmagazine_top_ticker_layout', array(
		'default' 			    => 'default-layout',
		'sanitize_callback' => 'vmagazine_sanitize_ticker_layout'
       ));

$wp_customize->add_control('vmagazine_top_ticker_layout', array(
		'type' 			    => 'radio',
		'label' 		    => esc_html__( 'Available Layouts', 'vmagazine' ),
    'description' 	=> esc_html__( 'Select news ticker section layout from available layouts', 'vmagazine' ),
		'section' 		  => 'vmagazine_news_ticker_section',
		'choices' 		  => array(
	      'default-layout' 	=> esc_html__( 'Layout One', 'vmagazine' ),
        'layout-two' 		=> esc_html__( 'Layout Two', 'vmagazine' ),
    		)
       ) );

//News ticker count
$wp_customize->add_setting('vmagazine_ticker_count', array(
        'default' 			    => 5,
        'transport' 		    => 'postMessage',
        'sanitize_callback' => 'vmagazine_sanitize_number'
   	)
);    
$wp_customize->add_control('vmagazine_ticker_count',array(
        'type'			    => 'number',
        'label' 		    => esc_html__( 'Number of Posts', 'vmagazine' ),
        'section' 		  => 'vmagazine_news_ticker_section',
        'input_attrs' 	=> array(
            'min'   => 3,
            'max'   => 15,
            'step'  => 1
        )
    )
);
	
/**
* Ticker color options
* @since 1.0.3
*/
//ticker bg color
$wp_customize->add_setting('vmagazine_ticker_bg_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_bg_color', array(
            'label'         => esc_html__( 'Ticker Background Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));

//ticker title color
$wp_customize->add_setting('vmagazine_ticker_title_text_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_title_text_color', array(
            'label'         => esc_html__( 'Ticker Title Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));


//ticker news color
$wp_customize->add_setting('vmagazine_ticker_news_color', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_news_color', array(
            'label'         => esc_html__( 'Ticker News Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));

//ticker news color:hover
$wp_customize->add_setting('vmagazine_ticker_news_color_hover', array(
        'default'           => '#e52d6d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_news_color_hover', array(
            'label'         => esc_html__( 'Ticker News Color: Hover', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));

//ticker date color
$wp_customize->add_setting('vmagazine_ticker_date_color', array(
        'default'           => '#A0A0A0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_date_color', array(
            'label'         => esc_html__( 'Ticker Date Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));

//ticker navigation border color
$wp_customize->add_setting('vmagazine_ticker_nav_border_color', array(
        'default'           => '#eee',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_nav_border_color', array(
            'label'         => esc_html__( 'Ticker Navigation Border Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));

//ticker nav icon color
$wp_customize->add_setting('vmagazine_ticker_nav_icon_color', array(
        'default'           => '#333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
        
    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'vmagazine_ticker_nav_icon_color', array(
            'label'         => esc_html__( 'Navigation Arrow Color', 'vmagazine' ),
            'section'       => 'vmagazine_news_ticker_section',
)));


/**
* Layout Settings
* @since 1.0.3
*/


$wp_customize->add_section( 'vmagazine_layout_settings_panel', array(
  'title'           =>      esc_html__('Layout Settings', 'vmagazine'),
  'priority'        =>      20
));

/**
* Archive sidebars
*/
$wp_customize->add_setting( 'vmagazine_archive_post_sidebar_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_archive_post_sidebar_seperator',  array(
  'label'     => esc_html__( 'Archive Post Sidebar Layouts', 'vmagazine' ),
  'section'   => 'vmagazine_layout_settings_panel',
) ) ); 

$wp_customize->add_setting( 'vmagazine_archive_sidebar', array(
    'default'           => 'right_sidebar',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'vmagazine_sanitize_page_sidebar'
       )
);
$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize, 'vmagazine_archive_sidebar', array(
    'type'        => 'radio',
    'description' => esc_html__( 'Select sidebar for whole site archives, categories, search page etc.', 'vmagazine' ),
    'section'     => 'vmagazine_layout_settings_panel',
    'choices'     => array(
        'right_sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
        'left_sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
        'both_sidebar'  => get_template_directory_uri() . '/assets/images/both-sidebar.png',
        'no_sidebar'    => get_template_directory_uri() . '/assets/images/no-sidebar.png',
                
        )
       )
    )
);


/**
 * Post sidebars
 */
$wp_customize->add_setting( 'vmagazine_post_sidebar_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_post_sidebar_seperator',  array(
  'label'     => esc_html__( 'Post Sidebar Layouts', 'vmagazine' ),
  'section'   => 'vmagazine_layout_settings_panel',
) ) ); 

$wp_customize->add_setting('vmagazine_default_post_sidebar', array(
    'default'           => 'right_sidebar',
        'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'vmagazine_sanitize_page_sidebar'
       )
);
$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize,'vmagazine_default_post_sidebar',array(
    'type'        => 'radio',
    'description' => esc_html__( 'Select sidebar for single post.', 'vmagazine' ),
    'section'     => 'vmagazine_layout_settings_panel',
    'choices'     => array(
        'right_sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
        'left_sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
        'both_sidebar'  => get_template_directory_uri() . '/assets/images/both-sidebar.png',
        'no_sidebar'  => get_template_directory_uri() . '/assets/images/no-sidebar.png',
        )
       )
    )
);



/**
 * Page sidebars
 */

$wp_customize->add_setting( 'vmagazine_page_sidebar_seperator', array(
  'sanitize_callback' => 'vmagazine_sanitize_text',
) );

$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'vmagazine_page_sidebar_seperator',  array(
  'label'     => esc_html__( 'Page Sidebar Layouts', 'vmagazine' ),
  'section'   => 'vmagazine_layout_settings_panel',
) ) ); 


$wp_customize->add_setting('vmagazine_default_page_sidebar', array(
    'default'       => 'right_sidebar',
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'vmagazine_sanitize_page_sidebar'
    )
);
$wp_customize->add_control( new Vmagazine_Image_Radio_Control($wp_customize, 'vmagazine_default_page_sidebar', array(
    'type'        => 'radio',
    'description' => esc_html__( 'Select sidebar for every pages.', 'vmagazine' ),
    'section'     => 'vmagazine_layout_settings_panel',
    'choices'     => array(
      'right_sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
            'left_sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
            'both_sidebar'  => get_template_directory_uri() . '/assets/images/both-sidebar.png',
            'no_sidebar'  => get_template_directory_uri() . '/assets/images/no-sidebar.png',
                
        )
       )
    )
);


}


endif;	
	    