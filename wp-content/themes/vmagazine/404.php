<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

get_header(); ?>

	<div class="vmagazine-container">
		<?php do_action( 'vmagazine_before_body_content' ); ?>
		
		<main id="main" class="site-main" role="main">

			<div class="error-404 not-found">
				<div class="vmagazine-404">
					<span><?php esc_html_e( '4', 'vmagazine' );?></span>
					<span class="zero"><?php esc_html_e( '0', 'vmagazine' );?></span>
					<span><?php esc_html_e( '4', 'vmagazine' );?></span>
				</div>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'vmagazine' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'vmagazine' ); ?></p>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
			

		</main><!-- #main -->
		
		<?php do_action( 'vmagazine_after_body_content' ); ?>
	</div><!-- .vmagazine-container -->

<?php
get_footer();
