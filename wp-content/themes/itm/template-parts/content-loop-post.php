<?php
/**
 * Template part para visualizar el loop de las noticias (título y fecha).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

$post_date		= mysql2date('j F Y', $post->post_date);
$post_date		= explode(' ', $post_date);
$post_date[1]	= ucfirst($post_date[1]);
$post_date		= join($post_date, " de ");
$title			= get_the_title();

if (has_post_thumbnail($post->ID ))
{
	$image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail');
	$image = $image[0];
}
else
	$image = get_template_directory_uri() . '/images/no-image.jpg';

$permalink		= get_the_permalink();

$field			= get_field_object('ocultar_fecha');
$ocultar_fecha	= $field['value'];

?>
<div class="grid-item">
	<a href="<?php echo $permalink; ?>" class="ctn__preview ctn__preview-news">
		<div class="ctn__preview-image" style="background: url(<?php echo $image; ?>) no-repeat; background-size: 100%; background-position: center center">
			<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="preview-image">
		</div>
		<div class="ctn__preview-title">
			<h2 class="preview-title">
				<?php echo $title; ?>
			</h2>
		</div>
		<?php if ($ocultar_fecha == 'no'): ?>
		<div class="ctn__preview-news_date">
			<span class="preview-news_date"><?php echo $post_date; ?></span>
		</div>
		<?php endif; ?>
	</a href="#"><!-- ctn__preview -->
</div><!-- /grid-item -->