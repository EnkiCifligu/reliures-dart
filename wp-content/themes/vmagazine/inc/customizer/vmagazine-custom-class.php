<?php
/**
 * Extend custom classes for customizer
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) { 

	/**
	 * Multiple checkbox customize control class.
	 */
	class Vmagazine_Customize_Checkbox_Multiple extends WP_Customize_Control {
	    
	    public $type = 'checkbox-multiple';

	    public function render_content() {

	        if ( empty( $this->choices ) )
	            return; ?>

	        <?php if ( !empty( $this->label ) ) : ?>
	            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <?php endif; ?>

	        <?php if ( !empty( $this->description ) ) : ?>
	            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	        <?php endif; ?>

	        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

	        <ul>
	            <?php foreach ( $this->choices as $value => $label ) : ?>

	                <li>
	                    <label>
	                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
	                        <?php echo esc_html( $label ); ?>
	                    </label>
	                </li>

	            <?php endforeach; ?>
	        </ul>

	        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
	    <?php }
	}

    class Vmagazine_Customize_Switch_Control extends WP_Customize_Control {

      /**
       * The type of customize control being rendered.
       *
       * @since  1.0.0
       * @access public
       * @var    string
       */
    public $type = 'switch';
    /**
       * Displays the control content.
       *
       * @since  1.0.0
       * @access public
       * @return void
       */
    public function render_content() { ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
            <div class="switch_options">
              <?php 
                $show_choices = $this->choices;
                foreach ( $show_choices as $key => $value ) {
                  echo '<span class="switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. $value.'</span>';
                }
              ?>
                    <input type="hidden" id="ap_switch_option" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
  <?php
    }
  }

  class Wp_Customize_Seperator_Control extends WP_Customize_Control {
     public function render_content() { ?>
       <span class="customize-control-seperator">
           <?php echo esc_html( $this->label ); ?>
       </span>  
       <?php     
  }     

}

	/**
     * Image control by radtion button 
     */
    class Vmagazine_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-radio-' . $this->id;

			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<ul class="controls" id="vmagazine-img-container">
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ( $this->value() == $value ) ? 'vmagazine-radio-img-selected vmagazine-radio-img-img' : 'vmagazine-radio-img-img';
			?>
					<li class="inc-radio-image">
						<label>
							<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr( $class ); ?>' />
						</label>
					</li>
			<?php
				endforeach;
			?>
			</ul>
			<?php
		}
	}

	/**
     * Customize for text-area, extend the WP customizer
     */
    class Vmagazine_Textarea_Custom_Control extends WP_Customize_Control{
    	/**
    	 * Render the control's content.
    	 * 
    	 */
    	public $type = 'vmagazine_textarea';
      	public function render_content() {
    ?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
          		<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
    				<?php echo esc_textarea( $this->value() ); ?>
    			</textarea>
    		</label>
    <?php
    	}
    }

  
    /** Section background color picker field **/
    class Vmagazine_Bg_Color_Picker extends WP_Customize_Control {
        public function render_content() { ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>
        <span class="desc clearfix">
            <?php echo esc_html( $this->description ); ?>
        </span>
        <input type='text' class="customizer-bg-color-picker" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
    <?php
        }
    }





/**
   * A class to create a list of icons in customizer field
   *
   * @since 1.0.0
   * @access public
   */
  class Vmagazine_Customize_Icons_Control extends WP_Customize_Control {

    /**
       * The type of customize control being rendered.
       *
       * @since  1.0.0
       * @access public
       * @var    string
       */
    public $type = 'vmagazine_icons';

    /**
       * Displays the control content.
       *
       * @since  1.0.0
       * @access public
       * @return void
       */
    public function render_content() {

      $saved_icon_value = $this->value(); ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <div class="ap-customize-icons">
          <div class="selected-icon-preview"><?php if( !empty( $saved_icon_value ) ) { echo '<i class="fa '. esc_attr($saved_icon_value) .'"></i>'; } ?>
          </div>
          <span class="icon-toggle"><i class="fa fa-chevron-down"></i></span>
          <ul class="icons-list-wrapper">
            <?php 
              $vmagazine_icons_list = vmagazine_cust_icons_array();
              foreach ( $vmagazine_icons_list as $key => $icon_value ) {
                if( $saved_icon_value == $icon_value ) {
                  echo '<li class="selected"><i class="fa '. esc_attr($icon_value) .'"></i></li>';

                } else {
                  echo '<li><i class="fa '. esc_attr($icon_value) .'"></i></li>';
                }
              }
            ?>
          </ul>
          <input type="hidden" class="ap-icon-value" value="" <?php $this->link(); ?>>
        </div>

      </label>
  <?php
    }
  }



} //endif class_exists

