<?php
/**
 * Vmagazine: Block Post Carousel(small)
 *
 *
 * Displays posts in smaller carousel format like news ticker
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_post_carousel_small_widget' );

function vmagazine_post_carousel_small_widget() {
    register_widget( 'Vmagazine_Post_Carousel_Small' );
}

class Vmagazine_Post_Carousel_Small extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'Vmagazine_Post_Carousel_Small',
            'description' => esc_html__( 'Display small carousel slider  .', 'vmagazine' )
        );
        parent::__construct( 'Vmagazine_Post_Carousel_Small', esc_html__( 'Vmagazine: Carousel Slider(Small)', 'vmagazine' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown;
        
        $fields = array(

             'block_layout' => array(
                'vmagazine_widgets_name'         => 'block_layout',
                'vmagazine_widgets_title'        => esc_html__( 'Layout will be like this', 'vmagazine' ),
                'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'css.png',
                'vmagazine_widgets_field_type'   => 'widget_layout_image'
            ),

             'block_title' => array(
                'vmagazine_widgets_name'         => 'block_title',
                'vmagazine_widgets_title'        => esc_html__( 'Block Title', 'vmagazine' ),
                'vmagazine_widgets_field_type'   => 'text'
            ),

            'block_post_type' => array(
                'vmagazine_widgets_name' => 'block_post_type',
                'vmagazine_widgets_title' => esc_html__( 'Block posts: ', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'radio',
                'vmagazine_widgets_default' => 'latest_posts',
                'vmagazine_widgets_field_options' => $vmagazine_posts_type
            ),

            'block_post_category' => array(
                'vmagazine_widgets_name' => 'block_post_category',
                'vmagazine_widgets_title' => esc_html__( 'Category for Block Posts', 'vmagazine' ),
                'vmagazine_widgets_default'      => 0,
                'vmagazine_widgets_field_type' => 'select',
                'vmagazine_widgets_field_options' => $vmagazine_cat_dropdown
            ),
            'block_posts_count' => array(
                'vmagazine_widgets_name'         => 'block_posts_count',
                'vmagazine_widgets_title'        => esc_html__( 'No. of Posts', 'vmagazine' ),
                'vmagazine_widgets_default'      => 4,
                'vmagazine_widgets_field_type'   => 'number'
            ),

            
                        
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }
        $vmagazine_block_title       = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $vmagazine_block_posts_count = empty($instance['block_posts_count']) ? 4 : $instance['block_posts_count'];
        $vmagazine_block_posts_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id = empty($instance['block_post_category']) ? null: $instance['block_post_category'];

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-block-post-car-small block-post-wrapper">
            <?php if( $vmagazine_block_title ): ?>
            <h4 class="block-title">
                <span class="title-bg">
                    <?php echo esc_html($vmagazine_block_title); ?>
                </span>
            </h4>
            <?php endif; ?>

            <div class="carousel-wrap cS-hidden">
            <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        $img_src = vmagazine_home_element_img('vmagazine-large-square-middle');
            ?>
                        <div class="single-post clearfix wow fadeInUp" data-wow-duration="0.7s">
                                
                                <div class="post-thumb">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title(); ?>" />
                                    <div class="image-overlay"></div>
                                        
                                </div><!-- .post-thumb -->
                                <div class="post-content-wrapper clearfix">
                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
                                    <h3 class="extra-large-font">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="date">
                                        <?php
                                            $date = get_the_date();
                                            echo esc_html($date);
                                        ?>
                                    </div>
                                    
                                </div><!-- .post-content-wrapper -->
                           
                        </div><!-- .single-post  -->
                        <?php
                    }
                }
                wp_reset_query();
            ?>
            </div> 
                      
            
        </div><!-- .block-post-wrapper -->
    <?php
        echo wp_kses_post($after_widget);



    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    vmagazine_widgets_updated_field_value()      defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$vmagazine_widgets_name] = vmagazine_widgets_updated_field_value( $widget_field, $new_instance[$vmagazine_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    vmagazine_widgets_show_widget_field()        defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $vmagazine_widgets_field_value = !empty( $instance[$vmagazine_widgets_name]) ? esc_attr($instance[$vmagazine_widgets_name] ) : '';
            vmagazine_widgets_show_widget_field( $this, $widget_field, $vmagazine_widgets_field_value );
        }
    }
}