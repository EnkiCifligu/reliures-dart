<?php
/**
 * About Author Widget
 *
 * @package vmagazine
 */
/**
 * Adds vmagazine_Testimonial widget.
 */
 if(!function_exists('vmagazine_register_about_author_widget')){
add_action('widgets_init', 'vmagazine_register_about_author_widget');

function vmagazine_register_about_author_widget() {
    register_widget('vmagazine_about_author');
}
}
if(!class_exists('vmagazine_about_author')){
class Vmagazine_About_Author extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'vmagazine_about_author', esc_html__('Vmagazine : About Author','vmagazine'), array(
                'description' => esc_html__('A widget that shows information of a author', 'vmagazine')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            
            'widget_title' => array(
                'vmagazine_widgets_name' => 'widget_title',
                'vmagazine_widgets_title' => esc_html__('Widget Title', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'author_title' => array(
                'vmagazine_widgets_name' => 'author_title',
                'vmagazine_widgets_title' => esc_html__('Author Title', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'author_image' => array(
                'vmagazine_widgets_name' => 'author_image',
                'vmagazine_widgets_title' => esc_html__( 'Author Image', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'upload',
            ),
            'author_desc' => array(
                'vmagazine_widgets_name' => 'author_desc',
                'vmagazine_widgets_title' => esc_html__('Description', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'textarea',
            ),
            'fb_url' => array(
                'vmagazine_widgets_name' => 'fb_url',
                'vmagazine_widgets_title' => esc_html__('Facebook URL', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'url',
            ),
            'twitter_url' => array(
                'vmagazine_widgets_name' => 'twitter_url',
                'vmagazine_widgets_title' => esc_html__('Twitter URL', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'url',
            ),
            'pinterest_url' => array(
                'vmagazine_widgets_name' => 'pinterest_url',
                'vmagazine_widgets_title' => esc_html__('Pinterest URL', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'url',
            ),
            'insta_url' => array(
                'vmagazine_widgets_name' => 'insta_url',
                'vmagazine_widgets_title' => esc_html__('Instagram URL', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'url',
            ),
            'link_new_tabs' => array(
                'vmagazine_widgets_name' => 'link_new_tabs',
                'vmagazine_widgets_title' => esc_html__('Open Link on new tabs ?', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'checkbox',
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
    public function widget($args, $instance) {
        extract($args);
        echo wp_kses_post($before_widget);
        if($instance){
        $vmagazine_widget_title = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];
        $author_title  = empty($instance['author_title'] ) ? '' : $instance['author_title'];
        $author_desc = empty( $instance['author_desc'] ) ? '' : $instance['author_desc'];
        $vmagazine_author_image   = empty( $instance['author_image'] ) ? '' : $instance['author_image'];
        $fb_url = empty( $instance['fb_url'] ) ? '' : $instance['fb_url'];
        $twitter_url = empty( $instance['twitter_url'] ) ? '' : $instance['twitter_url'];
        $pinterest_url = empty( $instance['pinterest_url'] ) ? '' : $instance['pinterest_url'];
        $insta_url = empty( $instance['insta_url'] ) ? '' : $instance['insta_url'];
        $link_new_tabs  = empty( $instance['link_new_tabs'])  ? '_self': '_blank';
            ?>
                <div class="vmagazine-about-author">
                    <?php if($vmagazine_widget_title){ ?>
                        <h4 class="widget-title">
                            <?php echo esc_html($vmagazine_widget_title); ?>
                        </h4>
                        
                    <?php } ?>
                    <div class="info_wrap">
                        <div class="author-title">
                            <span>
                                <?php echo esc_html($author_title); ?>
                            </span>
                        </div>
                        <div class="author-img">
                            <?php echo vmagazine_load_images($vmagazine_author_image); ?>   
                        </div>
                        <div class="author-desc">
                            <?php echo esc_html($author_desc); ?>
                        </div>
                        <div class="author-profiles">
                            <a href="<?php echo esc_url($fb_url); ?>" class="fb-link" target="<?php echo esc_attr($link_new_tabs); ?>">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo esc_url($twitter_url);?>" class="twitter-url" target="<?php echo esc_attr($link_new_tabs); ?>">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo esc_url($pinterest_url); ?>" class="pinterest-link" target="<?php echo esc_attr($link_new_tabs); ?>">
                                <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo esc_url($insta_url);?>" class="insta-url" target="<?php echo esc_attr($link_new_tabs); ?>">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>
                      
                    </div>
                </div>
        <?php
        }
        echo wp_kses_post($after_widget);
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	vmagazine_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$vmagazine_widgets_name] = vmagazine_widgets_updated_field_value($widget_field, $new_instance[$vmagazine_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	vmagazine_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $vmagazine_widgets_field_value = !empty($instance[$vmagazine_widgets_name]) ? esc_attr($instance[$vmagazine_widgets_name]) : '';
            vmagazine_widgets_show_widget_field($this, $widget_field, $vmagazine_widgets_field_value);
        }
    }

}
}