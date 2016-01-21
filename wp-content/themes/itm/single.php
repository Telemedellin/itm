<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package itm
 */

get_header();

$term		= get_the_category();
$term		= $term[0];

$data		= get_category_setting($term);
$facultad	= get_category($term->parent);

extract($data);

$class = '';
switch ($facultad->slug)
{
	case 'facultad-de-artes-y-humanidades':
		$class = ' artes-y-humanidades';
		break;
	case 'facultad-de-ciencias-economicas':
		$class = ' ciencias-economicas';
		break;
	case 'facultad-de-ciencias-exactas-y-aplicadas':
		$class = ' ciencias-exactas';
		break;
	case 'facultad-de-ingenierias':
		$class = ' ingenierias';
		break;
}

$post_date		= mysql2date('j F Y', $post->post_date);
$post_date		= explode(' ', $post_date);
$post_date[1]	= ucfirst($post_date[1]);
$post_date		= join($post_date, " de ");

$field			= get_field_object('ocultar_fecha');
$ocultar_fecha	= $field['value'];

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="ctn_cover-image" style="background: url(<?php echo $cover; ?>) no-repeat;background-size: cover;"></div>
		<div class="ctn__content container">
			<header class="ctn__header-content">
				<h1 class="entry-title<?php echo $class; ?>"><?php echo get_the_title($ecp_post->ID); ?></h1>
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
				<?php if (!is_null($menu) || !is_null($sidebar)):  ?>
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
					<?php
						if ($ocultar_fecha == 'no')
							echo $post_date;
					?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							/*if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;*/
						?>

					<?php endwhile; // End of the loop. ?>
				</div>
				<?php else: ?>
				<?php
					if ($ocultar_fecha == 'no')
						echo $post_date;
				?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						/*if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;*/
					?>

				<?php endwhile; // End of the loop. ?>
				<?php endif; ?>
			</section><!-- ctn__section-content -->
		</div>



	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>