<?php
/**
 * Vmagazine: Grid List Posts
 *
 * Widget to display latest or selected category posts as on list style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_tab_posts_list_widget' );

function vmagazine_tab_posts_list_widget() {
    register_widget( 'vmagazine_tab_posts_list' );
}

class vmagazine_tab_posts_list extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_tab_posts_list',
            'description' => esc_html__( 'Display fullwidth slider with .', 'vmagazine' )
        );
        $width = array(
                'width'  => 600
        );
        parent::__construct( 'vmagazine_tab_posts_list', esc_html__( 'Vmagazine: Fullwidth slider', 'vmagazine' ), $widget_ops,$width );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_posts_type, $vmagazine_cat_dropdown, $vmagazine_block_layout;
        
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
                'vmagazine_widgets_default'      => 'block_layout_1',
                'vmagazine_widgets_field_type' => 'radioimg',
                'vmagazine_widgets_field_options' => array(
                    'block_layout_1' =>  VMAG_WIDGET_IMG_URI.'fws-1.png',
                    'block_layout_2' =>  VMAG_WIDGET_IMG_URI.'fws-2.png',
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
                'block_post_type' => array(
                    'vmagazine_widgets_name'        => 'block_post_type',
                    'vmagazine_widgets_title'       => esc_html__( 'Block Display Type', 'vmagazine' ),
                    'vmagazine_widgets_field_type'  => 'radio',
                    'vmagazine_widgets_default'     => 'latest_posts',
                    'vmagazine_widgets_field_options' => $vmagazine_posts_type
                ),

                'block_post_category'               => array(
                    'vmagazine_widgets_name'        => 'block_post_category',
                    'vmagazine_widgets_title'       => esc_html__( 'Category for Block Posts', 'vmagazine' ),
                    'vmagazine_widgets_default'     => 0,
                    'vmagazine_widgets_field_type'  => 'select',
                    'vmagazine_widgets_field_options' => $vmagazine_cat_dropdown
                ),

                'block_posts_count' => array(
                    'vmagazine_widgets_name'         => 'block_posts_count',
                    'vmagazine_widgets_title'        => esc_html__( 'No. of Posts', 'vmagazine' ),
                    'vmagazine_widgets_default'      => 4,
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

        $vmagazine_block_posts_count = empty($instance['block_posts_count']) ? 4 : $instance['block_posts_count'];
        $vmagazine_block_posts_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id = empty($instance['block_post_category']) ? null: $instance['block_post_category'];
        $vmagazine_block_layout = empty($instance['block_post_layout']) ? 'block_layout_1' : $instance['block_post_layout'];
        $block_section_meta = empty($instance['block_section_meta']) ? 'show' : $instance['block_section_meta'];

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-fullwid-slider block-post-wrapper <?php echo esc_attr($vmagazine_block_layout);?>" data-count="<?php echo absint($vmagazine_block_posts_count);?>">
            <div class="slick-wrap sl-before-load">
            <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $img_src = vmagazine_home_element_img('vmagazine-single-large');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            ?>
                        <div class="single-post clearfix">
                            
                                <div class="post-thumb">
                                    <?php echo  vmagazine_load_images($img_src); ?>
                                    <div class="image-overlay"></div>
                                </div><!-- .post-thumb -->
                                <div class="post-content-wrapper clearfix">
                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>

                                    <?php if( $block_section_meta == 'show' ): ?>
                                    <div class="post-meta clearfix">
                                        <?php  do_action( 'vmagazine_icon_meta' ); ?>
                                    </div><!-- .post-meta --> 
                                    <?php endif; ?>
                                    <h3 class="extra-large-font">
                                        <a href="<?php the_permalink(); ?>">
                                             <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                </div><!-- .post-content-wrapper -->
                           
                        </div><!-- .single-post  -->
                        <?php
                    }
                }
                wp_reset_query();
            ?>
            </div> 
            <?php if( $vmagazine_block_layout == 'block_layout_2' ){ ?>
            <div class="vmagazine-container">
            <?php } ?>
            <div class="posts-tab-wrap sl-before-load">
                <?php 
                    $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                    $block_query = new WP_Query( $block_args );
                    if( $block_query->have_posts() ) {
                        while( $block_query->have_posts() ) {
                            $block_query->the_post();
                            $image_id = get_post_thumbnail_id();
                            $img_srcs = vmagazine_home_element_img('vmagazine-small-thumb');
                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>                
                <div class="single-post clearfix">  
                    <div class="slider-nav-inner-wrapper">
                        <div class="post-thumb">
                            <a href="javascript:void(0)" class="thumb-zoom">
                                <?php echo  vmagazine_load_images($img_srcs); ?>
                                <div class="image-overlay"></div>
                            </a>
                            <?php do_action( 'vmagazine_post_format_icon' );?>
                        </div><!-- .post-thumb -->
                        <div class="post-caption-wrapper">
                             <?php if( $block_section_meta == 'show' ):
                               $posted_on = get_the_date();
                               echo '<span class="posted-on"><i class="fa fa-clock-o"></i>'. $posted_on .'</span>';
                             endif; ?>
                            <h3 class="large-font">
                                <?php the_title(); ?>
                            </h3>
                           
                        </div><!-- .post-caption-wrapper -->
                    </div><!-- .slider-nav-inner-wrapper -->
                </div> 
                <?php }} wp_reset_query();?>               
            </div>
            <?php if( $vmagazine_block_layout == 'block_layout_2' ){ ?>
            </div>
            <?php } ?>
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