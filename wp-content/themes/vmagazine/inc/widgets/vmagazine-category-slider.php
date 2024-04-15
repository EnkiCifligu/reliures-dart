<?php
/**
 * Vmagazine: Category Posts (Slider)
 *
 * Widget to display selected category posts as on slider style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_category_posts_slider_widget' );

function vmagazine_register_category_posts_slider_widget() {
    register_widget( 'vmagazine_category_posts_slider' );
}

class vmagazine_Category_Posts_Slider extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_category_posts_slider',
            'description' => esc_html__( 'Display posts from selected category as slider.', 'vmagazine' )
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_category_posts_slider', esc_html__( 'Vmagazine : Category Posts(Slider)', 'vmagazine' ), $widget_ops , $width );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_cat_dropdown, $vmagazine_block_layout,$vmagazine_posts_type;
        
        $fields = array(

           
            //widget wrapper div start
            'block_wrapper_start' => array(
                'vmagazine_widgets_name'    => 'block_wrapper_start',
                'vmagazine_widgets_class'   => 'vmagazine_admin_widget_wrapper',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),

                'block_slider_layout' => array(
                    'vmagazine_widgets_name' => 'block_slider_layout',
                    'vmagazine_widgets_title' => esc_html__( 'Slider Layouts', 'vmagazine' ),
                    'vmagazine_widgets_description' => esc_html__( 'Choose the slider layout from available options.', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 'block_layout_1',
                    'vmagazine_widgets_field_type' => 'radioimg',
                    'vmagazine_widgets_field_options' => array(
                         'block_layout_1' =>  VMAG_WIDGET_IMG_URI.'cps-1.png',
                         'block_layout_2' =>  VMAG_WIDGET_IMG_URI.'cps-2.png',
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
                    'block_post_type' => array(
                        'vmagazine_widgets_name'        => 'block_post_type',
                        'vmagazine_widgets_title'       => esc_html__( 'Block posts: ', 'vmagazine' ),
                        'vmagazine_widgets_field_type'  => 'radio',
                        'vmagazine_widgets_default'     => 'latest_posts',
                        'vmagazine_widgets_field_options' => $vmagazine_posts_type
                    ),
                    'block_post_category' => array(
                        'vmagazine_widgets_name' => 'block_post_category',
                        'vmagazine_widgets_title' => esc_html__( 'Select Category for Slider', 'vmagazine' ),
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
                    'block_section_excerpt' => array(
                        'vmagazine_widgets_name' => 'block_section_excerpt',
                        'vmagazine_widgets_title' => esc_html__( 'Excerpt For Post Description', 'vmagazine' ),
                        'vmagazine_widgets_description' => esc_html__( 'Enter Excerpts in number of letters default: 180 &#40; exerpt will work on first layout only &#41;', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'number',
                        'vmagazine_widgets_default'     => 180
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
                        'vmagazine_widgets_title' => esc_html__( 'Hide/Show Meta', 'vmagazine' ),
                        'vmagazine_widgets_default'=>'show',
                        'vmagazine_widgets_field_options'=>array('show'=>'Show','hide'=>'Hide'),
                        'vmagazine_widgets_field_type' => 'switch',
                        'vmagazine_widgets_description'  => esc_html__('Show or hide post meta options like author name, post date etc','vmagazine'),
                    ),
                    'cat_bg_image' => array(
                        'vmagazine_widgets_name' => 'cat_bg_image',
                        'vmagazine_widgets_title' => esc_html__( 'Background Image', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'upload',
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
                        'vmagazine_widgets_title' => esc_html__( 'View All Button Border Color: Hover', 'vmagazine' ),
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

        $vmagazine_block_title       = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $vmagazine_block_posts_count = empty( $instance['block_posts_count'] ) ? 4 : $instance['block_posts_count'];
        $vmagazine_block_cat_id      = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        $block_post_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_slider_layout     = empty( $instance['block_slider_layout'] ) ? 'block_layout_1' : $instance['block_slider_layout'];
        $cat_slider_bg = empty( $instance['cat_bg_image'] ) ? '' : $instance['cat_bg_image'];
        $block_view_all_text = isset( $instance['block_view_all_text'] ) ? $instance['block_view_all_text']  : '';
        $block_section_excerpt = empty($instance['block_section_excerpt']) ? '' : $instance['block_section_excerpt'];

        if( $vmagazine_slider_layout == 'block_layout_2' ){
             $before_widget = str_replace('class="', 'class="'. $vmagazine_slider_layout . ' ', $before_widget);
        }
        if( $vmagazine_slider_layout == 'block_layout_1' ){
            $bg_image = 'style="background-image: url('.esc_url($cat_slider_bg).')"';
            $wid_wrapper_st = '<div class="content-wrapper-featured-slider">';
            $wid_wrapper_ed = '</div>';
        }else{
            $bg_image = '';
            $wid_wrapper_st = '';
            $wid_wrapper_ed = '';
        }

        $block_section_meta = empty($instance['block_section_meta']) ? 'show' : $instance['block_section_meta'];
        $block_section_btn_txt_color = empty($instance['block_section_btn_txt_color']) ? null : $instance['block_section_btn_txt_color'];
        $block_section_btn_txt_color_hover = empty($instance['block_section_btn_txt_color_hover']) ? null : $instance['block_section_btn_txt_color_hover'];
        $block_section_btn_border_color = empty($instance['block_section_btn_border_color']) ? null : $instance['block_section_btn_border_color'];

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-cat-slider block-post-wrapper <?php echo esc_attr( $vmagazine_slider_layout ); ?>" <?php echo wp_kses_post($bg_image);?>>
            
            <?php echo wp_kses_post($wid_wrapper_st); ?>
            <?php vmagazine_widget_title( $vmagazine_block_title, $vmagazine_block_cat_id); ?>
                <?php
                    $block_args = vmagazine_query_args( $block_post_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                    $block_query = new WP_Query( $block_args );
                    if( $block_query->have_posts() ) {
                        echo '<ul class="widget-cat-slider cS-hidden">';
                        while( $block_query->have_posts() ) {
                            $block_query->the_post();
                            $total_posts_count = $block_query->post_count+1;
                            $image_id = get_post_thumbnail_id();
                            if( $vmagazine_slider_layout == 'block_layout_1' ) {
                                $img_src = vmagazine_home_element_img('vmagazine-large-category');
                            } else {
                                $img_src = vmagazine_home_element_img('vmagazine-vertical-slider-thumb');
                            }                            
                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

                            if( $vmagazine_slider_layout == 'block_layout_1'){
                                $font_class = 'extra-large-font';
                            }else{
                                $font_class = 'small-font';
                            }

                            ?>
                            <li class="single-post clearfix">
                                <div class="post-thumb">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                </div>
                                <div class="post-caption">
                                    <?php 
                                    if($vmagazine_slider_layout == 'block_layout_1'){
                                        do_action( 'vmagazine_post_cat_or_tag_lists' ); 
                                    }
                                    if( $block_section_meta == 'show' ): ?>
                                    <div class="post-meta">
                                        <?php do_action( 'vmagazine_icon_meta' ); ?>
                                    </div>
                                    <?php endif; ?>
                                    <h3 class="<?php echo esc_attr($font_class);?>">
                                        <a href="<?php the_permalink(); ?>">
                                             <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php if( ($vmagazine_slider_layout == 'block_layout_1') && $block_section_excerpt ){ ?>
                                    <p>
                                      <?php 
                                        echo vmagazine_get_excerpt_content( absint($block_section_excerpt) );
                                      ?>
                                      <?php if( $block_view_all_text ): ?>
                                      <span class="read-more">
                                          <a href="<?php the_permalink();?>"><?php echo esc_html($block_view_all_text); ?></a>
                                      </span>
                                     <?php endif; ?>
                                    </p>
                                    <?php } ?>
                                </div><!-- .post-caption -->
                            </li><!-- .single-post -->
                            <?php
                        }
                        echo '</ul>';
                    }
                wp_reset_postdata();
            ?>
        <?php echo wp_kses_post($wid_wrapper_ed); ?><!-- .content-wrapper -->
        </div><!-- .block-post-wrapper -->
    <?php
        echo wp_kses_post($after_widget);

        /**
        * Widget stylings
        */
        if( $block_section_btn_txt_color || $block_section_btn_txt_color_hover || $block_section_btn_border_color ):
        echo "
            <style type='text/css'>
            .vmagazine-cat-slider.block-post-wrapper.{$vmagazine_slider_layout} .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p span.read-more a{
                color: $block_section_btn_txt_color;
            }
            .vmagazine-cat-slider.block-post-wrapper.{$vmagazine_slider_layout} .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p span.read-more a:hover{
                color: $block_section_btn_txt_color_hover;   
            }
            .vmagazine-cat-slider.block-post-wrapper.{$vmagazine_slider_layout} .content-wrapper-featured-slider .lSSlideWrapper li.single-post .post-caption p span.read-more a:hover{
                border-color: $block_section_btn_border_color;   
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