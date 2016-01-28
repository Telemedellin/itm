<?php
/**
 * Template part para visualizar el loop de los programas universitarios de x facultad.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

global $facultad;

?>

<?php foreach ($facultad as $_facultad): ?>
<div class="ctn__facultad">
	<div class="ctn__facultad-title">
		<h2 class="facultad-title"><?php echo $_facultad->name; ?></h2>
	</div>
	<?php
		$class		= '';

		$formaciones = get_categories(array(
				'type'                     => 'post',
				'child_of'                 => $_facultad->term_id,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => false,
				'hierarchical'             => false,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false
			)
		);

		$programas = array();
		
		foreach ($formaciones as $formacion)
		{
			if (strpos($formacion->slug, 'formacion') !== false)
			{
				$programas = get_categories(array(
						'type'                     => 'post',
						'child_of'                 => '',
						'parent'                   => $formacion->term_id,
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => false,
						'hierarchical'             => false,
						'exclude'                  => '',
						'include'                  => '',
						'number'                   => '',
						'taxonomy'                 => 'category',
						'pad_counts'               => false
					)
				);
			}
		}

		switch ($_facultad->slug)
		{
			case 'facultad-de-artes-y-humanidades':
				$class = 'artes-y-humanidades';
				break;
			case 'facultad-de-ciencias-economicas-y-administrativas':
				$class = 'ciencias-economicas';
				break;
			case 'facultad-de-ciencias-exactas-y-aplicadas':
				$class = 'ciencias-exactas';
				break;
			case 'facultad-de-ingenierias':
				$class = 'ingenierias';
				break;
		}
	?>
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
	<div class="ctn__programas brd__<?php echo $class; ?>">
		<?php foreach($programas as $programa): ?>
		<?php
			$ecppost 			= get_ecp_post($programa->term_id);

			// Si no tiene imagen destacada configurada, procedemos a usar la imagen del portada.
			$imagen_destacada	= get_field('imagen_destacada', $programa);

			if (!empty($imagen_destacada))
				$image			= $imagen_destacada;
			else
				$image			= get_template_directory_uri() . '/images/no-image.jpg';

			$titulo_prgrama		= get_the_title($ecppost->ID);
			$titulo_otorgado	= get_field('titulo_otorgado', $ecppost->ID);

			$field				= get_field_object('modalidad', $ecppost->ID);
			$modalidad			= $field['choices'][$field['value'][0]];

			$duracion			= get_field('duracion', $ecppost->ID);
		?>
		<a href="<?php echo get_category_link($programa->term_id); ?>" class="ctn__programa">
			<div class="ctn__programa_top">
				<div class="ctn__programa-image" style="background: url(<?php echo $image; ?>) no-repeat; background-size: 100%; background-position: center center">
					<img src="<?php echo $image; ?>" alt="">
				</div>
				<h3 class="programa-title"><?php echo $titulo_prgrama; ?></h3>
			</div>
			<div class="ctn__programa-bottom">
					<dl>
						<dt>Título a otorgar</dt>
							<dd><?php echo $titulo_otorgado; ?></dd>
						<dt>Modalidad</dt>
							<dd><?php echo $modalidad; ?></dd>
						<dt>Duración</dt>
							<dd><?php echo $duracion; ?></dd>
					</dl>
					<span class="btn-vermas">Ver más</span>
			</div>
		</a><!-- ctn__programa -->
		<?php endforeach; ?>
	</div><!-- ctn__programas -->
</div><!-- ctn__facultad -->
<?php endforeach; ?>