<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'vmagazine_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary-left" class="widget-area vmagazine-sidebar" role="complementary">
	<div class="theiaStickySidebar">
		<?php do_action( 'vmagazine_before_sidebar' ); ?>
		<?php dynamic_sidebar( 'vmagazine_left_sidebar' ); ?>
		<?php do_action( 'vmagazine_after_sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
