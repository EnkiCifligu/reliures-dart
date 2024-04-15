<?php
/**
 *
 * @package Vmagazine
 */
 if(!function_exists('vmagazine_player_widget')){
add_action('widgets_init', 'vmagazine_player_widget');

function vmagazine_player_widget() {
    register_widget('vmagazine_player');
}
}
if(!class_exists('Vmagazine_Player')){
class Vmagazine_Player extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'vmagazine_player', 'Vmagazine : Media Player', array(
            'description' => esc_html__('Add any media and to your website', 'vmagazine')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        global $vmagazine_cat_dropdown;
        
        $fields = array(
            'player_title' => array(
                'vmagazine_widgets_name' => 'player_title',
                'vmagazine_widgets_title' => esc_html__('Title', 'vmagazine'),
                'vmagazine_widgets_field_type' => 'text',
            ),

            'player_url' => array(
                'vmagazine_widgets_name' => 'player_url',
                'vmagazine_widgets_title' => esc_html__('Player Link', 'vmagazine'),
                'vmagazine_widgets_description' => esc_html__( 'Enter soundcloud url', 'vmagazine' ),
                'vmagazine_widgets_default' => '',
                'vmagazine_widgets_field_type' => 'url',
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
        $player_title = $instance['player_title'];
        $player_url = empty( $instance['player_url'] ) ? '' : $instance['player_url'];
       
        echo wp_kses_post($before_widget);
        if($player_title || $player_url){
            if($player_title){
                  vmagazine_widget_title( $player_title, $vmagazine_block_title_url=null, $cat_id=null );
            } ?>
            <div class="vmagazine-player-widget">
            	<div class="player-inner">
            	<?php echo wp_oembed_get( esc_url($player_url) ); ?>
            	</div>
            </div>
        <?php
           
        }
        echo wp_kses_post($after_widget);
    }

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
     * @param	array $instance Previously saved values from database.
     *
     * @uses	vmagazine_widgets_show_widget_field()		defined in widget-fields.php
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
}
