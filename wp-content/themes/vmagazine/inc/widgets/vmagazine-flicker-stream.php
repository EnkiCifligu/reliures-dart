<?php
/**
 * Flickr Stream Widget
 *
 * @package vmagazine
 */

add_action( 'widgets_init', 'register_vmagazine_flickr_stream_widget' );

function register_vmagazine_flickr_stream_widget() {
    register_widget( 'vmagazine_flickr_stream' );
}

if( !class_exists( 'Vmagazine_Flickr_Stream' ) ) :
class Vmagazine_Flickr_Stream extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'vmagazine_flickr_stream',
            __('Vmagazine : Flickr Stream', 'vmagazine'),
            array(
                'description' => __('Displays your Flickr photos.', 'vmagazine' )
            )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // Title
            'widget_title' => array(
                'vmagazine_widgets_name' => 'widget_title',
                'vmagazine_widgets_title' => esc_html__( 'Title', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'text'
            ),
            // Other fields
            'flickr_id' => array(
                'vmagazine_widgets_name' => 'flickr_id',
                'vmagazine_widgets_title' => esc_html__( 'Flickr ID', 'vmagazine' ),
                'vmagazine_widgets_description' => esc_html__('eg: 150375770@N32','vmagazine'),
                'vmagazine_widgets_field_type' => 'text'
            ),
            'photo_count' => array(
                'vmagazine_widgets_name' => 'photo_count',
                'vmagazine_widgets_title' => esc_html__( 'Number of Photos', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'number'
               
            ),
            'photo_type' => array(
                'vmagazine_widgets_name' => 'photo_type',
                'vmagazine_widgets_title' => esc_html__( 'Type (user or group)', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'select',
                'vmagazine_widgets_field_options' => array(
                    'user' => esc_html__('User', 'vmagazine'),
                    'group' => esc_html__('Group', 'vmagazine')
                )
            ),
            'photo_display' => array(
                'vmagazine_widgets_name' => 'photo_display',
                'vmagazine_widgets_title' => esc_html__( 'Display', 'vmagazine' ),
                'vmagazine_widgets_field_type' => 'select',
                'vmagazine_widgets_field_options' => array(
                    'latest' => esc_html__('Latest', 'vmagazine'),
                    'random' => esc_html__('Random', 'vmagazine')
                )
            )
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

        $widget_title = empty($instance['widget_title']) ? null : $instance['widget_title'];
        $flickr_id = strip_tags($instance['flickr_id']);
        $photo_count = empty($instance['photo_count']) ? 4 : $instance['photo_count'];
        $photo_type = $instance['photo_type'];
        $photo_display = $instance['photo_display'];

        echo wp_kses_post($before_widget);

        // Show title
        if (isset($widget_title)) {
            vmagazine_widget_title( $widget_title, $vmagazine_block_title_url=null, $cat_id=null );
        }
        ?>
        <div class="clearfix widget-flickr-stream">
            <script type="text/javascript" src="https://www.flickr.com/badge_code_v2.gne?count=<?php echo intval($photo_count) ?>&amp;display=<?php echo esc_attr($photo_display) ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_attr($photo_type) ?>&amp;<?php echo esc_attr($photo_type) ?>=<?php echo esc_attr($flickr_id) ?>"></script>
        </div>
        
        <?php
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
     *
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
     * @param array $instance Previously saved values from database.
     * <ins></ins>
     * 
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_mag_widgets_field_value = isset($instance[$vmagazine_widgets_name]) ? esc_attr($instance[$vmagazine_widgets_name]) : '';
            vmagazine_widgets_show_widget_field($this, $widget_field, $accesspress_mag_widgets_field_value);
        }
    }

}
endif;