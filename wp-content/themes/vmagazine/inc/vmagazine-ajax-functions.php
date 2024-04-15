<?php
/*
* The file contains Ajax functions required for the theme
* @package Vmagazine 
* @since 1.0.0
* @author AccessPress Themes
*/


/*===========================================================================================================*/
/**
* Child Category Posts Ajax Function
*
* vmagazine-multiple-category
*/
if ( ! function_exists( 'vmagazine_tabs_ajax_action' ) ) {
    function vmagazine_tabs_ajax_action() {
            $cat_id    = $_POST['category_id'];
            $cat_slug  = $_POST['category_slug'];
            $vmagazine_block_layout = $_POST['layout'];
            $post_limit = $_POST['limit'];
            $post_length = $_POST['plength'];
            $read_more = $_POST['readMore'];
            ob_start();
        ?>
        <div class="block-cat-content <?php echo esc_attr( $cat_slug ); ?>">
           <?php
                $block_args = array(
                            'category__in' => $cat_id,
                            'posts_per_page' => $post_limit
                            );
                $block_query = new WP_Query( $block_args );

                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ):
                    while( $block_query->have_posts() ):
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        if($vmagazine_block_layout=='block_layout_2'){
                            
                            $vmagazine_font_size = 'small-font';
                            if( $post_count < 3  ) {
                                $img_src = vmagazine_home_element_img('vmagazine-long-post-thumb');
                                echo '<div class="left-post-wrapper wow fadeInDown" data-wow-duration="0.7s">';
                            }elseif( $post_count >= 3 ){
                                $img_src = vmagazine_home_element_img('vmagazine-cat-post-sm');
                            }
                            if( $post_count == 3 ) {
                                $vmagazine_animate_class = 'fadeInUp';
                                echo '<div class="right-posts-wrapper wow fadeInUp" data-wow-duration="0.7s">';
                            }

                        }else{
                            if( $post_count == 1 ) {
                                $vmagazine_font_size = 'large-font';
                                $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                                echo '<div class="left-post-wrapper wow fadeInDown" data-wow-duration="0.7s">';
                            } elseif( $post_count == 2 ) {
                                $vmagazine_font_size = 'small-font';
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');
                                $vmagazine_animate_class = 'fadeInUp';
                                echo '<div class="right-posts-wrapper wow fadeInUp" data-wow-duration="0.7s">';
                            } else {
                                $vmagazine_font_size = 'small-font';
                                $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                            }
                        }
                    ?>
                        <div class="single-post clearfix">
                            <div class="post-thumb">
                                <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    <div class="image-overlay"></div>
                                </a>
                                
                            </div><!-- .post-thumb -->
                            <div class="post-caption-wrapper">
                                <div class="post-caption-inner">
                                    <div class="post-meta clearfix">
                                        <?php do_action( 'vmagazine_icon_meta' ); ?>
                                    </div>
                                    <h3 class="<?php echo esc_attr( $vmagazine_font_size ); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                             <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                                <?php if( ($vmagazine_block_layout=='block_layout_1') && ($post_count == 1) ){
                                    ?>
                                    <p> 
                                    <?php echo vmagazine_get_excerpt_content( absint($post_length) )?> 
                                    </p>
                                <?php } ?>

                            </div><!-- .post-caption-wrapper -->
                           
                        </div><!-- .single-post -->

                    <?php
                         if( ($vmagazine_block_layout=='block_layout_2') && ( $post_count < 3 ) ){
                            echo '</div>';
                        }elseif( $post_count == 1 || $post_count == $total_posts_count ) {
                            if( $post_count == $total_posts_count ){
                                if( $read_more ){
                                    $vmagazine_block_view_all_text = $read_more;
                                    vmagazine_block_view_all( $cat_id, $vmagazine_block_view_all_text );
                                }
                            }
                            echo '</div>';
                        }
                    endwhile;
                endif;
                wp_reset_query();
           ?>
        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo ''.$sv_html; //Escaping of all variables already done above
        die();
    }
}
add_action( 'wp_ajax_vmagazine_tabs_ajax_action', 'vmagazine_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_vmagazine_tabs_ajax_action', 'vmagazine_tabs_ajax_action' );





/*===========================================================================================================*/
/**
* Child Category Posts Ajax Function
*
* vmagazine-multiple-category-tabbed
*/
if ( ! function_exists( 'vmagazine_cat_tabbed_ajax_action' ) ) {
    function vmagazine_cat_tabbed_ajax_action() {
            $cat_id    = $_POST['category_id'];
            $cat_slug  = $_POST['category_slug'];
            $post_eserpt = $_POST['post_excerpt'];
            ob_start();
        ?>
        <div class="block-cat-content <?php echo esc_attr( $cat_slug ); ?>">
           <?php
                $block_args = array(
                            'category__in' => $cat_id,
                            'posts_per_page' => 7
                            );
                $block_query = new WP_Query( $block_args );

                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ):
                    while( $block_query->have_posts() ):
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        if( $post_count == 1 ) {
                                $vmagazine_font_size = 'large-font';
                                
                                $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                                echo '<div class="top-post-wrapper wow fadeInDown" data-wow-duration="0.7s">';
                            } elseif( $post_count == 2 ) {
                                $vmagazine_font_size = 'small-font';
                                
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');
                                $vmagazine_animate_class = 'fadeInUp';
                                echo '<div class="btm-posts-wrapper wow fadeInUp" data-wow-duration="0.7s">';
                                echo '<div class="first-col-wrapper">';
                            }
                            elseif( $post_count == 5 ){
                                echo '<div class="second-col-wrapper">';
                            } else {
                                $vmagazine_font_size = 'small-font';
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');
                            }
                        ?>
                        <div class="single-post clearfix">
                            <div class="post-thumb">
                                <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    <div class="image-overlay"></div>
                                </a>
                                <?php if( $post_count == 1 ) { do_action( 'vmagazine_post_format_icon' ); } ?>
                            </div><!-- .post-thumb -->
                            <div class="post-caption-wrapper">
                                <div class="post-meta clearfix">
                                    <?php do_action( 'vmagazine_icon_meta' ); ?>
                                </div>
                                <h3 class="<?php echo esc_attr( $vmagazine_font_size ); ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if( $post_count > 1 ){
                                            echo vmagazine_title_excerpt(45);
                                        }else{
                                            the_title();
                                        } ?>
                                    </a>
                                </h3>
                                <?php if( $post_count == 1 ){ ?>
                                    <p> 
                                    <?php echo vmagazine_get_excerpt_content(  absint($post_eserpt) )?> 
                                    </p>
                                <?php } ?>

                            </div><!-- .post-caption-wrapper -->
                           
                        </div><!-- .single-post -->

                    <?php
                        if( $post_count == 1 ) {
                            echo '</div>';
                        }
                        if( $post_count == 4 ){
                                echo '</div>';/** first-col-wrapper **/
                        }
                        elseif( $post_count == $total_posts_count ){
                             echo '</div>';/** second-col-wrapper **/
                            echo '</div>';
                        }
                    endwhile;
                endif;
                wp_reset_query();
           
        $vmagazine_block_view_all_text = 'View All';
          vmagazine_block_view_all( $cat_id, $vmagazine_block_view_all_text ); ?>
        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo ''.$sv_html; //Escaping of all variables already done above
        die();
    }
}
add_action( 'wp_ajax_vmagazine_cat_tabbed_ajax_action', 'vmagazine_cat_tabbed_ajax_action' );
add_action( 'wp_ajax_nopriv_vmagazine_cat_tabbed_ajax_action', 'vmagazine_cat_tabbed_ajax_action' );



/*===========================================================================================================*/
/**
* slider tab Ajax Function
* 
* Vmagazine-slider-tab
**/
if ( ! function_exists( 'vmagazine_slider_tab_action' ) ) {
    function vmagazine_slider_tab_action() {
            $cat_id    = $_POST['category_id'];
            $cat_slug  = $_POST['category_slug'];
            $post_perpage = $_POST['postper_page'];
            ob_start();
        ?>
        <div class="block-cat-content <?php echo esc_attr( $cat_slug ); ?>" data-slug="<?php echo esc_attr( $cat_slug ); ?>">
           <?php
                $block_args = array(
                            'category__in' => $cat_id,
                            'posts_per_page' => $post_perpage
                            );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    echo '<div class="tab-cat-slider">';
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $img_src = vmagazine_home_element_img('vmagazine-post-slider-lg');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="single-post">
                            <div class="post-thumb">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    <div class="image-overlay"></div>
                                <?php do_action( 'vmagazine_post_format_icon' ); ?>
                            </div>
                            <div class="post-caption">
                                <h3 class="large-font">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo vmagazine_title_excerpt(50); ?>
                                    </a>
                                </h3>
                            </div><!-- .post-caption -->
                        </div><!-- .single-post -->
                        <?php
                    }
                    echo '</div>';
                }                
                wp_reset_query();
           ?>
        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo ''.$sv_html; //Escaping of all variables already done above
        die();
    }
}
add_action( 'wp_ajax_vmagazine_slider_tab_action', 'vmagazine_slider_tab_action' );
add_action( 'wp_ajax_nopriv_vmagazine_slider_tab_action', 'vmagazine_slider_tab_action' );


/*===========================================================================================================*/
/**
* slider tab Ajax Function
* 
* Vmagazine-slider-tab-carousel
**/
if ( ! function_exists( 'vmagazine_slider_tab_carousel_action' ) ) {
    function vmagazine_slider_tab_carousel_action() {
            $cat_id    = $_POST['category_id'];
            $cat_slug  = $_POST['category_slug'];
            $post_perpage = $_POST['postper_page'];
            ob_start();
        ?>
        <div class="block-cat-content-carousel <?php echo esc_attr( $cat_slug ); ?>" data-slug="<?php echo esc_attr( $cat_slug ); ?>">
           <?php
                $block_args = array(
                            'category__in' => $cat_id,
                            'posts_per_page' => $post_perpage
                            );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    echo '<div class="tab-cat-slider-carousel">';
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $img_src = vmagazine_home_element_img('vmagazine-post-slider-lg');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="single-post clearfix">
                            <div class="post-thumb">
                                <a href="javascript:void(0)" class="thumb-zoom">
                                    <img src="<?php echo esc_url($img_src) ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <div class="image-overlay"></div>
                                </a>
                                <?php do_action( 'vmagazine_post_format_icon' ); ?>
                            </div>
                            <div class="post-caption">
                                <h3 class="large-font">
                                    <a href="<?php the_permalink(); ?>">
                                       <?php echo vmagazine_title_excerpt(60); ?>
                                    </a>
                                </h3>
                            </div><!-- .post-caption -->
                        </div><!-- .single-post -->
                        <?php
                    }
                    echo '</div>';
                }                
                wp_reset_query();
           ?>
        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo ''.$sv_html; //Escaping of all variables already done above
        die();
    }
}
add_action( 'wp_ajax_vmagazine_slider_tab_carousel_action', 'vmagazine_slider_tab_carousel_action' );
add_action( 'wp_ajax_nopriv_vmagazine_slider_tab_carousel_action', 'vmagazine_slider_tab_carousel_action' );


/*===========================================================================================================*/
/**
* slider tab Ajax Function
* 
* Vmagazine-block-post-slider
**/
if ( ! function_exists( 'vmagazine_block_post_slider_action' ) ) {
    function vmagazine_block_post_slider_action() {
            $cat_id    = $_POST['category_id'];
            $cat_slug  = $_POST['category_slug'];
            $post_perpage = $_POST['postper_page'];
            ob_start();
        ?>
        <div class="block-cat-content <?php echo esc_attr( $cat_slug ); ?>" data-slug="<?php echo esc_attr( $cat_slug ); ?>">
           <?php
                $block_args = array(
                            'category__in' => $cat_id,
                            'posts_per_page' => $post_perpage
                            );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                if( $block_query->have_posts() ) {
                    echo '<div class="block-post-slider-wrapper">';
                     $total_posts_count = $block_query->post_count;
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); 
                        $big_image_path = vmagazine_home_element_img('vmagazine-post-slider-lg');
                        $sm_image_path = vmagazine_home_element_img('vmagazine-slider-thumb');
                          if( $post_count == 1 ) { ?>
                            <div class="slider-item-wrapper">
                                    <div class="slider-bigthumb">
                                            <div class="slider-img">
                                                <img src="<?php echo esc_url($big_image_path) ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                            </div>
                                            <div class="post-captions">
                                                <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
                                                <div class="post-meta clearfix">
                                                    <?php do_action( 'vmagazine_icon_meta' ); ?>
                                                </div>
                                                <h3 class="large-font">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo vmagazine_title_excerpt(45); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                    </div>
                                <?php 
                            }elseif( $post_count <= 5 ){

                             if( $post_count == 2 ){ ?>
                                    <div class="small-thumbs-wrapper">
                                        <div class="small-thumbs-inner"> 
                             <?php } ?>
                               <div class="slider-smallthumb">
                                    <div class="slider-img">
                                        <img src="<?php echo esc_url($sm_image_path) ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    </div>
                                    <div class="post-captions">
                                        <div class="post-meta clearfix">
                                            <?php do_action( 'vmagazine_icon_meta' ); ?>
                                        </div>
                                        <h3 class="large-font">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo vmagazine_title_excerpt(45); ?>
                                            </a>
                                        </h3>
                                    </div>
                               </div>
                            
                          <?php  }
                           if( $post_count == 5 || $total_posts_count == $post_count ){ ?>
                            </div>
                            </div><!-- .small-thumbs-inner -->
                            </div><!-- .small-thumbs-wrapper -->
                        <?php 
                          }
                          if( $post_count == 5 ){
                            $post_count = 0;
                          } 
                    }
                    echo '</div>';
                }                
                wp_reset_query();
           ?>
        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo ''.$sv_html; //Escaping of all variables already done above
        die();
    }
}
add_action( 'wp_ajax_vmagazine_block_post_slider_action', 'vmagazine_block_post_slider_action' );
add_action( 'wp_ajax_nopriv_vmagazine_block_post_slider_action', 'vmagazine_block_post_slider_action' );



/*=============================================================================================

* Latest article load ajax function
*
*
*/
if(!function_exists('ajax_load_more')){
    function ajax_load_more(){

        if($_POST['paged']){
            $type = $_POST['type'];
            $cat_id = $_POST['id'];
            ob_start();
            $post_per_page = 5;
            if( $type=='category_posts' && !empty($type) ){
                $bog_content_args = array(  
                    'post_type' => 'post',
                       'posts_per_page' =>$post_per_page,
                       'category__in'=>$cat_id,
                       'offset'=>$_POST['banner_offset'],
                       'post_status' => 'publish',
                       'order' => 'DESC',
                       'paged' => $_POST['paged']
                );
            }else{
               $bog_content_args = array(  'post_type' => 'post',
                   'posts_per_page' =>$post_per_page,
                   'offset'=>$_POST['banner_offset'],
                   'post_status' => 'publish',
                   'order' => 'DESC',
                   'paged' => $_POST['paged']

                   );    
            }

           $bog_content_query = new WP_Query($bog_content_args);

           if($bog_content_query->have_posts()){
               
                $ret_html="";
                while($bog_content_query->have_posts()){               
                    $bog_content_query->the_post();
                    $image_id = get_post_thumbnail_id();
                    $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );                   
                    ?>
                    <div class="single-post clearfix wow fadeInUp" data-wow-duration="0.7s">
                        <div class="post-thumb">
                            <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($image_alt); ?>" title="<?php the_title(); ?>" />
                                <div class="image-overlay"></div>
                            </a>
                        </div><!-- .post-thumb -->
                        <div class="post-content-wrapper clearfix">
                            <div class="post-meta clearfix">
                                <?php  do_action( 'vmagazine_icon_meta' ); ?>
                            </div><!-- .post-meta --> 
                            <h3 class="large-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div><!-- .post-content-wrapper -->
                    </div><!-- .single-post  -->
                <?php
                }

                $ret_html = ob_get_contents();
                ob_get_clean();

                if( $bog_content_query->post_count < $post_per_page ) {
                    $paged = 0;
                }else {
                    $paged = $_POST['paged']+1;
                }
                echo  json_encode( array(
                    "message1" => $ret_html,
                   "message2" => $paged,
                   "message3"=>$bog_content_query->post_count));
            }else {
                die('outside');
               echo  json_encode( array(
                   "message2" => 0,
                   ));
        }} wp_reset_query();
        die();
    }
}
add_action('wp_ajax_ajax_load_more','ajax_load_more');
add_action( 'wp_ajax_nopriv_ajax_load_more', 'ajax_load_more' );


/*=============================================================================================

*   Grid/List ajax load function
*
*
*/
if(!function_exists('grid_list_ajax_load')){
    function grid_list_ajax_load(){

        if($_POST['paged']){
            $post_type = $_POST['post_type'];
            $cat_id = $_POST['id'];
            $vmagazine_block_layout = $_POST['layout'];
            $post_per_page = $_POST['postper_page'];
            $postsLength = $_POST['pLength'];
            ob_start();
            if($post_type=='category_posts' && !empty($post_type)){
                $block_content_args = array(  
                       'post_type' => 'post',
                       'posts_per_page' =>$post_per_page,
                       'category__in'=>$cat_id,
                       'offset'=>$_POST['banner_offset'],
                       'post_status' => 'publish',
                       'order' => 'DESC',
                       'paged' => $_POST['paged']
                );
            }else{
               $block_content_args = array(  
                   'post_type' => 'post',
                   'posts_per_page' =>$post_per_page,
                   'offset'=>$_POST['banner_offset'],
                   'post_status' => 'publish',
                   'order' => 'DESC',
                   'paged' => $_POST['paged']

                   );    
            }
          
           $block_content_query = new WP_Query($block_content_args);
           
           if($block_content_query->have_posts()){
                while( $block_content_query->have_posts() ) {
                    $block_content_query->the_post();
                     $image_id = get_post_thumbnail_id();
                    if($vmagazine_block_layout=='grid'){
                        $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                    }elseif($vmagazine_block_layout=='list'){
                        $img_src = vmagazine_home_element_img('vmagazine-post-slider-lg');
                    }else{
                        $img_src = vmagazine_home_element_img('full');
                   }
                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                    <div class="single-post clearfix wow fadeInUp" data-wow-duration="0.7s">
                        <div class="post-thumb">
                            <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                <div class="image-overlay"></div>
                            </a>
                            <?php  
                                if($vmagazine_block_layout == 'list' ){
                                    do_action( 'vmagazine_post_cat_or_tag_lists' );
                                 } ?>
                        </div><!-- .post-thumb -->
                        <div class="post-content-wrapper clearfix">
                            <div class="post-meta clearfix">
                                 <?php do_action( 'vmagazine_icon_meta' ); ?>
                            </div><!-- .post-meta -->                                
                            <h3 class="large-font">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php if( ($vmagazine_block_layout=='list') || ($vmagazine_block_layout=='grid-two') ) : ?>
                                <div class="post-content">
                                   
                                   <p> <?php echo vmagazine_get_excerpt_content( absint($postsLength) );?> 
                                   </p>
                                </div><!-- .post-content --> 
                            <?php endif;?>
                        </div><!-- .post-content-wrapper -->
                    </div><!-- .single-post  -->
                    <?php
                }
                $ret_html = ob_get_contents();
                ob_get_clean();

                if( $block_content_query->post_count < $post_per_page ) {
                    $paged = 0;
                }else {
                    $paged = intval($_POST['paged'])+1;
                }
                echo  json_encode( array(
                   "message1" => $ret_html,
                   "message2" => $paged,
                   "message3"=>$block_content_query->post_count));
            }else {
                die('outside');
               echo  json_encode( array(
                   "message2" => 0,
                   ));
        }
    } wp_reset_query();
        die();
}
}
add_action('wp_ajax_grid_list_ajax_load','grid_list_ajax_load');
add_action( 'wp_ajax_nopriv_grid_list_ajax_load', 'grid_list_ajax_load' );

/*===========================================================================================================*/

/**
* Ajax Search function
*
*/
function search_function(){

    $key = $_POST['key'];
    ob_start();
    $args = array(
            'posts_per_page'    => 3,
            's'                 => $key,
            'post_type'         => 'post',
            'post_status' => 'publish',
            'orderby'     => 'title', 
            'order'       => 'ASC' 
    );
            
    $the_query = new WP_Query( $args);
    ?>
      <div class="search-res-wrap">   
        <?php
        if( $the_query->have_posts() ){
            
            while( $the_query->have_posts() ): $the_query->the_post(); 

                ?>
                
                    <div class="search-content-wrap">
                        <?php if( has_post_thumbnail() ){
                             $has_img = '';
                         ?>
                            <div class="img-wrap">
                                <a href="<?php the_permalink()?>">
                                <?php the_post_thumbnail(); ?>    
                                </a>
                            </div>
                        <?php }else{
                                $has_img = 'no-image';
                        } ?>
                        <div class="cont-search-wrap <?php echo esc_attr($has_img);?>">
                            <div class="title">
                                <a href="<?php the_permalink()?>">
                                    <?php
                                    $vmagazine_header_layout = get_theme_mod('vmagazine_header_layout','header_layout_1');
                                    if( $vmagazine_header_layout == 'header_layout_2' || $vmagazine_header_layout == 'header_layout_4' ){
                                        the_title();
                                    }else{
                                     echo vmagazine_title_excerpt(25);   
                                    }
                                     ?>
                                </a>
                            </div>
                            <div class="post-meta clearfix">
                                <?php  do_action( 'vmagazine_icon_meta' ); ?>
                            </div><!-- .post-meta --> 
                        </div>
                    </div>
                    <div class="ajax-search-view-all">
                        <a href="<?php echo esc_url( home_url( '/' ).'?s='.$key ); ?>"><?php esc_html_e('View All','vmagazine') ?></a>
                    </div>
                
                <?php
                endwhile;
                }else{ ?>
                    <div class="no-match">
                        <?php esc_html_e('No Match Found','vmagazine'); ?>
                    </div>
                <?php 
                }
                wp_reset_query(); ?>
        </div>
    <?php             
    $sv_html = ob_get_contents();
    ob_get_clean();
    echo ''.$sv_html; //Escaping of all variables already done above
    die();
}
add_action('wp_ajax_search_function','search_function');
add_action( 'wp_ajax_nopriv_search_function', 'search_function' );