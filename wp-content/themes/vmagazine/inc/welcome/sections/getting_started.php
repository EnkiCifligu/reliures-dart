<div class="theme-steps-list">

	<div class="theme-steps">
		<h3><?php echo esc_html__('Step 1 - Recommended Actions', 'vmagazine'); ?></h3>
		<p><?php echo esc_html__('Before you start setting up the theme, there are few recommended action that you need to follow. These recommendation helps you to set up the theme more easily and quickly.', 'vmagazine'); ?></p>
		<a class="button" href="<?php echo esc_url(admin_url('/themes.php?page=vmagazine-welcome&section=actions_required')); ?>"><?php echo esc_html__('Recommended Actions', 'vmagazine'); ?></a>
	</div>

	<div class="theme-steps">
		<h3><?php echo esc_html__('Step 2 - Customizer Options Panel', 'vmagazine'); ?></h3>
		<p><?php echo esc_html__('Using the WordPress Customizer you can easily customize every aspect of the theme.', 'vmagazine'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Go to Customizer Panels', 'vmagazine'); ?></a>
	</div>

</div>

<div class="theme-image">
	<img src="<?php echo esc_url(get_template_directory_uri()) ?>/screenshot.png">
</div>
