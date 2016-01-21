<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!--<div class="entry-meta">
			<?php itm_posted_on(); ?>
		</div> .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			/*wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'itm' ),
				'after'  => '</div>',
			) );*/
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php itm_entry_footer(); ?>
	</footer> .entry-footer -->
</article><!-- #post-## -->

