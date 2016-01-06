<?php

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once $parse_uri[0] . 'wp-load.php';

set_include_path(get_include_path() . PATH_SEPARATOR . 'linq/');
require_once('PHPLinq/LinqToObjects.php');

if (isset($_POST))
{
	$category_id = $_POST['facultad'];
	unset($_POST['facultad']);
	extract($_POST);
	
	$categories = obtenerProgramas($category_id);
	$data = array();

	foreach ($categories as $category)
	{
		$ecpPost = get_ecp_post($category->term_id);

		$tipo_programa		= get_field('tipo_de_programa_academico', $ecpPost->ID);
		$titulo				= get_the_title($ecpPost->ID);
		$imagen				= get_the_post_thumbnail($ecpPost->ID);
		$titulo_otorgado	= get_field('titulo_otorgado', $ecpPost->ID);

		$field				= get_field_object('modalidad', $ecpPost->ID);
		$modalidad			= $field['value'][0];
		$modalidad_text		= $field['choices'][$modalidad];

		$duracion			= get_field('duracion', $ecpPost->ID);
		$enlace				= get_category_link($category->term_id);
		
		$data[] = (object)array(
			'tipo_programa' => $tipo_programa,
			'category_id' => $category->term_id,
			'titulo' => $titulo,
			'imagen' => $imagen,
			'titulo_otorgado' => $titulo_otorgado,
			'modalidad' => $modalidad,
			'modalidad_text' => $modalidad_text,
			'duracion' => $duracion,
			'enlace' => $enlace
		);
	}

	$w = "";
	$result = "";
	
	if (empty($posgrado) && empty($pregrado) && empty($virtual) && empty($presencial))
	{
		$result = from('$p')->in($data)
					->select('$p');
	}
	else
	{
		if (!empty($posgrado) && !empty($pregrado))
			$w .= 'preg_match("[posgrado|pregrado]", $p->tipo_programa) == true';
		else
		{
			if (!empty($w) && !empty($posgrado))
				$w .= ' && preg_match("[posgrado]", $p->tipo_programa) == true';
			else
				if (!empty($posgrado))
					$w .= 'preg_match("[posgrado]", $p->tipo_programa) == true';

			if (!empty($w) && !empty($pregrado))
				$w .= ' && preg_match("[pregrado]", $p->tipo_programa) == true';
			else
				if (!empty($pregrado))
					$w .= 'preg_match("[pregrado]", $p->tipo_programa) == true';
		}


		if (empty($posgrado) && empty($pregrado) && !empty($virtual) && !empty($presencial))
			$w .= 'preg_match("[virtual|presencial]", $p->modalidad) == true';
		else if (!empty($w) && !empty($virtual) && !empty($presencial))
			$w .= ' && preg_match("[virtual|presencial]", $p->modalidad) == true';
		else
		{
			if (!empty($w) && !empty($virtual))
				$w .= ' && preg_match("[virtual]", $p->modalidad) == true';
			else
				if (!empty($virtual))
					$w .= 'preg_match("[virtual]", $p->modalidad) == true';

			if (!empty($w) && !empty($presencial))
				$w .= ' && preg_match("[presencial]", $p->modalidad) == true';
			else
				if (!empty($presencial))
					$w .= 'preg_match("[presencial]", $p->modalidad) == true';
		}

		$result = from('$p')->in($data)
					->where('$p => ' . $w)
					->select('$p');
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

function data($titulo, $titulo_otorgado, $modalidad, $duracion, $enlace)
{
	return array(
		'titulo' => $titulo,
		'titulo_otorgado' => $titulo_otorgado,
		'modalidad' => $modalidad,
		'duracion' => $duracion,
		'enlace' => $enlace
	);
}

?>