<?php
/**
 * Template part para visualizar el loop de categorías.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

$ecpPost = get_ecp_post($category->term_id);

if (has_post_thumbnail($ecpPost->ID ))
{
	$image = wp_get_attachment_image_src(get_post_thumbnail_id( $ecpPost->ID ), 'single-post-thumbnail');
	$image = $image[0];
}
else
	$image = get_field('imagen_portada', $ecpPost->ID);

$titulo = $category->name;
$enlace = get_category_link($category->term_id);
$class  = '';

switch ($category->slug)
{
	case 'facultad-de-artes-y-humanidades':
		$class = 'artes-y-humanidades';
		break;
	case 'facultad-de-ciencias-economicas':
		$class = 'ciencias-economicas';
		break;
	case 'facultad-de-ciencias-exactas-y-aplicadas':
		$class = 'ciencias-exactas';
		break;
	case 'facultad-de-ingenierias':
		$class = 'ingenierias';
		break;
}

?>

<div class="grid-item">
	<a href="<?php echo $enlace; ?>" class="ctn__preview">
		<div class="ctn__preview-image" style="background: url(<?php echo $image; ?>) no-repeat; background-size: 100%; background-position: center center">
			<img src="" alt="" class="preview-image">
		</div>
		<div class="ctn__preview-title brd__<?php echo $class; ?>">
			<h2 class="preview-title">
				<?php echo $titulo; ?>
			</h2>
		</div>
	</a><!-- ctn__preview -->			
</div>