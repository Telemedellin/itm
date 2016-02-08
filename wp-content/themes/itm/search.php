<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package itm
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="ctn_cover-image" style="background: url(<?php echo get_template_directory_uri(); ?>/images/no-cover.jpg) no-repeat;background-size: cover;"></div>
			<div class="ctn__content container">
				<?php if ( have_posts() ) : ?>
				<header class="ctn__header-content">
					<h1 class="entry-title">RESULTADOS DE LA BÚSQUEDA</h1>
					<div class="ctn__info-header">
						<div class="ctn__breadcrumbs breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
							<?php if(function_exists('bcn_display'))
							{
								bcn_display();
							}?>
						</div><!-- ctn__breadcrumbs -->
					</div><!-- ctn__info-header -->
				</header>
				<section class="ctn__section-content search clearfix">
					<div class="container">
						<div class="col-md-12">
						<?php printf('Resultados para la busqueda: "<span class="criteria">'.esc_html__('%s', 'itm' ).'</span>"', '<span>' . get_search_query() . '</span>'); ?>
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
							?>

						<?php endwhile; ?>
						</div>

						<?php the_posts_navigation(); ?>
					</div>
				</section>
				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
