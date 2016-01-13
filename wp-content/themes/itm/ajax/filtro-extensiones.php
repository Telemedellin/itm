<?php

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once $parse_uri[0] . 'wp-load.php';

set_include_path(get_include_path() . PATH_SEPARATOR . get_template_directory() . '/libs/linq/');
require_once('PHPLinq/LinqToObjects.php');

if (isset($_POST))
{
	$category_id = $_POST['cat'];
	unset($_POST['cat']);
	extract($_POST);

	$categories = obtenerProgramas($category_id);
	$data = array();

	foreach ($categories as $category)
	{
		$ecpPost = get_ecp_post($category->term_id);

		$tipo_programa		= get_field('tipo_de_programa_academico', $ecpPost->ID);
		$titulo				= get_the_title($ecpPost->ID);
		$imagen				= get_the_post_thumbnail($ecpPost->ID);

		$field				= get_field_object('ext_tipo_programa', $ecpPost->ID);
		$tipo				= $field['value'][0];
		$tipo_text			= $field['choices'][$tipo];

		$field				= get_field_object('sede', $ecpPost->ID);
		$sede				= $field['value'][0];
		$sede_text			= $field['choices'][$sede];

		$intensidad_horaria	= get_field('intensidad_horaria', $ecpPost->ID);
		$enlace				= get_category_link($category->term_id);
		
		$data[] = (object)array(
			'tipo_programa' => $tipo_programa,
			'category_id' => $category->term_id,
			'titulo' => $titulo,
			'imagen' => $imagen,
			'tipo' => $_tipo_programa,
			'tipo_text' => $tipo_programa_text,
			'sede' => $sede,
			'sede_text' => $sede_text,
			'intensidad_horaria' => $intensidad_horaria .= ($intensidad_horaria > 1 ) ? ' horas' : ' hora',
			'enlace' => $enlace
		);
	}

	$w = "";
	$result = "";

	if (empty($tipo))
	{
		$result = from('$p')->in($data)
					->select('$p');
	}
	else
	{
		$result = $data;
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