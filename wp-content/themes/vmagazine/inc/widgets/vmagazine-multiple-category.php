<?php
/**
 * Vmag: Block Posts (Multiple category)
 *
 * Widget to display latest or selected category posts as block one style.
 *
 * @package AccessPress Themes
 * @subpackage VMag Pro
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_block_posts_ajax_widget' );

function vmagazine_register_block_posts_ajax_widget() {
    register_widget( 'vmagazine_block_posts_ajax' );
}

class vmagazine_Block_Posts_Ajax extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'vmagazine_block_posts_ajax',
            'description' => esc_html__( 'Display posts from selected category or latest.', 'vmagazine' )
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_block_posts_ajax', esc_html__( 'Vmagazine : Multiple Category Block', 'vmagazine' ), $widget_ops, $width );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown, $vmag_tab_options, $vmagazine_cat_array;

        $fields = array(
            //widget wrapper div start
            'block_wrapper_start' => array(
                'vmagazine_widgets_name'    => 'block_wrapper_start',
                'vmagazine_widgets_class'   => 'vmagazine_admin_widget_wrapper',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),
            
                 'block_ajax_layout' => array(
                    'vmagazine_widgets_name' => 'block_ajax_layout',
                    'vmagazine_widgets_title' => esc_html__( 'Available Layouts', 'vmagazine' ),
                    'vmagazine_widgets_description' => esc_html__( 'Choose layout from available options.', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 'block_layout_1',
                    'vmagazine_widgets_field_type' => 'radioimg',
                    'vmagazine_widgets_field_options' => array(
                        'block_layout_1' =>  VMAG_WIDGET_IMG_URI.'mcb-1.png',
                        'block_layout_2' =>  VMAG_WIDGET_IMG_URI.'mcb-2.png',
                    )
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
                        'vmagazine_widgets_title'        => esc_html__( 'No. Of Posts', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 5,
                        'vmagazine_widgets_field_type'   => 'number'
                    ),
                    'block_section_excerpt' => array(
                        'vmagazine_widgets_name' => 'block_section_excerpt',
                        'vmagazine_widgets_title' => esc_html__( 'Excerpt For Post Description', 'vmagazine' ),
                        'vmagazine_widgets_description' => esc_html__( 'Enter excerpts in number of letters default: 200 &#40; this will only work on first layout &#41;', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'number',
                        'vmagazine_widgets_default'     => 200
                    ),
                    'block_view_all_text' => array(
                        'vmagazine_widgets_name' => 'block_view_all_text',
                        'vmagazine_widgets_title' => esc_html__( 'View All Button Text', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'text',
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
                        'vmagazine_widgets_title' => esc_html__( 'Show/Hide Meta', 'vmagazine' ),
                        'vmagazine_widgets_default'=>'show',
                        'vmagazine_widgets_field_options'=>array('show'=>'Show','hide'=>'Hide'),
                        'vmagazine_widgets_field_type' => 'switch',
                        'vmagazine_widgets_description'  => esc_html__('Show or hide post meta options like author name, post date etc','vmagazine'),
                    ),
                   
                    'block_section_border_color' => array(
                        'vmagazine_widgets_name' => 'block_section_border_color',
                        'vmagazine_widgets_title' => esc_html__( 'Post Seperator Border Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),
                    'block_section_btn_txt_color' => array(
                        'vmagazine_widgets_name' => 'block_section_btn_txt_color',
                        'vmagazine_widgets_title' => esc_html__( 'View All Button Text Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),  
                    'block_section_btn_txt_color_hover' => array(
                        'vmagazine_widgets_name' => 'block_section_btn_txt_color_hover',
                        'vmagazine_widgets_title' => esc_html__( 'View All Button Text Color: Hover', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),  
                    'block_section_btn_border_color' => array(
                        'vmagazine_widgets_name' => 'block_section_btn_border_color',
                        'vmagazine_widgets_title' => esc_html__( 'View All Button Border Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),
                    'block_section_tab_color' => array(
                        'vmagazine_widgets_name' => 'block_section_tab_color',
                        'vmagazine_widgets_title' => esc_html__( 'Tab Text Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),
                    'block_section_tab_color_active' => array(
                        'vmagazine_widgets_name' => 'block_section_tab_color_active',
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
        $vmagazine_block_layout = empty( $instance['block_ajax_layout'] ) ? 'block_layout_1' : $instance['block_ajax_layout'];
        $block_view_all_text = isset( $instance['block_view_all_text'] ) ? $instance['block_view_all_text']  : '';
        $block_section_excerpt = empty($instance['block_section_excerpt']) ? '' : $instance['block_section_excerpt'];
        $block_section_meta = isset( $instance['block_section_meta'] ) ? $instance['block_section_meta'] : 'show';

        $block_section_border_color = empty($instance['block_section_border_color']) ? null : $instance['block_section_border_color'];
        
        $block_section_btn_txt_color = empty($instance['block_section_btn_txt_color']) ? null : $instance['block_section_btn_txt_color'];
        $block_section_btn_txt_color_hover = empty($instance['block_section_btn_txt_color_hover']) ? null : $instance['block_section_btn_txt_color_hover'];
        $block_section_btn_border_color = empty($instance['block_section_btn_border_color']) ? null : $instance['block_section_btn_border_color'];
        $block_section_tab_color = empty($instance['block_section_tab_color']) ? null : $instance['block_section_tab_color'];
        $block_section_tab_color_hover = empty($instance['block_section_tab_color_hover']) ? null : $instance['block_section_tab_color_hover'];


        if( !empty( $vmagazine_block_multi_cats ) ) {
            $first_cat_id = key( $vmagazine_block_multi_cats );
            $first_cat_slug = get_term_by( 'id', $first_cat_id , 'category' );
            if( $first_cat_slug ){
                $first_cat_slug = $first_cat_id;//$first_cat_slug->slug;
            }
            $vmagazine_block_posts_type = 'category_posts';
        } if( empty($first_cat_id) || empty($first_cat_slug) ) {
             $terms = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            ) );
            if($terms[0]){
                    $first_cat_id = $terms[0]->term_id;
            }else{
                $first_cat_id = '';
            }
            $first_cat_slug = '';
            $vmagazine_block_posts_type = '';
        }

        if($vmagazine_block_layout=='block_layout_2'){
            $layout = 'layout-two';
        }else{
            $layout = 'layout-one';
        }

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-mul-cat block-post-wrapper <?php echo esc_attr($layout);?> clearfix">
            <div class="block-header clearfix">
                <?php
                    vmagazine_widget_title( $vmagazine_block_title, $title_url=null, $cat_id=null);
                    echo '<div class="child-cat-tabs"><ul class="vmagazine-tab-links">';
                    $li_order = 0;
                    foreach ( $vmagazine_block_multi_cats as $key => $term_id ) {
                        $li_order++;
                        $li_class = '';
                        if( $li_order == 1 ){
                            $li_class = ' class="active"';
                        }
                        $term = get_term_by( 'id', $key, 'category' );
                        if(!empty( $term )){
                            echo '<li'.$li_class.'>
                            <a href="javascript:void(0)" data-id="' . intval($key) . '" data-slug="' . intval($key) . '" data-link="'.get_term_link($term->slug, 'category').'" data-layout="'.esc_attr($vmagazine_block_layout).'" data-count="'.absint($vmagazine_block_posts_count).'" data-length="'.absint($block_section_excerpt).'" data-btn="'.esc_attr($block_view_all_text).'">' . $term->name . '</a>
                            </li>';

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
                <div class="block-cat-content <?php echo esc_attr( $first_cat_slug ); ?>">

            <?php
                if( !empty( $first_cat_id ) ) {
                    $block_cat_id = $first_cat_id;
                } else {
                    $block_cat_id = $first_cat_id;
                }

                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $block_cat_id );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
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
                                    <?php echo vmagazine_load_images($img_src); ?>
                                    <div class="image-overlay"></div>
                                </a>
                                <?php if( $post_count == 1 ) { do_action( 'vmagazine_post_format_icon' ); } ?>
                            </div><!-- .post-thumb -->
                            <div class="post-caption-wrapper">
                                <div class="post-caption-inner">
                                    <?php if( $block_section_meta == 'show' ): ?>
                                    <div class="post-meta clearfix">
                                        <?php do_action( 'vmagazine_icon_meta' ); ?>
                                    </div>
                                    <?php endif; ?>
                                    <h3 class="<?php echo esc_attr( $vmagazine_font_size ); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                             <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                                <?php if( ($vmagazine_block_layout=='block_layout_1') && ($post_count == 1) && $block_section_excerpt ){
                                    ?>
                                    <p> 
                                    <?php echo vmagazine_get_excerpt_content( absint($block_section_excerpt) )?> 
                                    </p>
                                <?php } ?>

                            </div><!-- .post-caption-wrapper -->
                            
                        </div><!-- .single-post -->
            <?php

                        if( ($vmagazine_block_layout=='block_layout_2') && ( $post_count < 3 ) ){
                            echo '</div>';
                        }elseif( $post_count == 1 || $post_count == $total_posts_count ) {
                            if( $post_count == $total_posts_count ){
                                if( $block_view_all_text ){
                                    $vmagazine_block_view_all_text = esc_html($block_view_all_text);
                                    vmagazine_block_view_all( $block_cat_id, $vmagazine_block_view_all_text );    
                                }
                                
                            }
                            echo '</div>';
                        }
                        
                    }
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
        if($block_section_btn_txt_color || $block_section_btn_txt_color_hover || $block_section_btn_border_color || $block_section_tab_color || $block_section_tab_color_hover || $block_section_border_color ): 
        
        echo "
            <style type='text/css'>
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-content-wrapper .right-posts-wrapper .view-all a{
                color: $block_section_btn_txt_color;
            }
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-content-wrapper .right-posts-wrapper .view-all a:hover{
                color: $block_section_btn_txt_color_hover;
            }
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-content-wrapper .right-posts-wrapper .view-all a{
                border-color: $block_section_btn_border_color;
            }
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-header .child-cat-tabs .vmagazine-tab-links li a{
                color: $block_section_tab_color;
            }
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-header .child-cat-tabs .vmagazine-tab-links li.active a, .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-header .child-cat-tabs .vmagazine-tab-links li a:hover{
                color: $block_section_tab_color_hover;
            }
            
            .vmagazine-mul-cat.block-post-wrapper.{$layout} .block-content-wrapper .right-posts-wrapper .single-post{
                border-color: $block_section_border_color;
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