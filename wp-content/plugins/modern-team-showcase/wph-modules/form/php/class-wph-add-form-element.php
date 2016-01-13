<?php

/**
* This class uses a WPH_Writer object to generate markup for the frontend editor
*/
class WPH_Add_Form_Element {
	
	public $panel;
	
	public $structure = 
		array(
			"container"=>
				array(
						"input",
						"select",
						"textarea",
//						"multi select",
						"input number",
						"checkbox",
						"radio",
//						"hidden",
						"link",
						"email",
//						"color",
//						"date",
//						"media upload",
						"html",
						"divider",
						"label",
						"password",
//						"blank",
					),
		);
	
	public $material = 
		array(
			"container"=>
				array(
						"tag"=>"div",
						"class"=>"elements",
						"content"=>false,
					),
			"element"=>
				array(
						"tag"=>"span",
						"content"=>"Element",
						"class"=>"button",
					),
			"input"=>
				array(
						"template"=>"element",
						"content"=>"Single Line Text",
					),
			"select"=>
				array(
						"template"=>"element",
						"content"=>"Drop Down",
					),
			"textarea"=>
				array(
						"template"=>"element",
						"content"=>"Paragraph Text",
						"class"=>"button_textarea",
					),
			"multi select"=>
				array(
						"template"=>"element",
						"content"=>"Multi Select",
						"class"=>"button_multi_select",
					),
			"input number"=>
				array(
						"template"=>"element",
						"content"=>"Number",
						"class"=>"button_input_number",
					),
			"checkbox"=>
				array(
						"template"=>"element",
						"content"=>"Checkboxes",
						"class"=>"button_checkbox",
					),
			"radio"=>
				array(
						"template"=>"element",
						"content"=>"Radio Buttons",
						"class"=>"button_radio",
					),
			"hidden"=>
				array(
						"template"=>"element",
						"content"=>"Hidden",
						"class"=>"button_hidden",
					),
			"link"=>
				array(
						"template"=>"element",
						"content"=>"Link",
						"class"=>"button_link",
					),
			"email"=>
				array(
						"template"=>"element",
						"content"=>"Email",
						"class"=>"button_input_email",
					),
			"link"=>
				array(
						"template"=>"element",
						"content"=>"Link",
						"class"=>"button_input_link",
					),
			"color"=>
				array(
						"template"=>"element",
						"content"=>"Color",
						"class"=>"button_input_color",
					),
			"date"=>
				array(
						"template"=>"element",
						"content"=>"Date",
						"class"=>"button_input_date",
					),
			"media upload"=>
				array(
						"template"=>"element",
						"content"=>"Media Upload",
					),
			"html"=>
				array(
						"template"=>"element",
						"content"=>"HTML",
					),
			"divider"=>
				array(
						"template"=>"element",
						"content"=>"Divider",
					),
			"label"=>
				array(
						"template"=>"element",
						"content"=>"Label",
					),
			"password"=>
				array(
						"template"=>"element",
						"content"=>"Password",
					),
			"blank"=>
				array(
						"template"=>"element",
						"content"=>"Blank",
					),
		);
	
	function __construct( ){		
		//modify material
		$this->modify_material( );
		
		//build
		$writer = new WPH_Writer( $this->structure, $this->material );
		$writer->class_prefix = 'wph_editor_form_';
		$writer->data_prefix = 'data-wph-editor-form-';
		$writer->build( );
		$this->panel = $writer->flush_html( );		
	}
	
	function modify_material( ){

		foreach( $this->material as $element_name => &$element_material ){
			// template
			if( empty( $element_material[ 'template' ] ) ) $element_material[ 'template' ] = 'element';
			// content
			if( empty( $element_material[ 'content' ] ) && $element_name !== 'container' ) $element_material[ 'content' ] = ucwords( $element_name );
			// class
			if( empty( $element_material[ 'class' ] ) ) $element_material[ 'class' ] = 'button_' . str_replace( ' ', '_', $element_name );
			// common class - form button
			if( $element_name !== 'container' ) $element_material[ 'class' ] = $element_material[ 'class' ] . ' button';
			//data
			if( empty( $element_material[ 'data' ] ) ) $element_material[ 'data' ] = array( );
			// common data - element type
			if( $element_name !== 'container' ) $element_material[ 'data' ][ 'element' ] = $element_name;
		}
		
	}
	
}

?>