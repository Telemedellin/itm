<?php
/*
Template Name: Template categoría programas academicos
*/
/*
 * Template para visualizar la página inicial de un programa académico.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header();

global $ecp_post, $ecp_category;

get_ecp_post();

// Facultad actual
$facultad	= get_category(get_category($ecp_category->parent)->parent);

$class = '';
switch ($facultad->slug)
{
	case 'facultad-de-artes-y-humanidades':
		$class = ' artes-y-humanidades';
		break;
	case 'facultad-de-ciencias-economicas':
		$class = ' ciencias-economicas';
		break;
	case 'facultad-de-ciencias-exactas-y-aplicadas':
		$class = ' ciencias-exactas';
		break;
	case 'facultad-de-ingenierias':
		$class = ' ingenierias';
		break;
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="ctn_cover-image">
			</div>
			<div class="ctn__content container">
				<header class="ctn__header-content">
					<h1 class="entry-title<?php echo $class; ?>"><?php echo get_the_title($ecp_post->ID); ?></h1>
					<div class="ctn__info-header">
						<div class="ctn__breadcrumbs breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
							<?php if(function_exists('bcn_display'))
							{
								bcn_display();
							}?>
						</div><!-- ctn__breadcrumbs -->
					</div><!-- ctn__info-header -->
				</header><!-- ctn__header-content -->
				<section class="ctn__section-content programa clearfix">
					<div class="col-md-3 ctn__menu-lateral">
						<div class="menu-lateral_titulo <?php echo $class; ?>">
							<h3>Menú de navegación</h3>
						</div>
						<?php
							$field = get_field_object('menu', $ecp_post->ID);
							$value = get_field('menu', $ecp_post->ID);
							$label = $field['choices'][ $value ];
							echo $value
						?>

						<?php
							$sidebar	= get_field('sidebar', $ecp_post->ID);
							dynamic_sidebar($sidebar);
						?>
						
						<?php
							$titulo_otorgado	= get_field('titulo_otorgado', $ecp_post->ID);

							$field				= get_field_object('modalidad', $ecp_post->ID);
							$modalidad			= $field['choices'][$field['value'][0]];

							$duracion			= get_field('duracion', $ecp_post->ID);
						?>
						<div class="ctn__programa-bottom clearfix<?php echo $class; ?>">
							<dl>
								<dt>Título a otorgar</dt>
									<dd><?php echo $titulo_otorgado; ?></dd>
								<dt>Modalidad</dt>
									<dd><?php echo $modalidad; ?></dd>
								<dt>Duración</dt>
									<dd><?php echo $duracion; ?></dd>
							</dl>
						</div>
						<div class="clearfix padding"></div>
					</div>
					<div class="col-md-9">
						<?php echo $post_date; ?>
						<?php get_template_part( 'template-parts/content', 'programas' ); ?>
					</div>
				</section><!-- ctn__section-content -->
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
