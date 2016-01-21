<?php

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once $parse_uri[0] . 'wp-load.php';

set_include_path(get_include_path() . PATH_SEPARATOR . get_template_directory() . '/libs/linq/');
require_once('PHPLinq/LinqToObjects.php');

if (isset($_POST))
{
	$category_id	= 65;
	$tipo			= $_POST['tipo'];

	unset($_POST['tipo']);

	$facultades = obtenerProgramas($category_id);
	$programas = array();

	foreach ($facultades as $facultad)
	{
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

		$class = '';
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

		$programas[$facultad->name.'::'.$class.'::'.$facultad->slug] = array();
		foreach ($formaciones as $formacion)
		{
			if (strpos($formacion->slug, 'formacion') !== false)
			{
				$programas[$facultad->name.'::'.$class.'::'.$facultad->slug] = array_merge_recursive($programas[$facultad->name.'::'.$class.'::'.$facultad->slug], get_categories(array(
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
				));
			}
		}

		if (count($programas[$facultad->name.'::'.$class.'::'.$facultad->slug]) == 0)
			unset($programas[$facultad->name.'::'.$class.'::'.$facultad->slug]);
	}

	$datos = array();
	foreach ($programas as $key => $facultad)
	{
		$params = explode('::', $key);
		
		foreach ($facultad as $programa)
		{
			$ecpPost = get_ecp_post($programa->term_id);

			$tipo_programa		= get_field('tipo_de_programa_academico', $ecpPost->ID);
			$titulo				= $programa->name;
			$imagen_destacada	= get_field('imagen_destacada', $programa);

			if (!empty($imagen_destacada) || !is_null($imagen_destacada))
				$imagen			= $imagen_destacada;
			else
				$imagen			= get_field('imagen_portada', $programa);

			$titulo_otorgado	= get_field('titulo_otorgado', $ecpPost->ID);

			$field				= get_field_object('modalidad', $ecpPost->ID);
			$modalidad			= $field['value'][0];
			$modalidad_text		= $field['choices'][$modalidad];

			$duracion			= get_field('duracion', $ecpPost->ID);
			$enlace				= get_category_link($programa->term_id);
			
			$datos[$key][] = (object)array(
				'tipo' => $params[2],
				'tipo_programa' => $tipo_programa,
				'category_id' => $programa->term_id,
				'titulo' => $titulo,
				'imagen' => $imagen,
				'titulo_otorgado' => $titulo_otorgado,
				'modalidad' => $modalidad,
				'modalidad_text' => $modalidad_text,
				'duracion' => $duracion,
				'enlace' => $enlace
			);
		}
	}

	$w = '';
	$w1 = '';
	$w2 = '';
	$w3 = '';
	$tipo_programa = '';
	$modalidad = '';
	$result = array();
	if (!empty($tipo))
		$w1 = '$p->tipo == "'.$tipo.'"';

	$cont = 0;
	foreach ($_POST as $key => $value)
	{
		if ($cont == 0 || $cont == 1)
		{
			if (empty($tipo_programa) && $value == 'true')
				$tipo_programa .= $key;
			else
				if (!empty($tipo_programa) && $value == 'true')
					$tipo_programa .= '|'.$key;
		}
		else
		{
			if (empty($modalidad) && $value == 'true')
				$modalidad .= $key;
			else
				if (!empty($modalidad) && $value == 'true')
					$modalidad .= '|'.$key;
		}
		$cont++;
	}

	if (!empty($tipo_programa))
		$w2 = 'preg_match("['.$tipo_programa.']", $p->tipo_programa) == true';

	if (!empty($modalidad))
		$w3 = 'preg_match("['.$modalidad.']", $p->modalidad) == true';

	if (!empty($w1) && empty($w2) && empty($w3))
		$w .= $w1;
	if (empty($w1) && !empty($w2) && empty($w3))
		$w .= $w2;
	if (empty($w1) && empty($w2) && !empty($w3))
		$w .= $w3;
	if (!empty($w1) && !empty($w2) && empty($w3))
		$w .= $w1 . ' && ' . $w2;
	if (!empty($w1) && empty($w2) && !empty($w3))
		$w .= $w1 . ' && ' . $w3;
	if (empty($w1) && !empty($w2) && !empty($w3))
		$w .= $w2 . ' && ' . $w3;
	if (!empty($w1) && !empty($w2) && !empty($w3))
		$w .= $w1 . ' && ' . $w2 . ' && ' . $w3;

	if (empty($tipo) && empty($w))
	{
		$result = $datos;
	}
	else if (!empty($tipo) && empty($w))
	{
		foreach ($datos as $key => $programa)
		{
			$params = explode('::', $key);
			if ($tipo == $params[2])
				$result[$key] = $datos[$key];
		}
	}
	else if (empty($tipo) && !empty($w))
	{
		foreach ($datos as $key => $programa)
		{
			$result[$key] = from('$p')->in($programa)
						->where($w)
						->select('$p');
						
			if(count($result[$key]) == 0)
				unset($result[$key]);
		}
	}
	else if (!empty($tipo) && !empty($w))
	{
		foreach ($datos as $key => $programa)
		{
			$params = explode('::', $key);
			if ($tipo == $params[2])
			{
				$result[$key] = from('$p')->in($programa)
							->where($w)
							->select('$p');
							
				if(count($result[$key]) == 0)
					unset($result[$key]);
			}
		}
	}

	header('Content-Type: application/json');
	echo json_encode($result);
}

function obtenerProgramas($category_id)
{
	return get_categories(array(
			'type'                     => 'post',
			'child_of'                 => $category_id,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 
		)
	);
}

?>