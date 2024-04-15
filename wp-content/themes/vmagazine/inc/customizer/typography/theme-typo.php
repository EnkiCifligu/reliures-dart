<?php
/**
*	Theme Typography
*
*
* vmagazine Pro Refine Function
*/
require get_template_directory() . '/inc/customizer/typography/typography.php';
function vmagazine_get_google_font_variants(){
    $vmagazine_font_list = get_option( 'vmagazine_google_font','Lato' );
    $font_family = $_REQUEST['font_family'];
    $font_array = vmagazine_search_key($vmagazine_font_list,'family', $font_family);
    $variants_array = $font_array['0']['variants'] ;
    $options_array = "";
    foreach ($variants_array  as $key=>$variants ) {
        $options_array .= '<option value="'.esc_attr($key).'">'.esc_html($variants).'</option>';
    }
	if(!empty($options_array)){
		echo ''.$options_array; //Escaping of all variables already done above
	}else{
		 $options_array = '';
	}
	die();
}
add_action("wp_ajax_vmagazine_get_google_font_variants", "vmagazine_get_google_font_variants");

function vmagazine_search_key($array, $key, $value){
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subarray) {
            $results = array_merge($results, vmagazine_search_key($subarray, $key, $value));
        }
    }
    return $results;
}

/**
 * Display Front Live Priview function
*/
if ( ! function_exists( 'vmagazine_store_typhography' ) ) {
	function vmagazine_store_typhography(){

		/*=== Menu ====*/

		$menu_font_family = get_theme_mod( 'menu_font_family');
		$menu_font_style = get_theme_mod( 'menu_font_style');
if($menu_font_family ==''){
	$menu_font_family = 'Open Sans';
}
		$menu_font_family_str = str_replace( ' ', '+', $menu_font_family );
	 	$menu_typography =  $menu_font_family_str.':'.$menu_font_style;



		/* === <p> === */
		$p_font_family = get_theme_mod( 'p_font_family');
		$p_font_style = get_theme_mod( 'p_font_style');
if($p_font_family ==''){
	$p_font_family = 'Open Sans';
}
		$p_font_family_str = str_replace( ' ', '+', $p_font_family );
	 	$p_typography =  $p_font_family_str.':'.$p_font_style;

	 	/* === <h1> === */
		$h1_font_family = get_theme_mod( 'h1_font_family');
		$h1_font_style = get_theme_mod( 'h1_font_style');
if($h1_font_family ==''){
	$h1_font_family = 'Open Sans';
}
		$h1_font_family_str = str_replace( ' ', '+', $h1_font_family );
	 	$h1_typography =  $h1_font_family_str.':'.$h1_font_style;

	 	/* === <h2> === */
		$h2_font_family = get_theme_mod( 'h2_font_family');
		$h2_font_style = get_theme_mod( 'h2_font_style');
if($h2_font_family ==''){
	$h2_font_family = 'Open Sans';
}
		$h2_font_family_str = str_replace( ' ', '+', $h2_font_family );
	 	$h2_typography =  $h2_font_family_str.':'.$h2_font_style;

	 	/* === <h3> === */
		$h3_font_family = get_theme_mod( 'h3_font_family');
		$h3_font_style = get_theme_mod( 'h3_font_style');
if($h3_font_family ==''){
	$h3_font_family = 'Open Sans';
}
		$h3_font_family_str = str_replace( ' ', '+', $h3_font_family );
	 	$h3_typography =  $h3_font_family_str.':'.$h3_font_style;

	 	/* === <h4> === */
		$h4_font_family = get_theme_mod( 'h4_font_family');
		$h4_font_style = get_theme_mod( 'h4_font_style');
if($h4_font_family ==''){
	$h4_font_family = 'Open Sans';
}
		$h4_font_family_str = str_replace( ' ', '+', $h4_font_family );
	 	$h4_typography =  $h4_font_family_str.':'.$h4_font_style;

	 	/* === <h5> === */
		$h5_font_family = get_theme_mod( 'h5_font_family');
		$h5_font_style = get_theme_mod( 'h5_font_style');
if($h5_font_family ==''){
	$h5_font_family = 'Open Sans';
}
		$h5_font_family_str = str_replace( ' ', '+', $h5_font_family );
	 	$h5_typography =  $h5_font_family_str.':'.$h5_font_style;

	 	/* === <h6> === */
		$h6_font_family = get_theme_mod( 'h6_font_family');
		$h6_font_style = get_theme_mod( 'h6_font_style');
if($h6_font_family ==''){
	$h6_font_family = 'Open Sans';
}
		$h6_font_family_str = str_replace( ' ', '+', $h6_font_family );
	 	$h6_typography =  $h6_font_family_str.':'.$h6_font_style;

		$all_fonts = array( $menu_typography, $p_typography, $h1_typography, $h2_typography, $h3_typography, $h4_typography, $h5_typography, $h6_typography );

			$font_family = array();
			$font_weight_array = array();
			foreach($all_fonts as $fonts){
				$each_font = explode(':',$fonts);
				$font_family[] = $each_font[0];
				if(!isset($font_weight_array[$each_font[0]]) ){
					$font_weight_array[$each_font[0]][] = $each_font[1];
				}else{
					if(!in_array($each_font[1],$font_weight_array[$each_font[0]])){
						$font_weight_array[$each_font[0]][] = $each_font[1];
					}
				}
			}
			$final_font_array = array();
			foreach($font_weight_array as $font => $font_weight){
				if(!empty($font)) {
					$font_weight_str = implode(',',$font_weight);
					if($font_weight_str != ''){
					$each_font_string = $font.':'.$font_weight_str;
					}else{
						$each_font_string = $font;
					}
					$final_font_array[] = $each_font_string;
				}
			}

			$final_font_string = implode("|",$final_font_array);

		$query_args = array(
			'family' => $final_font_string,
		);
		wp_enqueue_style('vmagazine-typhography-font', add_query_arg($query_args, "//fonts.googleapis.com/css"));
	}
}
add_action('wp_enqueue_scripts','vmagazine_store_typhography');
