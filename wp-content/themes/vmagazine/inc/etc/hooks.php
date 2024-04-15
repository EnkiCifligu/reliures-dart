<?php
/**
 * Define function under assign hook
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

/*===========================================================================================================*/
/**
 * Function to display different layout of header
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_mobile_header_navigation', 'vmagazine_skip_links', 0 );
add_action( 'vmagazine_header_section', 'vmagazine_header_section_hook', 10 );

if ( ! function_exists( 'vmagazine_skip_links' ) ) {
    /**
     * Skip links
     * @since  1.0.0
     * @return void
     */
    function vmagazine_skip_links() {
        ?>
            <a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to navigation', 'vmagazine' ); ?></a>
            <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'vmagazine' ); ?></a>
        <?php
    }
}

if( ! function_exists('vmagazine_header_section_hook') ):
    function vmagazine_header_section_hook() { 
        $vmagazine_header_layout = get_theme_mod( 'vmagazine_header_layout', 'header_layout_1' );
        switch ( $vmagazine_header_layout ) {

            case 'header_layout_4':
                get_template_part( 'layouts/header/header', 'layout4' );
                break;

            case 'header_layout_3':
                get_template_part( 'layouts/header/header', 'layout3' );
                break;

            case 'header_layout_2':
                get_template_part( 'layouts/header/header', 'layout2' );
                break;

            case 'header_layout_1':
                get_template_part( 'layouts/header/header', 'layout1' );
                break;
            
            default:
                get_template_part( 'layouts/header/header', 'layout1' );
                break;
        }
    }
endif;


/**
 * Footer action Area
**/
 
/**
* Footer
*
* @see  vmagazine_footer_widgets()
* @see  vmagazine_button_footer()
*/
add_action( 'vmagazine_footer', 'vmagazine_footer_widgets', 0 );
add_action( 'vmagazine_footer', 'vmagazine_button_footer', 10 );



function vmagazine_button_footer(){
    $vmagazine_footer_layout = get_theme_mod( 'vmagazine_footer_layout', 'footer_layout_1' );
    switch ( $vmagazine_footer_layout ) {

        case 'footer_layout_2':
            get_template_part( 'layouts/footer/footer', 'layout2' );
            break;

        case 'footer_layout_1':
            get_template_part( 'layouts/footer/footer', 'layout1' );
            break;
        
        default:
            get_template_part( 'layouts/footer/footer', 'layout1' );
            break;
    }    
}


/*===========================================================================================================*/
/**
 * Function to display current date at top header
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_header_date', 'vmagazine_header_date_hook' );

if( ! function_exists( 'vmagazine_header_date_hook' ) ):
    function vmagazine_header_date_hook() {
        $vmagazine_date_option = get_theme_mod( 'vmagazine_header_date_option', 'show' );
        if( $vmagazine_date_option != 'hide' ) {
?>
            <div class="vmagazine-current-date"><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></div>
<?php
        }
    }
endif;
/*===========================================================================================================*/
/**
 * Related posts section
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_related_posts', 'vmagazine_related_posts_hook' );

if( !function_exists( 'vmagazine_related_posts_hook' ) ):
    function vmagazine_related_posts_hook() {
        $vmagazine_related_posts_option = get_theme_mod( 'vmagazine_related_posts_option', 'hide' );
        $vmagazine_related_post_title = get_theme_mod( 'vmagazine_related_posts_title', esc_html__( 'Related Articles', 'vmagazine' ) );
        if( $vmagazine_related_posts_option == 'hide' ) 
            return;

                wp_reset_postdata();
                global $post;
                if( empty( $post ) ) {
                    $post_id = '';
                } else {
                    $post_id = $post->ID;
                }

                $vmagazine_related_posts_type = get_theme_mod( 'vmagazine_related_post_type', 'related_cat' );
                
                $vmagazine_related_post_count = get_theme_mod('vmagazine_related_post_count',3);
                $vmagazine_related_post_excerpt = get_theme_mod('vmagazine_related_post_excerpt',200);
                // Define related post arguments
                $related_args = array(
                    'no_found_rows'            => true,
                    'update_post_meta_cache'   => false,
                    'update_post_term_cache'   => false,
                    'ignore_sticky_posts'      => 1,
                    'orderby'                  => 'rand',
                    'post__not_in'             => array( $post_id ),
                    'posts_per_page'           => absint($vmagazine_related_post_count)
                );

                
                if ( $vmagazine_related_posts_type == 'related_tag' ) {
                    $tags = wp_get_post_tags( $post_id );
                    if ( $tags ) {
                        $tag_ids = array();
                        foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
                        $related_args['tag__in'] = $tag_ids;
                    }
                } else {
                    $categories = get_the_category( $post_id );
                    if ( $categories ) {
                        $category_ids = array();
                        foreach( $categories as $individual_category ) {
                            $category_ids[] = $individual_category->term_id;
                        }
                        $related_args['category__in'] = $category_ids;
                    }
                }

                $related_query = new WP_Query( $related_args );
                if( $related_query->have_posts() ) {
                    ?>
                    <div class="vmagazine-related-wrapper">
                <h4 class="related-title">
                    <span class="title-bg"><?php echo esc_attr( $vmagazine_related_post_title ); ?></span>
                </h4>
                <?php
                    echo '<div class="related-posts-wrapper clearfix">';
                    while( $related_query->have_posts() ) {
                        $related_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'vmagazine-rectangle-thumb', true );
                        $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                        <div class="single-post">
                            <?php if( $img_src ): ?>
                            <div class="post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                </a>
                                <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
                            </div>
                            <?php endif; ?>
                            <div class="related-content-wrapper">
                                <?php 
                                $vmagazine_single_posts_layout = get_theme_mod('vmagazine_single_posts_layout','post_layout1');
                                if( $vmagazine_single_posts_layout =='post_layout1' ){ ?>
                                <div class="post-meta"><?php do_action( 'vmagazine_icon_meta' ); ?></div>
                                 <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-contents">
                                    <?php echo vmagazine_get_excerpt_content( absint($vmagazine_related_post_excerpt) )?> 
                                </div>   
                                <?php }else{ ?>
                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta"><?php do_action( 'vmagazine_icon_meta' ); ?></div>
                                <?php } 
                                $vmagazine_single_posts_layout = get_theme_mod('vmagazine_single_posts_layout','post_layout1');
                                if( $vmagazine_single_posts_layout =='post_layout1' ){ 
                                ?>
                                <a href="<?php the_permalink() ?>" class="vmagazine-related-more">
                                    <?php echo esc_html__('Read More','vmagazine');?>
                                </a>
                                <?php } ?>
                            </div>
                            
                        </div><!--. single-post -->
                <?php
                    }
                     wp_reset_query();
                    echo '</div>';
                    ?>
                    </div><!-- .vmagazine-related-wrapper -->
                <?php 
                }
               
        ?>
           
<?php
    }
endif;
/*===========================================================================================================*/
/**
 * Get author info
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_author_info', 'vmagazine_author_info_hook' );

if( ! function_exists( 'vmagazine_author_info_hook' ) ):
    function vmagazine_author_info_hook() {
        global $post;
        $author_id = $post->post_author;
        $author_avatar = get_avatar( $author_id, '132' );
        $author_nickname = get_the_author_meta( 'display_name' );
        $author_extra_img_url = get_the_author_meta( 'user_meta_image', $post->post_author );
        $vmagazine_author_option = get_theme_mod( 'vmagazine_author_info_option', 'hide' );
        $vmagazine_author_location = get_the_author_meta( 'user_location' );
        if( $vmagazine_author_option != 'hide' ) {
?>
            <div class="vmagazine-author-metabox clearfix">
                <h4 class="box-title">
                    <span class="title-bg">
                        <?php esc_html_e('About Author','vmagazine'); ?>    
                    </span>
                </h4>
                <div class="vmag-author-wrapper">
                <div class="author-avatar">
                    <a class="author-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
                        <?php 
                            if( !empty( $author_extra_img_url ) ) {
                                $author_img_id = vmagazine_get_attachment_id_from_url( $author_extra_img_url );
                                $author_thumb_img = wp_get_attachment_image_src( $author_img_id, 'thumbnail', true ); ?>
                                <img src="<?php echo esc_url( $author_thumb_img[0] )?>" alt="<?php the_title_attribute()?>"/>
                            <?php 
                            } else {
                                echo wp_kses_post($author_avatar);
                            }
                        ?>
                    </a>
                </div><!-- .author-avatar -->
                <div class="author-desc-wrapper"> 
                <div class="author-desc-inner">
                    <div class="author-desc-first-wrapper">
                        <a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo esc_html( $author_nickname ); ?></a>
                        <span class="author-location"><?php echo esc_attr($vmagazine_author_location);?></span>
                    </div>
                    <?php 
                    $vmagazine_single_posts_layout = get_theme_mod('vmagazine_single_posts_layout','post_layout1');
                    if( $vmagazine_single_posts_layout == 'post_layout1'):
                     ?>
                    <div class="author-social">
                        <?php 
                            global $vmagazine_user_social_array;
                            foreach( $vmagazine_user_social_array as $icon_id => $icon_name ) {
                                $author_social_link = get_the_author_meta( $icon_id );
                                if( !empty( $author_social_link ) ) {
                        ?>
                                    <span class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></span>
                        <?php            
                                }
                            }
                        ?>
                    </div><!-- .author-social -->
                    <?php endif; ?>
                </div>   
                    <div class="author-description"><?php echo get_the_author_meta( 'description' ); ?></div>
                    <?php
                    if( $vmagazine_single_posts_layout == 'post_layout2'):
                     ?>
                    <div class="author-social">
                        <?php 
                            global $vmagazine_user_social_array;
                            foreach( $vmagazine_user_social_array as $icon_id => $icon_name ) {
                                $author_social_link = get_the_author_meta( $icon_id );
                                if( !empty( $author_social_link ) ) {
                        ?>
                                    <span class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></span>
                        <?php            
                                }
                            }
                        ?>
                    </div><!-- .author-social -->
                    <?php endif; ?>

                </div><!-- .author-desc-wrapper-->
                </div>
            </div><!--vmagazine-author-metabox-->
<?php
        }
    }
endif;
/*===========================================================================================================*/
/**
 * Get random icon at primary menu
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_menu_random_icon', 'vmagazine_menu_random_icon_hook' );

if( ! function_exists( 'vmagazine_menu_random_icon_hook' ) ):
    function vmagazine_menu_random_icon_hook() {
        $vmagazine_random_icon = get_theme_mod( 'vmagazine_menu_random_option', 'show' );
        $vmagazine_random_icon_class = get_theme_mod( 'vmagazine_random_post_icon', 'fa-random' );
        if( $vmagazine_random_icon != 'hide' ) {
            $vmagazine_random_post_args = array( 
                        'posts_per_page'        => 1,
                        'post_type'             => 'post',
                        'ignore_sticky_posts'   => true,
                        'orderby'               => 'rand'
                    );
            $vmagazine_random_post_query = new WP_Query( $vmagazine_random_post_args );
            while( $vmagazine_random_post_query->have_posts() ) {
                $vmagazine_random_post_query->the_post();
    ?>
                <a href="<?php the_permalink(); ?>" class="icon-random" title="<?php esc_html_e( 'View a random post', 'vmagazine' ); ?>">
                    <i class="fa <?php echo esc_attr( $vmagazine_random_icon_class ); ?>"></i>
                </a>
    <?php
            }
            wp_reset_query();
        }
    }
endif;
/*===========================================================================================================*/
/**
 * Post Review on widget's posts
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_widget_post_review', 'vmagazine_widget_post_review_cb', 10 );

if( ! function_exists( 'vmagazine_widget_post_review_cb' ) ):
    function vmagazine_widget_post_review_cb() {
        
        
            global $post; 
            $post_review_type = get_post_meta( $post->ID, 'post_review_option', true );
            switch ( $post_review_type ){
                case 'star_review':
                    $post_meta_name = 'star_rating';
                    $post_meta_value = 'feature_star';
                    break;
                case 'percent_review':
                    $post_meta_name = 'percent_rating';
                    $post_meta_value = 'feature_percent';
                    break;
                case 'point_review':
                    $post_meta_name = 'points_rating';
                    $post_meta_value = 'feature_points';
                    break;
                default:
                    $post_meta_name = 'star_rating';
                    $post_meta_value = 'feature_star';
            }
            if( $post_review_type != 'no_review' && !empty( $post_review_type ) ){
                $product_rating = get_post_meta( $post->ID, $post_meta_name, true );
                $count = count($product_rating);
                $total_review = 0;
                foreach ( $product_rating as $key => $value ) {
                    $rate_value = $value[ $post_meta_value ];
                    $total_review = $total_review+$rate_value;
                }
                if( $post_meta_name == 'star_rating' ){
                    $total_review = $total_review/$count;
                    $final_value = round( $total_review, 1);
                    echo '<div class="star-review-wrapper">';
                    vmagazine_display_post_rating( $final_value );
                    echo '<span class="total-value">'. $final_value .'</span>';
                    echo '</div>';
                } elseif( $post_meta_name == 'percent_rating' ){
                    $total_review = $total_review/$count/10/2;
                    $final_value = round( $total_review, 1);
                    echo '<div class="star-review-wrapper">';
                    vmagazine_display_post_rating( $final_value );
                    echo '<span class="total-value">'. $final_value .'</span>';
                    echo '</div>';
                } elseif( $post_meta_name == 'points_rating' ){
                    $total_review = $total_review/$count/2;
                    $final_value = round( $total_review, 1);
                    echo '<div class="star-review-wrapper">';
                    vmagazine_display_post_rating( $final_value );
                    echo '<span class="total-value">'. $final_value .'</span>';
                    echo '</div>';
                }
            }
        
    }
endif;
/*===========================================================================================================*/
/**
 * Post review for single post
 *
 * @since 1.0.0
 */

add_action( 'vmagazine_single_post_review', 'vmagazine_single_post_review_cb', 10 );

if( ! function_exists( 'vmagazine_single_post_review_cb' ) ):
function vmagazine_single_post_review_cb(){
    $single_post_review_option = get_theme_mod( 'vmagazine_post_review_option', 'show' );
    if( $single_post_review_option == 'hide' ) {
        return;
    }
    global $post;
    $review_sec_title = get_theme_mod( 'vmagazine_review_sec_title', esc_html__( 'Review Overview', 'vmagazine' ) );
    $review_summary_title = get_theme_mod( 'vmagazine_review_summary_title', esc_html__( 'Review Summary Title', 'vmagazine' ) );

    $post_review_type = get_post_meta( $post->ID, 'post_review_option', true );
    $post_review_description = get_post_meta($post->ID, 'post_review_description', true);
    
    if( $post_review_type != 'no_review' && $post_review_type == 'star_review' ){
        $star_rating = get_post_meta( $post->ID, 'star_rating', true );
        if( !empty ( $star_rating ) ){
            $count = count( $star_rating );
            $total_review = 0;
            foreach ( $star_rating as $key => $value ) {
                $star_value = $value['feature_star'];
                if( empty( $star_value ) ) {
                    $star_value = '0.5';
                }
                $total_review = $total_review+$star_value;
            }
            $total_review = $total_review/$count;
            $final_value = round( $total_review, 1 );
    ?>
        <div class="post-review-wrapper">
            <h4 class="section-title">
                <span class="title-bg">
                <?php echo esc_html( $review_sec_title ) ;?>
                </span>
                </h4>
            <div class="review-inner-wrap">
            <div class="summary-wrapper clearfix">
                <div class="total-reivew-wrapper star-wrap">
                    <span class="total-value"><?php echo esc_html( $final_value ) ;?></span>
                    <span class="stars-count"><?php vmagazine_display_post_rating( $total_review );?></span>
                </div>
                <div class="summary-details">
                    <span class="summery-label"><?php echo esc_html( $review_summary_title ) ;?></span>
                    <span class="summary-comments"><?php echo wp_kses_post( $post_review_description ); ?></span>
                </div>
                
            </div><!-- .summary-wrapper -->
            <div class="stars-review-wrapper">
                <?php                     
                    foreach ( $star_rating as $key => $value ) {
                        $featured_name = $value['feature_name'];
                        $single_star_value = $value['feature_star'];                        
                ?>
                    <div class="review-featured-wrap clearfix">  
                        <span class="review-featured-name"><?php echo esc_html( $featured_name ); ?></span>
                        <span class="stars-count"><?php vmagazine_display_post_rating( $single_star_value );?></span>
                    </div>
                <?php
                    }
                    
                ?>
            </div><!-- .stars-review-wrapper -->
            </div>
        </div><!-- .post-review-wrapper -->
    <?php
        }
    }
    elseif( $post_review_type != 'no_review' && $post_review_type == 'percent_review' ) {
        $percent_rating = get_post_meta( $post->ID, 'percent_rating', true );
        if( !empty ( $percent_rating ) ){
            $count = count( $percent_rating );
            $total_review = 0;
            foreach ( $percent_rating as $key => $value ) {
                $percent_value = $value['feature_percent'];
                if( empty( $percent_value ) ) {
                    $percent_value = '1';
                }
                $total_review = $total_review+$percent_value;
            }
            $total_review = $total_review/$count; 
            $total_review = round( $total_review, 1 );
            $total_percent_star = $total_review/20;

   ?>
        <div class="post-review-wrapper">
            <span class="section-title"><?php echo esc_html( $review_sec_title ) ;?></span>
            <div class="review-inner-wrap">
                
                <div class="summary-wrapper clearfix">
                    <div class="total-reivew-wrapper percent-wrap">
                        <span class="total-value"><?php echo esc_html( $total_review ) ;?> <span class="tt-per"> &#37;</span> </span>
                        <span class="stars-count"><?php vmagazine_display_post_rating( $total_percent_star );?></span>
                    </div>
                    <div class="summary-details">
                        <span class="summery-label"><?php echo esc_html( $review_summary_title ) ;?></span>
                        <span class="summary-comments"><?php echo wp_kses_post( $post_review_description ); ?></span>
                    </div>
                </div><!-- .summary-wrapper -->
                <div class="percent-review-wrapper">
                    <?php
                        foreach ( $percent_rating as $key => $value ) {
                            $featured_name = $value['feature_name'];
                            $single_percent_value = $value['feature_percent'];
                    ?>
                    <div class="percent-wrap clearfix">  
                        <span class="featured-name"><?php echo esc_html( $featured_name ); ?></span> - <span class="percent-value"><?php echo esc_attr( $single_percent_value );?> &#37; </span>
                        <div class="percent-rating-bar-wrap"><div style="width:<?php echo esc_attr( $single_percent_value )?>%"></div></div>
                    </div><!-- .percent-wrap -->
                    <?php 
                        }                     
                    ?>
                </div><!-- .percent-review-wrapper -->
            </div>            
        </div><!-- .post-review-wrapper -->
   <?php    
        }
    }
    elseif( $post_review_type !='no_review' && $post_review_type == 'point_review' ) {
        $points_rating = get_post_meta( $post->ID, 'points_rating', true );
        if( !empty ( $points_rating ) ){
            $count = count( $points_rating );
            $total_review = 0;
            
            foreach ( $points_rating as $key => $value ) {
                $points_value = empty($value['feature_points']) ? '' : $value['feature_points'];
                if( empty( $points_value ) ) {
                    $points_value = '0.1';
                }
                $total_review = $total_review+$points_value;
                $points_bar = $points_value * 10;
            }
            $total_review = $total_review/$count;
            $total_review = round( $total_review, 1 );
            $total_point_star = $total_review/2;
   ?>
        <div class="post-review-wrapper">
            <span class="section-title"><?php echo esc_html( $review_sec_title ) ;?></span>
            <div class="review-inner-wrap">
            <div class="summary-wrapper clearfix">
                <div class="total-reivew-wrapper point-wrap">
                    <span class="total-value"><?php echo esc_html( $total_review ); ?></span>
                    <span class="stars-count"><?php vmagazine_display_post_rating( $total_point_star );?></span>
                </div>
                <div class="summary-details">
                    <span class="summery-label"><?php echo esc_html( $review_summary_title ); ?></span>
                    <span class="summary-comments"><?php echo wp_kses_post( $post_review_description ); ?></span>
                </div>
                
            </div><!-- .summary-wrapper -->
            <div class="points-review-wrapper">
                <?php
                    foreach ( $points_rating as $key => $value ) {
                    $featured_name = $value['feature_name'];
                    $single_points_value = empty($value['feature_points']) ? '' : $value['feature_points'];
                ?>
                <div class="percent-wrap clearfix">  
                    <span class="featured-name"><?php echo esc_html( $featured_name ); ?></span> - <span class="percent-value"><?php echo esc_html( $single_points_value );?></span>
                    <div class="percent-rating-bar-wrap"><div style="width:<?php echo esc_attr( $single_points_value*10 ); ?>%"></div></div>
                </div><!-- .percent-wrap -->
                <?php 
                    }
                ?>
            </div><!-- .points-review-wrapper -->   
            </div>         
        </div><!-- .post-review-wrapper -->
   <?php    
        }
    }
}
endif;
/*===========================================================================================================*/
/**
 * Function to display post categories or tags lists
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_post_cat_or_tag_lists', 'vmagazine_post_cat_or_tag_lists_cb' );
if( ! function_exists( 'vmagazine_post_cat_or_tag_lists_cb' ) ) :
    function vmagazine_post_cat_or_tag_lists_cb() {

       

        if ( 'post' === get_post_type() ) {
            
                global $post;
                $categories = get_the_category();
                $separator = ' ';
                $output = '';
                if( $categories ) {
                    $output .= '<span class="cat-links">';
                    foreach( $categories as $category ) {
                        $output .= '<a href="'.get_category_link( $category->term_id ).'" class="cat-' . $category->term_id . '" rel="category tag">'.$category->cat_name.'</a>';                   
                    }
                    $output .='</span>';
                    echo trim( $output, $separator );
                }
        }
    }
endif;
/*===========================================================================================================*/
/**
* Display single category name only
*
*/
add_action('vmagazine_single_cat','vmagazine_single_cat');
if( ! function_exists('vmagazine_single_cat') ){
    function vmagazine_single_cat(){
        $categories = get_the_category();
        $cat_link = get_category_link( $categories[0]->term_id );
        if ( ! empty( $categories ) ) {
        echo '<span class="cat-links">';
            echo '<a href="'.esc_url($cat_link).'">'.esc_html($categories[0]->name).'</a>';
        echo '</span>';
       }
    }
}
/*===========================================================================================================*/
/**
 * Post format icon for homepage widget
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_post_format_icon', 'vmagazine_post_format_icon_cb' );

if( ! function_exists( 'vmagazine_post_format_icon_cb' ) ) {
    function vmagazine_post_format_icon_cb() {
        global $post;
        $post_id = $post->ID;
        $post_format = get_post_format( $post_id );
        if( $post_format == 'video' ) {
            echo '<span class="post-format-icon video-icon "><i class="icon_film"></i></span>';
        } elseif( $post_format == 'audio' ) {
            echo '<span class="post-format-icon audio-icon"><i class="icon_volume-high_alt"></i></span>';
        } elseif( $post_format == 'gallery' ) {
            echo '<span class="post-format-icon gallery-icon"><i class="icon_images"></i></span>';
        } else { } 
    }    
}

/*===========================================================================================================*/
/**
* Mobile Navigation 
*
*/
if( ! function_exists('vmagazine_mob_nav_logo') ){
    function vmagazine_mob_nav_logo(){
        $vmagazine_mobile_header_logo = get_theme_mod('vmagazine_mobile_header_logo');
        if( $vmagazine_mobile_header_logo ){ ?>
            <a href="<?php echo esc_url(home_url('/'));?>">
                <img src="<?php echo esc_url($vmagazine_mobile_header_logo);?>" alt="<?php the_title_attribute();?>">
            </a>
        <?php
        }else{
            the_custom_logo();
        }
    }
}


add_action('vmagazine_mobile_header','vmagazine_mobile_header');
function vmagazine_mobile_header(){
?>
    <div class="vmagazine-mob-outer">
        <div class="vmagazine-mobile-nav-wrapp">
            <div class="mob-search-icon">
                <span>
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
             </div>
             <div class="vmagazine-logo">
                <?php vmagazine_mob_nav_logo(); ?>
             </div>
             <div class="nav-toggle">
                <div class="toggle-wrap">
                 <span></span>
                </div>
             </div>
        </div>
    </div>
<?php 
}
add_action('vmagazine_mobile_header_navigation','vmagazine_header_navigation',10);
function vmagazine_header_navigation(){
?>
    
    <div class="vmagazine-mobile-search-wrapper">
        <div class="mob-search-form">
            <?php $vmagazine_mobile_header_bg = get_theme_mod('vmagazine_mobile_header_bg'); ?>
             <div class="img-overlay"></div>
           
            <div class="mob-srch-wrap">
                <div class="nav-close">
                    <span></span>
                    <span></span>
                </div>
                <div class="mob-search-wrapp">
                    <?php get_search_form(); ?>
                    <div class="search-content"></div>
                    <div class="block-loader" style="display:none;">
                        <div class="sampleContainer">
                            <div class="loader">
                                <span class="dot dot_1"></span>
                                <span class="dot dot_2"></span>
                                <span class="dot dot_3"></span>
                                <span class="dot dot_4"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="vmagazine-mobile-navigation-wrapper">
 
    <div class="mobile-navigation">
       <?php $vmagazine_mobile_header_bg = get_theme_mod('vmagazine_mobile_header_bg'); ?>
             <div class="img-overlay"></div>
        
        <div class="vmag-opt-wrap">
            <div class="nav-close">
                <span></span>
                <span></span>
            </div>

            <div class="icon-wrapper">
                <?php echo vmagazine_social_icons();?>
            </div>
            <div class="site-branding">                 
                <?php vmagazine_mob_nav_logo(); ?>
                <div class="site-title-wrapper">
                    <?php
                    if ( is_front_page() || is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                    endif;

                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; ?>
                </div>
            </div><!-- .site-branding -->
            <?php echo vmagazine_nav_mobile_header();?>    
        </div>
    </div>
</div>
<?php
}