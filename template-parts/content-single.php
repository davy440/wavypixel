<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wavypixel
 */

?>

<article class="single-style1" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	   <div class="secondary-content">
			<?php wavypixel_post_thumbnail();?>
		</div>

		<?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				wavypixel_posted_on();
				wavypixel_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wavypixel' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

