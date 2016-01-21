<?php
/*
Template Name: Template para la categoría extension academica
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

$data = get_category_setting($ecp_category);
extract($data);

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="ctn_cover-image" style="background: url(<?php echo $cover; ?>) no-repeat;background-size: cover;"></div>
			<div class="ctn__content container">
				<header class="ctn__header-content">
					<h1 class="entry-title"><?php echo $ecp_category->name; ?></h1>
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
						<div class="menu-lateral_titulo">
							<h3>Menú de navegación</h3>
						</div>
						<?php
							echo $menu;
						?>

						<?php
							dynamic_sidebar($sidebar);
						?>
						
						<?php

							$field				= get_field_object('ext_tipo_programa', $ecp_post->ID);
							$tipo				= $field['value'][0];
							$tipo_text			= $field['choices'][$tipo];

							$field				= get_field_object('sede', $ecp_post->ID);
							$sede				= $field['value'];
							$sede_text			= $field['choices'][$sede];

							$intensidad_horaria	= get_field('intensidad_horaria', $ecp_post->ID);

						?>
						<div class="ctn__programa-bottom clearfix">
							<dl>
								<dt>Tipo de programa</dt>
									<dd><?php echo $tipo_text; ?></dd>
								<dt>Sede</dt>
									<dd><?php echo $sede_text; ?></dd>
								<dt>Intensidad horaria</dt>
									<dd><?php echo $intensidad_horaria; ?></dd>
							</dl>
						</div>
						<div class="clearfix padding"></div>
					</div>
					<div class="col-md-9">
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