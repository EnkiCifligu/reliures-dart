<?php
/**
 * Testimonial post/page widget
 *
 * @package vmagazine
 */
/**
 * Adds vmagazine_Testimonial widget.
 */
 if(!function_exists('vmagazine_register_info_widget')){
add_action('widgets_init', 'vmagazine_register_info_widget');

function vmagazine_register_info_widget() {
    register_widget('vmagazine_info');
}
}
if(!class_exists('vmagazine_info')){
class vmagazine_info extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'vmagazine_info', esc_html__('Vmagazine : Footer Info','vmagazine'), array(
                'description' => esc_html__('A widget that shows information', 'vmagazine')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'title_info' => array(
                'vmagazine_widgets_name' => 'title_info',
                'vmagazine_widgets_title' => esc_html__('Info Title', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'location' => array(
                'vmagazine_widgets_name' => 'location',
                'vmagazine_widgets_title' => esc_html__('Location', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'phone' => array(
                'vmagazine_widgets_name' => 'phone',
                'vmagazine_widgets_title' => esc_html__('Phone', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'fax' => array(
                'vmagazine_widgets_name' => 'fax',
                'vmagazine_widgets_title' => esc_html__('Fax', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),
            'email' => array(
                'vmagazine_widgets_name' => 'email',
                'vmagazine_widgets_title' => esc_html__('Email', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
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
        $vmagazine_title_info = $instance['title_info'];
        $vmagazine_location = $instance['location'];
        $vmagazine_phome = $instance['phone'];
        $vmagazine_fax = $instance['fax'];
        $vmagazine_email = $instance['email'];
            ?>
                <div class="vmagazine-footer-info footer_info_wrap">
                    <?php if($vmagazine_title_info){ ?>
                        <h4 class="widget-title">
                            <?php echo esc_attr($vmagazine_title_info); ?>
                        </h4>
                        
                    <?php } ?>
                    <div class="info_wrap">
                        <?php if($vmagazine_location){ ?>
                            <div class="location_info">
                                <span class="fa_icon_info"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <span class="location"><?php echo esc_attr($vmagazine_location); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($vmagazine_phome){ ?>
                            <div class="phone_info">
                                <span class="fa_icon_info"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <span class="phone"><?php echo esc_attr($vmagazine_phome); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($vmagazine_fax){ ?>
                            <div class="fax_info">
                                <span class="fa_icon_info"><i class="fa fa-fax" aria-hidden="true"></i></span>
                                <span class="fax"><?php echo esc_attr($vmagazine_fax); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($vmagazine_email){ ?>
                            <div class="email_info">
                                <span class="fa_icon_info"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <span class="email"><?php echo esc_attr($vmagazine_email); ?></span>
                            </div>
                        <?php } ?>
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