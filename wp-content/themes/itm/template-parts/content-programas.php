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
			$content 	= apply_filters('the_content', $ecp_post->post_content);
			$content 	= str_replace(']]>', ']]&gt;', $content);
			echo $content;
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

