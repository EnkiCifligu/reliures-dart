<?php
/**
 * Template part for displaying archive posts in layout 4.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AccessPress Themes
 * @subpackage Vmagazine
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        $img_src = vmagazine_home_element_img('vmagazine-archive-large');
		?>
		<div class="archive-post">
			<?php if( $img_src ): ?>
			<div class="post-img">
				<a class="thumb-zoom" href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" />
					<div class="image-overlay"></div>
				</a>
			</div>
			<?php endif; ?>
			<div class="post-title-wrap">
				<div class="entry-header">
					<?php if( 'post' === get_post_type() ) { ?>
						<div class="entry-meta">
							<?php vmagazine_icon_meta();?>
						</div><!-- .entry-meta -->
					<?php } ?>
				</div><!-- .entry-header.layout1-header -->
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
			<div class="entry-content">
				<p>
				<?php
					$vmagazine_post_content = get_the_content();
					$vmagazine_excerpt_length = get_theme_mod( 'vmagazine_archive_excerpt_lenght', '150' );
					echo vmagazine_get_excerpt_content( $vmagazine_excerpt_length );
				?>
				</p>
				<?php 
					$vmagazine_read_more_txt = get_theme_mod( 'vmagazine_archive_read_more_text', __( 'Read More', 'vmagazine' ) );
				 ?>		
				<a class="vmagazine-archive-more" href="<?php the_permalink(); ?>">
					<?php echo esc_html( $vmagazine_read_more_txt ); ?>
				</a>
			</div><!-- .entry-content -->

		</div>
</article><!-- #post-## -->