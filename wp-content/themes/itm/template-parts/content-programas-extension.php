<?php
/**
 * Template part para visualizar el loop de los programas universitarios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

global $extensiones;

?>

<?php foreach ($extensiones as $extension): ?>
<div class="ctn__facultad">
	<div class="ctn__facultad-title">
		<h2 class="facultad-title"><?php echo $extension->tipo; ?></h2>
	</div>
	<!-- programa clone -->
	<a href="#" class="ctn__programa hidden" style="display:none;">
		<div class="ctn__programa_top">
			<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400) no-repeat; background-size: 100%; background-position: center center">
				<img src="http://lorempixel.com/400/400" alt="">
			</div>
			<h3 class="programa-title"></h3>
		</div>
		<div class="ctn__programa-bottom">
				<dl>
					<dt>Título a otorgar</dt>
						<dd></dd>
					<dt>Modalidad</dt>
						<dd></dd>
					<dt>Duración</dt>
						<dd></dd>
				</dl>
				<span class="btn-vermas">Ver más</span>
		</div>
	</a>
	<!-- programa clone -->
	<!-- sin resultados -->
	<h2 id="msg__sin-resultados" style="display:none;">No se han encontrado resultados.</h2>
	<!-- sin resultados -->
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
	</div><!-- ctn__programas -->
</div><!-- ctn__facultad -->
<?php endforeach; ?>