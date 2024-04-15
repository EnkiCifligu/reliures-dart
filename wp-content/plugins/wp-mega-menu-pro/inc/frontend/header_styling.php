<?php 
//WPMM_Libary::displayArr(  $get_custom_styling_details );
$menuid = $value['menuid'];
  $orientation = (isset($value['orientation']) && $value['orientation'] != '')?esc_attr($value['orientation']):'horizontal';
  if($orientation == "horizontal"){
      $oclass = "wpmm-orientation-horizontal";
  }else{
      $oclass = "wpmm-orientation-vertical";
  }
if($check){
  $enable_menu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color']:'false';
  $menu_background_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_background_color']) && $get_custom_styling_details[0]['custom_styling']['menu_background_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_background_color']:'';

  $enable_menu_bg_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color']:'false';
  $menu_bg_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color']:'';
  
  $enable_menu_font_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_font_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_font_color']:0;
  $menu_font_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_font_color']) && $get_custom_styling_details[0]['custom_styling']['menu_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_font_color']:'';
  $enable_menu_font_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color']:0;
  $menu_font_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_font_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_font_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_font_hover_color']:'';
  $enable_submenu_megamenu_width = (isset($get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width']) && $get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width']:'false';

  $submenu_megamenu_width = (isset($get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width']) && $get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width']:'';
  $enable_submenu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color']:'false';

  $submenu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['submenu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['submenu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_bg_color']:'';

  $enable_sub_cfont_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color']) && $get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color']:0;
  $submenu_cfont_color = (isset($get_custom_styling_details[0]['custom_styling']['submenu_cfont_color']) && $get_custom_styling_details[0]['custom_styling']['submenu_cfont_color'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_cfont_color']:'';
  $enable_sub_heading_font_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color']) && $get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color']:'false';
  $sub_heading_font_color = (isset($get_custom_styling_details[0]['custom_styling']['sub_heading_font_color']) && $get_custom_styling_details[0]['custom_styling']['sub_heading_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['sub_heading_font_color']:'';
  $enable_menu_icon_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color']:'false';
  $menu_icon_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_icon_color']) && $get_custom_styling_details[0]['custom_styling']['menu_icon_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_icon_color']:'';
  $enable_menu_icon_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color']:'false';
  $menu_icon_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color']:'';


if($enable_menu_bg_color == 'true' && $menu_background_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>{
	background-color: <?php echo $menu_background_color;?>;
}
<?php } ?>
<?php /* on menu hover icon menu bg color change */
if($enable_menu_bg_hover_color  == 'true' && $menu_bg_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>:hover{
	background: <?php echo $menu_bg_hover_color;?>;
}
<?php } 
/* on menu hover icon color change */
if($enable_menu_icon_color  && $menu_icon_color != ''){ ?>
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-mega-menu-icon{
color: <?php echo $menu_icon_color;?>;
}
<?php } 
if($enable_menu_icon_hover_color  && $menu_icon_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>:hover .wpmm-mega-menu-icon {
	color: <?php echo $menu_icon_hover_color;?>;
}
<?php } ?>

<?php if($enable_menu_font_color && $menu_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > a{
	color: <?php echo $menu_font_color;?>;
}
<?php } ?>
<?php if($enable_menu_font_hover_color && $menu_font_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > a:hover{
	color: <?php echo $menu_font_hover_color;?>;
}
<?php } ?>
<?php if($enable_submenu_megamenu_width  && $submenu_megamenu_width != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > .wpmm-sub-menu-wrap,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> ul{
	width: <?php echo $submenu_megamenu_width;?>;
}
<?php } ?>
<?php if($enable_submenu_bg_color  && $submenu_bg_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > .wpmm-sub-menu-wrap,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> ul{
    background-color: <?php echo $submenu_bg_color;?>;
}
<?php } ?>
<?php if($enable_sub_heading_font_color  && $sub_heading_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li h4.wpmm-mega-block-title::before,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li.wp-mega-menu-header > a.wp-mega-menu-link::before{
	background: <?php echo $sub_heading_font_color;?>;
}
<?php } ?>
<?php if($enable_sub_heading_font_color  && $sub_heading_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li h4.wpmm-mega-block-title{
	color: <?php echo $sub_heading_font_color;?>;
}
<?php } ?>
<?php if($enable_sub_cfont_color  && $submenu_cfont_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu li .wpmm-sub-menu-wrapper.wpmm_menu_1 li::before,
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_pages li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_categories li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_archive li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_meta li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_recent_comments li::before,
  .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_recent_entries li::before,
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_product_categories ul.product-categories li a::before, 
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_categories li::before, 
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_archive li::before{
color: <?php echo $submenu_cfont_color;?>;
}

.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li a:focus,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li a,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li div,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li span.wpmm-mega-menu-href-title,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrapper ul li span.wpmm-mega-menu-href-title{
	color: <?php echo $submenu_cfont_color;?>;
}
<?php } ?>
<?php 
 }

$activate_view_more_btn = (isset($get_custom_styling_details[0]['general_settings']['activate_view_more_btn']) && $get_custom_styling_details[0]['general_settings']['activate_view_more_btn'] == 'true')?1:0;
$vbtn_bgcolor = (isset($get_custom_styling_details[0]['general_settings']['vbtn_bgcolor']) && $get_custom_styling_details[0]['general_settings']['vbtn_bgcolor'] != '')?esc_attr($get_custom_styling_details[0]['general_settings']['vbtn_bgcolor']):'';
$vbtn_bghcolor = (isset($get_custom_styling_details[0]['general_settings']['vbtn_bghcolor']) && $get_custom_styling_details[0]['general_settings']['vbtn_bghcolor'] != '')?esc_attr($get_custom_styling_details[0]['general_settings']['vbtn_bghcolor']):'';
$vbtn_fcolor = (isset($get_custom_styling_details[0]['general_settings']['vbtn_fcolor']) && $get_custom_styling_details[0]['general_settings']['vbtn_fcolor'] != '')?esc_attr($get_custom_styling_details[0]['general_settings']['vbtn_fcolor']):'';
$vbtn_fhcolor = (isset($get_custom_styling_details[0]['general_settings']['vbtn_fhcolor']) && $get_custom_styling_details[0]['general_settings']['vbtn_fhcolor'] != '')?esc_attr($get_custom_styling_details[0]['general_settings']['vbtn_fhcolor']):'';

if($activate_view_more_btn == 1){  ?>
<?php if($vbtn_bgcolor != ''){ ?>
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> .wp-mega-sub-menu li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a{
  background-color: <?php echo $vbtn_bgcolor;?>;
  border-color: <?php echo $vbtn_bgcolor;?>;
}
<?php } ?>
<?php if($vbtn_fcolor != ''){ ?>
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> .wp-mega-sub-menu li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a i,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> .wp-mega-sub-menu li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a span{
  color: <?php echo $vbtn_fcolor;?>;
}
<?php } ?>
<?php if($vbtn_bghcolor != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a:hover{
  background-color: <?php echo $vbtn_bghcolor;?>;
}
<?php } ?>
<?php if($vbtn_fhcolor != ''){ ?>
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> .wp-mega-sub-menu li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a:hover i,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> .wp-mega-sub-menu li#wp_nav_menu-item-<?php echo $menuid;?>.wpmega-view-more-btn a:hover span{
  color: <?php echo $vbtn_fhcolor;?>;
}
<?php } ?>
<?php }
?>