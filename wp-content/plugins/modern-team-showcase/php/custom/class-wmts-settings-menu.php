<?php
/**
 * WPH Writer extension for WPH FrontEnd Editor. Automatically wraps elements in paragraph nodes, so no cover element is needed. 
 */
class WMTS_Settings_Menu extends WPH_Writer{

public $textdomain = "modern-team-showcase";
public $data_prefix = "data-wph-";
public $class_prefix = "wph_editor_";	

public $structure = 
	array(
		 "settingsType" => array(
			"Settings",
			"Query",
			"Member Template",
			"Overall",
		),
	);
	
public $material = 
	array(
		"settingsType"=> array(
			"tag"=> "div",
			"class no prefix"=>"wmts_editor_settingsType",
			"data"=>array(
				"type"=> "settingsType",
			),
		),
		"Settings" =>array(
			"tag"=>"span",
			"content"=>"Settings:",
		),
		"Query" =>array(
			"tag"=>"span",
			"content"=>"Query",
			"data"=>array(
				"type"=> "query",
			),
		),
		"Member Template" =>array(
			"tag"=>"span",
			"content"=>"Member Template",
			"data"=>array(
				"type"=> "member_template",
			),
		),
		"Overall" =>array(
			"tag"=>"span",
			"content"=>"Overall",
			"data"=>array(
				"type"=> "overall",
			),
		),
	);

}
?>