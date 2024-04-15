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

if ( ! is_active_sidebar( 'shop-right' ) ) {
	return;
}
?>

<aside id="secondary-right" class="widget-area vmagazine-shop-sidebar vmagazine-sidebar" role="complementary">
	<div class="theiaStickySidebar">
		<?php do_action( 'vmagazine_before_sidebar' ); ?>
		<?php dynamic_sidebar( 'shop-right' ); ?>
		<?php do_action( 'vmagazine_after_sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
