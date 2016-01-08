<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package itm
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,600,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,600,700' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'itm' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="ctn__header-top-bar hidden-xs">
			<div class="top-bar container">
				<?php wp_nav_menu( array( 
					'theme_location' => 'top-bar-menu', 
					'menu_id' => 'top-bar-menu',
					'menu_class' => 'top-bar-menu menu-horizontal',
					'container' => 'div',
					'container_class' => 'ctn__top-bar-navigation',
				 ) ); ?>
			</div>
		</div><!-- /ctn__top-bar -->
		<div class="ctn__header-middle-bar">
			<div class="middle-bar container">
				<?php wp_nav_menu( array( 
					'theme_location' => 'users-menu', 
					'menu_id' => 'users-menu',
					'menu_class' => 'users-menu menu-horizontal',
					'container' => 'div',
					'container_class' => 'ctn__users-navigation',
				 ) ); ?>
				<div class="ctn__site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-branding"><?php bloginfo( 'name' ); ?></a></h1>
				</div>
				<div class="ctn__search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div><!-- /ctn__header-middle-bar -->
		<div class="ctn__header-bottom-bar">
			<nav id="site-navigation" class="main-navigation container" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div><!-- /ctn__header-bottom-bar -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">
