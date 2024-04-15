<?php
/**
 * Vmagazine: Block Posts (Column)
 *
 * Widget to display latest or selected category posts as block one style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_block_posts_column_widget' );

function vmagazine_register_block_posts_column_widget() {
    register_widget( 'vmagazine_block_posts_column' );
}

class vmagazine_Block_Posts_Column extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_block_posts_column',
            'description' => esc_html__( 'Display posts from selected category or latest.', 'vmagazine' )
        );
         $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_block_posts_column', esc_html__( 'Vmagazine : Block Posts(Column)', 'vmagazine' ), $widget_ops,$width );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown, $vmagazine_block_post_layout_col;
        
        $fields = array(
            //widget wrapper div start
            'block_wrapper_start' => array(
                'vmagazine_widgets_name'    => 'block_wrapper_start',
                'vmagazine_widgets_class'   => 'vmagazine_admin_widget_wrapper',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),
                'block_column_layout' => array(
                    'vmagazine_widgets_name' => 'block_column_layout',
                    'vmagazine_widgets_title' => esc_html__( 'Block Column Layouts', 'vmagazine' ),
                    'vmagazine_widgets_description' => esc_html__( 'Choose the column layout from available options.', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 'block_layout_1',
                    'vmagazine_widgets_field_type' => 'radioimg',
                        'vmagazine_widgets_field_options' => array(
                        'block_layout_1' =>  VMAG_WIDGET_IMG_URI.'pc-1.png',
                        'block_layout_3' =>  VMAG_WIDGET_IMG_URI.'pc-1.1.png',
                        'block_layout_4' =>  VMAG_WIDGET_IMG_URI.'pc-2.png',
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
                        'vmagazine_widgets_default'      => 5,
                        'vmagazine_widgets_field_type'   => 'number'
                    ),
                    'block_section_excerpt' => array(
                        'vmagazine_widgets_name' => 'block_section_excerpt',
                        'vmagazine_widgets_title' => esc_html__( 'Excerpt For Post Description', 'vmagazine' ),
                        'vmagazine_widgets_description' => esc_html__( 'Enter excerpts in number of letters or leave it blank to hide default: 180 &#40; this will work on first layout only &#41;', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'number',
                        'vmagazine_widgets_default'  => 180
                    ),
                     'block_view_all_text' => array(
                        'vmagazine_widgets_name' => 'block_view_all_text',
                        'vmagazine_widgets_title' => esc_html__( 'View All Text', 'vmagazine' ),
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

        $vmagazine_block_title = empty($instance['block_title']) ? '' : $instance['block_title'];
        $vmagazine_block_posts_count = empty($instance['block_posts_count']) ? 5 : $instance['block_posts_count'];
        $block_section_excerpt = empty($instance['block_section_excerpt']) ? '' : $instance['block_section_excerpt'];
        $vmagazine_block_posts_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id = empty($instance['block_post_category']) ? null: $instance['block_post_category'];
        $vmagazine_block_layout = empty($instance['block_column_layout']) ? 'block_layout_1': $instance['block_column_layout'];
        $vmagazine_block_view_all_text = empty($instance['block_view_all_text']) ? '' : $instance['block_view_all_text'];
        $block_section_meta = empty($instance['block_section_meta']) ? 'show' : $instance['block_section_meta'];
        $block_section_btn_txt_color = empty($instance['block_section_btn_txt_color']) ? null : $instance['block_section_btn_txt_color'];
        $block_section_btn_border_color = empty($instance['block_section_btn_border_color']) ? null : $instance['block_section_btn_border_color'];
        $block_section_btn_txt_color_hover = empty($instance['block_section_btn_txt_color_hover']) ? null : $instance['block_section_btn_txt_color_hover'];


        echo wp_kses_post($before_widget);
        ?>
        <div class="wrapper-vmagazine-post-col <?php echo esc_attr( $vmagazine_block_layout ); ?>">
        <?php vmagazine_widget_title( $vmagazine_block_title, $title_url=null, $vmagazine_block_cat_id ); ?>
        <div class="vmagazine-post-col block-post-wrapper <?php echo esc_attr( $vmagazine_block_layout ); ?> wow zoomIn" data-wow-duration="1s">
            <div class="block-header clearfix">
                
            </div><!-- .block-header-->
            <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        
                        $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        $post_class = '';
                        if( $post_count == 1 ) { 
                            $post_class = 'first-post'; 
                        } else {
                            $post_class = 'bottom-post';
                        }
                        if( $vmagazine_block_layout == 'block_layout_3' || $vmagazine_block_layout == 'block_layout_4'){
                            $vmagazine_font_size = 'small-font';
                        }elseif( ($vmagazine_block_layout == 'block_layout_1') && ($post_count == 1) ){
                            $vmagazine_font_size = 'large-font';
                        }else{
                            $vmagazine_font_size = 'small-font';
                        }
            ?>
                        <div class="single-post <?php echo esc_attr( $post_class ); ?> clearfix">
                        <?php if( $post_count == 1 || $vmagazine_block_layout == 'block_layout_2' || $vmagazine_block_layout == 'block_layout_3' ||  $vmagazine_block_layout == 'block_layout_4' ) { ?>
                            <div class="post-thumb">
                                <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php echo vmagazine_load_images($img_src); ?>
                                    <div class="image-overlay"></div>
                                </a>
                                <?php do_action( 'vmagazine_post_format_icon' ); ?>
                            </div>
                        <?php } ?>
                            <div class="content-wrapper">
                                <?php
                                 if( ($vmagazine_block_layout != 'block_layout_1') || ($post_count == 1) ){ 
                                    if( $block_section_meta == 'show' ): ?>
                                    <div class="post-meta clearfix">
                                        <?php  do_action( 'vmagazine_icon_meta' ); ?>
                                    </div><!-- .post-meta --> 
                                    <?php endif;
                                 } ?>
                                <h3 class="<?php echo esc_attr( $vmagazine_font_size ); ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <?php 
                                    if( ($post_count == 1) && ($vmagazine_block_layout != 'block_layout_3') ) {
                                        if($block_section_excerpt){
                                            if( $vmagazine_block_layout != 'block_layout_4'){
                                                echo '<p>'. vmagazine_get_excerpt_content( absint($block_section_excerpt) ) .'</p>';
                                            }
                                        }
                                    } ?>
                            </div><!-- .content-wrapper -->                          
                        </div><!-- .single-post -->
                        <?php
                    }
                }
                ?>
                <?php if( $vmagazine_block_view_all_text ): ?>
                <span class="view-all">
                    <a href="<?php the_permalink()?>">
                        <?php echo esc_html($vmagazine_block_view_all_text); ?>
                    </a>
                </span>
                <?php
                endif;
                wp_reset_postdata();
            ?>
        </div><!-- .block-post-wrapper -->
    </div>
    <?php
        echo wp_kses_post($after_widget);

        /**
        * Widget stylings
        */
        if($block_section_btn_txt_color || $block_section_btn_border_color || $block_section_btn_txt_color_hover ):
            
        echo "
            <style type='text/css'>
            
            .widget_vmagazine_block_posts_column .block-post-wrapper.{$vmagazine_block_layout} .view-all a{
                color: $block_section_btn_txt_color;
            }
            .widget_vmagazine_block_posts_column .block-post-wrapper.{$vmagazine_block_layout} .view-all a{
                border-color: $block_section_btn_border_color;
            }
            .widget_vmagazine_block_posts_column .block-post-wrapper.{$vmagazine_block_layout} .view-all a:hover{
                color: $block_section_btn_txt_color_hover;
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