<?php
/*
Template Name: template para la categoría de extensión académica.
*/
/*
 * Template para visualizar el loop de las programas de extensión académica.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header();

global $ecp_post, $ecp_category, $extensiones, $tipos;

get_ecp_post();

set_include_path(get_include_path() . PATH_SEPARATOR . get_template_directory() . '/libs/linq/');
require_once('PHPLinq/LinqToObjects.php');

$data = get_categories(array(
		'type'                     => 'post',
		'child_of'                 => $ecp_category->term_id,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 0,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false 
	)
);

$extensiones = array();

foreach ($data as $extension)
{
	$ecpPost = get_ecp_post($extension->term_id);

	$extension->tipo_programa	= get_field('tipo_de_programa_academico', $ecpPost->ID);
	$extension->image			= get_the_post_thumbnail($ecpPost->ID);
	
	$field						= get_field_object('ext_tipo_programa', $ecpPost->ID);
	$tipo						= $field['value'][0];
	$tipo_text					= $field['choices'][$tipo];
	$extension->tipo			= $tipo;
	$extension->tipo_text		= $tipo_text;

	$field						= get_field_object('sede', $ecpPost->ID);
	$sede						= $field['value'];
	$sede_text					= $field['choices'][$sede];
	$extension->sede			= $sede;
	$extension->sede_text		= $sede_text;

	$extension->intensidad		= get_field('intensidad_horaria', $ecpPost->ID);
	$extension->enlace			= get_category_link($extension->term_id);

	$extensiones[$tipo_text][] = $extension;
}

?>
	<div id="primary" class="content-area" cat="<?php echo get_query_var('cat'); ?>">
		<main id="main" class="site-main" role="main">
			<div class="ctn_cover-image">
			</div>
			<div class="ctn__content container">
				<header class="ctn__header-content">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<div class="ctn__info-header">
						<div class="ctn__breadcrumbs breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
							<?php if(function_exists('bcn_display'))
							{
								bcn_display();
							}?>
						</div><!-- ctn__breadcrumbs -->
						<div class="entry-content padding">
							<span class="text-filters">Conoce los programas de extensión académica que ofrece el ITM</span>
						</div><!-- .entry-content -->
						<div class="ctn__input-filter padding">
							<div class="input-filter">
								<form action="">
									<input id="extension" type="text" placeholder="Escribe el nombre del programa">
								</form>
							</div>
						</div><!-- ctn__input-filter -->
						<div class="ctn__input-result">
						</div><!-- ctn__input-filter -->
						<div class="ctn__extension-filter padding">
							<span class="text-filters">Filtra por el tipo de programa</span>
							<div class="extension-filter">
								<span class="filter-label" rel="diplomados">Diplomados</span>
								<span class="filter-label" rel="cursos">Cursos</span>
								<span class="filter-label" rel="seminarios">Seminarios</span>
								<span class="filter-label" rel="talleres">Talleres</span>
								<span class="filter-label" rel="semilleros">Semilleros</span>
								<span class="filter-label" rel="simposios">Simposios</span>
								<span class="filter-label" rel="encuentros">Encuentros</span>
							</div>
						</div><!-- ctn__faculty-filter -->
						<div class="ctn__sede-filter padding">
							<span class="text-filters">Filtra por la sede</span>
							<div class="sede-filters">
								<form action="">
									<div class="ctn__filter checkbox-itm">
										<input id="campus-robledo" type="checkbox">
										<label for="campus-robledo">Campus Robledo</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="campus-fraternidad" type="checkbox">
										<label for="campus-fraternidad">Campus Fraternidad</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="campus-castilla" type="checkbox">
										<label for="campus-castilla">Campus Castilla</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="campus-prado" type="checkbox">
										<label for="campus-prado">Campus Prado</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="campus-la-floresta" type="checkbox">
										<label for="campus-la-floresta">Campus La Floresta</label>
									</div>
								</form>
							</div>
						</div><!-- ctn__program-filter -->
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
					<?php get_template_part( 'template-parts/content', 'programas-extension' ); ?>
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
