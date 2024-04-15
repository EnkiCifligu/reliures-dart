<?php
/**
 * Register customizer panels, sections, settings, and controls.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
# Register our customizer panels, sections, settings, and controls.

add_action( 'customize_register', 'vmagazine_typo_customize_register', 15 );
function vmagazine_typo_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/typography/customize/control-typography.php';

	// Register typography control JS template.
	$wp_customize->register_control_type( 'Customizer_Typo_Control_Typography' );

	// Add the typography panel.
	$wp_customize->add_panel( 'typography', array( 'priority' => 50, 'title' => esc_html__( 'Typography', 'vmagazine' ) ) );

	// Add the `<menu>` typography section.
	$wp_customize->add_section( 'menu_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Main Menu', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'menu_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_font_style',  array( 'default' => '600', 'sanitize_callback' => 'sanitize_text_field',        'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_text_transform', array( 'default' => 'uppercase', 'sanitize_callback' => 'sanitize_text_field',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_font_size',   array( 'default' => '13', 'sanitize_callback' => 'absint',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_line_height', array( 'default' => '1.5', 'sanitize_callback' => 'vmagazine_floatval', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'menu_color', array( 'default' => '#fff',     'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'menu_typography',
			array(
				'label'       => esc_html__( 'Main Menu Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your main menu to appear.', 'vmagazine' ),
				'section'     => 'menu_typography',
				'settings'    => array(
					'family'      => 'menu_font_family',
					'style'       => 'menu_font_style',
					'text_decoration' => 'menu_text_decoration',
					'text_transform' => 'menu_text_transform',
					'size'        => 'menu_font_size',
					'typocolor'  => 'menu_color'
				),
				'l10n'        => array(),
			)
		)
	);

	// Add the `<p>` typography section.
	$wp_customize->add_section( 'p_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Paragraphs', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'p_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_font_style',  array( 'default' => '400', 'sanitize_callback' => 'sanitize_text_field',   'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_font_size',   array( 'default' => '15', 'sanitize_callback' => 'absint',              'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_line_height', array( 'default' => '1.5', 'sanitize_callback' => 'vmagazine_floatval', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'p_color', array( 'default' => '#666',     'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'p_typography',
			array(
				'label'       => esc_html__( 'Paragraph Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'p_typography',
				'settings'    => array(
					'family'      => 'p_font_family',
					'style'       => 'p_font_style',
					'text_decoration' => 'p_text_decoration',
					'text_transform' => 'p_text_transform',
					'size'        => 'p_font_size',
					'line_height' => 'p_line_height',
					'typocolor'  => 'p_color'
				),
				'l10n'        => array(),
			)
		)
	);



	// Add the `<h1>` typography section.
	$wp_customize->add_section( 'h1_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Header (H1)', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'h1_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_font_size',   array( 'default' => '30', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h1_color', array( 'default' => '#000', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'h1_typography',
			array(
				'label'       => esc_html__( 'Header1 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h1_typography',
				'settings'    => array(
					'family'      => 'h1_font_family',
					'style'       => 'h1_font_style',
					'text_decoration' => 'h1_text_decoration',
					'text_transform' => 'h1_text_transform',
					'size'        => 'h1_font_size',
					'line_height' => 'h1_line_height',
					'typocolor'  => 'h1_color'
				),
				'l10n'        => array(),
			)
		)
	);

	// Add the `<h2>` typography section.
	$wp_customize->add_section( 'h2_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Header (H2)', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'h2_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_font_style',  array( 'default' => '700', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_font_size',   array( 'default' => '26', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h2_color', array( 'default' => '#252525', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'h2_typography',
			array(
				'label'       => esc_html__( 'Header2 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h2_typography',
				'settings'    => array(
					'family'      => 'h2_font_family',
					'style'       => 'h2_font_style',
					'text_decoration' => 'h2_text_decoration',
					'text_transform' => 'h2_text_transform',
					'size'        => 'h2_font_size',
					'line_height' => 'h2_line_height',
					'typocolor'  => 'h2_color'
				),
				'l10n'        => array(),
			)
		)
	);

	// Add the `<h3>` typography section.
	$wp_customize->add_section( 'h3_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Header (H3)', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'h3_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_font_size',   array( 'default' => '22', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h3_color', array( 'default' => '#000', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'h3_typography',
			array(
				'label'       => esc_html__( 'Header3 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h3_typography',
				'settings'    => array(
					'family'      => 'h3_font_family',
					'style'       => 'h3_font_style',
					'text_decoration' => 'h3_text_decoration',
					'text_transform' => 'h3_text_transform',
					'size'        => 'h3_font_size',
					'line_height' => 'h3_line_height',
					'typocolor'  => 'h3_color'
				),
				'l10n'        => array(),
			)
		)
	);


	// Add the `<h4>` typography section.
	$wp_customize->add_section( 'h4_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Header (H4)', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'h4_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_font_size',   array( 'default' => '20', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h4_color', array( 'default' => '#000', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'h4_typography',
			array(
				'label'       => esc_html__( 'Header4 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h4_typography',
				'settings'    => array(
					'family'      => 'h4_font_family',
					'style'       => 'h4_font_style',
					'text_decoration' => 'h4_text_decoration',
					'text_transform' => 'h4_text_transform',
					'size'        => 'h4_font_size',
					'line_height' => 'h4_line_height',
					'typocolor'  => 'h4_color'
				),
				'l10n'        => array(),
			)
		)
	);

	// Add the `<h5>` typography section.
	$wp_customize->add_section( 'h5_typography',
		array( 'panel' => 'typography', 'title' => esc_html__( 'Header (H5)', 'vmagazine' ) )
	);
	$wp_customize->add_setting( 'h5_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_font_size',   array( 'default' => '18', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h5_color', array( 'default' => '#000', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control(
		new Customizer_Typo_Control_Typography(
			$wp_customize,
			'h5_typography',
			array(
				'label'       => esc_html__( 'Header5 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h5_typography',
				'settings'    => array(
					'family'      => 'h5_font_family',
					'style'       => 'h5_font_style',
					'text_decoration' => 'h5_text_decoration',
					'text_transform' => 'h5_text_transform',
					'size'        => 'h5_font_size',
					'line_height' => 'h5_line_height',
					'typocolor'  => 'h5_color'
				),
				'l10n'        => array(),
			)
		)
	);

	// Add the `<h6>` typography section.
	$wp_customize->add_section( 'h6_typography',array(
		'panel' => 'typography',
		'title' => esc_html__( 'Header (H6)', 'vmagazine' )
	 ));

	$wp_customize->add_setting( 'h6_font_family', array( 'default' => 'Lato',  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_font_size',   array( 'default' => '16', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_line_height', array( 'default' => '1.1', 'sanitize_callback' => 'vmagazine_floatval','transport' => 'postMessage' ) );
	$wp_customize->add_setting( 'h6_color', array( 'default' => '#000', 'sanitize_callback' => 'sanitize_hex_color','transport' => 'postMessage' ) );

	$wp_customize->add_control( new Customizer_Typo_Control_Typography( $wp_customize, 'h6_typography', array(
				'label'       => esc_html__( 'Header6 Typography', 'vmagazine' ),
				'description' => esc_html__( 'Select how you want your paragraphs to appear.', 'vmagazine' ),
				'section'     => 'h6_typography',
				'settings'    => array(
					'family'      => 'h6_font_family',
					'style'       => 'h6_font_style',
					'text_decoration' => 'h6_text_decoration',
					'text_transform' => 'h6_text_transform',
					'size'        => 'h6_font_size',
					'line_height' => 'h6_line_height',
					'typocolor'  => 'h6_color'
				),
				'l10n'        => array(),
			)));




}

/**
 * Register control scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
# Load scripts and styles.
add_action( 'customize_controls_enqueue_scripts', 'vmagazine_customize_controls_register_scripts' );
function vmagazine_customize_controls_register_scripts() {
	wp_enqueue_script( 'vmagazine-pro-customize-controls', get_template_directory_uri() .'/inc/customizer/typography/js/customize-controls.js', array( 'customize-controls' ) );
	wp_enqueue_script( 'ajax-script-function', get_template_directory_uri() .'/inc/customizer/typography/js/typo-ajax.js', array('jquery')  );

    wp_localize_script( 'ajax-script-function', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_style( 'vmagazine-pro-customize-controls', get_template_directory_uri() .'/inc/customizer/typography/css/customize-controls.css' );
	wp_enqueue_style( 'vmagazine-pro-ui-controls', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );
}



/**
 * Load preview scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'customize_preview_init', 'vmagazine_customize_preview_enqueue_scripts' );
function vmagazine_customize_preview_enqueue_scripts() {
	wp_enqueue_script( 'vmagazine-google-webfont', get_template_directory_uri(). '/inc/customizer/typography/js/webfont.js' , array('jquery'));
	wp_enqueue_script( 'vmagazine-customize-preview', get_template_directory_uri().'/inc/customizer/typography/js/customize-previews.js', array( 'jquery', 'customize-preview', 'vmagazine-google-webfont') );
}
/**
 * Add custom body class to give some more weight to our styles.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $classes
 * @return array
 */
function vmagazine_body_class( $classes ) {
	return array_merge( $classes, array( 'vmagazineprotg' ) );
}
add_filter( 'body_class', 'vmagazine_body_class' );
