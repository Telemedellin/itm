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

get_header();

global $ecp_post;

get_ecp_post();

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
				<?php
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
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
