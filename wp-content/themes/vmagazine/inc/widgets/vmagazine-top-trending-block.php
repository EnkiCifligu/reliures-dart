<?php
/**
 * Vmagazine: Grid List Posts
 *
 * Widget to display 4 posts in square format
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

add_action( 'widgets_init', 'vmagazine_top_trending_widget' );

function vmagazine_top_trending_widget() {
    register_widget( 'Vmagazine_Top_Trending_Block' );
}

class Vmagazine_Top_Trending_Block extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'Vmagazine_Top_Trending_Block',
            'description' => esc_html__( 'Display 4 news in square format', 'vmagazine' )
        );
        parent::__construct( 'Vmagazine_Top_Trending_Block', esc_html__( 'Vmagazine: Top Trending', 'vmagazine' ), $widget_ops );
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
                'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'tt.png',
                'vmagazine_widgets_field_type'   => 'widget_layout_image'
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

                        
            //design

            'block_section_meta' => array(
                'vmagazine_widgets_name' => 'block_section_meta',
                'vmagazine_widgets_title' => esc_html__( 'Hide/Show Post Meta', 'vmagazine' ),
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

        $vmagazine_block_posts_count = 5;
        $vmagazine_block_posts_type = empty($instance['block_post_type']) ? 'latest_posts' : $instance['block_post_type'];
        $vmagazine_block_cat_id = empty($instance['block_post_category']) ? null: $instance['block_post_category'];
      ;
        $block_section_meta = empty($instance['block_section_meta']) ? 'show' : $instance['block_section_meta'];
        
        echo wp_kses_post($before_widget);
    ?>
        <div class="vmagazine-top-trending-block block-post-wrapper wow fadeInUp" data-wow-duration="0.7s">
            
            <?php 
                $block_args = vmagazine_query_args( $vmagazine_block_posts_type, $vmagazine_block_posts_count, $vmagazine_block_cat_id );
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                	$block_post_counter = 0;
                    while( $block_query->have_posts() ) {
                    	$block_post_counter++;
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $img_scrs = vmagazine_home_element_img('vmagazine-large-square-thumb');
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            ?>
                        
                            <?php if( $block_post_counter < 3 ){ ?>
                            	<?php if( $block_post_counter == 1 ){ ?>
                            	<div class="first-block-wrap">
                            	<?php } ?>
                            		<div class="inner-wrap">
                            		<div class="post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo vmagazine_load_images($img_scrs); ?>
                                        </a>    
                                        <div class="image-overlay"></div>
                                   
                                	</div><!-- .post-thumb -->
                                	<div class="post-content-wrapper clearfix">
	                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
	                                   
	                                    <h3 class="extra-large-font">
	                                        <a href="<?php the_permalink(); ?>">
	                                        	<?php the_title(); ?>
	                                        </a>
	                                    </h3>
                                         <?php if( $block_section_meta == 'show' ): ?>
                                        <div class="post-meta clearfix">
                                            <?php  do_action( 'vmagazine_icon_meta' ); ?>
                                        </div><!-- .post-meta --> 
                                        <?php endif; ?>
		                             </div><!-- .post-content-wrapper -->
		                         	</div>
		                            <?php if( $block_post_counter == 2 ){ ?> 
                            		</div><!-- .first-block-wrap -->
                            		<?php } ?>
                            <?php }elseif( $block_post_counter == 3 ){ ?>
                            		<div class="middle-block-wrap">
                            			<div class="inner-wrap">
	                            		<div class="post-thumb">
	                                    
                                       <?php $img_scr = vmagazine_home_element_img('vmagazine-large-square-middle'); ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo vmagazine_load_images($img_scr); ?>
                                        </a>
	                                   <div class="image-overlay"></div>
	                                    
	                                	</div>
	                                	<div class="post-content-wrapper clearfix">
		                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
		                                    
		                                    <h3 class="extra-large-font">
		                                        <a href="<?php the_permalink(); ?>">
		                                        	<?php the_title(); ?>
		                                        </a>
		                                    </h3>
                                            <?php if( $block_section_meta == 'show' ): ?>
                                            <div class="post-meta clearfix">
                                                <?php  do_action( 'vmagazine_icon_meta' ); ?>
                                            </div><!-- .post-meta --> 
                                            <?php endif; ?>
		                                </div><!-- .post-content-wrapper -->
		                             </div>
                            		</div>
                            <?php }else{ ?>
                            		<?php if( $block_post_counter == 4 ){ ?>
                            		<div class="last-block-wrap">
                            		<?php } ?>
                            			<div class="inner-wrap">
	                            		<div class="post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo vmagazine_load_images($img_scrs); ?>
                                        </a>
	                                   <div class="image-overlay"></div>
	                                	</div>
	                                	<div class="post-content-wrapper clearfix">
		                                    <?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
		                                    
		                                    <h3 class="extra-large-font">
		                                        <a href="<?php the_permalink(); ?>">
		                                        	<?php the_title(); ?>
		                                        </a>
		                                    </h3>
                                            <?php if( $block_section_meta == 'show' ): ?>
                                            <div class="post-meta clearfix">
                                                <?php  do_action( 'vmagazine_icon_meta' ); ?>
                                            </div><!-- .post-meta --> 
                                            <?php endif; ?>
		                                </div><!-- .post-content-wrapper -->
		                            	</div>
		                                <?php if( $block_post_counter == 5 ){ ?>
                            			</div><!-- .last-block-wrap -->
                            			<?php } ?>
                            <?php } ?>
                               
                                
                        <?php
                    }
                }
                wp_reset_query();
            ?>
            
            
            
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