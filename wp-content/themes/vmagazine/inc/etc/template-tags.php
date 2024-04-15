<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */
/*===========================================================================================================*/
if ( ! function_exists( 'vmagazine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function vmagazine_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' %s', 'post date', 'vmagazine' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'vmagazine' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="post-author">'. $byline .'</span><span class="posted-on">'. $posted_on .'</span>';

	

}
endif;


/*===========================================================================================================*/
/* Post Meta with icons **/
if( ! function_exists( 'vmagazine_icon_meta') ){
    function vmagazine_icon_meta(){
        
		$posted_on = get_the_date();
	    $comments  = get_comments_number();
	   
	    echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. esc_html($posted_on) .'</span>';
	    echo '<span class="comments"><i class="fa fa-comments"></i>'. esc_html($comments) .'</span>';
	    if(function_exists('vmagazine_post_views')){
	    	echo vmagazine_post_views();
	    }
    }
}
add_action( 'vmagazine_icon_meta', 'vmagazine_icon_meta' );


/*===========================================================================================================*/
/* Post Meta with icons without comments **/
if( ! function_exists( 'vmagazine_icon_meta_cm') ){
    function vmagazine_icon_meta_cm(){
        
	$posted_on = get_the_date();
   
    echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. esc_html($posted_on) .'</span>';
     if(function_exists('vmagazine_post_views')){
	    	echo vmagazine_post_views();
	    }
    }
}
add_action( 'vmagazine_icon_meta_cm', 'vmagazine_icon_meta_cm' );

/*===========================================================================================================*/
/* Post date for timeline */

if ( ! function_exists( 'vmagazine_timeline_posted_on' ) ) :
function vmagazine_timeline_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s"><span class="posted-day">%2$s</span> <span class="posted-month">%3$s</span></time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%5$s">%6$s</time>';
	}
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'd' ) ),
		esc_html( get_the_date( 'M' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	$posted_on = $time_string ;
	echo '<span class="posted-on">' . esc_html($posted_on) . '</span>';
}
endif;

add_action('vmagazine_timeline_date','vmagazine_timeline_posted_on');

/*===========================================================================================================*/
/**
 * Function for entry footer
 */
if ( ! function_exists( 'vmagazine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function vmagazine_entry_footer() {

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'vmagazine' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<footer class="entry-footer"><span class="edit-link">',
		'</span></footer>'
	);
}
endif;
/*===========================================================================================================*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function vmagazine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'vmagazine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'vmagazine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so vmagazine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so vmagazine_categorized_blog should return false.
		return false;
	}
}
/*===========================================================================================================*/
/**
 * Flush out the transients used in vmagazine_categorized_blog.
 */
function vmagazine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'vmagazine_categories' );
}
add_action( 'edit_category', 'vmagazine_category_transient_flusher' );
add_action( 'save_post',     'vmagazine_category_transient_flusher' );

/*===========================================================================================================*/
/**
 * Get post comment number
 */
if( ! function_exists( 'vmagazine_post_comments' ) ):
	function vmagazine_post_comments() {
		
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-count">';
				echo  '<i class="fa fa-comment-o"></i>';
					comments_popup_link( __( '0', 'vmagazine' ), __( '1', 'vmagazine' ), __( '%', 'vmagazine' ) );
				echo '</span>';
			}
	}
endif;

/*===========================================================================================================*/
/**
 * Single post Categories lists
 */

if( ! function_exists( 'vmagazine_post_cat_lists' ) ) :
	function vmagazine_post_cat_lists() {

		// Hide category and tag text for pages.
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
 * Single post Tags lists
 */

if( ! function_exists( 'vmagazine_single_post_tags_list' ) ) :
	function vmagazine_single_post_tags_list() {

		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( '', 'vmagazine' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links clearfix">' . esc_html__( '%1$s', 'vmagazine' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;