<?php
/*
Template Name: Template categoría formación
*/
/*
 * Template para visualizar el loop de todos los programas universitarios en cada facultad.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header();

global $ecp_post, $ecp_category, $facultades;

get_ecp_post();

// Facultad actual
$facultades[0]	= get_category($ecp_category->parent);

$class = '';
switch ($facultades[0]->slug)
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

	<div id="primary" class="content-area" cat="<?php echo get_query_var('cat'); ?>">
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
						<div class="entry-content padding">
							<span class="text-filters">Conoce los programas universitarios que ofrece el ITM</span>
						</div><!-- .entry-content -->
						<div class="ctn__input-filter padding">
							<div class="input-filter">
								<form action="">
									<input id="programa" type="text" placeholder="Escribe el nombre del programa">
								</form>
							</div>
						</div><!-- ctn__input-filter -->
						<div class="ctn__input-result">
						</div><!-- ctn__input-filter -->
						<div class="ctn__program-filter padding">
							<span class="text-filters">Filtra por el tipo de programa</span>
							<div class="formacion-filters">
								<form action="">
									<div class="ctn__filter checkbox-itm">
										<input id="posgrado" type="checkbox">
										<label for="posgrado">Posgrados</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="pregrado" type="checkbox">
										<label for="pregrado">Pregrados</label>
									</div>
								</form>
							</div>
						</div><!-- ctn__program-filter -->
						<div class="ctn__metodology-filters padding">
							<span class="text-filters">Metodología</span>
							<div class="metodology-formacion-filters">
								<form action="">
									<div class="ctn__filter checkbox-itm">
										<input id="virtual" type="checkbox">
										<label for="virtual">Virtual</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="presencial" type="checkbox">
										<label for="presencial">Presencial</label>
									</div>
								</form>
							</div>
						</div><!-- ctn__metodology-filters -->
					</div><!-- ctn__info-header -->
				</header><!-- ctn__header-content -->
				<section class="ctn__section-content">
					<div class="overlay-filter">
						<span class="overlay-text">Filtrando resultados...</span>
						<div class="ctn__loader">
							<div class="sk-circle">
							  <div class="sk-circle1 sk-child"></div>
							  <div class="sk-circle2 sk-child"></div>
							  <div class="sk-circle3 sk-child"></div>
							  <div class="sk-circle4 sk-child"></div>
							  <div class="sk-circle5 sk-child"></div>
							  <div class="sk-circle6 sk-child"></div>
							  <div class="sk-circle7 sk-child"></div>
							  <div class="sk-circle8 sk-child"></div>
							  <div class="sk-circle9 sk-child"></div>
							  <div class="sk-circle10 sk-child"></div>
							  <div class="sk-circle11 sk-child"></div>
							  <div class="sk-circle12 sk-child"></div>
							</div>
						</div>
					</div>
					<?php get_template_part( 'template-parts/content', 'formacion' ); ?>
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
