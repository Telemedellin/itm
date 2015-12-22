<?php
/**
 * Template part para visualizar el loop de los programas universitarios.
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
			<div class="entry-content padding">
				<span class="text-filters">Conoce los programas universitarios que ofrece el ITM</span>
			</div><!-- .entry-content -->
			<div class="ctn__input-filter padding">
				<div class="input-filter">
					<form action="">
						<input type="text" placeholder="Escribe el nombre del programa">
					</form>
				</div>
			</div><!-- ctn__input-filter -->
			<div class="ctn__faculty-filter padding">
				<span class="text-filters">Filtra por Facultad</span>
				<div class="faculty-filter">
					<span class="filter-label facultades">Todas las facultades</span>
					<span class="filter-label artes-y-humanidades">Facultad de Artes y Humanidades</span>
					<span class="filter-label ciencias-economicas select">Facultad de Ciencias Económicas y Administrativas</span>
					<span class="filter-label ingenierias">Facultad de Ingenierías</span>
					<span class="filter-label ciencias-exactas">Facultad de Ciencias Exactas y Aplicadas</span>
				</div>
			</div><!-- ctn__faculty-filter -->
			<div class="ctn__program-filter padding">
				<span class="text-filters">Filtra por el tipo de programa</span>
				<div class="program-filters">
					<form action="">
						<div class="ctn__filter checkbox-itm">
							<input id="posgrados" type="checkbox">
							<label for="posgrados">Posgrados</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="pregrados" type="checkbox">
							<label for="pregrados">Pregrados</label>
						</div>
					</form>
				</div>
			</div><!-- ctn__program-filter -->
			<div class="ctn__metodology-filters padding">
				<span class="text-filters">Metodología</span>
				<div class="metodology-filters">
					<form action="">
						<div class="ctn__filter checkbox-itm">
							<input id="presencial" type="checkbox">
							<label for="presencial">Presencial</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="virtual" type="checkbox">
							<label for="virtual">Virtual</label>
						</div>
					</form>
				</div>
			</div><!-- ctn__metodology-filters -->
		</div><!-- ctn__info-header -->
	</header><!-- ctn__header-content -->
	<section class="ctn__section-content">
		<div class="overlay-filter">
			<span class="overlay-text">Filtrando resultados...</span>
			<div class="ctn__loader">
				<div class="sk-circle">
				  <div class="sk-circle1 sk-child"></div>
				  <div class="sk-circle2 sk-child"></div>
				  <div class="sk-circle3 sk-child"></div>
				  <div class="sk-circle4 sk-child"></div>
				  <div class="sk-circle5 sk-child"></div>
				  <div class="sk-circle6 sk-child"></div>
				  <div class="sk-circle7 sk-child"></div>
				  <div class="sk-circle8 sk-child"></div>
				  <div class="sk-circle9 sk-child"></div>
				  <div class="sk-circle10 sk-child"></div>
				  <div class="sk-circle11 sk-child"></div>
				  <div class="sk-circle12 sk-child"></div>
				</div>
			</div>
		</div>
		<div class="ctn__facultad">
			<div class="ctn__facultad-title">
				<h2 class="facultad-title">Facultad de artes y humanidades</h2>
			</div>
			<div class="ctn__programas brd__ciencias-economicas">
				<a href="#" class="ctn__programa">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Título a otorgar</dt>
									<dd>Título a otrogar</dd>
								<dt>Metodología</dt>
									<dd>Presencial</dd>
								<dt>Duración</dt>
									<dd>10 semestres</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Título a otorgar</dt>
									<dd>Título a otrogar</dd>
								<dt>Metodología</dt>
									<dd>Presencial</dd>
								<dt>Duración</dt>
									<dd>10 semestres</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Título a otorgar</dt>
									<dd>Título a otrogar</dd>
								<dt>Metodología</dt>
									<dd>Presencial</dd>
								<dt>Duración</dt>
									<dd>10 semestres</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Título a otorgar</dt>
									<dd>Título a otrogar</dd>
								<dt>Metodología</dt>
									<dd>Presencial</dd>
								<dt>Duración</dt>
									<dd>10 semestres</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
			</div><!-- ctn__programas -->
		</div><!-- ctn__facultad -->
	</section><!-- ctn__section-content -->
</div>