<?php
/*
Template Name: Template para recorrer las noticias.
*/
/*
 * Template para recorrer categorías o artículos.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header();

global $ecp_post, $ecp_category;

get_ecp_post();

$menu			= get_field('menu', $ecp_post->ID);
$sidebar		= get_field('sidebar', $ecp_post->ID);

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="ctn_cover-image">
		</div>
		<div class="ctn__content container">
			<header class="ctn__header-content">
				<h1 class="entry-title"><?php echo get_the_title($ecp_post->ID); ?></h1>
				<div class="ctn__info-header">
					<div class="ctn__breadcrumbs breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php if(function_exists('bcn_display'))
						{
							bcn_display();
						}?>
					</div><!-- ctn__breadcrumbs -->
				</div><!-- ctn__info-header -->
			</header><!-- ctn__header-content -->
			<section class="ctn__section-content padding-content">
				<div class="row">
					<div class="col-md-3 ctn__menu-lateral">
						<div class="menu-lateral_titulo <?php echo $class; ?>">
							<h3>Menú de navegación</h3>
						</div>
						<?php
							echo $menu;
						?>
						<?php dynamic_sidebar($sidebar); ?>
					</div>
					<div class="col-md-9">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'loop-noticias' ); ?>
						<?php endwhile; // End of the loop. ?>
					</div>
				</div>
			</section><!-- ctn__section-content -->
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
