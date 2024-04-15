<?php
/**
 * Vmagazine: Categories Tabbed
 *
 * Widget to display selected category posts as on tabbed.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_categories_tabbed_widget' );

function vmagazine_register_categories_tabbed_widget() {
    register_widget( 'vmagazine_categories_tabbed' );
}

class vmagazine_Categories_Tabbed extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_categories_tabbed',
            'description' => esc_html__( 'Display category post in tabbed.', 'vmagazine' )
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_categories_tabbed', esc_html__( 'Vmagazine : Categories Tabbed', 'vmagazine' ), $widget_ops,$width );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_cat_dropdown;
        
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
                    'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'ct.png',
                    'vmagazine_widgets_field_type'   => 'widget_layout_image'
                ),
                
               'block_title' => array(
                    'vmagazine_widgets_name'         => 'block_title',
                    'vmagazine_widgets_title'        => esc_html__( 'Block Title', 'vmagazine' ),
                    'vmagazine_widgets_field_type'   => 'text'
                ),
                //widget tabs
                'block_tab_control' => array(
                    'vmagazine_widgets_name'            => 'block_tab_control',
                    'vmagazine_widgets_field_type'      => 'section_tab_wrapper',
                    'vmagazine_widgets_default'         => 'vmagazine_widget_general',
                    'vmagazine_widgets_field_options'   => array(
                        'vmagazine_widget_general' => esc_html__('First Tab','vmagazine'),
                        'vmagazine_widget_advanced'=> esc_html__('Second Tab','vmagazine'),
                        'vmagazine_widget_third'=> esc_html__('Third Tab','vmagazine'),
                        'vmagazine_widget_additionals' => esc_html__('Additional Settings','vmagazine'),
                    )
                ),
                //First Tab settings wrapper
                'tab_wrapper_general_start' => array(
                    'vmagazine_widgets_name'    => 'tab_wrapper_general_start',
                    'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine_widget_general',
                    'vmagazine_widgets_field_type'   => 'section_wrapper_start'
                ),

                    'first_tab_title' => array(
                        'vmagazine_widgets_name'         => 'first_tab_title',
                        'vmagazine_widgets_title'        => esc_html__( 'Tab Title', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ),

                    'first_tab_category' => array(
                        'vmagazine_widgets_name' => 'first_tab_category',
                        'vmagazine_widgets_title' => esc_html__( 'Select Category for First Tab', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 0,
                        'vmagazine_widgets_field_type' => 'select',
                        'vmagazine_widgets_field_options' => $vmagazine_cat_dropdown
                    ),

                'tab_wrapper_general_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_general_end',
                'vmagazine_widgets_field_type'   => 'section_wrapper_end'
                ),

                //second settings wrapper
                'tab_wrapper_adv_start' => array(
                    'vmagazine_widgets_name'    => 'tab_wrapper_adv_start',
                    'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine-hidden vmagazine_widget_advanced',
                    'vmagazine_widgets_field_type'   => 'section_wrapper_start'
                ),

                    'second_tab_title' => array(
                        'vmagazine_widgets_name'         => 'second_tab_title',
                        'vmagazine_widgets_title'        => esc_html__( 'Tab Title', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ),

                    'second_tab_category' => array(
                        'vmagazine_widgets_name' => 'second_tab_category',
                        'vmagazine_widgets_title' => esc_html__( 'Select Category for Second Tab', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 0,
                        'vmagazine_widgets_field_type' => 'select',
                        'vmagazine_widgets_field_options' => $vmagazine_cat_dropdown
                    ),
                //second tab closing
                'tab_wrapper_adv_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_adv_end',
                'vmagazine_widgets_field_type'   => 'section_wrapper_end'
                ),

                //third tab settings wrapper
                    'tab_wrapper_thrd_start' => array(
                        'vmagazine_widgets_name'    => 'tab_wrapper_thrd_start',
                        'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine-hidden vmagazine_widget_third',
                        'vmagazine_widgets_field_type'   => 'section_wrapper_start'
                    ),

                    'third_tab_title' => array(
                        'vmagazine_widgets_name'         => 'third_tab_title',
                        'vmagazine_widgets_title'        => esc_html__( 'Tab Title', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ),

                    'third_tab_category' => array(
                        'vmagazine_widgets_name' => 'third_tab_category',
                        'vmagazine_widgets_title' => esc_html__( 'Select Category for Third Tab', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 0,
                        'vmagazine_widgets_field_type' => 'select',
                        'vmagazine_widgets_field_options' => $vmagazine_cat_dropdown
                    ),
                //third tab closing
                'tab_wrapper_third_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_third_end',
                'vmagazine_widgets_field_type'   => 'section_wrapper_end'
                ),
            
                //Additional settings wrapper
                'tab_wrapper_add_start' => array(
                    'vmagazine_widgets_name'    => 'tab_wrapper_add_start',
                    'vmagazine_widgets_class'   => 'vmagazine-wie vmagazine-hidden vmagazine_widget_additionals',
                    'vmagazine_widgets_field_type'   => 'section_wrapper_start'
                ),

                    'block_posts_count' => array(
                        'vmagazine_widgets_name'         => 'block_posts_count',
                        'vmagazine_widgets_title'        => esc_html__( 'No. of Posts', 'vmagazine' ),
                        'vmagazine_widgets_default'      => 5,
                        'vmagazine_widgets_field_type'   => 'number'
                    ),

                    'block_button_viewall' => array(
                        'vmagazine_widgets_name'         => 'block_button_viewall',
                        'vmagazine_widgets_title'        => esc_html__( 'Enter View All Button Text', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ),

                    'block_section_meta' => array(
                        'vmagazine_widgets_name' => 'block_section_meta',
                        'vmagazine_widgets_title' => esc_html__( 'Hide/Show Meta', 'vmagazine' ),
                        'vmagazine_widgets_default'=>'show',
                        'vmagazine_widgets_field_options'=>array('show'=>'Show','hide'=>'Hide'),
                        'vmagazine_widgets_field_type' => 'switch',
                        'vmagazine_widgets_description'  => esc_html__('Show or hide post meta options like author name, post date etc','vmagazine'),
                    ),            

                   
                    'block_border_color' => array(
                        'vmagazine_widgets_name' => 'block_border_color',
                        'vmagazine_widgets_title' => esc_html__( 'Post Seperator Border Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),
                    'block_tabs_color' => array(
                        'vmagazine_widgets_name' => 'block_tabs_color',
                        'vmagazine_widgets_title' => esc_html__( 'Tabs Text Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),
                     'block_tabs_color_active' => array(
                        'vmagazine_widgets_name' => 'block_tabs_color_active',
                        'vmagazine_widgets_title' => esc_html__( 'Tabs Text Color: Active', 'vmagazine' ),
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

            
                 //additional tab closing
                'tab_wrapper_add_end' => array(
                'vmagazine_widgets_name'    => 'tab_wrapper_add_end',
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
        $vmagazine_block_posts_count = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];

        $vmagazine_first_tab_title = empty( $instance['first_tab_title'] ) ? '' : $instance['first_tab_title'];
        $vmagazine_second_tab_title = empty( $instance['second_tab_title'] ) ? '' : $instance['second_tab_title'];
        $vmagazine_third_tab_title = empty( $instance['third_tab_title'] ) ? '' : $instance['third_tab_title'];
        $block_section_meta = empty($instance['block_section_meta']) ? 'show' : $instance['block_section_meta'];
        $vmagazine_first_tab_cat_id = empty( $instance['first_tab_category'] ) ? 0: $instance['first_tab_category'];
        $vmagazine_second_tab_cat_id = empty( $instance['second_tab_category'] ) ? 0: $instance['second_tab_category'];
        $vmagazine_third_tab_cat_id = empty( $instance['third_tab_category'] ) ? 0: $instance['third_tab_category'];
        $view_all = empty( $instance['block_button_viewall'] ) ? '': $instance['block_button_viewall'];
        $block_border_color = empty($instance['block_border_color']) ? null : $instance['block_border_color'];
        $block_tabs_color = empty($instance['block_tabs_color']) ? null : $instance['block_tabs_color'];
        $block_tabs_color_active = empty($instance['block_tabs_color_active']) ? null : $instance['block_tabs_color_active'];
        $block_section_btn_txt_color = empty($instance['block_section_btn_txt_color']) ? null : $instance['block_section_btn_txt_color'];
        $block_section_btn_txt_color_hover = empty($instance['block_section_btn_txt_color_hover']) ? null : $instance['block_section_btn_txt_color_hover'];
        $block_section_btn_border_color = empty($instance['block_section_btn_border_color']) ? null : $instance['block_section_btn_border_color'];

    	echo wp_kses_post($before_widget);
   	vmagazine_widget_title( $vmagazine_block_title, $title_url=null, $cat_id=null);
    ?>
   		<div class="vmagazine-cat-tab vmagazine-tabbed-wrapper wow fadeInUp" data-wow-duration="1s">
   			<ul class="vmagazine-cat-tabs clearfix" id="vmagazine-widget-tabbed">
                <?php if( $vmagazine_first_tab_cat_id ) { ?>
	                <li class="cat-tab first-tabs">
	                    <a href="javascript:void(0)" id="tabfirst"><?php vmagazine_tabbed_title( $vmagazine_first_tab_title, $vmagazine_first_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
                <?php if( $vmagazine_second_tab_cat_id ) { ?>
	                <li class="cat-tab second-tabs">
	                    <a href="javascript:void(0)" id="tabsecond"><?php vmagazine_tabbed_title( $vmagazine_second_tab_title, $vmagazine_second_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
                <?php if( $vmagazine_third_tab_cat_id ) { ?>
	                <li class="cat-tab third-tabs">
	                    <a href="javascript:void(0)" id="tabthird"><?php vmagazine_tabbed_title( $vmagazine_third_tab_title, $vmagazine_third_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
           </ul>

           	<?php if( $vmagazine_first_tab_cat_id ) {
            ?>
           		<div id="section-tabfirst" class="vmagazine-tabbed-section" style="display: none;">
           			<?php
	                    $first_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmagazine_first_tab_cat_id,
	                                'posts_per_page' => $vmagazine_block_posts_count,
	                            );
	                    $first_tab_query = new WP_Query( $first_tab_args );
	                    if( $first_tab_query->have_posts() ) {
	                        while( $first_tab_query->have_posts() ) {
	                            $first_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
                                $img_src = vmagazine_home_element_img('vmagazine-cat-post-sm');
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	            ?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                   <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                       <?php echo vmagazine_load_images($img_src); ?>
                                            <div class="image-overlay"></div>
	                                    </a>
	                                </div>
	                                <div class="post-caption clearfix">
                                        <?php if( $block_section_meta == 'show' ): ?>
                                        <div class="post-meta">
                                        <?php $posted_on = get_the_date();
                                        echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. $posted_on .'</span>';?>
                                        </div>
                                         <?php endif; ?>
	                                    <h3 class="small-font">
                                            <a href="<?php the_permalink(); ?>">
                                                 <?php the_title(); ?>
                                            </a>
                                        </h3>
	                                   
	                                </div><!-- .post-caption -->
	                            </div><!-- .single-post -->
	            	            <?php
	                        }
	                    }
                        if( $view_all ){
                            vmagazine_block_view_all($vmagazine_first_tab_cat_id,$view_all);    
                        }
                        
                        wp_reset_query();
	            	?>
            	</div><!-- #tabfirst -->
            <?php } ?>
            <?php if( $vmagazine_second_tab_cat_id ) { ?>
	            <div id="section-tabsecond" class="vmagazine-tabbed-section" style="display: none;">
	           		<?php
	                    $second_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmagazine_second_tab_cat_id,
	                                'posts_per_page' => $vmagazine_block_posts_count,
	                            );
	                    $second_tab_query = new WP_Query( $second_tab_args );
	                    if( $second_tab_query->have_posts() ) {
	                        while( $second_tab_query->have_posts() ) {
	                            $second_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
	                            
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	            ?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                   <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                       <?php echo vmagazine_load_images($img_src); ?>
                                            <div class="image-overlay"></div>
	                                   </a>
	                                </div>
	                                <div class="post-caption clearfix">
                                        <?php if( $block_section_meta == 'show' ): ?>
                                        <div class="post-meta">
                                        <?php $posted_on = get_the_date();
                                        echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. $posted_on .'</span>';?>
                                        </div>
                                         <?php endif; ?>
	                                    <h3 class="small-font">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
	                                    
	                                </div><!-- .post-caption -->
	                            </div><!-- .single-post -->
	            	            <?php
	                        }
	                    }
                        vmagazine_block_view_all($vmagazine_second_tab_cat_id,$view_all);                    
                        wp_reset_query();
	            	?>
            	</div><!-- #tabsecond -->
            <?php } ?>
            <?php if( $vmagazine_third_tab_cat_id ) { ?>
	            <div id="section-tabthird" class="vmagazine-tabbed-section" style="display: none;">
	           		<?php 
	                
	                    $third_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmagazine_third_tab_cat_id,
	                                'posts_per_page' => $vmagazine_block_posts_count,
	                            );
	                    $third_tab_query = new WP_Query( $third_tab_args );
	                    if( $third_tab_query->have_posts() ) {
	                        while( $third_tab_query->have_posts() ) {
	                            $third_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
                                $img_src = vmagazine_home_element_img('vmagazine-small-thumb');
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	            ?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                   <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                      <?php echo vmagazine_load_images($img_src); ?>
                                            <div class="image-overlay"></div>
	                                    </a>
	                                </div>
	                                <div class="post-caption clearfix">
                                        <?php if( $block_section_meta == 'show' ): ?>
                                        <div class="post-meta">
                                        <?php $posted_on = get_the_date();
                                        echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. $posted_on .'</span>';?>
                                        </div>
                                         <?php endif; ?>
	                                    <h3 class="small-font">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
	                                    
	                                </div><!-- .post-caption -->	                                
	                            </div><!-- .single-post -->
	            	            <?php
	                        }
	                    }
                        vmagazine_block_view_all($vmagazine_third_tab_cat_id,$view_all);                    
                        wp_reset_query();
	            	?>
            	</div><!-- #tabthird -->
            <?php } ?>
   		</div><!-- .vmagazine-tabbed-wrapper -->
   	<?php
    	echo wp_kses_post($after_widget);

        /**
        * Widget stylings
        */
        if( $block_section_btn_txt_color || $block_section_btn_txt_color_hover || $block_section_btn_border_color || $block_tabs_color || $block_tabs_color_active || $block_border_color ):  

        echo "
            <style type='text/css'>
            .widget_vmagazine_categories_tabbed span.view-all a{
                color: $block_section_btn_txt_color;
            }
            .widget_vmagazine_categories_tabbed span.view-all a:hover{
                color: $block_section_btn_txt_color_hover;
            }
            .widget_vmagazine_categories_tabbed span.view-all a{
                border-color: $block_section_btn_border_color;
            }
            .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper ul#vmagazine-widget-tabbed li a{
                color: $block_tabs_color;
            }
            .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper ul#vmagazine-widget-tabbed li.active a, .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper ul#vmagazine-widget-tabbed li a:hover{
             color: $block_tabs_color_active;   
            }
            .widget_vmagazine_categories_tabbed .vmagazine-tabbed-wrapper .single-post{
                border-color: $block_border_color;
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
