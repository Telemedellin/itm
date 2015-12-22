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
				<span class="text-filters">Conoce los programas de extensión académica que ofrece el ITM</span>
			</div><!-- .entry-content -->
			<div class="ctn__input-filter padding">
				<div class="input-filter">
					<form action="">
						<input type="text" placeholder="Escribe el nombre del programa">
					</form>
				</div>
			</div><!-- ctn__input-filter -->
			<div class="ctn__faculty-filter padding">
				<span class="text-filters">Filtra por el tipo de programa</span>
				<div class="faculty-filter">
					<span class="filter-label">Diplomados</span>
					<span class="filter-label">Cursos</span>
					<span class="filter-label">Semianrios</span>
					<span class="filter-label">Talleres</span>
					<span class="filter-label">Simposios</span>
					<span class="filter-label">Encuentros</span>
				</div>
			</div><!-- ctn__faculty-filter -->
			<div class="ctn__sede-filter padding">
				<span class="text-filters">Filtra por la sede</span>
				<div class="program-filters">
					<form action="">
						<div class="ctn__filter checkbox-itm">
							<input id="robledo" type="checkbox">
							<label for="robledo">Campus Robledo</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="fraternidad" type="checkbox">
							<label for="fraternidad">Campus Fraternidad</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="castilla" type="checkbox">
							<label for="castilla">Campus Castilla</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="prado" type="checkbox">
							<label for="prado">Campus Prado</label>
						</div>
						<div class="ctn__filter checkbox-itm">
							<input id="floresta" type="checkbox">
							<label for="floresta">Campus La Floresta</label>
						</div>
					</form>
				</div>
			</div><!-- ctn__program-filter -->
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
				<h2 class="facultad-title">Cursos</h2>
			</div>
			<div class="ctn__programas grid brd__ciencias-economicas">
				<div class="grid-sizer"></div>
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
			</div><!-- ctn__programas -->
		</div><!-- ctn__facultad -->
		<div class="ctn__facultad">
			<div class="ctn__facultad-title">
				<h2 class="facultad-title">Diplomados</h2>
			</div>
			<div class="ctn__programas grid brd__ciencias-economicas">
				<div class="grid-sizer"></div>
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
				<a href="#" class="ctn__programa grid-item">
					<div class="ctn__programa_top">
						<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
							<img src="http://lorempixel.com/400/400" alt="">
						</div>
						<h3 class="programa-title">Nombre del programa</h3>
					</div>
					<div class="ctn__programa-bottom">
							<dl>
								<dt>Tipo de programa</dt>
									<dd>Diploado</dd>
								<dt>Sede</dt>
									<dd>Campus Robledo</dd>
								<dt>Intensidad horaria</dt>
									<dd>48 horas</dd>
							</dl>
							<span class="btn-vermas">Ver más</span>
					</div>
				</a><!-- ctn__programa -->
			</div><!-- ctn__programas -->
		</div><!-- ctn__facultad -->
	</section><!-- ctn__section-content -->
</div>