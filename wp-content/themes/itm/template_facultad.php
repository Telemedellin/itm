<?php
/*
Template Name: Template para el inicio micrositio
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

$class = '';
switch ($ecp_category->slug)
{
	case 'facultad-de-artes-y-humanidades':
		$class = ' artes-y-humanidades';
		break;
	case 'facultad-de-ciencias-economicas-y-administrativas':
		$class = ' ciencias-economicas';
		break;
	case 'facultad-de-ciencias-exactas-y-aplicadas':
		$class = ' ciencias-exactas';
		break;
	case 'facultad-de-ingenierias':
		$class = ' ingenierias';
		break;
}

$data		= get_category_setting($ecp_category);
$title		= $ecp_category->name;

extract($data);

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="ctn_cover-image" style="background: url(<?php echo $cover; ?>) no-repeat;background-size: cover;"></div>
			<div class="ctn__content container">
				<header class="ctn__header-content">
					<h1 class="entry-title<?php echo $class; ?>"><?php echo $title; ?></h1>
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
						<?php if ((!empty($menu)) && (!is_null($menu)) && (!is_bool($menu))): ?>
						<div class="menu-lateral_titulo <?php echo $class; ?>">
							<h3>Menú de navegación</h3>
						</div>
						<?php
							echo $menu;
						endif;

						if ((!empty($sidebar)) && (!is_null($sidebar)) && (!is_bool($sidebar))):
							dynamic_sidebar($sidebar);
						endif;
						?>
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
