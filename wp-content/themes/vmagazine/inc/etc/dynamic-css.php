<?php
/**
* Dynamic css file for the theme
*
*/
function vmagazine_dynamic_css(){

    $custom_css = "";


     /**
    * Preloader Option
    */
     $vmagazine_preloaders_bg_color = get_theme_mod('vmagazine_preloaders_bg_color','#fff');
     $vmagazine_preloader_color = get_theme_mod('vmagazine_preloader_color','#e52d6d');

if( $vmagazine_preloaders_bg_color ){
    $custom_css .= "
        .vmagazine-loader{
            background-color: $vmagazine_preloaders_bg_color;
        }";
}

if( $vmagazine_preloader_color ){

    $custom_css .="
        #loading1 #object,
        #loading2 .object,
        #loading5 .object,
        #loading6 .object,
        #loading7 .object,
        #loading8 .object,
        #loading9 .object,
        #loading10 .object,
        #loading11 .object,
        #loading12 .object-one,
        #loading12 .object-two,
        #loading13 .object,
        #loading14 .object,
        #loading15 .object,
        #loading16 .object,
        #loading17 .object,
        #loading18 .object{
            background-color: $vmagazine_preloader_color;
        }";

        $custom_css .="
             #loading3 .object,
            #loading4 .object{
            border-color: $vmagazine_preloader_color !important;
        }";
}

    /**
    * Categories color
    *
    *
    */
     global $vmagazine_cat_array;
     if( $vmagazine_cat_array ):
         foreach ( $vmagazine_cat_array as $key => $value ) {
            $cat_color = get_theme_mod('vmagazine_cat_color_' . $key, '#e52d6d');

            $custom_css .="
            span.cat-links .cat-$key{
                    background: {$cat_color};
            }";
         }
    endif;

/**
* Mobile Navigation options
*
*/
$vmagazine_mobile_header_bg_color = get_theme_mod('vmagazine_mobile_header_bg_color');
$vmagazine_mobile_header_bg = get_theme_mod('vmagazine_mobile_header_bg');
$vmagazine_mobile_header_bg_position_x = get_theme_mod('vmagazine_mobile_header_bg_position_x','center');
$vmagazine_mobile_header_bg_position_y = get_theme_mod('vmagazine_mobile_header_bg_position_y','center');
$vmagazine_mobile_header_bg_attachment = get_theme_mod('vmagazine_mobile_header_bg_attachment','scroll');
$vmagazine_mobile_header_bg_repeat = get_theme_mod('vmagazine_mobile_header_bg_repeat','no-repeat');

if( $vmagazine_mobile_header_bg ){
    $custom_css .="
        .mob-search-form,.mobile-navigation{
            background-image: url(".esc_url($vmagazine_mobile_header_bg).");
            background-position-y: {$vmagazine_mobile_header_bg_position_y};
            background-position-x: {$vmagazine_mobile_header_bg_position_x};
            background-attachment: {$vmagazine_mobile_header_bg_attachment};
            background-repeat: {$vmagazine_mobile_header_bg_repeat};
        }"; 

    $custom_css .="
        .vmagazine-mobile-search-wrapper .mob-search-form .img-overlay,.vmagazine-mobile-navigation-wrapper .mobile-navigation .img-overlay{
            background-color: {$vmagazine_mobile_header_bg_color};
        }";    
     
}else{
    $custom_css .="
        .mob-search-form,.mobile-navigation{
            background-color: {$vmagazine_mobile_header_bg_color};
        }";   
}

    /**
    * Footer Background Options
    *
    */
    $vmagazine_footer_bg_color = get_theme_mod('vmagazine_footer_bg_color');
    $vmagazine_footer_bg = get_theme_mod('vmagazine_footer_bg');
    $vmagazine_footer_bg_position_x = get_theme_mod('vmagazine_footer_bg_position_x','center');
    $vmagazine_footer_bg_position_y = get_theme_mod('vmagazine_footer_bg_position_y','center');
    $vmagazine_footer_bg_attachment = get_theme_mod('vmagazine_footer_bg_attachment','scroll');
    $vmagazine_footer_bg_repeat = get_theme_mod('vmagazine_footer_bg_repeat','no-repeat');

    if( $vmagazine_footer_bg ){
        $custom_css .= "
            .site-footer{
                background-image: url('{$vmagazine_footer_bg}');
                background-attachment: {$vmagazine_footer_bg_attachment};
                background-repeat: {$vmagazine_footer_bg_repeat};
                background-position-y: {$vmagazine_footer_bg_position_y};
                background-position-x: {$vmagazine_footer_bg_position_x};
        }";

        
    }elseif($vmagazine_footer_bg_color){
        $custom_css .= "
            .site-footer .img-overlay{
                background-color: {$vmagazine_footer_bg_color};
            }";
            
        $custom_css .= "
            .site-footer,footer .buttom-footer.footer_one .footer-btm-wrap{
                background-color: {$vmagazine_footer_bg_color};
            }";

    }

 /**
 * Container Width
 */   
 $vmagazine_container_width = get_theme_mod('vmagazine_container_width',1200);
 if( $vmagazine_container_width ){
    $custom_css .="
        .vmagazine-home-wrapp,.vmagazine-container,
        .boxed-width .vmagazine-main-wrapper,
        .boxed-width header.header-layout3 .site-main-nav-wrapper.menu-fixed-triggered, .boxed-width header .vmagazine-nav-wrapper.menu-fixed-triggered,
        .boxed-width .vmagazine-container,.vmagazine-fullwid-slider .vmagazine-container,
        .vmagazine-fullwid-slider.block_layout_2 .single-post .post-content-wrapper,
        .vmagazine-breadcrumb-wrapper .vmagazine-bread-home
        {
                max-width: {$vmagazine_container_width}px;
        }";

 }
    

$background_color = get_theme_mod('background_color','#f1f1f1');

if($background_color){

    $custom_css .="
        .template-two .widget-title span, .template-two .block-title span,
        .template-two .block-header .child-cat-tabs,
        .template-two .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs,
        .template-two .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider,
        .template-two .vmagazine-slider-tab-carousel .slider-cat-tabs-carousel,
        .template-two .vmagazine-slider-tab-carousel .block-header h4.block-title span.title-bg, .template-two .vmagazine-related-wrapper h4.related-title span.title-bg
        {
            background: #{$background_color};
        }";
}

//for boxed layout
$vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
$vmagazine_boxed_bg_color_inside = get_theme_mod('vmagazine_boxed_bg_color_inside','#fff');
if( ($vmagazine_boxed_bg_color_inside != '#fff') && ($vmagazine_site_layout_width == 'boxed') )
$custom_css .="
.elements-paddings-hidden.template-two .widget-title span, .elements-paddings-hidden.template-two .block-title span, .elements-paddings-hidden.template-two .block-header .child-cat-tabs, .elements-paddings-hidden.template-two .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs, .elements-paddings-hidden.template-two .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider
{
    background: $vmagazine_boxed_bg_color_inside; 
}";


/**
* Theme color
*
*/
$vmagazine_theme_color = get_theme_mod('vmagazine_theme_color','#e52d6d');
$rgba_theme_color = vmagazine_hex2rgba( $vmagazine_theme_color, 0.6 );
$clrgba_theme_color = vmagazine_hex2rgba( $vmagazine_theme_color, 0.3 );
$slider_tab_theme_color = vmagazine_hex2rgba( $vmagazine_theme_color, 0.4 );
$theme_title_color = vmagazine_hex2rgba( $vmagazine_theme_color, 0.2 );
$widget_border_transparent = vmagazine_hex2rgba( $vmagazine_theme_color, 0.4 );

if( $vmagazine_theme_color != '#e52d6d' ){
    $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .vmagazine-ticker-caption span, 
    .vmagazine-ticker-wrapper .layout-two .vmagazine-ticker-caption span,
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,
    a.scrollup,a.scrollup:hover,.widget .tagcloud a:hover,span.cat-links a,.entry-footer .edit-link a.post-edit-link,
    .template-three .widget-title:before, .template-three .block-title:before,.template-three .widget-title span, .template-three .block-title span,.widget-title:after, .block-title:after,
    .template-four .widget-title span, .template-four .block-title span, .template-four .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title span.title-bg, .template-four .comment-respond h4.comment-reply-title span, .template-four .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span,.template-five .widget-title:before, .template-five .block-title:before,
    .template-five .widget-title span, .template-five .block-title span,.vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more,.vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title:after, .vmagazine-container #primary.vmagazine-content .post-review-wrapper .section-title:after, .vmagazine-container #primary.vmagazine-content .comment-respond .comment-reply-title:after,
    .vmagazine-container #primary.vmagazine-content .comment-respond .comment-form .form-submit input.submit,.widget .custom-html-widget .tnp-field-button input.tnp-button,.woocommerce-page .vmagazine-container.sidebar-shop .widget_price_filter .ui-slider .ui-slider-range,.woocommerce-page .vmagazine-container.sidebar-shop ul.products li.product .product-img-wrap a.button,.woocommerce-page .vmagazine-container.sidebar-shop ul.products li.product .onsale, .sidebar-shop .sale span.onsale,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,header ul.site-header-cart li span.count,
    header ul.site-header-cart li.cart-items .widget_shopping_cart p.woocommerce-mini-cart__buttons a.button:hover,
    .widget .tagcloud a:hover, .top-footer-wrap .vmagazine-container .widget.widget_tag_cloud .tagcloud a:hover,
    header.header-layout3 .site-main-nav-wrapper .top-right .vmagazine-search-form-primary form.search-form label:before,
    .vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper .entry-content a.vmagazine-archive-more,
    .vmagazine-container #primary.vmagazine-content .entry-content nav.post-navigation .nav-links a:hover:before,
    .vmagazine-archive-layout4 .vmagazine-container #primary article .entry-content a.vmagazine-archive-more,
    header.header-layout2 .logo-ad-wrapper .middle-search form.search-form:after,
    .ap_toggle .ap_toggle_title,.ap_tagline_box.ap-bg-box,.ap-team .member-social-group a, .horizontal .ap_tab_group .tab-title.active, .horizontal .ap_tab_group .tab-title.hover, .vertical .ap_tab_group .tab-title.active, .vertical .ap_tab_group .tab-title.hover,
    .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span, .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title span, .template-three .vmagazine-container #primary.vmagazine-content .comment-respond h4.comment-reply-title span, .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span.title-bg,
    .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title:before, .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title:before, .template-three .vmagazine-container #primary.vmagazine-content .comment-respond h4.comment-reply-title:before, .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title:before,
    .vmagazine-container #primary.vmagazine-content .post-password-form input[type='submit'],
    .woocommerce .cart .button, .woocommerce .cart input.button,
    .dot_1,.vmagazine-grid-list.list #loading-grid .dot_1,
    span.view-all a:hover,.block-post-wrapper.block_layout_3 .view-all a:hover,
    .vmagazine-post-col.block_layout_1 span.view-all a:hover,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .view-all a:hover,
    .block-post-wrapper.list .gl-posts a.vm-ajax-load-more:hover, .block-post-wrapper.grid-two .gl-posts a.vm-ajax-load-more:hover,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p span.read-more a,.template-five .vmagazine-container #primary.vmagazine-content .comment-respond .comment-reply-title span.title-bg,
    .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox h4.box-title span.title-bg,
    .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox h4.box-title:before,
    .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox .box-title:after,
    .template-five .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title span.title-bg,
    .template-five .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox .box-title span.title-bg,
    .middle-search .block-loader .dot_1,.no-results.not-found form.search-form input.search-submit,
    .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper ul#vmagazine-widget-tabbed li.active a, .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper ul#vmagazine-widget-tabbed li a:hover,
    .vmagazine-container #primary .entry-content .post-tag .tags-links a,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .lSSlideWrapper .lSAction > a:hover,
    .related-content-wrapper a.vmagazine-related-more,
    .vmagazine-container #primary .post-review-wrapper .review-inner-wrap .percent-review-wrapper .percent-rating-bar-wrap div, .vmagazine-container #primary .post-review-wrapper .review-inner-wrap .points-review-wrapper .percent-rating-bar-wrap div,
    .vmagazine-fullwid-slider.block_layout_1 .slick-slider .post-content-wrapper h3.extra-large-font a:hover,
    .vmagazine-post-carousel.block_layout_2 .block-carousel .single-post:hover .post-caption h3.large-font a,
    .vmagazine-container #primary .comment-respond .comment-reply-title:after,
    .template-five .vmagazine-container #primary .vmagazine-author-metabox .box-title span.title-bg, .template-five .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg, .template-five .vmagazine-container #primary .post-review-wrapper .section-title span.title-bg, .template-five .vmagazine-container #primary .comment-respond .comment-reply-title span.title-bg,.vmagazine-post-carousel .block-carousel button.slick-arrow:hover,.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper button.slick-arrow:hover,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner span.posted-day,
    .vmagazine-slider-tab-carousel .block-content-wrapper-carousel button.slick-arrow:hover,.slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-content-wrapper .tab-cat-slider.slick-slider .slick-dots li button:before,.widget.widget_vmagazine_video_player .vmagazine-yt-player .vmagazine-video-holder .video-thumbs .video-controls,
    .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs .vmagazine-tabbed-links li.active a, .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs .vmagazine-tabbed-links li a:hover,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-header .child-cat-tabs .vmagazine-tab-links li.active a, .vmagazine-mul-cat.block-post-wrapper.layout-two .block-header .child-cat-tabs .vmagazine-tab-links li a:hover,
    .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li.active a, .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li a:hover,
    .vmagazine-slider-tab-carousel .slider-cat-tabs-carousel .slider-tab-links-carousel li.active a, .vmagazine-slider-tab-carousel .slider-cat-tabs-carousel .slider-tab-links-carousel li a:hover,
    .vmagazine-mul-cat.layout-one .block-header .child-cat-tabs .vmagazine-tab-links li.active a, .vmagazine-mul-cat.layout-one .block-header .child-cat-tabs .vmagazine-tab-links li a:hover
    {
        background: $vmagazine_theme_color;
    }";

    $custom_css .="
    a:hover,.vmagazine-ticker-wrapper .layout-two .ticker-tags ul li a:hover,
    header.header-layout2 nav.main-navigation .nav-wrapper .index-icon a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .index-icon a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .index-icon a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .index-icon a:hover,
    .widget.widget_categories ul li,.widget.widget_categories ul li a:hover,footer .buttom-footer.footer_one .footer-credit .footer-social ul.social li a:hover,header.header-layout4 .logo-wrapper-section .vmagazine-container .social-icons ul.social li a:hover,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-con-wrap .cat-con-section .menu-post-block h3 a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-con-wrap .cat-con-section .menu-post-block h3 a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-con-wrap .cat-con-section .menu-post-block h3 a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-con-wrap .cat-con-section .menu-post-block h3 a:hover,.vmagazine-breadcrumb-wrapper .vmagazine-bread-home span.current,.vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li,.vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li a:hover,
    .vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu .menu-main-menu-container ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li a:hover,.site-footer .footer-widgets .widget_vmagazine_info .footer_info_wrap .info_wrap div span:first-of-type,
    .vmagazine-container #primary.vmagazine-content .entry-content nav.post-navigation .nav-links a:hover p,
    .vmagazine-container #primary.vmagazine-content .post-review-wrapper .review-inner-wrap .summary-wrapper .total-reivew-wrapper span.stars-count,.vmagazine-container #primary.vmagazine-content .post-review-wrapper .review-inner-wrap .stars-review-wrapper .review-featured-wrap span.stars-count span.star-value,header.header-layout1 .vmagazine-top-header .top-menu ul li a:hover, header.header-layout3 .vmagazine-top-header .top-menu ul li a:hover,header.header-layout1 .vmagazine-top-header .top-left ul.social li a:hover, header.header-layout3 .vmagazine-top-header .top-right ul.social li a:hover,header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:hover:after, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:hover:after, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:hover:after, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:hover:after,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li .menu-post-block:hover a, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li .menu-post-block:hover a, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li .menu-post-block:hover a, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li .menu-post-block:hover a,header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item:hover a,.woocommerce-page .vmagazine-container.sidebar-shop ul.products li.product:hover a.woocommerce-LoopProduct-link h2,.woocommerce-page .vmagazine-container.sidebar-shop ul.products span.price,.woocommerce-page .vmagazine-container.sidebar-shop .vmagazine-sidebar .widget_product_categories .product-categories li,.woocommerce-page .vmagazine-container.sidebar-shop .vmagazine-sidebar .widget_product_categories .product-categories li a:hover,.woocommerce-page .vmagazine-container.sidebar-shop .widget_top_rated_products ul.product_list_widget li ins span.woocommerce-Price-amount, .woocommerce-page .vmagazine-container.sidebar-shop .widget_recent_reviews ul.product_list_widget li ins span.woocommerce-Price-amount,.woocommerce-page .vmagazine-container.sidebar-shop .widget_top_rated_products ul.product_list_widget li:hover a, .woocommerce-page .vmagazine-container.sidebar-shop .widget_recent_reviews ul.product_list_widget li:hover a,.woocommerce div.product p.price, .woocommerce div.product span.price,.comment-form-rating p.stars,header ul.site-header-cart li.cart-items .widget_shopping_cart p.woocommerce-mini-cart__buttons a.button,footer .buttom-footer.footer_one .footer-btm-wrap .vmagazine-btm-ftr .footer-nav ul li a:hover,
    .vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li, .top-footer-wrap .vmagazine-container .widget.widget_meta ul li, .top-footer-wrap .vmagazine-container .widget.widget_pages ul li, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul li, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul li, .top-footer-wrap .vmagazine-container .widget.widget_rss ul li, .top-footer-wrap .vmagazine-container .widget.widget_nav_menu ul li, .top-footer-wrap .vmagazine-container .widget.widget_archive ul li,
    .vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li a:hover, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li a:hover, .top-footer-wrap .vmagazine-container .widget_pages ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_meta ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_pages ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_rss ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_nav_menu ul li a:hover, .top-footer-wrap .vmagazine-container .widget.widget_archive ul li a:hover,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:hover, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:hover, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:hover,
    .vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper .entry-content a.vmagazine-archive-more:hover,
    .vmagazine-container #primary.vmagazine-content .post-password-form input[type='submit']:hover,
    .vmagazine-archive-layout4 .vmagazine-container #primary article .entry-content a.vmagazine-archive-more:hover,
    .vmagazine-container #primary .entry-content .post-tag .tags-links a:hover,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:hover:after,
    .vmagazine-slider-tab-carousel .block-content-wrapper-carousel .single-post:hover .post-caption h3,
    .woocommerce-page .vmagazine-container.sidebar-shop .widget_top_rated_products ul.product_list_widget li:hover a,
    .woocommerce-page .vmagazine-container.sidebar-shop .widget_recently_viewed_products ul.product_list_widget li:hover a,
    .woocommerce-page .vmagazine-container.sidebar-shop .widget_products ul.product_list_widget li:hover a,
    .woocommerce-page .vmagazine-container.sidebar-shop .widget_recent_reviews ul.product_list_widget li:hover a,
    .related-content-wrapper a.vmagazine-related-more:hover,
    .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slider-item-wrapper .slider-bigthumb:hover .post-captions h3.large-font a, .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .small-thumbs-wrapper .small-thumbs-inner .slider-smallthumb:hover .post-captions h3.large-font a,.vmagazine-post-carousel .block-carousel .single-post:hover .post-caption h3.large-font a
    {
        color: $vmagazine_theme_color;
    }";

    $custom_css .="
    .lSSlideOuter .lSPager.lSpg > li:hover a, .lSSlideOuter .lSPager.lSpg > li a:hover, .lSSlideOuter .lSPager.lSpg > li.active a,
    .widget.widget_vmagazine_video_player .vmagazine-yt-player .vmagazine-video-holder .video-thumbs .mCS-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar
    {
        background-color: $vmagazine_theme_color;
    }";

    $custom_css .="
    .widget .tagcloud a:hover,.vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field:focus,.site-footer .footer-widgets .widget .tagcloud a:hover,header ul.site-header-cart li.cart-items .widget_shopping_cart p.woocommerce-mini-cart__buttons a.button,.widget .tagcloud a:hover, .top-footer-wrap .vmagazine-container .widget.widget_tag_cloud .tagcloud a:hover,
    .vmagazine-container #primary.vmagazine-content .entry-content nav.post-navigation .nav-links a:hover:before,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more, .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more,
    .ap_toggle,.ap_tagline_box.ap-all-border-box,.ap_tagline_box.ap-left-border-box,
    .vmagazine-archive-layout4 .vmagazine-container #primary article .entry-content a.vmagazine-archive-more,
    .vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper .entry-content a.vmagazine-archive-more,
    .vmagazine-container #primary.vmagazine-content .post-password-form input[type='submit'],
    .vmagazine-container #primary.vmagazine-content .post-password-form input[type='submit']:hover,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article.sticky .archive-post,
    .woocommerce-info,span.view-all a:hover,.vmagazine-post-col.block_layout_1 span.view-all a:hover,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .vmagazine-search-form-primary form.search-form input.search-field:focus,
    .block-post-wrapper.block_layout_3 .view-all a:hover,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .view-all a:hover,
    .block-post-wrapper.list .gl-posts a.vm-ajax-load-more:hover, .block-post-wrapper.grid-two .gl-posts a.vm-ajax-load-more:hover,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p span.read-more a,
    .no-results.not-found form.search-form input.search-submit,
    .vmagazine-container #primary .entry-content .post-tag .tags-links a,
    .related-content-wrapper a.vmagazine-related-more
    {
        border-color: $vmagazine_theme_color;
    }";

    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul li span.comment-author-link,
    .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li a,.woocommerce-page .vmagazine-container.sidebar-shop .widget_recent_reviews ul.product_list_widget li .reviewer,
    .vmagazine-breadcrumb-wrapper .vmagazine-bread-home li.current
    {
        color: $rgba_theme_color;
    }";

    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field:hover
    {
        border-color: $clrgba_theme_color;
    }";

    $custom_css .="
    .lSSlideOuter .lSPager.lSpg > li a
    {
        background-color: $clrgba_theme_color;
    }";

    $custom_css .="
    .template-two .widget-title:before, .template-two .block-title:before,
    .template-two .vmagazine-container #primary.vmagazine-content .comment-respond h4.comment-reply-title:before, .template-two .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title:before, .template-two .vmagazine-container #primary.vmagazine-content .post-review-wrapper .section-title:before,
    .template-two .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox h4.box-title:before{
        background: $theme_title_color;
    }";
    $custom_css .="
    .template-three .widget-title span:after, .template-three .block-title span:after,
    .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span:after, .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title span:after, .template-three .vmagazine-container #primary.vmagazine-content .comment-respond h4.comment-reply-title span:after, .template-three .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span.title-bg:after,
    .template-three .vmagazine-container #primary.vmagazine-content .vmagazine-author-metabox h4.box-title span.title-bg:after,
    .vmagazine-ticker-wrapper .default-layout .vmagazine-ticker-caption span:before, .vmagazine-ticker-wrapper .layout-two .vmagazine-ticker-caption span:before
    {
        border-color: transparent transparent transparent $vmagazine_theme_color;
    }";
    $custom_css .="
    .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content span a:hover{
        color: $rgba_theme_color;
    }";
    
    $custom_css .="
    header.header-layout3 .site-main-nav-wrapper .top-right .vmagazine-search-form-primary{
        border-top: solid 2px $vmagazine_theme_color;
    }";
    $custom_css .="
    .template-four .widget-title span:after, .template-four .block-title span:after, .template-four .vmagazine-container #primary.vmagazine-content .vmagazine-related-wrapper h4.related-title span.title-bg:after, .template-four .comment-respond h4.comment-reply-title span:after, .template-four .vmagazine-container #primary.vmagazine-content .post-review-wrapper h4.section-title span:after
    {
        border-color: $vmagazine_theme_color transparent transparent transparent;
    }";

    $custom_css .="
    .vmagazine-post-carousel .block-carousel .slick-dots li button::before, .vmagazine-post-carousel .block-carousel li.slick-active button:before,
    .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slick-dots li button::before, .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper li.slick-active button:before,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel .slick-dots li button::before, .vmagazine-slider-tab-carousel .block-content-wrapper-carousel .slick-dots li.slick-active button::before
    {
        background: $rgba_theme_color;
    }";

    
    $custom_css .="
    .slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-content-wrapper .tab-cat-slider.slick-slider .slick-active.slick-center .post-thumb .image-overlay
    {
        background: $slider_tab_theme_color;
    }";


    $custom_css .="
    .vmagazine-post-carousel .block-carousel ul.slick-dots:before,.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper ul.slick-dots:before,.vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper ul.slick-dots:after,.vmagazine-post-carousel .block-carousel ul.slick-dots:after,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel ul.slick-dots:before,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel ul.slick-dots:after
    {
        background: $widget_border_transparent;
    }";
    
    if(is_rtl() ){
        $custom_css .="
        .vmagazine-ticker-wrapper .default-layout .vmagazine-ticker-caption span:before, .vmagazine-ticker-wrapper .layout-two .vmagazine-ticker-caption span:before {
        border-color: transparent $vmagazine_theme_color transparent transparent;
        }";
    }
    
}

/**
* Additional color options
* @package VMagazine
* @since 1.0.3
*/  

//menu bg color
$vmagazine_header_nav_bg_color = get_theme_mod('vmagazine_header_nav_bg_color','#fff');
if( $vmagazine_header_nav_bg_color != '#fff' ){
    $custom_css .="
    .site-main-nav-wrapper, header.header-layout2 .vmagazine-nav-wrapper,
    header.header-layout1 .vmagazine-nav-wrapper, 
    header.header-layout3 .site-main-nav-wrapper,
    .boxed-width header.header-layout3 .site-main-nav-wrapper, 
    .site-main-nav-wrapper,
    header.header-layout4 nav.main-navigation .nav-wrapper,
    .vmagazine-mob-outer
    {
        background: $vmagazine_header_nav_bg_color;
    }";

    $custom_css .="
    header.header-layout4 nav.main-navigation .nav-wrapper{
        border-bottom: none;
    }";
}

//menu link color
$vmagazine_header_nav_link_color = get_theme_mod('vmagazine_header_nav_link_color','#000');
if( $vmagazine_header_nav_link_color != '#000' ){
    $custom_css .="
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    .main-navigation i,.site-header-cart i,
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    .sidebar-icon i,.search-toggle i,
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    header.header-layout2 .vmagazine-nav-wrapper.menu-fixed-triggered nav.main-navigation .nav-wrapper, 
    header.header-layout2 .vmagazine-nav-wrapper.menu-fixed-triggered nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a,
    vmagazine-mobile-nav-wrapp i
    
    {
        color: $vmagazine_header_nav_link_color;
    }";

    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:after,
    header.header-layout2 .vmagazine-nav-wrapper.menu-fixed-triggered nav.main-navigation .nav-wrapper .menu-mmnu-container ul > li.menu-item a::after,
    .vmagazine-mobile-nav-wrapp .nav-toggle span:before, .vmagazine-mobile-nav-wrapp .nav-toggle span:after,
    .vmagazine-mobile-nav-wrapp .nav-toggle span
    {
        background: $vmagazine_header_nav_link_color;
    }";


}

//menu link color: hover
$vmagazine_header_nav_link_color_hover = get_theme_mod('vmagazine_header_nav_link_color_hover','#e52d6d');
if( $vmagazine_header_nav_link_color_hover != '#e52d6d' ){
    $custom_css .="
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover,
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item:hover a
    {
        color: $vmagazine_header_nav_link_color_hover;
    }";
}

//menu link bg color: hover
$vmagazine_header_nav_link_bg_color_hover = get_theme_mod('vmagazine_header_nav_link_bg_color_hover','#e52d6d');
if( $vmagazine_header_nav_link_bg_color_hover != '#e52d6d' ){
    $custom_css .="
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item a:hover{
        background: $vmagazine_header_nav_link_bg_color_hover; 
    }";
}



/**
* Top header
*/

//top header bg color
$vmagazine_top_header_bg_color = get_theme_mod('vmagazine_top_header_bg_color','#000');
if( $vmagazine_top_header_bg_color != '#000' ){
    $custom_css .="
    header.header-layout1 .vmagazine-top-header, 
    header.header-layout3 .vmagazine-top-header, 
    header.header-layout4 .vmagazine-top-header
    {
        background: $vmagazine_top_header_bg_color; 
    }";
}

//top header link color
$vmagazine_top_header_link_color = get_theme_mod('vmagazine_top_header_link_color','#fff');
if( $vmagazine_top_header_link_color != '#fff' ){
    $custom_css .="
    header.header-layout1 .vmagazine-top-header .top-menu ul li a, 
    header.header-layout3 .vmagazine-top-header .top-menu ul li a,
    header.header-layout1 .vmagazine-top-header .top-left ul.social li a, 
    header.header-layout3 .vmagazine-top-header .top-right ul.social li a
    {
        color: $vmagazine_top_header_link_color;
    }";
}

//top header link color:hover
$vmagazine_top_header_link_color_hover = get_theme_mod('vmagazine_top_header_link_color_hover','#e52d6d');
if( $vmagazine_top_header_link_color_hover != '#e52d6d' ){
    $custom_css .="
    header.header-layout1 .vmagazine-top-header .top-left ul.social li a:hover, 
    header.header-layout3 .vmagazine-top-header .top-right ul.social li a:hover,
    header.header-layout1 .vmagazine-top-header .top-menu ul li a:hover, 
    header.header-layout3 .vmagazine-top-header .top-menu ul li a:hover
    {
        color: $vmagazine_top_header_link_color_hover;
    }";
}

//top header text color
$vmagazine_top_header_text_color = get_theme_mod('vmagazine_top_header_text_color','#fff');
$top_header_border = vmagazine_hex2rgba( $vmagazine_top_header_text_color, 0.5 );
if( $vmagazine_top_header_text_color != '#fff' ){
    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field, header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field,header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form.search-form:after, header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form.search-form:after
    {
        color: $vmagazine_top_header_text_color;
    }";

    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary:before{
        background: $top_header_border;
    }";

    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-moz-placeholder 
    {
        color: $vmagazine_top_header_text_color;
    }";

    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-webkit-input-placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout1 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-ms-input-placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-moz-placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-webkit-input-placeholder{
        color: $vmagazine_top_header_text_color;
    }";
    $custom_css .="
    header.header-layout3 .vmagazine-top-header .vmagazine-search-form-primary form input.search-field::-ms-input-placeholder
    {
        color: $vmagazine_top_header_text_color;
    }";

}

/**
* Submenu color options
*
*/

//submenu link colors
$vmagazine_header_submenu_link_color = get_theme_mod('vmagazine_header_submenu_link_color','#000');
if( $vmagazine_header_submenu_link_color != '#000' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a,
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li.menu-item.menu-item-has-children:after
    {
        color: $vmagazine_header_submenu_link_color;
    }";
}

//submenu link colors:hover
$vmagazine_header_submenu_link_color_hover = get_theme_mod('vmagazine_header_submenu_link_color_hover','#e52d6d');
if( $vmagazine_header_submenu_link_color_hover != '#e52d6d' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, 
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover, 
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a:hover
    {
        color: $vmagazine_header_submenu_link_color_hover;
    }";
}


//submenu background color
$vmagazine_header_submenu_bg_color = get_theme_mod('vmagazine_header_submenu_bg_color','#fff');
if( $vmagazine_header_submenu_bg_color != '#fff' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu, 
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu, 
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu
    {
        background: $vmagazine_header_submenu_bg_color; 
    }";
}

/**
* Mega-Menu color options
*/

//navigation bg color
$vmagazine_header_mega_menu_nav_bg_color = get_theme_mod('vmagazine_header_mega_menu_nav_bg_color','#F6F6F6');
if( $vmagazine_header_mega_menu_nav_bg_color != '#F6F6F6' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap, 
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap, 
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap
    {
       background: $vmagazine_header_mega_menu_nav_bg_color;  
    }";
}

//mega menu navigation colors
$vmagazine_header_mega_menu_nav_color =  get_theme_mod('vmagazine_header_mega_menu_nav_color','#000' );
if( $vmagazine_header_mega_menu_nav_color != '#000' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a, 
    header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu li a
    {
        color: $vmagazine_header_mega_menu_nav_color;
    }";

}

//mega menu navigation colors:hover
$vmagazine_header_mega_menu_nav_color_hover = get_theme_mod('vmagazine_header_mega_menu_nav_color_hover','#000');
if( $vmagazine_header_mega_menu_nav_color_hover != '#000' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat
    {
        color: $vmagazine_header_mega_menu_nav_color_hover;
    }";
}

//mega menu navigation bg colors:hover
$vmagazine_header_mega_menu_nav_bg_color_hover = get_theme_mod('vmagazine_header_mega_menu_nav_bg_color_hover','#fff');
if( $vmagazine_header_mega_menu_nav_bg_color_hover != '#fff' ){
    $custom_css .="
    header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout2 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout1 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout3 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a:hover, header.header-layout4 nav.main-navigation .nav-wrapper .menu-mmnu-container ul li.menu-item .sub-menu.mega-sub-menu .ap-mega-menu-cat-wrap a.mega-active-cat
    {
        background: $vmagazine_header_mega_menu_nav_bg_color_hover;
    }";
}


/**
* Logo section area
*/

//logo area bg color
$vmagazine_header_logo_section_bg_color = get_theme_mod('vmagazine_header_logo_section_bg_color','#fff');
if( $vmagazine_header_logo_section_bg_color != '#fff' ){
    $custom_css .="
    .site-header .logo-wrapper,
    .site-header .logo-ad-wrapper,
    .site-header .logo-wrapper-section,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .social-icons,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .header-search-wrapper .vmagazine-search-form-primary,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .vmagazine-search-form-primary form.search-form input.search-field,
    header.header-layout1 .logo-ad-wrapper, header.header-layout3 .logo-ad-wrapper,
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field
    {
        background: $vmagazine_header_logo_section_bg_color;
    }";
}


//text color
$vmagazine_header_logo_section_text_color = get_theme_mod('vmagazine_header_logo_section_text_color','#000');
if( $vmagazine_header_logo_section_text_color != '#000' ){
    $custom_css .="
    .site-header .logo-wrapper,
    .site-header .logo-ad-wrapper,
    .site-header .logo-wrapper-section,
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .social-icons ul.social li a,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .header-search-wrapper .search-close,
    header.header-layout4 .logo-wrapper-section .vmagazine-container .search-toggle i
    {
        color: $vmagazine_header_logo_section_text_color;
    }";
    
    $custom_css .="
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field::placeholder
    {
        color: {$vmagazine_header_logo_section_text_color} !important; 
    }";
    $custom_css .="
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field::-webkit-input-placeholder
    {
        color: {$vmagazine_header_logo_section_text_color} !important; 
    }";   
    $custom_css .="
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field::-ms-input-placeholder
    {
        color: {$vmagazine_header_logo_section_text_color} !important; 
    }";  
    $custom_css .="
    header.header-layout2 .logo-ad-wrapper .middle-search input.search-field::-moz-placeholder
    {
        color: {$vmagazine_header_logo_section_text_color} !important; 
    }";      
    
}

/**
* Ticker color Options
* @since 1.0.3
*/

//bg color
$vmagazine_ticker_bg_color = get_theme_mod('vmagazine_ticker_bg_color','#fff');
if( $vmagazine_ticker_bg_color != '#fff' ){
    $custom_css .="
    .vmagazine-ticker-wrapper{
        background: $vmagazine_ticker_bg_color; 
    }";
}

//ticker title color
$vmagazine_ticker_title_text_color = get_theme_mod('vmagazine_ticker_title_text_color','#fff');
if( $vmagazine_ticker_title_text_color != '#fff' ){
    $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .vmagazine-ticker-caption, .vmagazine-ticker-wrapper .layout-two .vmagazine-ticker-caption
    {
        color: $vmagazine_ticker_title_text_color;
    }";
}

//ticker news color
$vmagazine_ticker_news_color = get_theme_mod('vmagazine_ticker_news_color','#000');
if( $vmagazine_ticker_news_color != '#000' ){
    $custom_css .="
    .ticker-wrapp ul li a{
        color: $vmagazine_ticker_news_color;
    }";
}

//ticker news color:hover
$vmagazine_ticker_news_color_hover = get_theme_mod('vmagazine_ticker_news_color_hover','#e52d6d');
if( $vmagazine_ticker_news_color_hover != '#e52d6d' ){
    $custom_css .="
    .ticker-wrapp ul li a:hover{
        color: $vmagazine_ticker_news_color_hover;
    }";
}

//ticker date color
$vmagazine_ticker_date_color = get_theme_mod('vmagazine_ticker_date_color','#A0A0A0');
if( '#A0A0A0' != $vmagazine_ticker_date_color ){
    $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date, .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lslide .single-news .date, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lslide .single-news .date
    {
        color: $vmagazine_ticker_date_color;
    }";

    $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date:before, .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lslide .single-news .date:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSSlide .single-news .date:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lslide .single-news .date:before
    {
        background: $vmagazine_ticker_date_color;
    }";
}

//ticker navigation border color
//ticker nav icon color
$vmagazine_ticker_nav_icon_color = get_theme_mod('vmagazine_ticker_nav_icon_color','#333');
if( '#333' != $vmagazine_ticker_nav_icon_color ){
    $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev:before,.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext:before, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext:before
    {
        color: $vmagazine_ticker_nav_icon_color; 
    }";

     $custom_css .="
    .vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSPrev,.vmagazine-ticker-wrapper .default-layout .lSSlideOuter .lSSlideWrapper .lSAction a.lSNext, .vmagazine-ticker-wrapper .layout-two .lSSlideOuter .lSSlideWrapper .lSAction a.lSNex
    {
        border-color: $vmagazine_ticker_nav_icon_color;
    }";
}



//boxed inner bg color
$vmagazine_boxed_bg_color_inside = get_theme_mod('vmagazine_boxed_bg_color_inside','#fff');
if( $vmagazine_boxed_bg_color_inside != '#fff' ){
    $custom_css .="
    .boxed-width .vmagazine-main-wrapper
    {
        background: $vmagazine_boxed_bg_color_inside;
    }";
}

// widget/frame bg colors
$vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
$vmagazine_framed_widget_bg_color = get_theme_mod('vmagazine_framed_widget_bg_color','#fff');
$vmagazine_framed_widget_rgba_color = vmagazine_hex2rgba( $vmagazine_framed_widget_bg_color, 0.9 );
if( ($vmagazine_framed_widget_bg_color != '#fff') && ($vmagazine_site_layout_width == 'framed') ){
    $custom_css .="
    .block-post-wrapper.block_layout_3 .single-post .content-wrapper,
    .vmagazine-post-col.block_layout_1,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper,
    .vmagazine-rec-posts.recent-post-widget,.vmagazine-featured-slider.featured-slider-wrapper .section-wrapper,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper,.block-post-wrapper.list,
    .widget .tagcloud, .top-footer-wrap .vmagazine-container .widget.widget_tag_cloud .tagcloud,
    .block-post-wrapper.grid,.vmagazine-mul-cat-tabbed .block-content-wrapper,
    .widget.widget_categories ul, .top-footer-wrap .vmagazine-container .widget_pages > ul,
    .widget_vmagazine_block_posts_column .block-post-wrapper.block_layout_4 .single-post,
    .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper,
    .vmagazine-block-post-slider .block-content-wrapper,.vmagazine-slider-tab-carousel .block-content-wrapper-carousel,
    .vmagazine-grid-list.grid-two,.vmagazine-post-carousel .block-carousel,.vmagazine-timeline-post .timeline-post-wrapper,
    .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner,
    .vmagazine-block-post-car-small .lSSlideOuter .carousel-wrap .single-post,.vmagazine-mul-cat.layout-one .block-content-wrapper,
    .vmagazine-container .vmagazine-sidebar .widget.widget_archive ul,
    .top-footer-wrap .vmagazine-container .widget select, .vmagazine-container .vmagazine-sidebar .widget.widget_archive select, .top-footer-wrap .vmagazine-container .widget.widget_archive select,
    .vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap, .top-footer-wrap .vmagazine-container .widget.widget_calendar .calendar_wrap,.vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar th, .vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar td,.vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul, .top-footer-wrap .vmagazine-container .widget.widget_meta ul, .top-footer-wrap .vmagazine-container .widget.widget_pages ul, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul, .top-footer-wrap .vmagazine-container .widget.widget_rss ul,.search-field,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget,.vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget form select,
     body.right-sidebar .container-wrapp-inner #primary,.vmagazine-container #primary .entry-content nav.post-navigation .nav-links a p,
    .vertical .ap_tab_content,.widget .custom-html-widget,
    .vmagazine-container #primary .comment-respond .comment-form input, .vmagazine-container #primary .comment-respond .comment-form textarea,.search-res-wrap
    {
        background: $vmagazine_framed_widget_bg_color; 
    }";

    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_categories select
    {
        background-color: $vmagazine_framed_widget_bg_color; 
    }";

    $custom_css .="
    .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .small-thumbs-wrapper .small-thumbs-inner .slider-smallthumb,
    .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slider-item-wrapper .slider-bigthumb
    {
        border-color: $vmagazine_framed_widget_bg_color;  
    }";

    $custom_css .="
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption
    {
        background: $vmagazine_framed_widget_rgba_color;
    }";

    $custom_css .="
    .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper:after
    {
        border-color: transparent {$vmagazine_framed_widget_bg_color} transparent transparent;
    }";
}



//elements heading title colors
$vmagazine_elements_title_colors = get_theme_mod('vmagazine_elements_title_colors','#252525');
if( '#252525' != $vmagazine_elements_title_colors ){
    $custom_css .="
    .block-post-wrapper.block_layout_3 .single-post .content-wrapper .small-font a,
    .vmagazine-post-col.block_layout_1 .single-post .content-wrapper .large-font a,
    .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content a,
    .vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font a,
    .vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption h3.small-font a,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post h3.small-font a,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption h3,
    .block-post-wrapper.list .single-post .post-content-wrapper .large-font,
    .block-post-wrapper.grid .posts-wrap .single-post .post-content-wrapper h3.large-font,
    .vmagazine-mul-cat-tabbed .block-content-wrapper .top-post-wrapper .single-post .post-caption-wrapper h3.large-font,
    .vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .single-post .post-caption-wrapper h3.small-font,
    .widget_vmagazine_block_posts_column .block-post-wrapper.block_layout_4 .single-post h3.small-font,
    .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper .single-post .post-caption h3.small-font,
    .vmagazine-slider-tab-carousel .block-content-wrapper-carousel .post-caption h3,
    .vmagazine-grid-list.grid-two .single-post.first-post h3.large-font,
    .vmagazine-grid-list.grid-two .single-post h3.large-font,h3.small-font,
    .vmagazine-block-post-car-small h3.extra-large-font,
    .vmagazine-mul-cat.layout-one .block-cat-content .right-posts-wrapper .single-post .post-caption-wrapper h3.small-font,
    .vmagazine-mul-cat.layout-one .block-cat-content .left-post-wrapper .post-caption-wrapper h3.large-font,
    .element-has-desc .vmagazine-grid-list.grid-two .single-post.first-post h3.large-font,
    .element-has-desc .vmagazine-grid-list.grid-two .single-post h3.large-font,
    .vmagazine-container #primary .entry-header h1.entry-title,.vmagazine-container #primary .vmagazine-related-wrapper .single-post h3.small-font,
    .vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title,
    .vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .prev-link .prev-text h4, .vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .next-link .next-text h4,
    .search-content .search-content-wrap .cont-search-wrap .title a,
    .vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper h2.entry-title,
    .vmagazine-archive-layout2.right-sidebar .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title, .vmagazine-archive-layout2.left-sidebar .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-title
    {
        color: $vmagazine_elements_title_colors;
    }";
}

//elements heading title colors:hover
$vmagazine_elements_title_colors_hover = get_theme_mod('vmagazine_elements_title_colors_hover','#e52d6d');
if( '#e52d6d' != $vmagazine_elements_title_colors_hover ){
    $custom_css .="
    .block-post-wrapper.block_layout_3 .single-post .content-wrapper .small-font a:hover,
    .vmagazine-post-col.block_layout_1 .single-post .content-wrapper .large-font a:hover,
    .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content a:hover, .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content span a:hover,
    .vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font a:hover,
    .vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption h3.small-font a:hover,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post h3.small-font a:hover,
    .vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .left-post-wrapper .single-post:hover .post-caption-wrapper .small-font a,
    .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .slider-item-wrapper .slider-bigthumb:hover .post-captions h3.large-font a, .vmagazine-block-post-slider .block-content-wrapper .block-post-slider-wrapper .small-thumbs-wrapper .small-thumbs-inner .slider-smallthumb:hover .post-captions h3.large-font a,.vmagazine-post-carousel .block-carousel .single-post:hover .post-caption h3.large-font a,h3 a:hover,h2 a:hover

    {
        color: $vmagazine_elements_title_colors_hover;
    }";
}

//elements content color
$vmagazine_elements_content_colors = get_theme_mod('vmagazine_elements_content_colors','#666');
if( $vmagazine_elements_content_colors != '#666' ){
    $custom_css .="
    .vmagazine-post-col.block_layout_1 .single-post .content-wrapper p,
    .vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide .slider-caption .post-content,
    .block-post-wrapper.list .single-post .post-content-wrapper .post-content p,
    .vmagazine-mul-cat-tabbed .block-content-wrapper .top-post-wrapper .single-post .post-caption-wrapper p,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p,
    .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner span.posted-month, .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner span.posted-year,
    .element-has-desc .vmagazine-grid-list.grid-two .single-post .post-content p,
    .vmagazine-mul-cat.layout-one .block-cat-content .left-post-wrapper .post-caption-wrapper p,
    .vmagazine-container #primary .entry-content p,.ap-dropcaps.ap-square,.entry-content h3,.entry-content h2,.entry-content h1,.entry-content h4,.entry-content h5,.entry-content h6,.entry-content,
    .vmagazine-container #primary .vmagazine-related-wrapper .single-post .post-contents,
    .vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .entry-content p,
    .apss-share-text,
    .vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget p, .top-footer-wrap .vmagazine-container .widget.widget_text .textwidget p,.vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li cite,.widget_calendar,.vmagazine-container .vmagazine-sidebar .widget.widget_calendar .calendar_wrap table#wp-calendar caption, .top-footer-wrap .vmagazine-container .widget.widget_calendar .calendar_wrap table#wp-calendar caption,
    input[type='text'], input[type='email'], input[type='url'], input[type='password'], input[type='search'],
    .vmagazine-container .vmagazine-sidebar .widget.widget_categories select, .vmagazine-container .vmagazine-sidebar .widget.widget_archive select,
    .vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget form select,
    .vmagazine-container #primary .comment-respond .comment-form p.logged-in-as,
    .vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .prev-link .prev-text h2, .vmagazine-container #primary.post-single-layout2 .single_post_pagination_wrapper .next-link .next-text h2,
    .navigation.pagination .nav-links a.page-numbers,
     .widget .tagcloud a,.widget.widget_categories ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li a,.widget_calendar a,.vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li a, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget.widget_meta ul li a, .top-footer-wrap .vmagazine-container .widget.widget_pages ul li a, .top-footer-wrap .vmagazine-container .widget.widget_recent_comments ul li a, .top-footer-wrap .vmagazine-container .widget.widget_recent_entries ul li a, .top-footer-wrap .vmagazine-container .widget.widget_rss ul li a, .top-footer-wrap .vmagazine-container .widget.widget_archive ul li a,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post .entry-content a.vmagazine-archive-more:after,
    .vmagazine-archive-layout1 .vmagazine-container #primary article .archive-wrapper .entry-content p
    {
        color: $vmagazine_elements_content_colors;
    }";
    
    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field::placeholder,
    .vmagazine-container #primary .comment-respond .comment-form textarea::placeholder
    {
       color: $vmagazine_elements_content_colors;
    }";
    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field::-webkit-input-placeholder,
    .vmagazine-container #primary .comment-respond .comment-form textarea::-webkit-input-placeholder
    {
       color: $vmagazine_elements_content_colors;
    }";
    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field::-ms-input-placeholder,
    .vmagazine-container #primary .comment-respond .comment-form textarea::-ms-input-placeholder
    {
       color: $vmagazine_elements_content_colors;
    }";
    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_search form.search-form input.search-field::-moz-placeholder,
    .vmagazine-container #primary .comment-respond .comment-form textarea::-moz-placeholder
    {
       color: $vmagazine_elements_content_colors;
    }";
    
    
}

//element post meta colors
$vmagazine_elements_meta_colors = get_theme_mod('vmagazine_elements_meta_colors','#777777');
if( $vmagazine_elements_meta_colors != '#777777' ){
    $custom_css .="
    .post-meta,.vmagazine-block-post-car-small .post-content-wrapper .date,
    .vmagazine-rec-posts.recent-post-widget .recent-posts-content .recent-post-content span a,
    .vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption .post-meta,
    .vmagazine-container #primary .entry-meta,.search-content .search-content-wrap .cont-search-wrap .post-meta,
    .vmagazine-archive-layout4 .vmagazine-container #primary main.site-main article .archive-post .post-title-wrap .entry-meta,.posted-date
    {
        color: $vmagazine_elements_meta_colors;
    }";

    $custom_css .="
    .post-meta span:after,.vmagazine-cat-slider.block-post-wrapper.block_layout_1 .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption .post-meta span:after,
    .vmagazine-container #primary .entry-meta span:after{
        background: $vmagazine_elements_meta_colors;
    }";
}



//widgets border colors
$vmagazine_elements_border_colors = get_theme_mod('vmagazine_elements_border_colors','#fff');
if( $vmagazine_elements_border_colors != '#fff' ){
    $custom_css .="
    .vmagazine-container .vmagazine-sidebar .widget.widget_archive ul li, .widget.widget_categories ul li,
    .vmagazine-container .vmagazine-sidebar .widget.widget_nav_menu ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_rss ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_entries ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_recent_comments ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_meta ul li, .vmagazine-container .vmagazine-sidebar .widget.widget_pages ul li,
    .vmagazine-container .vmagazine-sidebar .widget.widget_text .textwidget form select,.widget .tagcloud a,
    .navigation .nav-links a,.vmagazine-container #primary .vmagazine-related-wrapper .single-post,
    .vmagazine-container #primary .comment-respond .comment-form,.ap-dropcaps.ap-square,
    .vmagazine-grid-list.grid-two .single-post,.vmagazine-mul-cat.block-post-wrapper.layout-two .block-content-wrapper .right-posts-wrapper .single-post,
    .vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .second-col-wrapper,.vmagazine-mul-cat-tabbed .block-content-wrapper .btm-posts-wrapper .single-post,.vmagazine-post-col.block_layout_1 .single-post .content-wrapper .small-font,.vmagazine-rec-posts.recent-post-widget .recent-posts-content,.vmagazine-featured-slider.featured-slider-wrapper .featured-posts li.f-slide,.block-post-wrapper.list .single-post,.block-post-wrapper.grid .posts-wrap .single-post,.widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper .single-post,.vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper,.vmagazine-mul-cat.layout-one .block-cat-content .right-posts-wrapper .single-post,
    .vmagazine-archive-layout2 .vmagazine-container main.site-main article .archive-post,
    .navigation.pagination .nav-links a.page-numbers,.navigation.pagination .nav-links .page-numbers.current
    {
        border-color: $vmagazine_elements_border_colors;
    }";
    
    $custom_css .="
    .vmagazine-container #primary .comment-respond .comment-form textarea
    {
       border: 1px solid {$vmagazine_elements_border_colors}; 
    }";

    $custom_css .="
    .vmagazine-timeline-post .timeline-post-wrapper .single-post:before{
        background: $vmagazine_elements_border_colors;
    }";

    $custom_css .="
    .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper:before{
        border-color: transparent {$vmagazine_elements_border_colors} transparent transparent;
    }";


}



/**
* Breadcrumbs colors
*/

//current page/post
$vmagazine_post_current_colors = get_theme_mod('vmagazine_post_current_colors','#e52d6d');
if( $vmagazine_post_current_colors != '#e52d6d' ){
    $custom_css .="
    .vmagazine-breadcrumb-wrapper .vmagazine-bread-home li.current
    {
        color: $vmagazine_post_current_colors;
    }";

}

//page/post color
$vmagazine_post_link_colors = get_theme_mod('vmagazine_post_link_colors','#000');
if( $vmagazine_post_link_colors != '#000' ){
    $custom_css .="
    .vmagazine-breadcrumb a,.vmagazine-breadcrumb-wrapper .vmagazine-bread-home li:after,
    .breadcrumb-title h1
    {
        color: $vmagazine_post_link_colors;
    }";
}


/**
* Widget title colors 
* @since 1.0.3
*/

//template five title bg color
$vmagazine_title_layout_five_title_bg_color = get_theme_mod('vmagazine_title_layout_five_title_bg_color','#e52d6d');
if( $vmagazine_title_layout_five_title_bg_color != '#e52d6d' ){
    $custom_css .="
    .template-five .widget-title span, .template-five .block-title span,
    .template-five .widget-title:before, .template-five .block-title:before,
    .template-four .widget-title span, .template-four .block-title span, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg, .template-four .comment-respond h4.comment-reply-title span, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span,
    .template-four .vmagazine-mul-cat-tabbed .block-header h4.block-title:before, .template-four .vmagazine-mul-cat.layout-one .block-header h4.block-title:before, .template-four .vmagazine-block-post-slider .block-header h4.block-title:before, .template-four .vmagazine-slider-tab-carousel .block-post-wrapper h4.block-title:before, .template-four .slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-header h4.block-title:before, .template-four .vmagazine-mul-cat.block-post-wrapper.layout-two .block-title::before,
    .template-three .widget-title span, .template-three .block-title span,.template-three .widget-title:before, .template-three .block-title:before
    {
        background: $vmagazine_title_layout_five_title_bg_color; 
    }";


    $custom_css .="
    .template-four .widget-title span:after, .template-four .block-title span:after, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg:after, .template-four .comment-respond h4.comment-reply-title span:after, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span:after
    {
            border-color: {$vmagazine_title_layout_five_title_bg_color} transparent transparent transparent;
    }";

    $custom_css .="
    .template-four .vmagazine-mul-cat-tabbed .block-header .multiple-child-cat-tabs .vmagazine-tabbed-links li.active a:before, .template-four .vmagazine-mul-cat.layout-one .block-header .child-cat-tabs .vmagazine-tab-links li.active a:before, .template-four .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li.active a:before, .template-four .vmagazine-slider-tab-carousel .slider-cat-tabs-carousel .slider-tab-links-carousel li.active a:before, .template-four .slider-tab-wrapper .block-post-wrapper.block_layout_1 .block-header .slider-cat-tabs ul.slider-tab-links li.active a:before, .template-four .vmagazine-mul-cat.block-post-wrapper.layout-two .block-header .child-cat-tabs .vmagazine-tab-links li.active a:before
    {
        border-color: transparent transparent {$vmagazine_title_layout_five_title_bg_color} transparent;
    }";

    $custom_css .="
    .template-three .widget-title span:after, .template-three .block-title span:after
    {
       border-color: transparent transparent transparent {$vmagazine_title_layout_five_title_bg_color}; 
    }";

}

$vmagazine_title_layout_one_title_bg_color = get_theme_mod('vmagazine_title_layout_one_title_bg_color','#e52d6d');
$widget_title_transparent_brder = vmagazine_hex2rgba( $vmagazine_title_layout_one_title_bg_color, 0.2 );
if( $vmagazine_title_layout_one_title_bg_color != '#e52d6d' ){
    $custom_css .="
    .template-two .widget-title:before, .template-two .block-title:before
    {
        background: $widget_title_transparent_brder;
    }";

    $custom_css .="
    .widget-title:after, .block-title:after{
        background: $vmagazine_title_layout_one_title_bg_color;
    }";
}


//widget title color
$vmagazine_widget_title_color = get_theme_mod('vmagazine_widget_title_color','#fff');
if( $vmagazine_widget_title_color != '#fff' ){
    $custom_css .="
    .template-five .widget-title span, .template-five .block-title span,
    .template-four .widget-title span, .template-four .block-title span, .template-four .vmagazine-container #primary .vmagazine-related-wrapper h4.related-title span.title-bg, .template-four .comment-respond h4.comment-reply-title span, .template-four .vmagazine-container #primary .post-review-wrapper h4.section-title span,.template-three .widget-title span, .template-three .block-title span,
    .template-two .widget-title, .template-two .block-title,.widget-title, .block-title
    {
        color: $vmagazine_widget_title_color;
    }";
}





    wp_add_inline_style( 'vmagazine-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'vmagazine_dynamic_css' );