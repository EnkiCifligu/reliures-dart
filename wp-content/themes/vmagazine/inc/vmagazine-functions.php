<?php
/**
 *  Define custom or extra function which needed for vmagazine
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */


/*===========================================================================================================*/
/**
 * Vmagazine News Ticker 
 *
 * @since 1.0.0
 */
add_action( 'vmagazine_news_ticker', 'vmagazine_news_ticker_hook' );
if( ! function_exists( 'vmagazine_news_ticker_hook' ) ):
    function vmagazine_news_ticker_hook() {
        $vmagazine_ticker_option = get_theme_mod( 'vmagazine_ticker_option', 'show' );
        $vmagazine_ticker_caption = get_theme_mod( 'vmagazine_ticker_caption', esc_html__( 'Recent News', 'vmagazine' ) );
        $vmagazine_top_ticker_layout = get_theme_mod('vmagazine_top_ticker_layout','default-layout');
        $vmagazine_ticker_count = get_theme_mod( 'vmagazine_ticker_count', '5' );
        $vmagazine_ticker_cat = get_theme_mod('vmagazine_ticker_cat',0);
        $vmagazine_ticker_tags_caption = get_theme_mod('vmagazine_ticker_tags_caption','Trending');
        $vmagazine_ticker_disp_option   = get_theme_mod('vmagazine_ticker_disp_option','latest-post');

        if( $vmagazine_ticker_option == 'hide' ){
            return;
        }
        ?>
        <div class="vmagazine-ticker-wrapper cS-hidden">
        <div class="vmagazine-container <?php echo esc_attr($vmagazine_top_ticker_layout);?>">
        <?php 
        if( $vmagazine_ticker_option != 'hide' ) {
            if( $vmagazine_ticker_disp_option == 'cat-post' ){

                $vmagazine_ticker_args = array(
                                    'post_type'     => 'post',
                                    'posts_per_page' => $vmagazine_ticker_count,
                                    'cat'            => absint($vmagazine_ticker_cat),   
                                    'ignore_sticky_posts' => 1
                                );    
            }else{

                 $vmagazine_ticker_args = array(
                                    'post_type'     => 'post',
                                    'posts_per_page' => $vmagazine_ticker_count,
                                    'ignore_sticky_posts' => 1
                                ); 

            }
            
            $vmagazine_ticker_query = new WP_Query( $vmagazine_ticker_args );
            if( $vmagazine_ticker_query->have_posts() ) { ?>
                <div class="ticker-wrapp">
                    <div class="vmagazine-ticker-caption">
                        <span><?php echo esc_html( $vmagazine_ticker_caption ); ?></span>
                    </div>
                <?php 
                echo '<ul id="vmagazine-news-ticker" >';
                while( $vmagazine_ticker_query->have_posts() ) {
                    $vmagazine_ticker_query->the_post();
        ?>
                    <li>
                        <div class="single-news">
                            <a href="<?php the_permalink(); ?>">
                            <?php echo vmagazine_title_excerpt(80); ?>
                            </a>
                            <span class="date">
                                <?php echo get_the_date(); ?>
                            </span>
                        </div>
                    </li>
        <?php
                }
                echo '</ul>'; ?>
            </div>
            <?php 
            if( $vmagazine_top_ticker_layout == 'layout-two' ): ?>
            <div class="ticker-tags">
               
                <div class="tag-title"><?php echo esc_html($vmagazine_ticker_tags_caption); ?></div>
                <?php
                echo '<ul>';
                while( $vmagazine_ticker_query->have_posts() ):
                    $vmagazine_ticker_query->the_post(); 
                    if(get_the_tag_list()) {
                        echo get_the_tag_list('<li>','</li><li>','</li>');
                    }
                endwhile;
                echo '</ul>';
                ?>
            </div>
            <?php 
            endif;
            }
        }
        echo '</div><!--.vmagazine-container -->';
        echo '</div>';
    }
endif;


   
/*===========================================================================================================*/
/**
 * Changed excerpt more
 */
add_filter( 'excerpt_more', 'vmagazine_custom_excerpt_more' );

if( ! function_exists( 'vmagazine_custom_excerpt_more' ) ):
    function vmagazine_custom_excerpt_more( $more ) {
        return '...';
    }
    endif;
    /*===========================================================================================================*/
/**
 * Menu fallback 
 */
function vmagazine_wp_page_menu() {
    wp_page_menu();
}
/*===========================================================================================================*/
/**
 * Get media attachment id from url
 */ 
if ( ! function_exists( 'vmagazine_get_attachment_id_from_url' ) ):
    function vmagazine_get_attachment_id_from_url( $attachment_url ) {     
        global $wpdb;
        $attachment_id = false;

        // If there is no url, return.
        if ( '' == $attachment_url )
            return;

        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();

        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }     
        return $attachment_id;
    }
    endif;

/*===========================================================================================================*/
/**
 * Function define about page/post/archive sidebar
 */
if( ! function_exists( 'vmagazine_get_sidebar' ) ):
    function vmagazine_get_sidebar() {
        global $post;
        if( $post ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'vmagazine_page_sidebar', true );
        }

        if( is_home() ) {
            $set_id = get_option( 'page_for_posts' );
            $sidebar_meta_option = get_post_meta( $set_id, 'vmagazine_page_sidebar', true );
        }

        if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
            $sidebar_meta_option = 'default_sidebar';
        }

        $vmagazine_archive_sidebar = get_theme_mod( 'vmagazine_archive_sidebar', 'right_sidebar' );
        $vmagazine_post_default_sidebar = get_theme_mod( 'vmagazine_default_post_sidebar', 'right_sidebar' );
        $vmagazine_page_default_sidebar = get_theme_mod( 'vmagazine_default_page_sidebar', 'right_sidebar' );

        if( $sidebar_meta_option == 'default_sidebar' ) {
            if( is_single() ) {
                if( $vmagazine_post_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif( $vmagazine_post_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                } elseif( $vmagazine_post_default_sidebar == 'both_sidebar' ) {
                    get_sidebar();
                    get_sidebar( 'left' );
                }
            } elseif( is_page() ) {
                if( $vmagazine_page_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif( $vmagazine_page_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                } elseif( $vmagazine_page_default_sidebar == 'both_sidebar' ) {
                    get_sidebar();
                    get_sidebar( 'left' );
                }
            } elseif( $vmagazine_archive_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $vmagazine_archive_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            } elseif( $vmagazine_archive_sidebar == 'both_sidebar' ) {
                    get_sidebar();
                    get_sidebar( 'left' );
                }
        } elseif( $sidebar_meta_option == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $sidebar_meta_option == 'left_sidebar' ) {
            get_sidebar( 'left' );
        } elseif( $sidebar_meta_option == 'both_sidebar' ) {
            get_sidebar();
            get_sidebar( 'left' );
        }
    }
    endif;
    /*===========================================================================================================*/
/**
 * Move comment fields at bottom
 */
function vmagazine_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'vmagazine_move_comment_field_to_bottom' );

    /*===========================================================================================================*/
/**
 * Function for excerpt length
 */
if( ! function_exists( 'vmagazine_get_excerpt_content' ) ):
    function vmagazine_get_excerpt_content( $limit ) {

        $striped_contents = strip_shortcodes( get_the_content() );
        $striped_content = strip_tags( $striped_contents );
        $limit_content = mb_substr( $striped_content, 0 , $limit );
       
        return $limit_content;
    }
    endif;
/*===========================================================================================================*/
/**
* Post title excerpt
*/
if( ! function_exists( 'vmagazine_title_excerpt' ) ):
    function vmagazine_title_excerpt( $limit ) {
        $title = get_the_title();
        $limit_content = mb_substr( $title, 0 , $limit );
        $title_length = strlen($title);
       if( $title_length > $limit){
        $limit_content .= '...';
       }
        return $limit_content;
    }
    endif;


    /*===========================================================================================================*/
/**
 * Function for excerpt length in archive
 */
if( ! function_exists( 'vmagazine_archive_excerpt' ) ):
    function vmagazine_archive_excerpt( $content, $limit ) {
        $content = strip_tags( $content );
        $content = strip_shortcodes( $content );
        $words = explode( ' ', $content );    
        return implode( ' ', array_slice( $words, 0, $limit ));
    }
    endif;
    /*===========================================================================================================*/
/**
 * Function to escaping hex color
 */
function vmagazine_esc_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
    }

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
}



/*===========================================================================================================*/


// Remove issues with pref-etching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
/*===========================================================================================================*/
/*** 
 * Display Star according to number of rating
*/
if( ! function_exists( 'vmagazine_display_post_rating' ) ):
    function vmagazine_display_post_rating ( $total_stars ) {

        $star_integer = intval($total_stars);
       
        // this echo full stars
        for ( $i = 0; $i < $star_integer; $i++ ) {
            echo '<span class="star-value"><i class="fa fa-star"></i></span>';
        }

        $star_rest = intval($total_stars) - $star_integer;

        // this echo full star or half or empty star
        if ( $star_rest >= 0.25 and $star_rest < 0.75 ) {
            echo '<span class="star-value"><i class="fa fa-star-half-o"></i></span>';
        } else if ( $star_rest >= 0.75 ) {
            echo '<span class="star-value"><i class="fa fa-star"></i></span>';
        } else if ( $total_stars != 5 ) {
            echo '<span class="star-value"><i class="fa fa-star-o"></i></span>';
        }

        // this echo empty star
        for ( $i = 0; $i < 4-$star_integer; $i++ ) {
            echo '<span class="star-value"><i class="fa fa-star-o"></i></span>';
        }
    }
    endif;
    /*===========================================================================================================*/
/**
 * Ceiling number for post rating
 */
if( !function_exists( 'ceiling ') ) {
    function ceiling( $number, $significance = 1 ) {
        return ( is_numeric( $number ) && is_numeric( $significance ) ) ? (ceil( $number/$significance )*$significance ) : false;
    }
}
/*===========================================================================================================*/
/**
* Fallback image for widgets
*
*/
if( !function_exists( 'vmagazine_home_element_img' ) ) :
    function vmagazine_home_element_img($img_size='full') {
      
        $fallback_option  = get_theme_mod( 'post_fallback_img_option', 'show' );
        $fallback_img_url = get_theme_mod( 'post_fallback_image' );
        $img_src = '';
        if( has_post_thumbnail() ) {
             $image_id      = get_post_thumbnail_id();
             $image_path    = wp_get_attachment_image_src( $image_id, $img_size, true );
             $img_src       = $image_path[0];
            
        } elseif( $fallback_option == 'show' && !empty( $fallback_img_url ) ) {
            $fallback_img_id    = vmagazine_get_attachment_id_from_url( $fallback_img_url );
            $fallback_image_url = wp_get_attachment_image_src( $fallback_img_id, $img_size, true );
            $img_src       = $fallback_image_url[0];
        } 
        return $img_src;
    }
    endif;

/*===========================================================================================================*/
/***
* load images on frontend
*/
if( ! function_exists('vmagazine_load_images') ){
    function vmagazine_load_images($img_src){ 
        $vmagazine_lazyload_option = get_theme_mod('vmagazine_lazyload_option','enable');
        
        if( $vmagazine_lazyload_option == 'enable' ){ ?>
        <img class="lazy" data-src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title(); ?>" />
        <?php     
        }else{ ?>
        <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title(); ?>" />
        <?php 
        }   
    }
}


/*===========================================================================================================*/
/**
 * Get single post featured image with fallback image
 */
if( !function_exists( 'vmagazine_single_post_featured_image' ) ) :
    function vmagazine_single_post_featured_image() {
        global $post;
        $post_id = $post->ID;
        $fallback_option  = get_theme_mod( 'post_fallback_img_option', 'show' );
        $fallback_img_url = get_theme_mod( 'post_fallback_image' );
        if( has_post_thumbnail() ) {
            echo '<div class="entry-thumb">';
            the_post_thumbnail( 'vmagazine-single-large' );
            echo '</div>';
        } elseif( $fallback_option == 'show' && !empty( $fallback_img_url ) ) {
            $fallback_img_id    = vmagazine_get_attachment_id_from_url( $fallback_img_url );
            $fallback_image_url = wp_get_attachment_image_src( $fallback_img_id, 'vmagazine-single-large', true );
            echo '<div class="entry-thumb"><img src="'. esc_url( $fallback_image_url[0] ) .'" alt="'.the_title_attribute().'"/></div>';
        } 
    }
    endif;

/*===========================================================================================================*/
/**
 * Convert YouTube time duration
 */
function vmagazine_covtime( $duration ) {
    preg_match_all( '/(\d+)/', $duration ,$parts );

     //Put in zeros if we have less than 3 numbers.
    if ( count( $parts[0] ) == 1 ) {
        array_unshift( $parts[0], "0", "0" );
    } elseif ( count( $parts[0] ) == 2 ) {
        array_unshift( $parts[0], "0" );
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
    $seconds_overflow = floor( $sec_init/60 );

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ( $min_init )%60;
    $minutes = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
    $minutes_overflow = floor( ( $min_init )/60 );

    $hours = $parts[0][0] + $minutes_overflow;    

    if( $hours != 0 ) {
        return $hours.':'.$minutes.':'.$seconds;
    } else {
        return $minutes.':'.$seconds;
    }        
}
/*===========================================================================================================*/
/**
 * Change layout for comment
 */
function vmagazine_comment_list( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment; 
   
    ?>
    <li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 100 ); ?>
            </div><!-- .comment-author -->

            <div class="cmt-main-content">
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'vmagazine' ); ?></em>
                <br />
            <?php endif; ?>
            <div class="commnet-author-wrapp">
            <div class="cmt-author-name">
                <?php printf( __( '<cite class="fn">%s</cite>','vmagazine' ), get_comment_author_link() ); ?>
            </div><!-- .cmt-author-name -->
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','vmagazine'), get_comment_date(),  get_comment_time()) ?></a>
                <?php edit_comment_link(__('(Edit)','vmagazine'),'  ','') ?>
            </div><!-- .comment-meta -->
            </div>
            <div class="cmt-content-wrap">
                <?php comment_text(); ?>
            </div><!-- .cmt-content-wrap -->
            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        </div><!-- .cmt-main-content -->

    </div>
</li>
<?php
}

/**
* Change comment form textarea to use placeholder
*
* @param  array $args
* @return array
*/
function vmagazine_comment_textarea_placeholder( $args ) {
$args['comment_field']  = str_replace( 'textarea', 'textarea placeholder="'.esc_attr__('Your Comment','vmagazine').'"', $args['comment_field'] );
return $args;
}
add_filter( 'comment_form_defaults', 'vmagazine_comment_textarea_placeholder' );


/**
* Comment Form Fields Placeholder
*
*/
function vmagazine_comment_form_fields( $fields ) {
 
foreach( $fields as &$field ) {
$field = str_replace( 'id="author"', 'id="author" placeholder="'.esc_attr__('Name*','vmagazine').'"', $field );
$field = str_replace( 'id="email"', 'id="email" placeholder="'.esc_attr__('Email Address*','vmagazine').'"', $field );
$field = str_replace( 'id="url"', 'id="url" placeholder="'.esc_attr__('Website','vmagazine').'"', $field );
}
return $fields;
}
add_filter( 'comment_form_default_fields', 'vmagazine_comment_form_fields' );





/**
* Date for timeline posts
*
*/
add_action('vmagazine_formated_date','vmagazine_formated_date');
function vmagazine_formated_date(){
     $date = '<div class="blog-date-inner"><span class="posted-day">%1$s</span><span class="posted-month">%2$s</span><span class="posted-year">%3$s</span></div>';
     $date = sprintf( $date,
          get_the_date('j'),
          get_the_date('M'),
          get_the_date('Y')
        );
    $posted_on = $date;
    echo '<div class="blog-date">'.$posted_on.'</div>';
}



/**
* Youtube video time convert 
*
*/
if ( !function_exists( 'vmagazine_youtube_duration' ) ) {
   function vmagazine_youtube_duration( $duration ) {

       preg_match_all( '/(\d+)/', $duration, $parts );
       //Put in zeros if we have less than 3 numbers.
       if ( count( $parts[ 0 ] ) == 1 ) {

           array_unshift( $parts[ 0 ], "0", "0" );
       } elseif ( count( $parts[ 0 ] ) == 2 ) {
           array_unshift( $parts[ 0 ], "0" );
       }

       $sec_init = $parts[ 0 ][ 2 ];
       $seconds = $sec_init % 60;
       $seconds = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
       $seconds_overflow = floor( $sec_init / 60 );

       $min_init = $parts[ 0 ][ 1 ] + $seconds_overflow;
       $minutes = ( $min_init ) % 60;
       $minutes = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
       $minutes_overflow = floor( ( $min_init ) / 60 );

       $hours = $parts[ 0 ][ 0 ] + $minutes_overflow;

       if ( $hours != 0 ) {
           return $hours . ':' . $minutes . ':' . $seconds;
       } else {
           return $minutes . ':' . $seconds;
       }
   }

}


/**
* function to retrieve default categories from posts
*/
function vmagazine_category_lists() {
    $categories = get_categories(
            array(
                'hide_empty' => 0,
                'exclude' => 1
            )
    );
    $category_list = array();
    $category_list[0] = esc_html__('Select Category', 'vmagazine');
    foreach ($categories as $category) :
        $category_list[$category->term_id] = $category->name;
    endforeach;
    return $category_list;
}




//Pagination for single posts
function vmagazine_single_post_pagination(){ ?>   
    <div class="single_post_pagination_wrapper clearfix">
        <div class="prev-link"> 
            <div class="prev-link-wrapper clearfix">
                <?php
                $prevPost = get_previous_post();
                if ( is_a( $prevPost , 'WP_Post' ) ) :
                    $prevthumbnail = get_the_post_thumbnail($prevPost->ID,'thumbnail'); 
                    $prevtitle = get_the_title($prevPost->ID); 
                    
                    if($prevthumbnail){ ?>
                        <span class="prev-image">
                            <?php previous_post_link('%link', $prevthumbnail); ?>
                        </span>
                    <?php } ?> 

                    <div class="prev-text">
                        <h4><?php previous_post_link('%link', $prevtitle) ;?></h4>
                        <h2><?php previous_post_link('%link', 'Previous Post'); ?></h2>
                    </div>
                
                <?php endif; ?>
            </div>
        </div>

        <?php // Display the thumbnail of the next post ?>
        <div class="next-link"> 
            <div class="next-link-wrapper clearfix">
                <?php
                $nextPost = get_next_post();
                if ( is_a( $nextPost , 'WP_Post' ) ) :
                    $nextthumbnail = get_the_post_thumbnail($nextPost->ID,'thumbnail');
                    $nextitle = get_the_title($nextPost->ID); ?>
                    <div class="next-text">
                        <h4><?php next_post_link('%link',$nextitle); ?></h4>
                        <h2><?php next_post_link('%link', 'Next Post'); ?></h2>
                    </div>

                    <?php
                    if($nextthumbnail){ ?>
                        <span class="next-image">
                            <?php next_post_link('%link', $nextthumbnail); ?>
                        </span>
                    <?php } 
                endif; ?>
            </div>
        </div>
    </div> <!-- .single_post_pagination_wrapper -->
<?php 
} 
add_action('vmagazine_single_post_nav','vmagazine_single_post_pagination');




/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vmagazine_body_classes( $classes ) {

     global $post;

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    //image hover effect classes
    $vmagazine_img_hover_layouts = get_theme_mod('vmagazine_img_hover_layouts','hover-effect-1');
    $classes[]  = esc_html($vmagazine_img_hover_layouts);

    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( ($vmagazine_site_layout_width == 'wide') || ($vmagazine_site_layout_width == 'boxed') ){
        $classes[] = 'elements-paddings-hidden';   
    }

    $vmagazine_preloader_show = get_theme_mod('vmagazine_preloader_show','hide');
    
    if( $vmagazine_preloader_show == 'show' ){
        $classes[] = 'vmagazine-loader-enabled';
    }

    /** 
    * Site Layout
    * @since 1.0.3
    */
    $vmagazine_site_layout_width = get_theme_mod('vmagazine_site_layout_width','framed');
    if( $vmagazine_site_layout_width == 'boxed' ){
        $classes[] = 'boxed-width';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    $vmagazine_single_posts_layout = get_theme_mod('vmagazine_single_posts_layout','post_layout1');
    if( $vmagazine_single_posts_layout == 'post_layout3' ){
        $classes[] = 'post-single-layout3';
    }

    /**
     * option for site layout 
     */
    $vmagazine_site_layout = get_theme_mod( 'vmagazine_site_layout', 'fullwidth_layout' );
    
    if( !empty( $vmagazine_site_layout ) ) {
        $classes[] = $vmagazine_site_layout;
    }

    /**
     * sidebar option for post/page/archive 
     */
    if( $post ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'vmagazine_page_sidebar', true );
    }
     
    if( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $set_id, 'vmagazine_page_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $vmagazine_archive_sidebar = get_theme_mod( 'vmagazine_archive_sidebar', 'right_sidebar' );
    $vmagazine_post_default_sidebar = get_theme_mod( 'vmagazine_default_post_sidebar', 'right_sidebar' );        
    $vmagazine_page_default_sidebar = get_theme_mod( 'vmagazine_default_page_sidebar', 'right_sidebar' );
    
     
    if( class_exists( 'WooCommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-right' ) ){
        $classes[] = 'right-sidebar';    
    }elseif( class_exists( 'WooCommerce' ) && is_woocommerce() && ! is_active_sidebar( 'shop-right' ) ){
        $classes[] = 'no-sidebar';
    }
        
    elseif( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $vmagazine_post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $vmagazine_post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            }elseif( $vmagazine_post_default_sidebar == 'both_sidebar' ) {
                 $classes[] = 'both-sidebars';
            } elseif( $vmagazine_post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            }

        } elseif( is_page() ) {
            if( $vmagazine_page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $vmagazine_page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $vmagazine_page_default_sidebar == 'both_sidebar' ) {
                 $classes[] = 'both-sidebars';
            } elseif( $vmagazine_page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            }

        }

        
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    }elseif( $sidebar_meta_option == 'both_sidebar' ) {
        $classes[] = 'both-sidebars';
    }

   

    //archive sidebars
    if( (is_archive() || is_home() || is_search()) &&  ! vmagazine_woo_page_check() ){
        if( $vmagazine_archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $vmagazine_archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        }elseif( $vmagazine_archive_sidebar == 'both_sidebar' ) {
            $classes[] = 'both-sidebars';
        } elseif( $vmagazine_archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } 
    }

    $vmagazine_archive_layout = get_theme_mod( 'vmagazine_archive_layout', 'layout1' );
    if( (!empty( $vmagazine_archive_layout) && is_archive() || is_home() || is_search() ) ){
        $classes[] = 'vmagazine-archive-'.esc_attr( $vmagazine_archive_layout );
    }
    $vmagazine_template_layout_setting = get_theme_mod('vmagazine_template_layout_setting','template-one');
    if( $vmagazine_template_layout_setting ){
        $classes[] = $vmagazine_template_layout_setting;   
    }
    if( is_singular() ){
        $classes[] = 'vmagazine-single-layout';
    }

    return $classes;
}
add_filter( 'body_class', 'vmagazine_body_classes' );

/**
 * Removed prefix from Archive title
 *
 * @since 1.0.0
 */
function vmagazine_remove_prefix_archive_title ( $title ) {
    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title =  get_the_author();

        }

    return $title;
}
add_filter( 'get_the_archive_title', 'vmagazine_remove_prefix_archive_title' );


/*------------------------------------------------------------------------------------------------------------------*/
/**
 * Define function for fontawewome icons
 *
 * @param null
 * @return array
 * @since 1.0.0
 */
 function vmagazine_cust_icons_array(){
    $ap_icon_list_raw =
            'fa-500px,fa-address-book,fa-address-book-o,fa-address-card,fa-address-card-o,fa-adjust,fa-adn,fa-align-center,
            fa-align-justify,fa-align-left,fa-align-right,fa-amazon,fa-ambulance,fa-american-sign-language-interpreting,
            fa-anchor,fa-android,fa-angellist,fa-angle-double-down,fa-angle-double-left,fa-angle-double-right,fa-angle-double-up,fa-angle-down,fa-angle-left,
            fa-angle-right,fa-angle-up,fa-apple,fa-archive,fa-area-chart,fa-arrow-circle-down,fa-arrow-circle-left,fa-arrow-circle-o-down,
            fa-arrow-circle-o-left,fa-arrow-circle-o-right,fa-arrow-circle-o-up,fa-arrow-circle-right,fa-arrow-circle-up,fa-arrow-down,
            fa-arrow-left,fa-arrow-right,fa-arrow-up,fa-arrows,fa-arrows-alt,fa-arrows-h,fa-arrows-v,fa-asl-interpreting,fa-assistive-listening-systems,
            fa-asterisk,fa-at,fa-audio-description,fa-automobile,fa-backward,fa-balance-scale,fa-ban,fa-bandcamp,fa-bank,fa-bar-chart,
            fa-bar-chart-o,fa-barcode,fa-bars,fa-bath,fa-bathtub,fa-battery,fa-battery-0,fa-battery-1,fa-battery-2,fa-battery-3,
            fa-battery-4,fa-battery-empty,fa-battery-full,fa-battery-half,fa-battery-quarter,fa-battery-three-quarters,
            fa-bed,fa-beer,fa-behance,fa-behance-square,fa-bell,fa-bell-o,fa-bell-slash,fa-bell-slash-o,fa-bicycle,
            fa-binoculars,fa-birthday-cake,fa-bitbucket,fa-bitbucket-square,fa-bitcoin,fa-black-tie,fa-blind,fa-bluetooth,
            fa-bluetooth-b,fa-bold,fa-bolt,fa-bomb,fa-book,fa-bookmark,fa-bookmark-o,fa-braille,fa-briefcase,fa-btc,fa-bug,
            fa-building,fa-building-o,fa-bullhorn,fa-bullseye,fa-bus,fa-buysellads,fa-cab,fa-calculator,fa-calendar,fa-calendar-check-o,
            fa-calendar-minus-o,fa-calendar-o,fa-calendar-plus-o,fa-calendar-times-o,fa-camera,fa-camera-retro,fa-car,fa-caret-down,fa-caret-left,fa-caret-right,
            fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-caret-up,fa-cart-arrow-down,fa-cart-plus,
            fa-cc,fa-cc-amex,fa-cc-diners-club,fa-cc-discover,fa-cc-jcb,fa-cc-mastercard,fa-cc-paypal,fa-cc-stripe,fa-cc-visa,fa-certificate,
            fa-chain,fa-chain-broken,fa-check,fa-check-circle,fa-check-circle-o,fa-check-square,fa-check-square-o,fa-chevron-circle-down,
            fa-chevron-circle-left,fa-chevron-circle-right,fa-chevron-circle-up,fa-chevron-down,fa-chevron-left,fa-chevron-right,fa-chevron-up,
            fa-child,fa-chrome,fa-circle,fa-circle-o,fa-circle-o-notch,fa-circle-thin,fa-clipboard,fa-clock-o,fa-clone,fa-close,fa-cloud,
            fa-cloud-download,fa-cloud-upload,fa-cny,fa-code,fa-code-fork,fa-codepen,fa-codiepie,fa-coffee,fa-cog,fa-cogs,fa-columns,fa-comment,
            fa-comment-o,fa-commenting,fa-commenting-o,fa-comments,fa-comments-o,fa-compass,fa-compress,fa-connectdevelop,fa-contao,fa-copy,fa-copyright,
            fa-creative-commons,fa-credit-card,fa-credit-card-alt,fa-crop,fa-crosshairs,fa-css3,fa-cube,fa-cubes,fa-cut,fa-cutlery,fa-dashboard,fa-dashcube,
            fa-database,fa-deaf,fa-deafness,fa-dedent,fa-delicious,fa-desktop,fa-deviantart,fa-diamond,fa-digg,fa-dollar,fa-dot-circle-o,fa-download,fa-dribbble,
            fa-drivers-license,fa-drivers-license-o,fa-dropbox,fa-drupal,fa-edge,fa-edit,fa-eercast,fa-eject,fa-ellipsis-h,fa-ellipsis-v,fa-empire,fa-envelope,fa-envelope-o,fa-envelope-open,fa-envelope-open-o,
            fa-envelope-square,fa-envira,fa-eraser,fa-etsy,fa-eur,fa-euro,fa-exchange,fa-exclamation,fa-exclamation-circle,fa-exclamation-triangle,fa-expand,fa-expeditedssl,fa-external-link,
            fa-external-link-square,fa-eye,fa-eye-slash,fa-eyedropper,fa-facebook,fa-facebook-f,fa-facebook-official,fa-facebook-square,fa-fast-backward,
            fa-fast-forward,fa-fax,fa-feed,fa-female,fa-fighter-jet,fa-file,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,
            fa-file-movie-o,fa-file-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-text,
            fa-file-text-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-files-o,fa-film,fa-filter,fa-fire,fa-fire-extinguisher,fa-firefox,fa-first-order,
            fa-flag,fa-flag-checkered,fa-flag-o,fa-flash,fa-flask,fa-flickr,fa-floppy-o,fa-folder,fa-folder-o,fa-folder-open,fa-folder-open-o,fa-font,
            fa-font-awesome,fa-fonticons,fa-fort-awesome,fa-forumbee,fa-forward,fa-foursquare,fa-free-code-camp,fa-frown-o,fa-futbol-o,fa-gamepad,fa-gavel,fa-gbp,fa-ge,fa-gear,
            fa-gears,fa-genderless,fa-get-pocket,fa-gg,fa-gg-circle,fa-gift,fa-git,fa-git-square,fa-github,fa-github-alt,fa-github-square,
            fa-gitlab,fa-gittip,fa-glass,fa-glide,fa-glide-g,fa-globe,fa-google,fa-google-plus,fa-google-plus-circle,fa-google-plus-official,
            fa-google-plus-square,fa-google-wallet,fa-graduation-cap,fa-gratipay,fa-grav,fa-group,fa-h-square,fa-hacker-news,fa-hand-grab-o,
            fa-hand-lizard-o,fa-hand-o-down,fa-hand-o-left,fa-hand-o-right,fa-hand-o-up,fa-hand-paper-o,fa-hand-peace-o,fa-hand-pointer-o,fa-hand-rock-o,
            fa-hand-scissors-o,fa-hand-spock-o,fa-hand-stop-o,fa-handshake-o,fa-hard-of-hearing,fa-hashtag,fa-hdd-o,fa-header,fa-headphones,fa-heart,fa-heart-o,
            fa-heartbeat,fa-history,fa-home,fa-hospital-o,fa-hotel,fa-hourglass,fa-hourglass-1,fa-hourglass-2,fa-hourglass-3,fa-hourglass-end,fa-hourglass-half,
            fa-hourglass-o,fa-hourglass-start,fa-houzz,fa-html5,fa-i-cursor,fa-id-badge,fa-id-card,fa-id-card-o,fa-ils,fa-image,fa-imdb,fa-inbox,fa-indent,fa-industry,
            fa-info,fa-info-circle,fa-inr,fa-instagram,fa-institution,fa-internet-explorer,fa-intersex,fa-ioxhost,fa-italic,fa-joomla,fa-jpy,fa-jsfiddle,fa-key,
            fa-keyboard-o,fa-krw,fa-language,fa-laptop,fa-lastfm,fa-lastfm-square,fa-leaf,fa-leanpub,fa-legal,fa-lemon-o,fa-level-down,fa-level-up,
            fa-life-bouy,fa-life-buoy,fa-life-ring,fa-life-saver,fa-lightbulb-o,fa-line-chart,fa-link,fa-linkedin,fa-linkedin-square,fa-linode,fa-linux,fa-list,
            fa-list-alt,fa-list-ol,fa-list-ul,fa-location-arrow,fa-lock,fa-long-arrow-down,fa-long-arrow-left,fa-long-arrow-right,fa-long-arrow-up,fa-low-vision,
            fa-magic,fa-magnet,fa-mail-forward,fa-mail-reply,fa-mail-reply-all,fa-male,fa-map,fa-map-marker,fa-map-o,fa-map-pin,fa-map-signs,fa-mars,fa-mars-double,
            fa-mars-stroke,fa-mars-stroke-h,fa-mars-stroke-v,fa-maxcdn,fa-meanpath,fa-medium,fa-medkit,fa-meetup,fa-meh-o,fa-mercury,
            fa-microchip,fa-microphone,fa-microphone-slash,fa-minus,fa-minus-circle,fa-minus-square,fa-minus-square-o,fa-mixcloud,fa-mobile,
            fa-mobile-phone,fa-modx,fa-money,fa-moon-o,fa-mortar-board,fa-motorcycle,fa-mouse-pointer,fa-music,fa-navicon,fa-neuter,
            fa-newspaper-o,fa-object-group,fa-object-ungroup,fa-odnoklassniki,fa-odnoklassniki-square,fa-opencart,fa-openid,fa-opera,
            fa-optin-monster,fa-outdent,fa-pagelines,fa-paint-brush,fa-paper-plane,fa-paper-plane-o,fa-paperclip,fa-paragraph,
            fa-paste,fa-pause,fa-pause-circle,fa-pause-circle-o,fa-paw,fa-paypal,fa-pencil,fa-pencil-square,fa-pencil-square-o,fa-percent,fa-phone,fa-phone-square,fa-photo,fa-picture-o,fa-pie-chart,
            fa-pied-piper,fa-pied-piper-alt,fa-pied-piper-pp,fa-pinterest,fa-pinterest-p,fa-pinterest-square,fa-plane,fa-play,fa-play-circle,fa-play-circle-o,
            fa-plug,fa-plus,fa-plus-circle,fa-plus-square,fa-plus-square-o,fa-podcast,fa-power-off,fa-print,fa-product-hunt,fa-puzzle-piece,fa-qq,
            fa-qrcode,fa-question,fa-question-circle,fa-question-circle-o,fa-quora,fa-quote-left,fa-quote-right,fa-ra,fa-random,fa-ravelry,fa-rebel,fa-recycle,fa-reddit,
            fa-reddit-alien,fa-reddit-square,fa-refresh,fa-registered,fa-remove,fa-renren,fa-reorder,fa-repeat,fa-reply,fa-reply-all,fa-resistance,fa-retweet,fa-rmb,fa-road,fa-rocket,
            fa-rotate-left,fa-rotate-right,fa-rouble,fa-rss,fa-rss-square,fa-rub,fa-ruble,fa-rupee,fa-s15,fa-safari,fa-save,fa-scissors,fa-scribd,fa-search,fa-search-minus,
            fa-search-plus,fa-sellsy,fa-send,fa-send-o,fa-server,fa-share,fa-share-alt,fa-share-alt-square,fa-share-square,fa-share-square-o,fa-shekel,fa-sheqel,fa-shield,fa-ship,
            fa-shirtsinbulk,fa-shopping-bag,fa-shopping-basket,fa-shopping-cart,fa-shower,fa-sign-in,fa-sign-language,fa-sign-out,fa-signal,fa-signing,fa-simplybuilt,fa-sitemap,
            fa-skyatlas,fa-skype,fa-slack,fa-sliders,fa-slideshare,fa-smile-o,fa-snapchat,fa-snapchat-ghost,fa-snapchat-square,fa-snowflake-o,fa-soccer-ball-o,fa-sort,fa-sort-alpha-asc,
            fa-sort-alpha-desc,fa-sort-amount-asc,fa-sort-amount-desc,fa-sort-asc,fa-sort-desc,fa-sort-down,fa-sort-numeric-asc,fa-sort-numeric-desc,fa-sort-up,fa-soundcloud,
            fa-space-shuttle,fa-spinner,fa-spoon,fa-spotify,fa-square,fa-square-o,
            fa-stack-exchange,fa-stack-overflow,fa-star,fa-star-half,fa-star-half-empty,fa-star-half-full,fa-star-half-o,fa-star-o,fa-steam,fa-steam-square,fa-step-backward,
            fa-step-forward,fa-stethoscope,fa-sticky-note,fa-sticky-note-o,fa-stop,fa-stop-circle,fa-stop-circle-o,fa-street-view,fa-strikethrough,
            fa-stumbleupon,fa-stumbleupon-circle,fa-subscript,fa-subway,fa-suitcase,fa-sun-o,fa-superpowers,fa-superscript,fa-support,fa-table,fa-tablet,fa-tachometer,fa-tag,fa-tags,fa-tasks,fa-taxi,
            fa-telegram,fa-television,fa-tencent-weibo,fa-terminal,fa-text-height,fa-text-width,fa-th,fa-th-large,fa-th-list,fa-themeisle,fa-thermometer,fa-thermometer-0,fa-thermometer-1,fa-thermometer-2,
            fa-thermometer-3,fa-thermometer-4,fa-thermometer-empty,fa-thermometer-full,fa-thermometer-half,fa-thermometer-quarter,fa-thermometer-three-quarters,fa-thumb-tack,
            fa-thumbs-down,fa-thumbs-o-down,fa-thumbs-o-up,fa-thumbs-up,fa-ticket,fa-times,fa-times-circle,fa-times-circle-o,fa-times-rectangle,fa-times-rectangle-o,fa-tint,fa-toggle-down,
            fa-toggle-left,fa-toggle-off,fa-toggle-on,fa-toggle-right,fa-toggle-up,fa-trademark,fa-train,fa-transgender,fa-transgender-alt,fa-trash,fa-trash-o,fa-tree,
            fa-trello,fa-tripadvisor,fa-trophy,fa-truck,fa-try,fa-tty,fa-tumblr,fa-tumblr-square,
            fa-turkish-lira,fa-tv,fa-twitch,fa-twitter,fa-twitter-square,fa-umbrella,fa-underline,fa-undo,fa-universal-access,fa-university,fa-unlink,fa-unlock,fa-unlock-alt,fa-unsorted,fa-upload,
            fa-usb,fa-usd,fa-user,fa-user-circle,fa-user-circle-o,fa-user-md,fa-user-o,fa-user-plus,fa-user-secret,fa-user-times,fa-users,fa-vcard,fa-vcard-o,fa-venus,fa-venus-double,fa-venus-mars,
            fa-viacoin,fa-viadeo,fa-viadeo-square,fa-video-camera,fa-vimeo,fa-vimeo-square,fa-vine,fa-vk,fa-volume-control-phone,fa-volume-down,fa-volume-off,fa-volume-up,
            fa-warning,fa-wechat,fa-weibo,fa-weixin,fa-whatsapp,fa-wheelchair,fa-wheelchair-alt,fa-wifi,fa-wikipedia-w,fa-window-close,fa-window-close-o,fa-window-maximize,fa-window-minimize,fa-window-restore,fa-windows,fa-won,
            fa-wordpress,fa-wpbeginner,fa-wpexplorer,fa-wpforms,fa-wrench,fa-xing,fa-xing-square,fa-y-combinator,fa-y-combinator-square,fa-yahoo,fa-yc,fa-yc-square,fa-yelp,fa-yen,
            fa-yoast,fa-youtube,fa-youtube-play,fa-youtube-square' ;
    $ap_icon_list = explode( "," , $ap_icon_list_raw);
    return $ap_icon_list;
 }


/*------------------------------------------------------------------------------------------------------------------*/
/**
* Modify default category widget
*
* @return adds span to default category widget and returns value
*/
add_filter('wp_list_categories', 'vmagazine_add_span_cat_count');
    function vmagazine_add_span_cat_count($links) {
    $links = str_replace('</a> (', '</a> <span>(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

/*------------------------------------------------------------------------------------------------------------------*/
/**
* Modify default category widget
*
* @return adds span to default archive widget and returns value
*/
add_filter('get_archives_link', 'vmagazine_style_the_archive_count');
function vmagazine_style_the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

/*------------------------------------------------------------------------------------------------------------------*/
/*
*Remove WordPress JSON API links in header html
*/
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

/*------------------------------------------------------------------------------------------------------------------*/
/**
* Menu fallback function
*
*/
if( ! function_exists('vmagazine_menu_fallback_message') ){
    function vmagazine_menu_fallback_message(){
        echo '<div class="menu-fallback-text">';
        esc_html_e('Please configure menus from &quot; Appearance &gt; Menus &quot; to display here','vmagazine');
        echo '</div>';
        
    }
}

/*-------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists('vmagazine_woo_page_check')){
    function vmagazine_woo_page_check(){
        if( ! class_exists( 'WooCommerce' ) ){
            return;
        }elseif( is_woocommerce () ){
            return true;
        }

    }
}

/*-------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists('vmagazine_logo_check')){
    function vmagazine_logo_check(){
        $logo_enable = get_theme_mod('display_header_text'); 
        if( $logo_enable || get_custom_logo() ){ ?>
            <div class="site-branding">                 
                <?php the_custom_logo(); ?>
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
            </div>
        <?php 
        }
    }
}