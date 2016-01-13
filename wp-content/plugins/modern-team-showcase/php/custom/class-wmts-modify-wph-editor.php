<?php

class WMTS_Modify_WPH_Editor{

	public function __construct ( ) {
		// create a settings menu
		add_filter("wph-frontend-editor-assemble", array( $this, 'create_settings_menu' ) );

		// create a query panel
		add_filter("wph-frontend-editor-assemble", array( $this, 'create_query_panel' ) );
		
		// create a member template panel
		add_filter("wph-frontend-editor-assemble", array( $this, 'create_member_template_panel' ) );
		
		// create a overall settings template panel
		add_filter("wph-frontend-editor-assemble", array( $this, 'create_overall_settings_panel' ) );

	}
	
	// settings menu
	function create_settings_menu( $editor_markup ){
		require_once( 'class-wmts-settings-menu.php' );
		$wmts_settings_menu = new WMTS_Settings_Menu;
		$wmts_settings_menu->build( );
		$markup = $wmts_settings_menu->flush_html( );
		return $editor_markup.$markup;
	}
	
	// query
	function create_query_panel( $editor_markup ){
		ob_start( );
		require_once( 'wmts-query-panel.php' );
		$markup = ob_get_contents( );
		ob_end_clean( );
		return $editor_markup.$markup;
	}
	
	// template
	function create_member_template_panel( $editor_markup ){
		ob_start( );
		require_once( 'wmts-member-template-panel.php' );
		$markup = ob_get_contents( );
		ob_end_clean( );
		return $editor_markup.$markup;
	}
	
	// overall settings
	function create_overall_settings_panel( $editor_markup ){
		ob_start( );
		require_once( 'wmts-overall-settings-panel.php' );
		$markup = ob_get_contents( );
		ob_end_clean( );
		return $editor_markup.$markup;
	}
	
}

?>