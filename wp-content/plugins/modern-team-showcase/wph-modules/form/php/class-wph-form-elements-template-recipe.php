<?php 

class WPH_Form_Elements_Template_Recipe {
	
	function __construct(  ){

	}

	public $structure = 
		array(
			"label",
			"input",
			"select"=>array(
					"option",
					"option 1",
					"option 2",
				),
			"textarea",
			/*
			"multi select"=>array(
					"option",
					"option 1",
					"option 2",
				),
			*/
			"input number",
			"checkbox",
			"radio",
//			"hidden",
			"link",
			"email",
			"date",
//			"color",
			"media upload",
			"html",
			"password",
			"blank",
			"divider",
		);
	
	public $material = 
		array(
			"label"=>array(
					"tag"=>"label",
					"content"=>"The label goes here",
					"class"=>"label",
				),
			"input"=>array(
					"tag"=>"input",
					"class"=>"input",
					"type"=>"text",
					"label"=>"Enter text here",
				),
			"select"=>array(
					"tag"=>"select",
					"class"=>"select",
					"label"=>"Select an option",
				),
			"option"=>array(
					"tag"=>"option",
					"class"=>"select_option",
					"content"=>"Some Option",
					"value"=>"some option",
					"label"=>"Select an option",
				),			
			"option 1"=>array(
					"template"=>"option",
					"content"=>"Another Option",
					"value"=>"another option",
				),			
			"option 2"=>array(
					"tag"=>"option",
					"class"=>"select_option",
					"content"=>"And Another",
					"value"=>"yet another",
				),
			"textarea"=>array(
					"tag"=>"textarea",
					"label"=>"Enter short description",
					"class"=>"textarea",
				),
			"multi select"=>array(
					"template"=>"select",
					"attr"=>array( "multiple"=>"true" ),
					"label"=>"Select multiple",
					"class"=>"multi select",
				),
			"input number"=>array(
					"tag"=>"input",
					"class"=>"input_number",
					"label"=>"Enter number",
					"type"=>"number",
				),
			"email"=>array(
					"tag"=>"input",
					"class"=>"input_email",
					"label"=>"Enter e-mail",
					"type"=>"email",
				),
			"link"=>array(
					"tag"=>"input",
					"class"=>"input_link",
					"label"=>"Enter link",
					"type"=>"url",
				),
			"checkbox"=>array(
					"tag"=>"input",
					"class"=>"input_checkbox",
					"label"=>"Select checkbox",
					"type"=>"checkbox",
				),
			// "checkbox"=>array(
					// "content"=>"<label>Checkbox Options</label><input class='wph_form_input_checkbox' type='checkbox' value='Some option' checked='checked' ><label>Some option</label> <input class='wph_form_input_checkbox' type='checkbox' value='Another option'><label>Another option</label> <input class='wph_form_input_checkbox' type='checkbox' value='Yet another'><label>Yet another</label>",
				// ),
			"radio"=>array(
					"tag"=>"input",
					"class"=>"input_radio",
					"label"=>"Select option",
					"type"=>"radio",
				),
			// "radio"=>array(
					// "content"=>"<label>Radio Options</label><input class='wph_form_input_radio' type='radio' value='Some option' checked='checked' ><label>Some option</label> <input class='wph_form_input_radio' type='radio' value='Another option'><label>Another option</label> <input class='wph_form_input_radio' type='radio' value='Yet another'><label>Yet another</label>",
				// ),
			"color"=>array(
					"tag"=>"input",
					"class"=>"input_color",
					"label"=>"Color picker",
					"type"=>"color",
				),
			"date"=>array(
					"tag"=>"input",
					"class"=>"input_date",
					"label"=>"Select date",
					"type"=>"date",
				),
			"html"=>array(
					"tag"=>"textarea",
					"class"=>"html",
					"label"=>"Enter HTML or regular text",
				),
			"divider"=>array(
					'tag'=>'hr',
					"class"=>"hr",
				),
			"media upload"=>array(
					'tag'=>'span',
					"class"=>"upload",
				),
			"password"=>array(
					"tag"=>"input",
					"class"=>"input_password",
					"label"=>"Password",
					"type"=>"password",
				),
			"blank"=>array(
					"tag"=>"div",
					"class"=>"blank",
					"label"=>"Blank",
				),
		);
	
}


?>