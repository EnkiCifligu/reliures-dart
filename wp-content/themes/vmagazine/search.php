<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

get_header(); ?>

	<div class="vmagazine-container container-wrapp-inner">
		<?php do_action( 'vmagazine_before_body_content' ); ?>
		<div id="primary" class="content-area vmagazine-content">
			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : 
			
				
				/* Start the Loop */
				$vmagazine_archive_layout = get_theme_mod( 'vmagazine_archive_layout', 'layout1' );
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if( $vmagazine_archive_layout == 'layout1' ) {
						get_template_part( 'layouts/archive/content', 'layout1' );
					} elseif( $vmagazine_archive_layout == 'layout2' ) {						
						get_template_part( 'layouts/archive/content', 'layout2' );						
					} elseif( $vmagazine_archive_layout == 'layout3' ) {
						get_template_part( 'layouts/archive/content', 'layout3' );
					} else {
						get_template_part( 'layouts/archive/content', 'layout4' );
					}

				endwhile;

				

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			
			</main><!-- #main -->
			<div class="archive-bottom-wrapper">
				<?php the_posts_pagination(); ?>
				
				<?php vmagazine_entry_footer(); ?>
			</div>

		</div><!-- #primary -->
		<?php vmagazine_get_sidebar(); ?>
		<?php do_action( 'vmagazine_after_body_content' ); ?>
	</div><!-- .vmagazine-container -->

<?php
get_footer();
