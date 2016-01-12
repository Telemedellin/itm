<?php
/**
 * WPH Writer extension for WPH FrontEnd Editor. Automatically wraps elements in paragraph nodes, so no cover element is needed. 
 */
class WPH_Form_Settings_Menu extends WPH_Writer{

public $textdomain = "wph";
public $data_prefix = "data-wph-";
public $class_prefix = "wph_editor_";	

public $structure = 
	array(
		 "settingsType" => array(
			"Settings",
			"Add Element",
			"Edit Element",
		),
	);
	
public $material = 
	array(
		"settingsType"=> array(
			"tag"=> "div",
			"class no prefix"=>"wph_form_editor_settingsType",
			"data"=>array(
				"type"=> "settingsType",
			),
		),
		"Settings" =>array(
			"tag"=>"span",
			"content"=>"Settings: ",
		),
		"Add Element" =>array(
			"tag"=>"span",
			"content"=>"Add Form Element",
			"data"=>array(
				"type"=> "Add Element",
			),
		),
		"Edit Element" =>array(
			"tag"=>"span",
			"content"=>"Edit Form Element",
			"data"=>array(
				"type"=> "Edit Element",
			),
		),
	);

}
?>