<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package itm
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="ctn_cover-image" style="background: url(/wp-content/themes/itm/images/no-cover.jpg) no-repeat;background-size: cover;"></div>
            <div class="ctn__content container">
                <header class="ctn__header-content">
					<h1 class="entry-title">ERROR 404</h1>
                </header>
                <section class="ctn__section-content programa clearfix error-404 not-found">
                    <div class="body">
                        <div class="page-content clearfix">
                            <h1 class="title">¡Ups!</h1>
                            <h3 class="subtitle">No encontramos la página que buscas</h3>
                            <div class="message-content">
                                <p class="primary-text">
                                    <b>Intenta de nuevo</b>
                                    <br>
                                    Puede ser que la página que buscas ya no está disponible en nuestro sitio o te has confundido al escribir lo que buscas.
                                    Te sugerimos buscar de nuevo o visitar una de las secciones activas de nuestro sitio.
                                </p>
                                <p class="secundary-text">
                                    Visita alguna de nuestras páginas activas: 
                                </p>
                            </div>
                            <div class="col-md-8 clearfix">
                                <div class="col-md-6">
                                    <div class="ctn__404-1-menu">
                                        <div class="container">
                                            <?php wp_nav_menu( array( 
                                                'theme_location' => 'error-404-1',
                                                'menu_id' => 'error-404-1',
                                                'menu_class' => 'error-404-1 menu-vertical',
                                                'container' => 'div',
                                                'container_class' => 'ctn__404-1-menu-bar-navigation',
                                            ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ctn__404-2-menu">
                                        <div class="container">
                                            <?php wp_nav_menu( array( 
                                                'theme_location' => 'error-404-2',
                                                'menu_id' => 'error-404-2',
                                                'menu_class' => 'error-404-2 menu-vertical',
                                                'container' => 'div',
                                                'container_class' => 'ctn__404-2-menu-bar-navigation',
                                            ) ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- .page-content -->
                    </div>
                </section><!-- .error-404 -->
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
