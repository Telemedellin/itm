<?php

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once $parse_uri[0] . 'wp-load.php';

set_include_path(get_include_path() . PATH_SEPARATOR . get_template_directory() . '/libs/linq/');
require_once('PHPLinq/LinqToObjects.php');

if (isset($_POST))
{
	$category_id	= $_POST['cat'];
	$_tipo			= $_POST['tipo'];
	
	unset($_POST['cat']);
	unset($_POST['tipo']);

	$categories = obtenerProgramas($category_id);
	$data = array();

	foreach ($categories as $category)
	{
		$ecpPost = get_ecp_post($category->term_id);

		$tipo_programa		= get_field('tipo_de_programa_academico', $ecpPost->ID);
		$titulo				= $category->name;
		$imagen_destacada	= get_field('imagen_destacada', $category);

		if (!empty($imagen_destacada) || !is_null($imagen_destacada))
			$imagen			= $imagen_destacada;
		else
			$imagen			= get_field('imagen_portada', $programa);

		$field				= get_field_object('ext_tipo_programa', $ecpPost->ID);
		$tipo				= $field['value'][0];
		$tipo_text			= $field['choices'][$tipo];

		$field				= get_field_object('sede', $ecpPost->ID);
		$sede				= $field['value'];
		$sede_text			= $field['choices'][$sede];

		$intensidad_horaria	= get_field('intensidad_horaria', $ecpPost->ID);
		$enlace				= get_category_link($category->term_id);

		$data[$tipo][] = (object)array(
			'tipo_programa' => $tipo_programa,
			'category_id' => $category->term_id,
			'titulo' => $titulo,
			'imagen' => $imagen,
			'tipo' => $tipo,
			'tipo_text' => $tipo_text,
			'sede' => $sede,
			'sede_text' => $sede_text,
			'intensidad_horaria' => $intensidad_horaria .= ($intensidad_horaria > 1 ) ? ' horas' : ' hora',
			'enlace' => $enlace
		);
	}

	$w = '';
	$w1 = '';
	$w2 = '';
	$sedes = '';
	$result = array();

	if (!empty($_tipo))
		$w1 = '$p->tipo == "'.$_tipo.'"';

	$cont = 0;
	foreach ($_POST as $key => $value)
	{
		if ($cont == 0 && $value == 'true')
		{
			$sedes .= $key;
			$cont++;
		}
		else
		{
			if ($value == 'true')
			{
				$sedes .= '|'.$key;
			}
		}
	}

	if (!empty($sedes))
		$w2 = 'preg_match("['.$sedes.']", $p->sede) == true';

	if (!empty($w1) && !empty($w2))
		$w .= $w1 . ' && ' . $w2;
	if (!empty($w1) && empty($w2))
		$w .= $w1;
	if (empty($w1) && !empty($w2))
		$w .= $w2;

	if (empty($w))
	{
		$result = $data;
	}
	else
	{
		if (empty($w1))
			foreach ($data as $key => $extension)
			{
				$result[$key] = from('$p')->in($data[$key])
							->where($w)
							->select('$p');
							
				if(count($result[$key]) == 0)
					unset($result[$key]);
			}
		else
		{
			if (isset($data[$_tipo]))
			{
				$result[$_tipo] = from('$p')->in($data[$_tipo])
							->where($w)
							->select('$p');

				if(count($result[$_tipo]) == 0)
					unset($result[$_tipo]);
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