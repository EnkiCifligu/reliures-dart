<?php
/**
 * Vmagazine: Block Post Slider
 *
 * Widget to display latest or selected category posts as Tab styles
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_block_post_slider_widget' );

function vmagazine_block_post_slider_widget() {
    register_widget( 'vmagazine_block_post_slider' );
}

class Vmagazine_Block_Post_Slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'vmagazine_block_post_slider',
            'description' => __( 'Display posts from selected category as tabbed slider.', 'vmagazine' ),
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_block_post_slider', esc_html__( 'Vmagazine : Block Post Slider', 'vmagazine' ), $widget_ops,$width );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global   $vmagazine_cat_array;

        $fields = array(
            
        //widget wrapper div start
        'block_wrapper_start' => array(
            'vmagazine_widgets_name'    => 'block_wrapper_start',
            'vmagazine_widgets_class'   => 'vmagazine_admin_widget_wrapper',
            'vmagazine_widgets_field_type'   => 'section_wrapper_start'
        ),
            
            'block_layout' => array(
                'vmagazine_widgets_name'         => 'block_layout',
                'vmagazine_widgets_title'        => esc_html__( 'Layout will be like this', 'vmagazine' ),
                'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'bps.png',
                'vmagazine_widgets_field_type'   => 'widget_layout_image'
            ),
            
            //widget tabs
            'block_tab_control' => array(
                'vmagazine_widgets_name'            => 'block_tab_control',
                'vmagazine_widgets_field_type'      => 'section_tab_wrapper',
                'vmagazine_widgets_default'         => 'vmagazine_widget_general',
                'vmagazine_widgets_field_options'   => array(
                    'vmagazine_widget_general' => esc_html__('General','vmagazine'),
                    'vmagazine_widget_advanced'=> esc_html__('Advanced Settings','vmagazine'),
                )
            ),
            //general settings wrapper
            'tab_wrapper_general_start' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_general_start',
                'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine_widget_general',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),

                'block_title' => array(
                    'vmagazine_widgets_name'         => 'block_title',
                    'vmagazine_widgets_title'        => esc_html__( 'Block Title', 'vmagazine' ),
                    'vmagazine_widgets_field_type'   => 'text'
                ),

                'block_multi_cats' => array(
                    'vmagazine_widgets_name' => 'block_multi_cats',
                    'vmagazine_widgets_title' => esc_html__( 'Select categories', 'vmagazine' ),
                    'vmagazine_widgets_field_type' => 'multicheckboxes',
                    'vmagazine_widgets_field_options' => $vmagazine_cat_array
                ),

                'block_posts_count' => array(
                    'vmagazine_widgets_name'         => 'block_posts_count',
                    'vmagazine_widgets_title'        => esc_html__( 'No. of Posts', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 10,
                    'vmagazine_widgets_field_type'   => 'number'
                ),
             
            'tab_wrapper_general_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_general_end',
                'vmagazine_widgets_field_type'   => 'section_wrapper_end'
            ),
            
            //Advanced settings wrapper
            'tab_wrapper_adv_start' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_adv_start',
                'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine-hidden vmagazine_widget_advanced',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),
            
                'block_section_meta' => array(
                    'vmagazine_widgets_name' => 'block_section_meta',
                    'vmagazine_widgets_title' => esc_html__( 'Hide/Show Meta', 'vmagazine' ),
                    'vmagazine_widgets_default'=>'show',
                    'vmagazine_widgets_field_options'=>array('show'=>'Show','hide'=>'Hide'),
                    'vmagazine_widgets_field_type' => 'switch',
                    'vmagazine_widgets_description'  => esc_html__('Show or hide post meta options like author name, post date etc','vmagazine'),
                ),

                'block_tabs_color' => array(
                    'vmagazine_widgets_name' => 'block_tabs_color',
                    'vmagazine_widgets_title' => esc_html__( 'Tab Text Color', 'vmagazine' ),
                    'vmagazine_widgets_field_type' => 'color'
                ),
                 'block_tabs_color_active' => array(
                    'vmagazine_widgets_name' => 'block_tabs_color_active',
                    'vmagazine_widgets_title' => esc_html__( 'Tab Text Color: Active', 'vmagazine' ),
                    'vmagazine_widgets_field_type' => 'color'
                ),
            
            'tab_wrapper_adv_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_adv_end',
                'vmagazine_widgets_field_type'   => 'section_wrapper_end'
            ),
            
        //widget wrapper div closing
        'block_wrapper_end' => array(
            'vmagazine_widgets_name'    => 'block_wrapper_end',
            'vmagazine_widgets_field_type'   => 'section_wrapper_end'
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
        $vmagazine_block_posts_count = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];
        $vmagazine_block_multi_cats = empty( $instance['block_multi_cats'] ) ? null : $instance['block_multi_cats'];
        $block_section_meta = isset( $instance['block_section_meta'] ) ? $instance['block_section_meta'] : 'show';
        $block_tabs_color = empty($instance['block_tabs_color']) ? null : $instance['block_tabs_color'];
        $block_tabs_color_active = empty($instance['block_tabs_color_active']) ? null : $instance['block_tabs_color_active'];
       
        if( !empty( $vmagazine_block_multi_cats ) ) {
            $first_cat_id = key( $vmagazine_block_multi_cats );
            $first_cat_slug = get_term_by( 'id', $first_cat_id , 'category' );
            if( $first_cat_slug ){
                $first_cat_slug = $first_cat_id;//$first_cat_slug->slug;    
            }else{
                $first_cat_slug = '';
            }
            
            $vmagazine_block_posts_type = 'category_posts';
        } if( empty($first_cat_id) || empty($first_cat_slug) ) {
            $terms = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            ) );
            if($terms[1]){
                $first_cat_id = $terms[1]->term_id;
                $first_cat_slug = $first_cat_id;//$terms[1]->slug;
            }else{
                $first_cat_id = '';
                 $first_cat_slug = '';
            }
            $vmagazine_block_posts_type = '';
        }


        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-block-post-slider block-post-wrapper clearfix">
            <div class="block-header clearfix">
                <?php
                    vmagazine_widget_title( $vmagazine_block_title, $cat_id=null );
                    echo '<div class="multiple-child-cat-tabs-post-slider"><ul class="vmagazine-tabbed-post-slider">';
                    foreach ( $vmagazine_block_multi_cats as $key => $term_id ) {
                        $term = get_term_by( 'id', $key, 'category' );
                        if(!empty( $term )){
                            echo '<li><a href="javascript:void(0)" data-id="' . intval( $key ) . '" data-slug="' . intval( $key ) . '" data-link="'.get_term_link($term->slug, 'category').'" data-offset="'.absint($vmagazine_block_posts_count).'">' . $term->name . '</a></li>';

                        }
                    }
                    echo '</ul></div>';
                ?>
            </div><!-- .block-header-->
            <div class="block-content-wrapper">
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
                <div class="block-cat-content <?php echo esc_attr( $first_cat_slug ); ?>" data-slug="<?php echo esc_attr( $first_cat_slug ); ?>">

            <?php
                if( !empty( $first_cat_id ) ) {
                    $block_cat_id = $first_cat_id;
                } else {
                    $block_cat_id = $vmagazine_block_cat_id;
                }

                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $block_cat_id );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                $post_counter = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ) { ?>
                   <div class="block-post-slider-wrapper"> 
                    <?php 
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $post_count++;
                        $post_counter++;
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
                                                <?php if( $block_section_meta == 'show' ): ?>
                                                <div class="post-meta clearfix">
                                                    <?php do_action( 'vmagazine_icon_meta' ); ?>
                                                </div>
                                                 <?php endif; ?>  
                                                <h3 class="large-font">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
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
                                        <?php if( $block_section_meta == 'show' ): ?>
                                        <div class="post-meta clearfix">
                                            <?php do_action( 'vmagazine_icon_meta' ); ?>
                                        </div>
                                        <?php endif; ?>  
                                        <h3 class="large-font">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                               </div>
                            <?php if( ($post_count == 5) || ($total_posts_count == $post_counter) ){ ?>
                                   </div><!-- .small-thumbs-inner -->
                                    </div><!-- .small-thumbs-wrapper -->  
                            <?php } ?>
                          <?php  }
                          if( ($post_count == 5) || ($total_posts_count == $post_counter) ){ ?>
                            </div>
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
            
            </div>
        </div><!-- .block-post-wrapper -->
    <?php
        echo wp_kses_post($after_widget);

        /**
        * Widget stylings
        */
        if( $block_tabs_color || $block_tabs_color_active ): 
        
        echo "
            <style type='text/css'>
            .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider ul.vmagazine-tabbed-post-slider li a{
                color: $block_tabs_color;
            }
            .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li.active a, .vmagazine-block-post-slider .block-header .multiple-child-cat-tabs-post-slider .vmagazine-tabbed-post-slider li a:hover{
                color: $block_tabs_color_active;
            }
            </style>
            ";
        endif;


    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    vmagazine_widgets_updated_field_value()      defined in vmag-widget-fields.php
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
     * @uses    vmagazine_widgets_show_widget_field()        defined in vmag-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $vmagazine_widgets_field_value = !empty( $instance[$vmagazine_widgets_name]) ? $instance[$vmagazine_widgets_name] : '';
            vmagazine_widgets_show_widget_field( $this, $widget_field, $vmagazine_widgets_field_value );
        }
    }
}