<?php
/**
 * Register widget area and call widget files
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

/**
* constants for widgets
*/
define( 'VMAG_WIDGET_IMG_URI', get_template_directory_uri() .'/assets/images/widgets-layouts/' );

/*===========================================================================================================*/
/**
 * Define categories lists in array
 */
$vmagazine_categories = get_categories( array( 'hide_empty' => true ) );
foreach ( $vmagazine_categories as $vmagazine_category ) {
    $vmagazine_cat_array[$vmagazine_category->term_id] = $vmagazine_category->cat_name.' ('. $vmagazine_category->category_count.')';
}

//categories in dropdown
$vmagazine_cat_dropdown['0'] = esc_html__( '--Select Category--', 'vmagazine' );
foreach ( $vmagazine_categories as $vmagazine_category ) {
    $vmagazine_cat_dropdown[$vmagazine_category->term_id] = $vmagazine_category->cat_name.' ('. $vmagazine_category->category_count.')';
}

/**
 * radio option for types
 */
$vmagazine_posts_type = array(
    'latest_posts'   => esc_html__( 'From Latest Posts', 'vmagazine' ),
    'random_posts'   => esc_html__( 'Random Posts', 'vmagazine' ),
    'category_posts' => esc_html__( 'From Selected Category', 'vmagazine' )
    );

/**
 * Select options for column
 */
$vmagazine_column_choice = array(
  ''    => esc_html__( 'Select No.of Column', 'vmagazine' ),
  '1' => esc_html__( '1 Column', 'vmagazine' ),
  '2' => esc_html__( '2 Columns', 'vmagazine' ),
  '3' => esc_html__( '3 Columns', 'vmagazine' ),
  '4' => esc_html__( '4 Columns', 'vmagazine' )
  );

/**
 * Block layout
 */
$vmagazine_block_layout = array(
    'block_layout_1' =>  esc_html__( 'Layout 1', 'vmagazine' ),
    'block_layout_2' =>  esc_html__( 'Layout 2', 'vmagazine' ),
    );

$vmagazine_block_post_layout = array(
    'block_layout_1' =>  esc_html__( 'Layout 1', 'vmagazine' ),
    'block_layout_2' =>  esc_html__( 'Layout 2', 'vmagazine' ),
    'block_layout_3' =>  esc_html__( 'Layout 3', 'vmagazine' ),
    );


$vmagazine_block_post_layout_col = array(
    'block_layout_1' =>  esc_html__( 'Layout 1', 'vmagazine' ),
    'block_layout_3' =>  esc_html__( 'Layout 2', 'vmagazine' ),
    'block_layout_4' =>  esc_html__( 'Layout 3', 'vmagazine' ),
    );

/**
*Grid/list layout
*/
$vmagazine_grdlst_layout = array(
    'grid' =>  esc_html__( 'Grid Layout', 'vmagazine' ),
    'list' => esc_html__('List Layout','vmagazine'),
    'grid-two' => esc_html__('Grid Two Layout','vmagazine'),
    );

/**
*Pagination layout
*/
$vmagazine_pagination_layout = array(
    'ajax_loader' =>  esc_html__( 'Ajax Loader', 'vmagazine' ),
    'view_all' => esc_html__('View All Button','vmagazine')
    );

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Checkboxes about admin roles
 */

$vmagazine_admin_roles = array(
    'subscriber'  => esc_html__( 'Subscriber', 'vmagazine' ),
    'contributor' => esc_html__( 'Contributor', 'vmagazine' ),
    'author'    => esc_html__( 'Author', 'vmagazine' ),
    'editor'    => esc_html__( 'Editor', 'vmagazine' ),
    'administrator' => esc_html__( 'Administrator', 'vmagazine' ),
  );

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Widget title function
 *
 * @param $widget_title string
 * @param $widget_title url
 *
 *  @return <h4>Widget title</h4> or <h4><a href="widget_title_url">widget title</a></h4> ( if widet url is not empty )
 */

if( ! function_exists( 'vmagazine_widget_title' ) ):
  function vmagazine_widget_title( $widget_title, $vmagazine_cat_id ) {
    if( empty($widget_title) && empty( $vmagazine_cat_id ) ) {
      return;
    }
?>
    <h4 class="block-title"><span class="title-bg">
<?php
    if( !empty( $widget_title ) ) {
      echo esc_html( $widget_title );
    } else {
      echo get_cat_name( $vmagazine_cat_id );
    }
?>
    </span></h4>
<?php
  }
endif;


function vmagazine_html_widget_title( $old_title ) {

  if(  is_page_template('tpl-blank.php') ){
    $output = '<span class="title-bg">';
    $output .= $old_title;
    $output .= '</span>';
    return $output;
  }else{
    return $old_title;
  }

}
add_filter( 'widget_title', 'vmagazine_html_widget_title' );

/*===========================================================================================================*/
/**
 * Function about custom query arguments
 * 
 * @param string $vmagazine_query_type (required options "latest_posts" or "   ")
 * @param int $vmagazine_post_count
 * @param int $vmagazine_cat_id
 * @return array $vmagazine_args
 */
if( ! function_exists( 'vmagazine_query_args' ) ) :
    function vmagazine_query_args( $vmagazine_query_type, $vmagazine_post_count, $vmagazine_cat_id = null) {

        if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
        elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
        else { $paged = 1; }
        
        if( $vmagazine_query_type == 'category_posts' && !empty( $vmagazine_query_type ) ) {
           $vmagazine_args = array(
               'post_type'      => 'post',
               'paged'          => $paged,
               'category__in'   => $vmagazine_cat_id,
               'posts_per_page' => $vmagazine_post_count,                       
               );
       } elseif( $vmagazine_query_type == 'latest_posts' ) {
           $vmagazine_args = array(
               'post_type'            => 'post',  
               'paged'                => $paged,                 
               'posts_per_page'       => $vmagazine_post_count,
               'ignore_sticky_posts'  => 1
               );

       }else{
        $vmagazine_args = array(
               'post_type'            => 'post',
               'orderby'              => 'rand',  
               'paged'                => $paged,                 
               'posts_per_page'       => $vmagazine_post_count,
               'ignore_sticky_posts'  => 1
               );
       }
       return $vmagazine_args;
   }
   endif;


/*--------------------------------------------------------------------------------------------------------*/
/**
 * Title for tab in Tabbed Widget
 * 
 * @param $tabbed_title string
 * @param $vmagazine_cat_id intiger
 *
 * @return $tabbed_title or $category_title if parameter is empty
 *
 */
if( ! function_exists( 'vmagazine_tabbed_title' ) ):
  function vmagazine_tabbed_title( $tabbed_title, $vmagazine_cat_id ) {
    if( !empty( $tabbed_title ) ) {
      echo esc_html( $tabbed_title );
    } else {
      echo get_cat_name( $vmagazine_cat_id );
    }
  }
endif;
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Name of child category for ajax used
 */
if( ! function_exists( 'vmagazine_child_cat_name' ) ):
  function vmagazine_child_cat_name( $vmagazine_cats_id ) {
    
    if( empty( $vmagazine_cats_id ) ) {
      return;
    }
    echo '<div class="child-cat-tabs"><ul class="vmagazine-tab-links">';
    foreach ( $vmagazine_cats_id as $key => $term_id ) {
      $term = get_term_by( 'id', $key, 'category' );
      echo '<li><a href="javascript:void(0)" data-id="' . intval( $key ) . '" data-slug="' . esc_attr( $term->slug ) . '">' . $term->name . '</a></li>';
    }
    echo '</ul></div>';
  }
endif;

/*--------------------------------------------------------------------------------------------------------*/
/**
 * View all button in block section
 */
if( !function_exists( 'vmagazine_block_view_all' ) ):
  function vmagazine_block_view_all( $vmagazine_block_cat_id, $view_all_text ) {
    if( $vmagazine_block_cat_id != null ) {
      $vmagazine_block_cat_link = get_category_link( $vmagazine_block_cat_id );
?>
      <span class="view-all"><a href="<?php echo esc_url( $vmagazine_block_cat_link ); ?>"><?php echo esc_html( $view_all_text ); ?></a></span>
<?php
    }
  }
endif;

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue all widget's admin scripts
 */
function vmagazine_widget_enqueue_scripts(){
    
    wp_enqueue_style( 'vmagazine-widget',VMAG_URI.'/inc/widgets/assets/vmagazine_wie.css', array(), VMAG_VER );
    wp_enqueue_script( 'vmagazine-widget',VMAG_URI.'/inc/widgets/assets/vmagazine_wie.js', array( 'jquery' ), VMAG_VER, true );
}
add_action( 'admin_print_scripts-widgets.php', 'vmagazine_widget_enqueue_scripts' );
// Add this to enqueue your scripts on Page Builder too
add_action('siteorigin_panel_enqueue_admin_scripts', 'vmagazine_widget_enqueue_scripts');

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Load individual widgets file and required related files too.
 */

require get_template_directory() . '/inc/widgets/widget-fields.php'; // widget fields
require get_template_directory() . '/inc/widgets/vmagazine-featured-slider.php'; // Feature slider
require get_template_directory() . '/inc/widgets/vmagazine-fullwidth-slider.php'; // Fullwidth slider
require get_template_directory() . '/inc/widgets/vmagazine-multiple-category.php'; // Multiple category posts
require get_template_directory() . '/inc/widgets/vmagazine-categories-tab.php'; // Categories Tab
require get_template_directory() . '/inc/widgets/vmagazine-post-column.php'; // Post column
require get_template_directory() . '/inc/widgets/vmagazine-grid-list.php'; // Grid/List
require get_template_directory() . '/inc/widgets/vmagazine-posts-carousel.php'; //post Carousel
require get_template_directory() . '/inc/widgets/vmagazine-category-slider.php'; // Category posts slider
require get_template_directory() . '/inc/widgets/vmagazine-slider-tab.php'; // Slider Tab
require get_template_directory() . '/inc/widgets/vmagazine-timeline-posts.php'; // Timeline Posts
require get_template_directory() . '/inc/widgets/vmagazine-medium-ad.php'; // Medium ad
require get_template_directory() . '/inc/widgets/vmagazine-footer-info.php'; // Footer-info
require get_template_directory() . '/inc/widgets/vmagazine-recent-posts.php';
require get_template_directory() . '/inc/widgets/vmagazine-slider-tab-carousel.php';
require get_template_directory() . '/inc/widgets/vmagazine-multiple-category-tabbed.php';
require get_template_directory() . '/inc/widgets/vmagazine-block-post-slider.php';
require get_template_directory() . '/inc/widgets/vmagazine-fb-like.php';//Facebook page like 
require get_template_directory() . '/inc/widgets/vmagazine-flicker-stream.php';//Flicker gallery
require get_template_directory() . '/inc/widgets/vmagazine-video-playlist.php';// Youtube Video Playlist
require get_template_directory() . '/inc/widgets/vmagazine-media-player.php';// Media player
require get_template_directory() . '/inc/widgets/vmagazine-top-trending-block.php';// trending news section
require get_template_directory() . '/inc/widgets/vmagazine-block-post-carousel(small).php';
require get_template_directory() . '/inc/widgets/vmagazine-about-author.php';