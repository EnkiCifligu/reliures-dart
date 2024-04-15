<?php
/**
 * Template part for displaying archive posts in layout 3.
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
        $img_src = vmagazine_home_element_img('vmagazine-long-post-thumb');
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
			<div class="post-content-wrapper">
				<div class="post-title-wrap">
					<?php do_action( 'vmagazine_post_cat_or_tag_lists' ); ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php echo vmagazine_title_excerpt(60); ?>
						</a>
					</h2>
					<div class="entry-header">
						<?php if( 'post' === get_post_type() ) { ?>
							<div class="entry-meta">
								<?php vmagazine_icon_meta();?>
							</div><!-- .entry-meta -->
						<?php } ?>
					</div><!-- .entry-header.layout1-header -->
				</div>
			
				<div class="entry-content">
					<p>
					<?php
						$vmagazine_post_content = get_the_content();
						$vmagazine_excerpt_length = get_theme_mod( 'vmagazine_archive_excerpt_lenght', '150' );
						echo vmagazine_get_excerpt_content( $vmagazine_excerpt_length );
					?>
					</p>
				</div><!-- .entry-content -->
		</div>		
		</div>
		
</article><!-- #post-## -->