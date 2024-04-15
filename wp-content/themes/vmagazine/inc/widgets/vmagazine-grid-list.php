<?php
/**
 * Vmagazine: Block Posts (List)
 *
 * Widget to display latest or selected category posts as on list style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_block_grid_list_widget' );

function vmagazine_register_block_grid_list_widget() {
    register_widget( 'vmagazine_block_grid_list' );
}

class vmagazine_Block_grid_List extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_block_grid_list',
            'description' => esc_html__( 'Display posts in grid or list format.', 'vmagazine' )
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_block_grid_list', esc_html__( 'Vmagazine : Grid/List Posts', 'vmagazine' ), $widget_ops, $width );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown,$vmagazine_pagination_layout;
        
        $fields = array(
            
            //widget wrapper div start
            'block_wrapper_start' => array(
                'vmagazine_widgets_name'    => 'block_wrapper_start',
                'vmagazine_widgets_class'   => 'vmagazine_admin_widget_wrapper',
                'vmagazine_widgets_field_type'   => 'section_wrapper_start'
            ),
            
                'block_post_layout' => array(
                    'vmagazine_widgets_name' => 'block_post_layout',
                    'vmagazine_widgets_title' => esc_html__( 'Block Layouts', 'vmagazine' ),
                    'vmagazine_widgets_description' => esc_html__( 'Choose the block layout from available options.', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 'grid',
                    'vmagazine_widgets_field_type' => 'radioimg',
                    'vmagazine_widgets_field_options' => array(
                         'grid' =>  VMAG_WIDGET_IMG_URI.'glp-1.png',
                         'list' =>  VMAG_WIDGET_IMG_URI.'glp-3.png',
                         'grid-two' =>  VMAG_WIDGET_IMG_URI.'glp-2.png',
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
                        'vmagazine_widgets_default'      => 4,
                        'vmagazine_widgets_field_type'   => 'number'
                    ),
                    'pagination_show' => array(
                        'vmagazine_widgets_name' => 'pagination_show',
                        'vmagazine_widgets_title' => esc_html__( 'Pagination Type', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 'view_all',
                        'vmagazine_widgets_field_type' => 'radio',
                        'vmagazine_widgets_field_options' => $vmagazine_pagination_layout
                    ), 

                    'block_view_all_text' => array(
                        'vmagazine_widgets_name'         => 'block_view_all_text',
                        'vmagazine_widgets_title'        => esc_html__( 'View All Button Text', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ), 
                    'block_section_excerpt' => array(
                        'vmagazine_widgets_name' => 'block_section_excerpt',
                        'vmagazine_widgets_title' => esc_html__( 'Excerpt For Post Description', 'vmagazine' ),
                        'vmagazine_widgets_description' => esc_html__( 'Enter excerpts in number of letters default: 200 &#40; this will only work on second and last layout &#41;', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'number',
                        'vmagazine_widgets_default' => 200
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
        $block_section_excerpt = empty($instance['block_section_excerpt']) ? '' : $instance['block_section_excerpt'];
        $vmagazine_block_posts_type    = empty( $instance['block_post_type'] ) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id    = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        $vmagazine_block_layout = empty( $instance['block_post_layout'] ) ? 'grid' : $instance['block_post_layout'];
        $vmagazine_block_view_all_text   = empty( $instance['block_view_all_text'] ) ? '': $instance['block_view_all_text'];
        
        $pagination_show = empty( $instance['pagination_show'] ) ? 'view_all' : $instance['pagination_show'];
        $block_section_meta = isset( $instance['block_section_meta'] ) ? $instance['block_section_meta'] : 'show';
        $block_section_border_color = empty($instance['block_section_border_color']) ? null : $instance['block_section_border_color'];
        $block_section_btn_txt_color = empty($instance['block_section_btn_txt_color']) ? null : $instance['block_section_btn_txt_color'];
        $block_section_btn_txt_color_hover = empty($instance['block_section_btn_txt_color_hover']) ? null : $instance['block_section_btn_txt_color_hover'];
        $block_section_btn_border_color = empty($instance['block_section_btn_border_color']) ? null : $instance['block_section_btn_border_color'];

        echo wp_kses_post($before_widget);

        $excerpt_class = ( $block_section_excerpt) ? 'element-has-desc' : 'no-desc';
    ?>
    <div class="vmagazine-grid-list-wrapp <?php echo esc_attr($vmagazine_block_layout.' '.$excerpt_class);?>">
    <div class="block-header clearfix">
        <?php 
            vmagazine_widget_title( $vmagazine_block_title, $title_url=null, $vmagazine_block_cat_id );
        ?>
    </div><!-- .block-header-->
        <div class="vmagazine-grid-list block-post-wrapper <?php echo esc_attr($vmagazine_block_layout);?>">
            
            <div class="posts-wrap">
                <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $paged=$block_args['paged'];
                $block_query = new WP_Query( $block_args );
                $post_count = 0 ;
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $post_count++;
                         $post_class = '';
                        if( $post_count == 1 ){
                            $post_class = 'first-post';
                        }
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        if( ($vmagazine_block_layout=='grid') || ($vmagazine_block_layout=='grid-two') ){
                            if( $post_count == 1 ){
                                $img_src = vmagazine_home_element_img('vmagazine-rectangle-thumb');    
                            }else{
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');    
                            }
                        }elseif($vmagazine_block_layout=='list'){
                            $img_src = vmagazine_home_element_img('vmagazine-post-slider-lg');
                        }else{
                            $img_src = vmagazine_home_element_img('full');
                        }
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="single-post <?php echo esc_attr($post_class);?> clearfix wow fadeInUp" data-wow-duration="0.7s">
                            <div class="post-thumb">
                                <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php echo vmagazine_load_images($img_src); ?>
                                    <div class="image-overlay"></div>
                                </a>
                                <?php 
                                if($vmagazine_block_layout == 'list' ){
                                    do_action( 'vmagazine_post_cat_or_tag_lists' );
                                 } ?>
                            </div><!-- .post-thumb -->
                            <div class="post-content-wrapper clearfix">
                                <?php if( $block_section_meta == 'show' ): ?>
                                <div class="post-meta clearfix">
                                   <?php do_action( 'vmagazine_icon_meta' ); ?>
                                </div><!-- .post-meta --> 
                                <?php endif; ?>                               
                                <h3 class="large-font">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <?php if( ($vmagazine_block_layout=='list') || ($vmagazine_block_layout=='grid-two') && ($block_section_excerpt) ) : ?>
                                    <div class="post-content">
                                      
                                       <p> 
                                        <?php echo vmagazine_get_excerpt_content( absint($block_section_excerpt) )?> 
                                        </p>
                                    </div><!-- .post-content --> 
                                <?php endif; ?>

                                
                            </div><!-- .post-content-wrapper -->
                        </div><!-- .single-post  -->
                        <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
               ?>
            </div>
            <?php 
            if($pagination_show=='view_all' && $vmagazine_block_view_all_text){
                vmagazine_block_view_all( $vmagazine_block_cat_id, $vmagazine_block_view_all_text );
            }
            elseif($pagination_show=='ajax_loader'){
            if($vmagazine_block_posts_type=='category_posts'){
                $id = 'id="'.$vmagazine_block_cat_id.'"';
            }else{
                $id = '';
            }?>
            <div class="gl-posts" <?php echo esc_attr($id);?> data-paged="<?php echo esc_attr($paged);?>" data-banner-offset="<?php echo absint($vmagazine_block_posts_count); ?>" data-offset="<?php echo esc_attr($vmagazine_block_posts_type);?>" data-type="<?php echo esc_attr($vmagazine_block_layout);?>" data-id="<?php echo absint($vmagazine_block_posts_count);?>" data-length="<?php echo absint($block_section_excerpt)?>">
                <?php if($vmagazine_block_view_all_text): ?>
                    <a href="javascript:void(0)" class="vm-ajax-load-more">
                    <span><?php echo esc_html($vmagazine_block_view_all_text);?></span>
                    <i class="fa fa-refresh"></i>
                    </a>
                <?php endif; ?>
            </div>
          
        <?php } ?>
                
            
        </div><!-- .block-post-wrapper -->
    </div>
    <?php
        echo wp_kses_post($after_widget);

         /**
        * Widget stylings
        */
        if( $block_section_btn_txt_color || $block_section_btn_txt_color_hover || $block_section_btn_border_color || $block_section_border_color):    
    
        echo "
            <style type='text/css'>
            .block-post-wrapper.{$vmagazine_block_layout} .gl-posts a.vm-ajax-load-more{
                color: $block_section_btn_txt_color;
            }
            .block-post-wrapper.{$vmagazine_block_layout} .gl-posts a.vm-ajax-load-more{
                border-color: $block_section_btn_border_color;
            }

            .block-post-wrapper.{$vmagazine_block_layout} .gl-posts a.vm-ajax-load-more:hover{
                color: $block_section_btn_txt_color_hover;
            }
            .vmagazine-grid-list.grid-two .single-post{
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