<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

global $ecp_post, $ecp_category;

?>

<article id="post-<?php echo $ecp_post->ID; ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php //itm_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$post_date		= mysql2date('j F Y', $ecp_post->post_date);
			$post_date		= explode(' ', $post_date);
			$post_date[1]	= ucfirst($post_date[1]);
			$post_date		= join($post_date, " de ");
			echo $post_date;

			if (has_post_thumbnail($ecp_post->ID))
				echo get_the_post_thumbnail($ecp_post->ID);

			$content 	= apply_filters('the_content', $ecp_post->post_content);
			$content 	= str_replace(']]>', ']]&gt;', $content);
			echo $content;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php itm_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

