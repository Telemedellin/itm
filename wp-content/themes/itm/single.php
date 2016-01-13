<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package itm
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="ctn_cover-image">
		</div>
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
				<div class="col-md-3 ctn__menu-lateral">
					<div class="menu-lateral_titulo <?php echo $class; ?>">
						<h3>Menú de navegación</h3>
					</div>
					<?php
						$field = get_field_object('menu', $ecp_post->ID);
						$value = get_field('menu', $ecp_post->ID);
						$label = $field['choices'][ $value ];
						echo $value
					?>
					<?php get_sidebar(); ?>
					<div class="clearfix padding"></div>
				</div>
				<div class="col-md-9">
					<?php echo $post_date; ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>
				</div>
			</section><!-- ctn__section-content -->
		</div>



	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>