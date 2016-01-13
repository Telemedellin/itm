<?php
/**
 * Add starter forms
 */

function wmts_add_starter_form( ){

	global $wmts_forms_presets_path;
	include_once( $wmts_forms_presets_path );
	
	// get term ids for "Finance" and "Marketing" which are initial dummy categories
	$marketing_term = get_term_by( 'name', 'Marketing', 'modernteamgroups' ); // dummy initial cat
	$marketing_term_id = $marketing_term->term_id;
	
	$finance_term = get_term_by( 'name', 'Finance', 'modernteamgroups' ); // dummy initial cat
	$finance_term_id = $finance_term->term_id;	

	// begin adding forms 

	// "Order" : This is a pre-built form for setting the order of members 
	$args = array(
		'post_title'     => 'Member Order',
		'post_status'    => 'publish',
		'post_type'      => 'modernteamforms',
	);
	
	$post_id = wp_insert_post( $args );
	
	$form_markup = $wmts_form_presets[ 0 ][ 0 ];
	update_post_meta( $post_id, 'MTS Form Markup', $form_markup );
	$form_model_json = $wmts_form_presets[ 0 ][ 1 ];
	update_post_meta( $post_id, 'MTS Form Model JSON', $form_model_json );

	$form_locations = '{"terms":["'. $finance_term_id .'","'. $marketing_term_id .'"],"post_types":["modernteammembers"]}';
	update_post_meta( $post_id, 'MTS Form Locations', $form_locations );
	update_post_meta( $post_id, 'MTS Form Location Type', 'simple' );
	
	// "Basic information" : This is a pre-built form for getting basic information about members
	$args = array(
		'post_title'     => 'Basic Information',
		'post_status'    => 'publish',
		'post_type'      => 'modernteamforms',
	);
	
	$post_id = wp_insert_post( $args );
	
	$form_markup = $wmts_form_presets[ 2 ][ 0 ];
	update_post_meta( $post_id, 'MTS Form Markup', $form_markup );
	$form_model_json = $wmts_form_presets[ 2 ][ 1 ];
	update_post_meta( $post_id, 'MTS Form Model JSON', $form_model_json );

	$form_locations = '{"terms":["'. $finance_term_id .'","'. $marketing_term_id .'"],"post_types":["modernteammembers"]}';
	update_post_meta( $post_id, 'MTS Form Locations', $form_locations );
	update_post_meta( $post_id, 'MTS Form Location Type', 'simple' );
}

?>