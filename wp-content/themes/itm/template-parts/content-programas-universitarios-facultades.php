<?php
/**
 * Template part para visualizar el loop de los programas universitarios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package itm
 */

global $facultades;

?>

<?php foreach ($facultades as $facultad): ?>
<div class="ctn__facultad">
	<div class="ctn__facultad-title">
		<h2 class="facultad-title"><?php echo $facultad->name; ?></h2>
	</div>
	<?php
		$class		= '';

		$formaciones = get_categories(array(
				'type'                     => 'post',
				'child_of'                 => $facultad->term_id,
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

		switch ($facultad->slug)
		{
			case 'facultad-de-artes-y-humanidades':
				$class = 'artes-y-humanidades';
				break;
			case 'facultad-de-ciencias-economicas':
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
	<div class="ctn__programas brd__<?php echo $class; ?>">
		<?php foreach($programas as $programa): ?>
		<?php
			$ecppost 			= get_ecp_post($programa->term_id);
			// RECORDAR PONER LA IMAGEN DESTACADA
			$cover_page			= get_field('imagen_portada', $ecppost->ID);
			$titulo_otorgado	= get_field('titulo_otorgado', $ecppost->ID);

			$field				= get_field_object('modalidad', $ecppost->ID);
			$modalidad			= $field['choices'][$field['value'][0]];

			$duracion			= get_field('duracion', $ecppost->ID);
		?>
		<a href="<?php echo get_category_link($programa->term_id); ?>" class="ctn__programa">
			<div class="ctn__programa_top">
				<div class="ctn__programa-image" style="background: url(http://lorempixel.com/400/400<?php //echo $cover_page; ?>) no-repeat; background-size: 100%; background-position: center center">
					<img src="http://lorempixel.com/400/400<?php //echo $cover_page; ?>" alt="">
				</div>
				<h3 class="programa-title">Nombre del programa</h3>
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