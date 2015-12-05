<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package itm
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="ctn__site-footer" role="contentinfo">
		<div class="ctn__footer-logos">
			<div class="logo">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-branding"><?php bloginfo( 'name' ); ?></a></h1>
			</div>
			<div class="ctn__footer-menu">
				Menu footer
			</div>
			<div class="ctn__logos-pie">
				<div class="ctn__logos-acreditacion">
					<div class="logos-acreditacion">
						<h3 class="acreditacion-itm">
							Logos de la acreditación del ITM
						</h3>
					</div>
				</div>
				<div class="ctn__redes">
					<div class="container">
						<ul class="menu-horizontal logos-redes">
							<li><a href="https://twitter.com/ITM_Medellin" class="icon-itm icon-twitter" target="_blank" title="Enlace al perfil de Twitter del ITM"></a></li>
							<li><a href="https://www.facebook.com/ITMinstitucional?fref=ts" class="icon-itm icon-facebook" target="_blank" title="Enlace al perfil de Facebook del ITM"></a></li>
							<li><a href="http://www.youtube.com/user/comunicacionitm/videos" class="icon-itm icon-youtube" target="_blank" title="Enlace al perfil de YouTube del ITM"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="ctn__footer-direccion">
				<?php dynamic_sidebar( 'direccion' ); ?>
			</div>
			<?php wp_nav_menu( array( 
				'theme_location' => 'footer-menu', 
				'menu_id' => 'footer-menu',
				'menu_class' => 'footer-menu menu-horizontal',
				'container' => 'div',
				'container_class' => 'ctn__footer-navigation',
			 ) ); ?>
			<div class="ctn__footer-logos">
				Logos
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
