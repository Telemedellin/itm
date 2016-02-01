<?php
/*
Template Name: Template para recorrer los posts.
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

$data		= get_category_setting($ecp_category);
$category_a	= get_category($ecp_category->parent);
$category_b	= get_category($category_a->parent);
$class 		= '';

if (empty($class)) $class = get_class_border($ecp_category->slug);
if (empty($class)) $class = get_class_border($category_a->slug);
if (empty($class)) $class = get_class_border($category_b->slug);

extract($data);

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="ctn_cover-image" style="background: url(<?php echo $cover; ?>) no-repeat;background-size: cover;"></div>
		<div class="ctn__content container">
			<header class="ctn__header-content">
				<h1 class="entry-title <?php echo $class; ?>"><?php echo get_the_title($ecp_post->ID); ?></h1>
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
					</div>
					<div class="col-md-9">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'loop-post' ); ?>
						<?php endwhile; // End of the loop. ?>
					</div>
				</div>
			</section><!-- ctn__section-content -->
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>