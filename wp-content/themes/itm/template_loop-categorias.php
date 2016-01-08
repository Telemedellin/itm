<?php
/*
Template Name: Template para recorrer categorias.
*/
/*
 * Template para recorrer categorías o artículos.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if (have_posts()): ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'loop-noticias' ); ?>
			<?php endwhile; // End of the loop. ?>
			<?php else: ?>
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
					</div><!-- ctn__info-header -->
				</header><!-- ctn__header-content -->
				<section class="ctn__section-content padding-content">
				<?php
					global $ecp_post;

					get_ecp_post();

					$categories = get_categories(array(
							'type'                     => 'post',
							'child_of'                 => '',
							'parent'                   => get_query_var('cat'),
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

					foreach ($categories as $category):
						require 'template-parts/content-loop-categorias.php';
					endforeach;
				?>
				</section><!-- ctn__section-content -->
			</div>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
