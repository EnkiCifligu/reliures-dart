<div class="vg-page-layout-sidebar <?php echo sanitize_html_class($sidebar_key); ?>" data-position="<?php echo esc_attr($position); ?>" style="display: none;">
	<?php
	if (is_active_sidebar($sidebar_key)) {
		dynamic_sidebar($sidebar_key);
	} else {
		?>
		<p><?php _e('Please add widgets to the sidebar.'); ?></p>
	<?php }
	?>
</div>