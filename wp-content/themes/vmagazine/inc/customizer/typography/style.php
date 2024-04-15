<?php
function vmagazine_hex2rgba($color, $opacity = false) {
	 $default = 'rgb(0,0,0)';
	 //Return default if no color provided
	 if(empty($color))
	       return $default;
	 //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if($opacity){
         if(abs($opacity) > 1)
         $opacity = 1.0;
         $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
         $output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
}
//Typography option Values
function vmagazine_custom_stylesheet(){
	
	$custom_css ="";
					
	/** Typography **/
    $font_intials = array(
        'p' => array(
            'tags' => 'body',
            'ffamily' => 'Lato',
            'fweight' => '400',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '15',
            'fheight' => '1.5',
            'fcolor' => '#666',
        ),
        'h1' => array(
            'tags' => '.entry-content h1,h1',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '30',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
        
        'h2' => array(
            'tags' => '.entry-content h2,h2',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '26',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
        'h3' => array(
            'tags' => '.entry-content h3,h3,.vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content a',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '22',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
        'h4' => array(
            'tags' => '.entry-content h4,.widget-title,h4',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '20',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
        'h5' => array(
            'tags' => '.entry-content h5,h5',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '18',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
        'h6' => array(
            'tags' => '.entry-content h6,h6',
            'ffamily' => 'Lato',
            'fweight' => '700',
            'ftrans' => 'none',
            'fdecor' => 'none',
            'fsize' => '16',
            'fheight' => '1.1',
            'fcolor' => '#252525',
        ),
    );

    foreach($font_intials as $initial => $tags) {
        extract($tags);
        $font_family    = get_theme_mod( $initial.'_font_family', $ffamily);
        $font_stylefull = get_theme_mod( $initial.'_font_style', $fweight);
        if(!empty($font_stylefull)) {

            $font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$font_stylefull);
            $text_decoration = get_theme_mod( $initial.'_text_decoration', $fdecor);
            $text_transform  = get_theme_mod( $initial.'_text_transform', $ftrans);
            $font_size       = get_theme_mod( $initial.'_font_size', $fsize);
            $line_height     = get_theme_mod( $initial.'_line_height', $fheight);
            $color           = get_theme_mod( $initial.'_color', $fcolor);
        }

        $custom_css .= " {$tags}{
            font-family : ".esc_attr($font_family) .";
            font-weight : ".esc_attr($font_stylefull) .";
            text-decoration : ".esc_attr($text_decoration) .";
            text-transform : ".esc_attr($text_transform) .";
            font-size : ".esc_attr($font_size) ."px;
            line-height : ".esc_attr($line_height) .";
            color : ".esc_attr($color) .";
        }";
    }

    $menu_font_family = get_theme_mod( 'menu_font_family','Lato');
        $menu_font_stylefull = get_theme_mod( 'menu_font_style','400');
        if(!empty($menu_font_stylefull)) {
            $menu_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$menu_font_stylefull);
            if(isset($menu_font_style_weight[1])){
                $menu_font_style = $menu_font_style_weight[1];
            }else{
                $menu_font_style = 'normal';
            }

            if(isset($menu_font_style_weight[0])){
                $menu_font_weight = $menu_font_style_weight[0];
            }else{
                $menu_font_weight = 400;
            }
        }
        $menu_text_decoration = get_theme_mod( 'menu_text_decoration','none');
        $menu_text_transform = get_theme_mod( 'menu_text_transform','uppercase');
        $menu_font_size = get_theme_mod( 'menu_font_size', '13');
        $menu_line_height = get_theme_mod( 'menu_line_height',1.2);
        $menu_color = get_theme_mod( 'menu_color', '#fff');
        $vmagazine_header_layout = get_theme_mod('vmagazine_header_layout','header_layout_1');
        if( $vmagazine_header_layout != 'header_layout_2'  ){
            $menu_color = '#000';
            $menu_font_weight = 600;
        }


    $custom_css .= "header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a{
        font-family : ".$menu_font_family .";
        font-style : ".$menu_font_style .";
        font-weight : ".$menu_font_weight .";
        text-decoration : ".$menu_text_decoration .";
        text-transform : ".$menu_text_transform .";
        font-size : ".$menu_font_size ."px;
        color : ".$menu_color .";
    }";
    
wp_add_inline_style( 'vmagazine-style', $custom_css );
}
add_action('wp_enqueue_scripts','vmagazine_custom_stylesheet');
