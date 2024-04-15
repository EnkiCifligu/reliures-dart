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

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area vmagazine-sidebar" role="complementary">
	<div class="theiaStickySidebar">
		<?php do_action( 'vmagazine_before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php do_action( 'vmagazine_after_sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
