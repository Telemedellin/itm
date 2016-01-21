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

global $ecp_category;

get_ecp_post();

$data		= get_category_setting($ecp_category);
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
			<section class="ctn__section-content padding-content">
				<div class="row">
					<div class="col-md-3 ctn__menu-lateral">
						<?php if (!empty($menu)): ?>
						<div class="menu-lateral_titulo">
							<h3>Menú de navegación</h3>
						</div>
						<?php
							echo $menu;
						?>
						<?php endif; ?>
						<?php dynamic_sidebar($sidebar); ?>
					</div>
					<div class="col-md-9">
						<?php if (have_posts()): ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content', 'loop-post' ); ?>
							<?php endwhile; // End of the loop. ?>
						<?php else: ?>
						<?php endif; ?>
					</div>
				</div>
			</section><!-- ctn__section-content -->
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
