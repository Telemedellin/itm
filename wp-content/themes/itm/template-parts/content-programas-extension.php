<?php
/**
 * Template part para visualizar el loop de los programas universitarios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

global $extensiones, $tipos;

?>
<!-- grid container clone -->
<div class="ctn__facultad hidden" style="display:none;">
	<div class="ctn__facultad-title">
		<h2 class="facultad-title"></h2>
	</div>
	<div class="ctn__programas grid">
		<div class="grid-sizer"></div>
	</div>
</div>
<!-- grid container clone -->
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
				<dt>Tipo de programa</dt>
					<dd></dd>
				<dt>Sede</dt>
					<dd></dd>
				<dt>Intensidad horaria</dt>
					<dd></dd>
			</dl>
			<span class="btn-vermas">Ver más</span>
	</div>
</a>
<!-- programa clone -->
<!-- sin resultados -->
<h2 id="msg__sin-resultados" style="display:none;">No se han encontrado resultados.</h2>
<!-- sin resultados -->

<div class="ctn__grids">
<?php foreach ($extensiones as $key => $_extensiones): ?>
	<div class="ctn__facultad">
		<div class="ctn__facultad-title">
			<h2 class="facultad-title"><?php echo $key; ?></h2>
		</div>
		<div class="ctn__programas grid">
			<div class="grid-sizer"></div>
			<?php foreach ($_extensiones as $extension): ?>
			<a href="<?php echo $extension->enlace; ?>" class="ctn__programa grid-item">
				<div class="ctn__programa_top">
					<div class="ctn__programa-image" style="background: url(<?php echo $extension->image; ?>) no-repeat; background-size: 100%; background-position: center center">
						<img src="<?php echo $image; ?>" alt="">
					</div>
					<h3 class="programa-title"><?php echo $extension->name; ?></h3>
				</div>
				<div class="ctn__programa-bottom">
						<dl>
							<dt>Tipo de programa</dt>
								<dd><?php echo $extension->tipo_text; ?></dd>
							<dt>Sede</dt>
								<dd><?php echo $extension->sede_text; ?></dd>
							<dt>Intensidad horaria</dt>
								<dd><?php echo $extension->intensidad; ?> horas</dd>
						</dl>
						<span class="btn-vermas">Ver más</span>
				</div>
			</a><!-- ctn__programa -->
			<?php endforeach; ?>
		</div><!-- ctn__programas -->
	</div><!-- ctn__facultad -->
<?php endforeach; ?>
</div>