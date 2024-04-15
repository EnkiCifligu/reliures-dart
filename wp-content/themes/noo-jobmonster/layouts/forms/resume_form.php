<?php do_action('noo_post_resume_before'); ?>
<div class="noo-vc-accordion panel-group icon-right_arrow" id="resume-post-accordion">
    <div class="panel panel-default">
		<div class="panel-heading active">
			<h3 class="panel-title"><a data-toggle="collapse" class="accordion-toggle" data-parent="resume-post-accordion" href="#collapseGeneral"><?php _e('General Information', 'noo'); ?></a></h3>
		</div>
        <div id="collapseGeneral" class="noo-accordion-tab collapse in">
	        <div class="panel-body">
				<?php noo_get_layout('resume/resume_general')?>
                <?php
				$fields = jm_get_resume_custom_fields();
				if( !empty( $fields ) ) {
					foreach ($fields as $field) {
						if ( '_portfolio' != $field['name'] )
							continue;
						$field_id = jm_resume_custom_fields_name( $field['name'], $field );
						$value = $resume_id = !empty( $_GET['resume_id'] ) ? noo_get_post_meta( $_GET['resume_id'], $field_id, '' ) : '';
						$value = !is_array($value) ? trim($value) : $value;

						$params = apply_filters( 'jm_resume_render_form_field_params', compact( 'field', 'field_id', 'value' ), $resume_id );
						extract($params);
						$object = array( 'ID' => $resume_id, 'type' => 'post' );

						?>
                        <div class="form-group row <?php noo_custom_field_class( $field, $object ); ?>">
                            <label for="<?php echo esc_attr($field_id)?>" class="col-sm-3 control-label"><?php echo(isset( $field['label_translated'] ) ? $field['label_translated'] : $field['label'])  ?></label>
                            <div class="col-sm-9">
								<?php noo_render_field( $field, $field_id, $value, '', $object ); ?>
                            </div>
                        </div>
						<?php
					}
				}
                ?>
			</div>
		</div>
	</div>
    <div class="panel panel-default">
		<?php if( Noo_Resume::enable_resume_detail() ) : ?>
			<div class="panel-heading">
				<h3 class="panel-title"><a data-toggle="collapse" class="accordion-toggle" data-parent="resume-post-accordion" href="#collapseDetail"><?php _e('Resume Details', 'noo'); ?></a></h3>
			</div>
	        <div id="collapseDetail" class="noo-accordion-tab collapse in">
		        <div class="panel-body">
					<?php noo_get_layout('resume/resume_detail')?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<script>
	jQuery('document').ready(function ($) {
		$('#resume-post-accordion').on('show.bs.collapse', function (e) {
			$(e.target).prev('.panel-heading').addClass('active');
		});
		$('#resume-post-accordion').on('hide.bs.collapse', function (e) {
			$(e.target).prev('.panel-heading').removeClass('active');
		});
	});
</script>
<?php do_action('noo_post_resume_after'); ?>