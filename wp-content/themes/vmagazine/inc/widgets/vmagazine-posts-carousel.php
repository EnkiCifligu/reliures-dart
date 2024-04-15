<?php
/**
 * Vmagazine: Block Posts (Carousel)
 *
 * Widget to display latest or selected category posts as on carousel style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_block_posts_carousel_widget' );

function vmagazine_register_block_posts_carousel_widget() {
    register_widget( 'vmagazine_block_posts_carousel' );
}

class vmagazine_Block_Posts_Carousel extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_block_posts_carousel',
            'description' => esc_html__( 'Display posts from selected category or latest.', 'vmagazine' )
        );
        parent::__construct( 'vmagazine_block_posts_carousel', esc_html__( 'Vmagazine : Block Posts(Carousel)', 'vmagazine' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown; 
        
        $fields = array(

            'block_post_layout' => array(
                'vmagazine_widgets_name' => 'block_post_layout',
                'vmagazine_widgets_title' => esc_html__( 'Block Layouts', 'vmagazine' ),
                'vmagazine_widgets_description' => esc_html__( 'Choose the block layout.', 'vmagazine' ),
                'vmagazine_widgets_default'      => 'block_layout_1',
                'vmagazine_widgets_field_type' => 'radioimg',
                'vmagazine_widgets_field_options' => array(
                    'block_layout_1' =>  VMAG_WIDGET_IMG_URI.'bpc-1.png',
                    'block_layout_2' =>  VMAG_WIDGET_IMG_URI.'bpc-1.1.png',
                )
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
                'vmagazine_widgets_default'      => 3,
                'vmagazine_widgets_field_type'   => 'number'
            ),

            
            'block_section_meta' => array(
                'vmagazine_widgets_name' => 'block_section_meta',
                'vmagazine_widgets_title' => esc_html__( 'Hide/Show Meta Description', 'vmagazine' ),
                'vmagazine_widgets_default'=>'show',
                'vmagazine_widgets_field_options'=>array('show'=>'Show','hide'=>'Hide'),
                'vmagazine_widgets_field_type' => 'switch'
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

        $vmagazine_block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $vmagazine_block_posts_count = empty( $instance['block_posts_count'] ) ? 3 : $instance['block_posts_count'];
        $vmagazine_block_posts_type    = empty( $instance['block_post_type'] ) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id    = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        $vmagazine_block_layout = empty($instance['block_post_layout']) ? 'block_layout_1' : $instance['block_post_layout'];
        
        $block_section_meta = isset( $instance['block_section_meta'] ) ? $instance['block_section_meta'] : 'show';

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-post-carousel block-post-wrapper wow zoomIn <?php echo esc_attr($vmagazine_block_layout);?>" data-wow-duration="0.7s">
            <?php if( $vmagazine_block_title ): ?>
            <div class="block-header clearfix">
                <h4 class="block-title">
                    <span class="title-bg">
                        <?php echo esc_html($vmagazine_block_title); ?>
                    </span>
                </h4>
            </div><!-- .block-header-->    
            <?php endif; ?>
                <?php 
                    $title_font_size = 'large-font';
                    if( $vmagazine_block_layout == 'block_layout_1'){
                        $img_size = 'vmagazine-rect-post-carousel';
                    }else{
                        $img_size = 'vmagazine-large-square-thumb';
                    }
                    
                ?>
            
            <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    echo '<div class="block-carousel sl-before-load">';
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $img_src = vmagazine_home_element_img($img_size);
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

            ?>
                        <div class="single-post clearfix">
                            <div class="post-thumb">
                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($image_alt); ?>" title="<?php the_title(); ?>" />
                            </div>
                                <?php do_action( 'vmagazine_post_format_icon' ); ?>
                                <div class="post-caption">
                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
                                    <?php if( $vmagazine_block_layout == 'block_layout_1'){ ?>
                                        <?php if( $block_section_meta == 'show' ): ?>
                                            <div class="post-meta">
                                                <?php do_action( 'vmagazine_icon_meta' ); ?>
                                            </div>
                                        <?php endif; ?> 
                                    <?php } ?>
                                    <h3 class="<?php echo esc_attr( $title_font_size ); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php if( $vmagazine_block_layout == 'block_layout_2'){ ?>
                                         <?php if( $block_section_meta == 'show' ): ?>
                                            <div class="post-meta">
                                                <?php do_action( 'vmagazine_icon_meta' ); ?>
                                            </div>
                                        <?php endif; ?> 
                                    <?php } ?>
                                </div><!-- .post-caption -->
                            
                        </div><!-- .single-post -->
            <?php
                    }
                    echo '</div>';
                }
                wp_reset_query();
            ?>
        <div class="crs-layout-action">
           <div class="vmagazine-lSPrev"></div>
           <div class="vmagazine-lSNext"></div>
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
     * @uses    vmagazine_widgets_updated_field_value()      defined in vmagazine-widget-fields.php
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
     * @uses    vmagazine_widgets_show_widget_field()        defined in vmagazine-widget-fields.php
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