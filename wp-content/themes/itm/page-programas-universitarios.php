<?php
/*
Template Name: Página programas universitarios
*/
/*
 * Template para visualizar el loop de las programas universitarios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header();

global $ecp_post, $ecp_category, $facultades;

get_ecp_post();

// Facultad actual
$facultad	= get_category($ecp_category->parent);

// Facultades
$facultades = get_categories(array(
		'type'                     => 'post',
		'child_of'                 => '',
		'parent'                   => $facultad->parent,
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => false,
		'hierarchical'             => false,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false
	)
);

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="ctn_cover-image">
			</div>
			<div class="ctn__content container">
				<header class="ctn__header-content">
					<h1 class="entry-title"><?php echo get_the_title($ecp_post->ID); ?></h1>
					<div class="ctn__info-header">
						<div class="ctn__breadcrumbs">
							<span><a href="#">Home</a></span><span><a href="#">Estudiar en el ITM</a></span><span><a href="#">Programas universitarios</a></span>
						</div><!-- ctn__breadcrumbs -->
						<div class="entry-content padding">
							<span class="text-filters">Conoce los programas universitarios que ofrece el ITM</span>
						</div><!-- .entry-content -->
						<div class="ctn__input-filter padding">
							<div class="input-filter">
								<form action="">
									<input type="text" placeholder="Escribe el nombre del programa">
								</form>
							</div>
						</div><!-- ctn__input-filter -->
						<div class="ctn__faculty-filter padding">
							<span class="text-filters">Filtra por Facultad</span>
							<div class="faculty-filter">
								<span class="filter-label facultades">Todas las facultades</span>
								<?php foreach ($facultades as $value): ?>

								<?php $select = ''; ?>
								<?php if ($facultad->slug == $value->slug): ?>
									<?php $select = ' select' ?>
								<?php endif; ?>

								<?php if ($value->slug == 'facultad-de-artes-y-humanidades'): ?>
								<span class="filter-label artes-y-humanidades<?php echo $select; ?>"><?php echo $value->name; ?></span>
								<?php endif; ?>

								<?php if ($value->slug == 'facultad-de-ciencias-economicas'): ?>
								<span class="filter-label ciencias-economicas<?php echo $select; ?>"><?php echo $value->name; ?></span>
								<?php endif; ?>

								<?php if ($value->slug == 'facultad-de-ciencias-exactas-y-aplicadas'): ?>
								<span class="filter-label ciencias-exactas<?php echo $select; ?>"><?php echo $value->name; ?></span>
								<?php endif; ?>

								<?php if ($value->slug == 'facultad-de-ingenierias'): ?>
								<span class="filter-label ingenierias<?php echo $select; ?>"><?php echo $value->name; ?></span>
								<?php endif; ?>

								<?php endforeach; ?>
							</div>
						</div><!-- ctn__faculty-filter -->
						<div class="ctn__program-filter padding">
							<span class="text-filters">Filtra por el tipo de programa</span>
							<div class="program-filters">
								<form action="">
									<div class="ctn__filter checkbox-itm">
										<input id="posgrados" type="checkbox">
										<label for="posgrados">Posgrados</label>
									</div>
									<div class="ctn__filter checkbox-itm">
										<input id="pregrados" type="checkbox">
										<label for="pregrados">Pregrados</label>
									</div>
								</form>
							</div>
						</div><!-- ctn__program-filter -->
						<div class="ctn__metodology-filters padding">
							<span class="text-filters">Metodología</span>
							<div class="metodology-filters">
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
					<?php get_template_part( 'template-parts/content', 'programas-universitarios-facultades' ); ?>
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
