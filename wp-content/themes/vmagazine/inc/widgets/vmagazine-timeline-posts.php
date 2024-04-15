<?php
/**
 * Vmagazine: Timeline Posts
 *
 * Widget to display selected category posts as Timeline on list style.
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_register_timeline_posts_list_widget' );

function vmagazine_register_timeline_posts_list_widget() {
    register_widget( 'vmagazine_timeline_posts_list' );
}

class vmagazine_timeline_posts_list extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmagazine_timeline_posts_list',
            'description' => esc_html__( 'Display posts from selected category as timeline list.', 'vmagazine' )
        );
        parent::__construct( 'vmagazine_timeline_posts_list', esc_html__( 'Vmagazine : Timeline Posts', 'vmagazine' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmagazine_cat_dropdown,$vmagazine_posts_type;
        
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
                        'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'tp.png',
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

                    'block_post_type' => array(
                        'vmagazine_widgets_name'        => 'block_post_type',
                        'vmagazine_widgets_title'       => esc_html__( 'Block posts: ', 'vmagazine' ),
                        'vmagazine_widgets_field_type'  => 'radio',
                        'vmagazine_widgets_default'     => 'latest_posts',
                        'vmagazine_widgets_field_options' => $vmagazine_posts_type
                    ),

                    'block_post_category' => array(
                        'vmagazine_widgets_name' => 'block_post_category',
                        'vmagazine_widgets_title' => esc_html__( 'Select Category for Lists', 'vmagazine' ),
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
                            
                    
                    'block_view_all_text' => array(
                        'vmagazine_widgets_name'         => 'block_view_all_text',
                        'vmagazine_widgets_title'        => esc_html__( 'View All Text', 'vmagazine' ),
                        'vmagazine_widgets_field_type'   => 'text'
                    ),
                //general closing
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


                    'block_section_border_color' => array(
                        'vmagazine_widgets_name' => 'block_section_border_color',
                        'vmagazine_widgets_title' => esc_html__( 'Post Seperator Border Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),  

                    'block_section_bg_color' => array(
                        'vmagazine_widgets_name' => 'block_section_bg_color',
                        'vmagazine_widgets_title' => esc_html__( 'Widget Background Color', 'vmagazine' ),
                        'vmagazine_widgets_field_type' => 'color'
                    ),  


                //advanced settings closing 
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
        $block_post_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_posts_count = empty( $instance['block_posts_count'] ) ? 4 : $instance['block_posts_count'];
        $vmagazine_block_cat_id    = empty( $instance['block_post_category'] ) ? 0: $instance['block_post_category'];
        $vmagazine_block_view_all_text   = empty( $instance['block_view_all_text'] ) ? '' : $instance['block_view_all_text'];
        $block_section_bg_color = empty($instance['block_section_bg_color']) ? null : $instance['block_section_bg_color'];
        $block_section_border_color = empty($instance['block_section_border_color']) ? null : $instance['block_section_border_color'];

        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-timeline-post block-post-wrapper wow fadeInUp" data-wow-duration="1s">
            <?php vmagazine_widget_title( $vmagazine_block_title, $title_url=null, $vmagazine_block_cat_id ); ?>
            <?php 
                    $block_args = vmagazine_query_args( $block_post_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                    
                    $block_query = new WP_Query( $block_args );
                    if( $block_query->have_posts() ) { ?>
                        <div class="timeline-post-wrapper">
                        <?php 
                        while( $block_query->have_posts() ):
                            $block_query->the_post();
                            ?>
                            <div class="single-post">
                                <div class="post-date">
                                    <?php do_action( 'vmagazine_formated_date' ); ?>
                                </div><!-- .post-thumb -->
                                <div class="post-caption clearfix">
                                    <div class="captions-wrapper">
                                        <h3 class="small-font">
                                            <a href="<?php the_permalink(); ?>">
                                               <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                                        <?php
                                            vmagazine_post_comments();

                                            if( function_exists('vmagazine_post_views')){
                                                vmagazine_post_views();    
                                            }
                                            
                                        ?>   
                                        </div><!-- .post-meta -->
                                    </div>
                                </div><!-- .post-caption -->
                            </div><!-- .single-post -->
                            <?php
                        endwhile; 
                        if( $vmagazine_block_view_all_text ){
                            vmagazine_block_view_all( $vmagazine_block_cat_id, $vmagazine_block_view_all_text );    
                        }
                         ?>
                        </div>
                 <?php 
                    }
                    wp_reset_query();
            ?>
        </div><!-- .block-post-wrapper -->
    <?php
        echo wp_kses_post($after_widget);

        /**
        * Widget stylings
        */
        if($block_section_border_color || $block_section_bg_color ): 
       
        echo "
            <style type='text/css'>
           
            .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper{
                border-color: $block_section_border_color;
            }
            .vmagazine-timeline-post .timeline-post-wrapper .single-post::before{
                background: $block_section_border_color;
            }
            .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper::before{
                border-color: transparent {$block_section_border_color} transparent transparent;
            }
            .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-date .blog-date-inner
            {
                background: $block_section_bg_color;
            }
            .vmagazine-timeline-post .timeline-post-wrapper .single-post .post-caption .captions-wrapper:after
            {
                border-color: transparent {$block_section_bg_color} transparent transparent;
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