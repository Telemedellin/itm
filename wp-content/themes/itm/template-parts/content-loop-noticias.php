<?php
/**
 * Template part para visualizar el loop de las noticias (título y fecha).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

?>
<div class="ctn_cover-image">
</div>
<div class="ctn__content container">
	<header class="ctn__header-content">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="ctn__info-header">
			<div class="ctn__breadcrumbs">
				<span><a href="#">Home</a></span><span><a href="#">Estudiar en el ITM</a></span><span><a href="#">Programas universitarios</a></span>
			</div><!-- ctn__breadcrumbs -->
		</div><!-- ctn__info-header -->
	</header><!-- ctn__header-content -->
	<section class="ctn__section-content padding-content">
		<div class="grid-item">
			<a href="#" class="ctn__preview ctn__preview-news">
				<div class="ctn__preview-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
					<img src="" alt="" class="preview-image">
				</div>
				<div class="ctn__preview-title">
					<h2 class="preview-title">
						Título del artículo o de la noticia, que puede ser un poco largo
					</h2>
				</div>
				<div class="ctn__preview-news_date">
					<span class="preview-news_date">31 de mayo de 2016</span>
				</div>
			</a href="#"><!-- ctn__preview -->
		</div><!-- /grid-item -->
	</section><!-- ctn__section-content -->
</div>