<?php
/**
 * Template part para visualizar el loop de categorías.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

$imagen = get_field('imagen_portada', $ecp_post->ID);
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
		<div class="ctn__preview-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
			<img src="" alt="" class="preview-image">
		</div>
		<div class="ctn__preview-title brd__<?php echo $class; ?>">
			<h2 class="preview-title">
				<?php echo $titulo; ?>
			</h2>
		</div>
	</a><!-- ctn__preview -->			
</div>