<?php
/*
 * Plugin Name: Modern Team Showcase
 * Version: 1.9.0
 * Plugin URI: http://modernteamshowcase.com
 * Description: Makes collecting and showcasing your team's information simple. A powerful, flexible tool for rapidly creating beautiful meet the team sections.
 * Author: WordPressaHolic
 * Requires at least: 4.0
 * Tested up to: 4.3.0
 *
 * Text Domain: modern-team-showcase
 *
 * @package WordPress
 * @author WordPressaHolic
 * @since 1.0.0
 */

/**
 * Load generic
 */
 
define( 'WMTS_VERSION_NUMBER', '1.9.0' );

function wmts_require_once( ) {
	$prefix = 'php/generic/';
	$require = array(
			'WPH_Duplicate_Posts' => 'class-wph-duplicate-posts.php',
			'WPH_Shortcode_Printer' => 'class-wph-shortcode-printer.php',
			'WPH_Writer' => 'class-wph-writer.php',
			'WPH_Template_Cooker' => 'class-wph-template-cooker.php',
			'WPH_Preset_Handler' => 'class-wph-presets-handler.php',
			'WPH_Template' => 'class-wph-template.php',
			'WPH_Select_Post_Type_And_Terms' => 'class-wph-select-post-type-and-terms.php',
			'WPH_Get_Post_Type_Taxonomy_And_Terms' => 'class-wph-get-post-type-taxonomy-and-terms.php',
			'phpQuery'=> 'phpQuery/phpQuery.php',

			//--form module
			'WPH_Form' => '../../wph-modules/form/php/class-wph-form.php',

			//--template module
			'WPH_Template' => '../../wph-modules/template/php/class-wph-template.php',

			//--front end editor
			'WPH_Frontend_Editor' => 'class-wph-frontend-editor.php',
			'WPH_Frontend_Editor_Keys' => 'class-wph-frontend-editor-keys.php',
			'WPH_Style_Ops_Writer' => 'class-wph-style-ops-writer.php',

		);
	foreach ($require as $name => $path)
		if (!class_exists($name)) require_once($prefix.$path);

}
wmts_require_once( );
require_once('php/generic/fa-icons-index.php');

/**
 * Load custom
 */
require_once( 'php/custom/cpt/class-wmts-showcases-custom-post-type.php' ); // showcase cpt
require_once( 'php/custom/cpt/class-wmts-members-custom-post-type.php' ); // members cpt - also contains groups taxonomy
require_once( 'php/custom/cpt/class-wmts-forms-custom-post-type.php' ); // forms cpt
require_once( 'php/custom/class-wmts-modify-wph-editor.php' ); // modify WPH editor
require_once( 'php/custom/class-wmts-query-handler.php' ); // query handler
require_once( 'php/custom/class-wmts-template-modifier.php' ); // template modifier
require_once( 'php/custom/class-wph-form-presets-handler.php' ); // collect form presets
require_once( 'php/custom/wmts-add-dummy-members.php' ); // build dummy members
require_once( 'php/custom/wmts-add-starter-form.php' ); // add starter form

/**
 * Common variables
 */
$wmts_assets = plugins_url( ).'/modern-team-showcase/assets';
$wmts_images_url = $wmts_assets.'/images';
$wmts_images_path = dirname(__FILE__) .'/assets/images';

/**
 * Load plugin textdomain.
 */
$wph_editor_translatables_wmts; // wph editor translations specific to accordion tables
$wph_editor_translatables_common; // wph editor translations common to all plugins
add_action( 'plugins_loaded', 'wmts_load_textdomain' );
function wmts_load_textdomain() {
	load_plugin_textdomain( 'modern-team-showcase', false,  dirname( plugin_basename( __FILE__ ) ) .'/language' );
	load_plugin_textdomain( 'wph-editor', false,  dirname( plugin_basename( __FILE__ ) ) .'/language' );

	// first opportunity to expose strings for translation
	global $wph_editor_translatables_wmts;
	global $wph_editor_translatables_common;

	require_once(dirname(__FILE__) .'/language/wph-editor/common/common.php');
	require_once(dirname(__FILE__) .'/language/wph-editor/plugin-specific/wmts.php');
}

/**
 * Register custom post types
 *
 */
//must be fired after plugin text domain is loaded
add_action( 'plugins_loaded', 'wmts_post_types' );
function wmts_post_types( ){
	global $wmts_assets;

	// members
	$wmts_custom_post_type = new WMTS_Showcases_Custom_Post_Type( 'Modern Team Showcases', __( 'Team Showcases', 'modern-team-showcase' ), __( 'Team Showcase', 'modern-team-showcase' ), '', 'dashicons-businessman' );

	// showcases
	$wmts_custom_post_type = new WMTS_Members_Custom_Post_Type('Modern Team Members', __( 'Team Members', 'modern-team-showcase' ), __( 'Team Member', 'modern-team-showcase' ), '', 'dashicons-businessman');

	// forms
	$wmts_custom_post_type = new WMTS_Forms_Custom_Post_Type('Modern Team Forms', __( 'Team Forms', 'modern-team-showcase' ), __( 'Team Form', 'modern-team-showcase' ), '', 'dashicons-businessman');

}

/**
 * Load initial data: starter form and dummy members
 */
// update_option( 'wmts_initial_data', false );
function wmts_initial_data( ){

	$option = 'wmts_initial_data';

	if( ! get_option( $option ) ){
		// add dummy members
		$member_query = new WP_Query( array( 'post_type'=> 'modernteammembers' ) );
		if( ! $member_query->have_posts( ) ){
			wmts_add_dummy_members( );
		}

		// add starter form
		$form_query = new WP_Query( array( 'post_type'=> 'modernteamforms' ) );
		if( ! $form_query->have_posts( ) ){
			wmts_add_starter_form( );
		}

		update_option( $option, true );
	}
}
add_action( 'admin_init', 'wmts_initial_data' );

/**
 * Load form builder
 */
$wmts_form = new WPH_Form( );

/**
 * Load template builder
 */
if( ! defined( 'WPH_Template' ) ) $wph_template = new WPH_Template( );

/**
 * Presets collector
 */
//-- showcase
$wmts_showcase_presets_handler = new WPH_Preset_Handler( );
$wmts_showcase_presets_path = plugin_dir_path( __FILE__ ) .'php/presets/showcase_presets.php';
//uncomment the following to collect showcase presets from posts with format "Preset: Type | Style "
// $wmts_showcase_presets_handler->compile_presets('modernteamshowcases', array( 'template' => 'MTS Template', 'overall settings' => 'MTS Overall Settings', 'devices settings' => 'MTS Devices Settings' ), 'preset:', $wmts_showcase_presets_path, 'wmts_showcase_presets');

//-- forms
$wmts_forms_presets_handler = new WPH_Form_Preset_Handler( );
$wmts_forms_presets_path = plugin_dir_path( __FILE__ ) .'php/presets/form_presets.php';
//uncomment the following to collect forms presets from posts with format "Preset: Name "
// $wmts_forms_presets_handler->compile_presets('modernteamforms', 'MTS Form Markup', 'preset:', $wmts_forms_presets_path, 'wmts_form_presets');

/**
 * Builds media queries based on CSS for various devices
 */
function wmts_build_media_queries( $devices_settings= false ){
	if( ! $devices_settings ) $devices_settings = ! empty( $_REQUEST[ 'devices_settings' ] ) ? $_REQUEST[ 'devices_settings' ] : false; // case of ajax
	if( empty( $devices_settings ) ) return;
	$css = '';
	$prev = false;
	foreach( $devices_settings as $device=> $settings ){
		if( ! empty( $settings[ 'css' ] ) ){
			
			if( empty( $settings[ 'apply_css_to' ] ) ) $settings[ 'apply_css_to' ] = 'this_and_lower';
			
			switch( $settings[ 'apply_css_to' ] ) {

				case 'this_and_higher':
					$condition = " @media screen and ( min-width:{$settings[ 'breakpoint' ]}px )";
					break;

				case 'only_this':
					$condition = " @media screen and ( min-width:{$settings[ 'breakpoint' ]}px )";
					$condition.= ( $prev && ! empty( $prev[ 'breakpoint' ] ) ) ? " and ( max-width:{$prev[ 'breakpoint' ]}px )" : '';
					break;

				default: // this and lower
					$condition= ( $prev && ! empty( $prev[ 'breakpoint' ] ) ) ? " @media screen and ( max-width:{$prev[ 'breakpoint' ]}px )" : '';
			}

			if( $condition ){
				$css.= " $condition { ". $settings[ 'css' ] ."} ";
			}else{
				$css.=  $settings[ 'css' ]; // no settings applied when going desktop and lower
			}

		}

		$prev = $settings;
	}
	return $css;
}

add_filter( 'wph_template_output', 'wmts_build_media_queries_during_ajax', 10, 2 );
function wmts_build_media_queries_during_ajax( $output, $args ){
	$output[ 'markup' ][ 'css' ] = wmts_build_media_queries( );
	if( ! empty( $args[ 2 ] ) && ! empty( $args[ 2 ][ 'general_css' ] ) ) $output[ 'markup' ][ 'css' ] .= $args[ 2 ][ 'general_css' ];
	return $output;
}

/**
 * Remove css-ids from template elements during ajax
 */
add_filter( 'wph_template_output', 'wmts_clear_css_ids_from_template_during_ajax', 10, 2 );
function wmts_clear_css_ids_from_template_during_ajax( $output, $args ){
	wmts_clear_css_ids_from_template( $output[ 'markup' ][ 'template' ] );
	return $output;
}

function wmts_clear_css_ids_from_template( &$template_element ){
	if( isset( $template_element[ 'css-id' ] ) ) unset( $template_element[ 'css-id' ] );
	// iterate over sub elements
	if( isset( $template_element[ 'sub_elements' ] ) ){
		foreach( $template_element[ 'sub_elements' ] as $key=> &$sub_element ){
			wmts_clear_css_ids_from_template( $sub_element );
		}
	}
}

/**
 * Preview on front-end
 */
add_filter( 'the_content', 'wmts_view_post' );
function wmts_view_post ($content) {
	global $post;

	if( get_post_type( $post ) === "modernteamshowcases" ){
		$code = do_shortcode( '[wmts id="'.$post->ID.'"]' );
		$content .= $code;
	}

	return $content;
}

/**
 * Register showcase shortcode
 */
add_shortcode( 'MTS', 'wmts_shortcode' );
add_shortcode( 'wmts', 'wmts_shortcode' );
function wmts_shortcode( $atts, $content= null ){

	if( $content && trim($content) ){
		$content = WPH_Template::search_and_process_meta( $content );
		return $content;
	}

	extract( shortcode_atts( array(
						'id' => false,
						'mobile'=> false,
						'tablet'=> false,
						'post_id'=> false,
						'purge_cache'=> false,
					), $atts
				)
			);

	$notice_style= "font-size: 15px;line-height: 25px;margin: 10px 0;display: inline-block;background-color: #ECECEC;padding: 10px;border-left: 3px solid #FFBA00;";
	
	// no id supplied
	if( empty( $id ) ) return '<span style="'.$notice_style.'">Please provide an \'id\' for this Modern Team Showcase shortcode</span>';
	
	// not initialized
	if( ! get_post_meta( $id, "MTS Query", true ) ) return '<span style="'.$notice_style.'">Sorry! There is no Team Showcase saved under the ID \''. $id .'\'. You need to first \'Save\' the showcase before it can appear on the front end via your shortcode.</span>';
	
	// include scripts in footer
	wmts_scripts( );

	//Alternate mobile / tablet shortcode
	if( ! empty( $mobile ) || ! empty( $tablet ) ){
		if( ! class_exists( 'Mobile_Detect' ) ) require_once( 'php/generic/Mobile_Detect.php' );
		$detect = new Mobile_Detect;
		if( $detect->isTablet() && $tablet ){ // Tablet
			return wmts_generate_showcase( $tablet, $purge_cache );
		} else if( $detect->isMobile( ) && ! $detect->isTablet( ) && $mobile ){ // Phone
			return wmts_generate_showcase( $mobile, $purge_cache );
		}
	}

	//Else case of regular shortcode
	return wmts_generate_showcase( $id, $purge_cache );
}

function wmts_generate_showcase( $id, $purge_cache= false ){
	
	// $time_start = microtime(true);

	// clear cache if needed
	wmts_clear_cache( $id );
	$admin = current_user_can( 'manage_options' );

	// cache
	$markup = get_post_meta( $id, 'MTS Showcase', true );
	if( $purge_cache || $admin ) $markup = false;

	// fresh build
	if( ! $markup ){
		$args = array(
			'query' => get_post_meta( $id, "MTS Query", true ),
			'query_handler' => 'WMTS_Query_Handler',
			'template' => get_post_meta( $id, "MTS Template", true ),
			'overall_settings' => get_post_meta( $id, "MTS Overall Settings", true ),
			'devices_settings' => get_post_meta( $id, "MTS Devices Settings", true ),
			'modifier' => 'WMTS_Template_Modifier',
			'post_id' => $id,
		);

		global $wph_template;
		$template_result = $wph_template->ajax( $args ); // calling ajax fn directly

		$media_queries = wmts_build_media_queries( $args[ 'devices_settings' ] );
		if( ! empty( $args[ 'overall_settings' ] ) && ! empty( $args[ 'overall_settings' ][ 'general_css' ] ) ) $media_queries .= $args[ 'overall_settings' ][ 'general_css' ];
		if( ! empty( $media_queries ) ) $media_queries = '<style>'. $media_queries .'</style>';
		$filter = empty( $template_result[ 'markup' ][ 'filters' ] ) ? '' : '<div class="wmts_filters">' . $template_result[ 'markup' ][ 'filters' ] . '</div>';
		$search = wmts_markup_for_search( $args );
		$members = empty( $template_result[ 'markup' ][ 'members' ] ) ? '' : $template_result[ 'markup' ][ 'members' ];
		$pagination = empty( $template_result[ 'markup' ][ 'pagination' ] ) ? '' : '<div class="wmts_pagination">' . $template_result[ 'markup' ][ 'pagination' ] . '</div>';

		$markup =
		$media_queries
		. "<div class='wmts_container' data-wmts-devices-settings='". htmlentities( json_encode( $args[ 'devices_settings' ] ) ) ."' data-wmts-overall-settings='". htmlentities( json_encode( $args[ 'overall_settings' ] ) ) ."' data-wph-post-id='". $id ."' data-wph-plugin='wmts' data-wmts-version='". WMTS_VERSION_NUMBER ."'>"
			. $filter
			. $search
			. '<div class="wmts_members">'
				. $members
			. '</div>'
			. $pagination
		. '</div>';

		update_post_meta( $id, "MTS Showcase", $markup );
		update_post_meta( $id, "_MTS Showcase", $markup );
	}

	if( ! $admin && ! get_option( 'wmts_license_status' ) ){
		$markup .= "<a href='http://www.modernteamshowcase.com/' target='_blank'>WordPress Team Showcase Plugin</a>";
	}

//	$time_end = microtime(true);
//	$time_taken = $time_end - $time_start;
//	$markup .= "<span>Time taken: $time_taken </span>";

	return $markup;
}

function wmts_markup_for_search( $args ){
	$search = '';	
	if( ! empty( $args[ 'overall_settings' ][ 'search' ] ) && $args[ 'overall_settings' ][ 'search' ] === 'Enabled' ){
		// get tax terms
		$terms = get_terms( 'modernteamgroups' );
		$all_departments = isset( $args[ 'overall_settings' ][ 'search_all_departments' ] ) ? $args[ 'overall_settings' ][ 'search_all_departments' ] : __( 'All Departments' );
		$options = '<option value="">'. $all_departments .'</option>';
		foreach( $terms as $term ){
			$options .= "<option value='". $term->slug ."'>" . $term->name . "</option>";
		}
		
		$search.= '<div class="wmts_search">';
			// name input
			$search.= '<input class="wmts_search_input_name" name="wmts_search_input_name" placeholder="'. ( isset( $args[ 'overall_settings' ][ 'search_input_placeholder' ] ) ? $args[ 'overall_settings' ][ 'search_input_placeholder' ] : '' ) .'" />';
			// category select
			$search.= '<select class="wmts_search_select_category">';
				$search.= $options;
			$search.= '</select>';
			$search.= '<span class="wmts_search_submit button">';
				$search.= '<i class="fa fa-refresh fa-spin"></i>';
				$search.= isset( $args[ 'overall_settings' ][ 'search_button_label' ] ) ? $args[ 'overall_settings' ][ 'search_button_label' ] : __( 'Search' );
				$search.= '<i class="fa fa-times"></i>';
			$search.= '</span>';
		$search.= '</div>';
	}
	
	return $search;
}

// adds the search markup to the showcase during template build
add_filter( 'wph_template_output', 'wmts_add_search_markup_by_ajax', 10, 2 );
function wmts_add_search_markup_by_ajax( $result, $arr ){
	$overall_settings = $arr[ 2 ];
	$args = array( 'overall_settings'=> $overall_settings );
	$search = wmts_markup_for_search( $args );
	$result[ 'markup' ][ 'search' ] = $search;
	return $result;
}

/*Escape quotes*/
function wmts_escape_quotes( &$arr ){
	foreach( $arr as $key=> &$val ){
		if( is_array( $val ) )
			wmts_escape_quotes( $val );
		else
			$val = str_replace( '"', '\\"', $val );
	}
}

/*Conduct search query via ajax*/
add_action( 'wp_ajax_nopriv_wmts_search', 'wmts_search' );
add_action( 'wp_ajax_wmts_search', 'wmts_search' );
function wmts_search( ){

	$id = $_REQUEST[ 'post_id' ];
	$name = $_REQUEST[ 'name' ];
	$category = $_REQUEST[ 'category' ];

	if( 'publish' !== get_post_status( $id ) ) die( ); // hacker trying to access draft showcase

	$args = array(
		'query' => get_post_meta( $id, "MTS Query", true ),
		'query_handler' => 'WMTS_Query_Handler',
		'template' => get_post_meta( $id, "MTS Template", true ),
		'overall_settings' => get_post_meta( $id, "MTS Overall Settings", true ),
		'devices_settings' => get_post_meta( $id, "MTS Devices Settings", true ),
		'modifier' => 'WMTS_Template_Modifier',
		'post_id' => $id,
	);
	
	// use these settings instead of saved ones in case admin has applied new settings and is testing pagination or search without saving
	if( ! empty( $_REQUEST[ 'wmts_backend_nonce' ] ) && wp_verify_nonce( $_REQUEST[ 'wmts_backend_nonce' ], 'wmts_backend_nonce' ) ){
		if( ! empty( $_REQUEST[ 'overall_settings' ] ) ) $args[ 'overall_settings' ] = $_REQUEST[ 'overall_settings' ];
		if( ! empty( $_REQUEST[ 'query' ] ) ) $args[ 'query' ] = $_REQUEST[ 'query' ];
		if( ! empty( $_REQUEST[ 'template' ] ) ) $args[ 'template' ] = $_REQUEST[ 'template' ];
		if( ! empty( $_REQUEST[ 'device_settings' ] ) ) $args[ 'device_settings' ] = $_REQUEST[ 'device_settings' ];
	}
	
	// check if pagination is actually enabled to avoid hacking
	if( empty( $args[ 'overall_settings' ][ 'search' ] ) || $args[ 'overall_settings' ][ 'search' ] !== 'Enabled' ) die( );

	// default query must be set, else search will not work
	if( empty( $args[ 'query' ][ 'post_type' ] ) ){
		$args[ 'query' ][ 'post_type' ] = array( 'modernteammembers' );
	}
	
	if( empty( $args[ 'query' ][ 'terms' ] ) ){
		$args[ 'query' ][ 'terms' ] = array( 'marketing', 'finance' );
	}

	if( ! empty ( $name ) ){
		$args[ 'query' ][ 'additional_args' ] = trim( $args[ 'query' ][ 'additional_args' ] );
		// case where some additional query already exists
		if( ! empty( $args[ 'query' ][ 'additional_args' ] ) ){
			$args[ 'query' ][ 'additional_args' ] .= '&'; // append search query string
		}

		$args[ 'query' ][ 'additional_args' ] = 's='.trim( $name );
	}
	
	if( ! empty ( $category ) ){
		$args[ 'query' ][ 'terms' ] = array( $category );
	}
	
	// if( ! empty ( $_REQUEST[ 'posts_per_page' ] ) ){
		// $args[ 'query' ][ 'posts_per_page' ] = $_REQUEST[ 'posts_per_page' ];
	// }

	global $wph_template;
	$template_result = $wph_template->ajax( $args ); // calling ajax fn directly
	$template_result[ 'markup' ][ 'no_results' ] = __( 'No results found. Clear search?' );
	echo json_encode( $template_result );
	die( );
}

/*Conduct paginated query via ajax*/
add_action( 'wp_ajax_nopriv_wmts_pagination', 'wmts_pagination' );
add_action( 'wp_ajax_wmts_pagination', 'wmts_pagination' );
function wmts_pagination( ){

	$id = $_REQUEST[ 'post_id' ];
	$current_pagination = $_REQUEST[ 'current_pagination' ];

	if( 'publish' !== get_post_status( $id ) ) die( ); // hacker trying to access draft showcase

	$args = array(
		'query' => get_post_meta( $id, "MTS Query", true ),
		'query_handler' => 'WMTS_Query_Handler',
		'template' => get_post_meta( $id, "MTS Template", true ),
		'overall_settings' => get_post_meta( $id, "MTS Overall Settings", true ),
		'devices_settings' => get_post_meta( $id, "MTS Devices Settings", true ),
		'modifier' => 'WMTS_Template_Modifier',
		'post_id' => $id,
	);
	
	// use these settings instead of saved ones in case admin has applied new settings and is testing pagination or search without saving
	if( ! empty( $_REQUEST[ 'wmts_backend_nonce' ] ) && wp_verify_nonce( $_REQUEST[ 'wmts_backend_nonce' ], 'wmts_backend_nonce' ) ){
		if( ! empty( $_REQUEST[ 'overall_settings' ] ) ) $args[ 'overall_settings' ] = $_REQUEST[ 'overall_settings' ];
		if( ! empty( $_REQUEST[ 'query' ] ) ) $args[ 'query' ] = $_REQUEST[ 'query' ];
		if( ! empty( $_REQUEST[ 'template' ] ) ) $args[ 'template' ] = $_REQUEST[ 'template' ];
		if( ! empty( $_REQUEST[ 'device_settings' ] ) ) $args[ 'device_settings' ] = $_REQUEST[ 'device_settings' ];
	}
	
	// check if pagination is actually enabled to avoid hacking
	if( empty( $args[ 'overall_settings' ][ 'pagination' ] ) || $args[ 'overall_settings' ][ 'pagination' ] !== 'Enabled' ) die( );

	// correct pagination type and label
	// $args[ 'overall_settings' ][ 'pagination_type' ] = $_REQUEST[ 'pagination_type' ];	
	// if( ! empty( $_REQUEST[ 'load_more_text' ] ) )	 $args[ 'overall_settings' ][ 'load_more_text' ] = $_REQUEST[ 'load_more_text' ];
	
	// need default query params
	if( empty( $args[ 'query' ][ 'post_type' ] ) ){
		$args[ 'query' ][ 'post_type' ] = array( 'modernteammembers' );
	}
	
	if( empty( $args[ 'query' ][ 'terms' ] ) ){
		$args[ 'query' ][ 'terms' ] = array( 'marketing', 'finance' );
	}

	// search params
	$name = isset( $_REQUEST[ 'name' ] ) ? $_REQUEST[ 'name' ] : '';
	$category = isset( $_REQUEST[ 'category' ] ) ? $_REQUEST[ 'category' ] : '';

	if( ! empty ( $name ) ){
		$args[ 'query' ][ 'additional_args' ] = trim( $args[ 'query' ][ 'additional_args' ] );
		// case where some additional query already exists
		if( ! empty( $args[ 'query' ][ 'additional_args' ] ) ){
			$args[ 'query' ][ 'additional_args' ] .= '&'; // append search query string
		}

		$args[ 'query' ][ 'additional_args' ] = 's='.trim( $name );
	}

	if( ! empty ( $category ) ){
		$args[ 'query' ][ 'terms' ] = array( $category );
	}

	// pagination params
	$args[ 'query' ][ 'additional_args' ] = trim( $args[ 'query' ][ 'additional_args' ] );
	// case where some additional query already exists
	if( ! empty( $args[ 'query' ][ 'additional_args' ] ) ){
		$args[ 'query' ][ 'additional_args' ] .= '&'; // append paged query string
	}

	$args[ 'query' ][ 'additional_args' ] = 'paged=' . trim( $current_pagination );
	
	// if( ! empty ( $_REQUEST[ 'posts_per_page' ] ) ){
		// $args[ 'query' ][ 'posts_per_page' ] = $_REQUEST[ 'posts_per_page' ];
	// }
	
	global $wph_template;
	$template_result = $wph_template->ajax( $args ); // calling ajax fn directly
	echo json_encode( $template_result );
	die( );
}

/* Provides possible filter options to frontEnd */
add_filter( 'wph_template_output', 'wmts_possible_filters', 10, 2 );
function wmts_possible_filters( $result, $args ){
	if( ! empty( $_REQUEST[ 'nonce' ] ) && wp_verify_nonce( $_REQUEST[ 'nonce' ], 'wph-nonce' ) && ! empty( $_REQUEST[ 'overall_settings' ] ) ){

		// is it category
		if( empty( $_REQUEST[ 'overall_settings' ][ 'filtering_key' ] ) ) $_REQUEST[ 'overall_settings' ][ 'filtering_key' ] = '{{category}}';
		$filtering_key = str_replace( array( '{{', '}}' ) , '', $_REQUEST[ 'overall_settings' ][ 'filtering_key' ] );
		$filtering_key = strtolower( $filtering_key );
		$filtering_key = trim( $filtering_key );
		
		if( $filtering_key === 'category' ){ // want this returned in proper format
			$result[ 'possible_filters' ] = $args[ 0 ][ 'terms' ];
			/*
			$result[ 'possible_filters' ] = array( );
			foreach( $args[ 0 ][ 'terms' ] as $term_slug ){
				$term = get_term_by( 'slug', $term_slug, 'modernteamgroups' );
				$result[ 'possible_filters' ][ ] = $term->name;
			}
			*/
		}else{ // else run a query to extract values from query posts for the meta key that is the filtering_key

			$filtering_key = str_replace( array( '{{', '}}' ) , '', $_REQUEST[ 'overall_settings' ][ 'filtering_key' ] );
			$filtering_key = trim( $filtering_key );

			$query =& $args[ 0 ];
			// if pagination is enabled then set posts per page to -1 to get all possible filter values
			$overall_settings =& $args[ 2 ];

			if( ! empty( $overall_settings[ 'pagination' ] ) && $overall_settings[ 'pagination' ] === 'Enabled' ){
				$additional_args =& $query[ 'additional_args' ];
				if( strlen( $additional_args ) ) $additional_args .= '&';
				$additional_args .= 'posts_per_page=-1';
			}

			$query_handler_instance = new WMTS_Query_Handler( );
			$the_query = $query_handler_instance->get_posts( $query );
			
			if( $the_query->have_posts( ) ){
				
				$result[ 'possible_filters' ] = array( );

				while ( $the_query->have_posts( ) ){
					$the_query->the_post( );

					global $post;
					$meta_val = get_post_meta( $post->ID, $filtering_key, true );
					
					if( ! empty( $meta_val ) && ! in_array( $meta_val, $result[ 'possible_filters' ] ) ){
						$result[ 'possible_filters' ][ ] = $meta_val;
					}
					
				}

				wp_reset_query( );
				
			}else{
				$result[ 'possible_filters' ]= false;
			}

		}
	
	}
	
	return $result;
}

/*Decide when to enqueue scripts */
add_action( 'init', 'wmts_enqueue_scripts' );
function wmts_enqueue_scripts( ){
	// essential style
	add_action('wp_enqueue_scripts', 'wmts_essential_style');
	add_action('admin_enqueue_scripts', 'wmts_essential_style');

	// admin user always gets scripts, regardless of whether the plugin shortcode gets processed on the page
	if( current_user_can( 'manage_options' ) ){
		add_action('wp_enqueue_scripts', 'wmts_scripts');
		add_action('admin_enqueue_scripts', 'wmts_scripts');
	}

}

// essential style
function wmts_essential_style( ){
	echo
	'<style id="wmts-essential">
		.wmts_container{
		max-height: 100px;
		overflow: hidden;
		}

		.wmts_container>*{
		opacity: .01;
		}
	</style>';
}

/*Enqueue scripts*/
function wmts_scripts () {

	$admin_view = current_user_can('manage_options') ? true : false;

	global $wmts_assets;
	// CSS
	//-- editor related additional styles
	if ($admin_view) {
		wp_register_style('perfect-scrollbar',  $wmts_assets.'/css/perfect-scrollbar.min.css');
		wp_enqueue_style( 'perfect-scrollbar' );

		wp_register_style('spectrum',  $wmts_assets.'/css/spectrum.css');
		wp_enqueue_style( 'spectrum' );

		wp_register_style('wph_editor',  $wmts_assets.'/css/wph_editor.css');
		wp_enqueue_style( 'wph_editor' );

		wp_register_style('wph_keys',  $wmts_assets.'/css/wph_keys.css');
		wp_enqueue_style( 'wph_keys' );

		wp_register_style('wmts-admin',  $wmts_assets.'/css/wmts-admin.css', false, WMTS_VERSION_NUMBER);
		wp_enqueue_style( 'wmts-admin' );
	}

	//-- viewer related
	wp_register_style('wmts',  $wmts_assets.'/css/wmts.css', false, WMTS_VERSION_NUMBER);
	wp_enqueue_style( 'wmts' );

	wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style( 'fontawesome' );

	// JS
	//-- editor related additional scripts
	if ($admin_view) {
		
		// admin user nonce
		$wmts_backend_nonce = wp_create_nonce( 'wmts_backend_nonce' );
		echo "<script> var wmts_backend_nonce= '$wmts_backend_nonce';</script>";
		
		wp_enqueue_media();

		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-button');

		wp_register_script('perfect-scrollbar',  $wmts_assets.'/js/perfect-scrollbar.min.js', array('jquery'));
		wp_enqueue_script( 'perfect-scrollbar' );

		wp_register_script('spectrum',  $wmts_assets.'/js/spectrum.js', array('jquery'));
		wp_enqueue_script( 'spectrum' );

		wp_register_script('mousetrap.min',  $wmts_assets.'/js/mousetrap.min.js', array('jquery'));
		wp_enqueue_script('mousetrap.min');

		wp_register_script('wph_editor_privileged',  $wmts_assets.'/js/wph_editor_privileged.js', array('jquery'));
		wp_enqueue_script('wph_editor_privileged');
		wp_localize_script( 'wph_editor_privileged', 'wph_ajax', array( "url"=>admin_url( 'admin-ajax.php' ), "nonce"=> wp_create_nonce( 'wph-nonce' ) ) );

		wp_register_script( 'wmts-admin',  $wmts_assets.'/js/wmts-admin.js', array( 'jquery' ), WMTS_VERSION_NUMBER );
		wp_enqueue_script( 'wmts-admin' );

		if ( 'modernteamshowcase' == get_post_type( ) ) wp_dequeue_script( 'autosave' );
		
	}

	//--viewer related
	wp_register_script( 'wmts',  $wmts_assets.'/js/wmts.js', array('jquery'), WMTS_VERSION_NUMBER, true );
	wp_localize_script( 'wmts', 'wmts_ajax_url', admin_url( 'admin-ajax.php' ) );
	wp_enqueue_script('wmts');

}

/**
 * wph select post type and terms
 */
if( ! defined( 'WPH_Select_Post_Type_And_Terms' ) )
	$WPH_Select_Post_Type_And_Terms = new WPH_Select_Post_Type_And_Terms( );

/**
 * Modify editor
 */
$wmts_modify_wph_editor = new WMTS_Modify_WPH_Editor( );

/**
 * Ability to duplicate items
 */
if ( class_exists( 'WPH_Duplicate_Posts' ) ){
	$wmts_duplicate_modernteamshowcases = new WPH_Duplicate_Posts( 'modernteamshowcases' );
	$wmts_duplicate_modernteamforms = new WPH_Duplicate_Posts( 'modernteamforms' );
	$wmts_duplicate_modernteammembers = new WPH_Duplicate_Posts( 'modernteammembers' );
}

/**
 * Remove 'Comments' column
 */
add_filter( 'manage_edit-modernteamshowcase_columns', 'wmts_remove_comments_column' );
function wmts_remove_comments_column ($columns) {
    unset( $columns['comments'] );
    return $columns;
}

function wmts_hide_sortables( ){
	echo "
			<style>
			#poststuff #post-body.columns-2 {
			width:100%;
			margin-right: 0;
			}

			#postbox-container-1 {
			display:none;
			}

			body #post-body #normal-sortables {
			min-height: 0!important;
			}

			</style>
	";

};

/**
 * FrontEnd
 */
add_action( 'wp_footer', 'wmts_frontEnd' );
function wmts_frontEnd( ){
	if( defined( 'WMTS_READY' ) ) echo '<script>var wmts_frontend= true; </script>';
}

/**
 * Add a metaboxes.
 */
add_action( 'add_meta_boxes', 'wmts_add_meta_box' );
function wmts_add_meta_box( ){

	// Showcase
	//-- preview
	add_meta_box(
		'wmts_preview',
		__( 'MTS: Preview Showcase', 'modern-team-showcase' ),
		'wmts_preview_meta_box_callback',
		'modernteamshowcases'
	);

	//-- presets
	add_meta_box(
		'wmts_presets',
		__( 'MTS: Load New Preset', 'modern-team-showcase' ),
		'wmts_presets_meta_box_callback',
		'modernteamshowcases',
		'advanced',
		'high'
	);
	
	//-- FAQs
	add_meta_box(
		'wmts_faqs',
		__( 'MTS: FAQs', 'modern-team-showcase' ),
		'wmts_faqs_meta_box_callback',
		'modernteamshowcases',
		'advanced',
		'high'
	);

	//-- guides
	add_meta_box(
		'wmts_guides',
		__( 'MTS: Quick Guides', 'modern-team-showcase' ),
		'wmts_guide_meta_box_callback',
		'modernteamshowcases',
		'advanced',
		'high'
	);

	// Forms
	//-- builder
	add_meta_box(
		'wmts_form_builder',
		__( 'Form Builder', 'modern-team-showcase' ),
		'wmts_form_builder',
		'modernteamforms'
	);

	//-- presets
	add_meta_box(
		'wmts_form_presets',
		__( 'Load New Preset', 'modern-team-showcase' ),
		'wmts_form_presets_meta_box_callback',
		'modernteamforms',
		'advanced',
		'high'
	);

	//-- associated post terms
	add_meta_box(
		'wmts_form_associated_post_terms',
		__( 'Where Should This Form Show? (Select associated post terms)', 'modern-team-showcase' ),
		'wmts_form_associated_post_terms',
		'modernteamforms'
	);

}

/**
 * Showcase presets meta box
 */
function wmts_presets_meta_box_callback( $post ){
	include 'php/custom/wmts-presets-meta-box.php';
}

/**
 * Showcase FAQs meta box
 */
function wmts_faqs_meta_box_callback( $post ){
	include 'php/custom/wmts-faqs-meta-box.php';
}

/**
 * Showcase guides meta box
 */
function wmts_guide_meta_box_callback( $post ){
	include 'php/custom/wmts-guide-meta-box.php';
}

/**
 * Get showcase json attributes like template and query if we are in admin
 */
add_action('wp_ajax_wmts_retrieve_json_data', 'wmts_retrieve_json_data');
function wmts_retrieve_json_data( ){
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'wph-nonce' ) ) die( 'Not permitted' );
	$post_id = $_REQUEST[ 'post_id' ];
	if( ! $post_id || 'modernteamshowcases' !== get_post_type( $post_id ) ) die( );

	$response = array(
		'query' => get_post_meta( $post_id, "MTS Query", true ),
		'template' => get_post_meta( $post_id, "MTS Template", true ),
		'result' => 'success',
	);

	echo json_encode( $response );
	die( );
}

/**
 * Get showcase presets via ajax
 * Presets templates contain maximum elements. This function culls the selected preset's elements based on what user wants
 */
add_action('wp_ajax_wmts_get_showcase_preset', 'wmts_get_showcase_preset');
function wmts_get_showcase_preset( ){

	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'wph-nonce' ) ) die( 'Not permitted' );

	// get preset parameters
	$parameters = $_REQUEST[ 'parameters' ];

	// get global presets array
	require_once( 'php/presets/showcase_presets.php' );

	// find the right preset settings
	$map = $wmts_showcase_presets[ 'map' ];
	$type = strtolower( $parameters[ 'type' ] );
	$style = strtolower( $parameters[ 'style' ] );
	$id = $map[ $type ][ $style ];
	$preset = $wmts_showcase_presets[ $id ];
	
	// columns
	if( ! empty( $parameters[ 'columns' ] ) ){
		$parameters[ 'columns' ] = abs( $parameters[ 'columns' ] );
		$device_settings = &$preset[ 'devices settings' ];
		if( empty( $device_settings ) ) $device_settings = array( );
		
		if( empty( $device_settings[ 'desktop' ] ) ) $device_settings[ 'desktop' ] = array( );
		$device_settings[ 'desktop' ][ 'columns' ] = $parameters[ 'columns' ];
		
		if( empty( $device_settings[ 'laptop' ] ) ) $device_settings[ 'laptop' ] = array( );
		$device_settings[ 'laptop' ][ 'columns' ] = $parameters[ 'columns' ];
	}

	// remove unwanted components
	$template = &$preset[ 'template' ];
	$wanted_components = isset( $parameters[ 'components' ] ) ? $parameters[ 'components' ] : array( );
	$optional_components = array( 'Image Centering', 'Links', 'Lightbox', 'Ribbon', 'Attributes', 'Description' );
	$unwanted_components = array_diff( $optional_components, $wanted_components );
	
	// customize description element
	if( in_array( 'Description', $wanted_components ) ){
		$content_source = $parameters[ 'description_details' ][ 'content_source' ];
		$content_limit = $parameters[ 'description_details' ][ 'limit' ];
		$content_append = empty( $parameters[ 'description_details' ][ 'append' ] ) ? '' : $parameters[ 'description_details' ][ 'append' ];
		$desc_embed_meta = "{{ $content_source | $content_limit }}" . $content_append;
		
		$description_template = &wmts_return_template_element_reference( $template, 'Description' );
		$description_template[ 'Content' ][ 'content' ] = $desc_embed_meta;
	}

	// remove unwanted elements from cell
	if( count( $unwanted_components ) ){
		$off_limits = array( 'Lightbox' );
		wmts_remove_unwanted_components( $template, $unwanted_components, $off_limits ); // the function won't look within the off limits container
	}

	// Lightbox
	if( in_array( 'Lightbox', $unwanted_components ) ){ // case where lightbox is not wanted at all
		if( isset( $parameters[ 'enable_profile_link' ] ) ){ // link to member post
			$template[ 'sub_elements' ][ 0 ][ 'Attr' ][ 'link' ] = '{{post_link}}';
			$name_element = &wmts_return_template_element_reference( $template, 'Name' );
			$name_element[ 'Attr' ][ 'link' ] = '{{post_link}}';
		}else{ // or cancel link, but don't leave link pointing to lightbox by defualt
			$template[ 'sub_elements' ][ 0 ][ 'Attr' ][ 'link' ] = '';
		}

		$lightbox_wanted_components = array( ); // used by attributes and links
	}else{
		// remove unwanted elements from lightbox
		$lightbox_template = &wmts_return_template_element_reference( $template, 'Lightbox' );
		if( ! is_array( $lightbox_template ) ) die( json_encode( array( 'message'=> 'could not find lightbox', 'lightbox'=> $lightbox_template ) ) );
		$lightbox_wanted_components = isset( $parameters[ 'lightbox_components' ] ) ? $parameters[ 'lightbox_components' ] : array( );
		$optional_components = array( 'Image Centering', 'Links', 'Ribbon', 'Attributes', 'Description' );
		$unwanted_components = array_diff( $optional_components, $lightbox_wanted_components );
		if( count( $unwanted_components ) ){
			wmts_remove_unwanted_components( $lightbox_template, $unwanted_components );
		}
		
		// set lightbox orientation
		if( ! empty( $parameters[ 'lightbox_orientation' ] ) ){
			$lightbox_template[ 'Class' ][ 'classes' ] .= ' wmts_lightbox_' . $parameters[ 'lightbox_orientation' ] . ' ';
		}
		
		// set lightbox color theme
		if( ! empty( $parameters[ 'lightbox_color_theme' ] ) ){
			$lightbox_template[ 'Class' ][ 'classes' ] .= ' wmts_lightbox_' . $parameters[ 'lightbox_color_theme' ] . ' ';
		}
		
		// customize lightbox description element
		if( in_array( 'Description', $lightbox_wanted_components ) ){
			$content_source = $parameters[ 'lightbox_description_details' ][ 'content_source' ];
			$content_limit = $parameters[ 'lightbox_description_details' ][ 'limit' ];
			$content_append = empty( $parameters[ 'lightbox_description_details' ][ 'append' ] ) ? '' : $parameters[ 'lightbox_description_details' ][ 'append' ];
			$desc_embed_meta = "{{ $content_source | $content_limit }}" . $content_append;
			
			$description_template = &wmts_return_template_element_reference( $lightbox_template, 'Description' );
			$description_template[ 'Content' ][ 'content' ] = $desc_embed_meta;
		}
		
		// add the view profile link among attributes
		if( in_array( 'Attributes', $lightbox_wanted_components ) && isset( $parameters[ 'enable_profile_link' ] ) ){
			$attributes_template = &wmts_return_template_element_reference( $lightbox_template, 'Attributes' );
			$new_attribute = $attributes_template[ 'sub_elements' ][ 0 ];
			$new_attribute[ 'Name' ][ 'name' ] = 'Profile Link';
			$new_attribute[ 'Content' ][ 'label_icon' ] = 'fa fa-chevron-right';
			$new_attribute[ 'Content' ][ 'value_text' ] = '<a target="_blank" href="{{post_link}}">View Full Profile</a>';
			array_unshift( $attributes_template[ 'sub_elements' ], $new_attribute );
		}
	}
	
	// Attributes
	if( ! empty( $parameters[ 'attributes_components' ] ) && ( in_array( 'Attributes', $wanted_components ) || in_array( 'Attributes', $lightbox_wanted_components ) ) ){
		$new_attributes_sub_elements = array( );
		$attributes_template = &wmts_return_template_element_reference( $template, 'Attributes' );
		$attributes_components = &$parameters[ 'attributes_components' ];
		if( count( $attributes_components ) ){
			foreach( $attributes_components as $attribute ){
				$single_attribute_template = &wmts_return_template_element_reference( $attributes_template, $attribute );
				array_push( $new_attributes_sub_elements, $single_attribute_template );
			}
		}
		$attributes_template[ 'sub_elements' ] = $new_attributes_sub_elements;
	}
	
	// Links
	if( in_array( 'Links', $wanted_components ) || in_array( 'Links', $lightbox_wanted_components ) ){
		$new_links_sub_elements = array( );
		$links_template = &wmts_return_template_element_reference( $template, 'Links' );
		$links_components = &$parameters[ 'links_components' ];
		
		// stuff 'mail' link into template because they do not exist normally
		if( ! empty( $links_components ) && in_array( 'Email', $links_components ) ){
			$mail_element = $links_template[ 'sub_elements' ][ 0 ];
			$mail_element[ 'Name' ][ 'name' ] = 'Email';
			$mail_element[ 'Content' ][ 'link_icon' ] = 'fa fa-envelope';
			$mail_element[ 'Content' ][ 'link_url' ] = 'mailto:{{ MTS E-mail }}';
			$mail_element[ 'Logic' ][ 'meta_key' ] = 'MTS E-mail';
			$mail_element[ 'css-id' ] = '';
			array_push( $links_template[ 'sub_elements' ], $mail_element );
		}
		
		if( count( $links_components ) ){
			foreach( $links_components as $link ){
				$single_link_template = &wmts_return_template_element_reference( $links_template, $link );
				array_push( $new_links_sub_elements, $single_link_template );
			}
		}
		$links_template[ 'sub_elements' ] = $new_links_sub_elements;
	}
	
	// grayscale
	if( isset( $parameters[ 'grayscale' ] ) ){
		$image_template = &wmts_return_template_element_reference( $template, 'Image Centering' );
		$image_template[ 'Class' ][ 'classes' ].= ' wmts_grayscale ';
	}
	
	// css
	if( ! empty( $parameters[ 'general_css' ] ) ){
		if( empty( $preset[ 'overall settings' ][ 'general_css' ] ) ) $preset[ 'overall settings' ][ 'general_css' ] = '';
		$preset[ 'overall settings' ][ 'general_css' ] .= urldecode( $parameters[ 'general_css' ] );
	}

	// remap metas
	if( ! empty( $parameters[ 'remap_metas' ] ) ){
		$old_keys = array_keys( $parameters[ 'remap_metas' ] );
		$new_keys = array_values( $parameters[ 'remap_metas' ] );
		$template_json = json_encode( $template );
		$template_json = str_replace( $old_keys, $new_keys, $template_json );
		$template = json_decode( $template_json, true );
	}

	global	$wph_template;

	// query settigs
	if( ! isset( $preset[ 'query' ] ) ) $preset[ 'query' ] = array( );
	
	//-- posts per page
	if( ! empty( $parameters[ 'posts_per_page' ] ) ){
		$preset[ 'query' ][ 'posts_per_page' ] = $parameters[ 'posts_per_page' ];
	}
	
	//-- post__in
	if( ! empty( $parameters[ 'post__in' ] ) ){
		$preset[ 'query' ][ 'post__in' ] = $parameters[ 'post__in' ];
	}
	
	// default post type
	$preset[ 'query' ][ 'post_type' ] = array( 'modernteammembers' );
	
	//-- terms
	if( ! empty( $parameters[ 'terms' ] ) ){
		$preset[ 'query' ][ 'terms' ] = $parameters[ 'terms' ];
	}
	
	// overall settings

	//-- filtering
	if( ! empty( $parameters[ 'filtering' ] ) ){
		$preset[ 'overall settings' ][ 'filtering' ] = 'Enabled';
		$preset[ 'overall settings' ][ 'filtering_key' ] = '{{category}}';
		$preset[ 'overall settings' ][ 'filtering_text' ] = 'All';		
		if( ! empty( $parameters[ 'filtering_details' ] ) )
			$preset[ 'overall settings' ][ 'filtering_details' ] = stripslashes( $parameters[ 'filtering_details' ] );
	}
	
	//-- pagination
	if( ! empty( $parameters[ 'pagination' ] ) ){
		$preset[ 'overall settings' ][ 'pagination' ] = 'Enabled';
		$preset[ 'overall settings' ][ 'pagination_type' ] = 'numbered';
	}
	
	//-- search
	if( ! empty( $parameters[ 'search' ] ) ) $preset[ 'overall settings' ][ 'search' ] = 'Enabled';	
	
	$args = array(
			'query'=> ( ! empty ( $preset[ 'query' ] ) ) ? $preset[ 'query' ] : false,
			'query_handler' => 'WMTS_Query_Handler',
			'post_id'=> $_REQUEST[ 'post_id' ],
			'modifier'=> $_REQUEST[ 'modifier' ],
			'template'=> $preset[ 'template' ],
			'overall_settings'=> $preset[ 'overall settings' ],
	);

	$response = $wph_template->ajax( $args );
	$response[ 'preset' ] = $preset;
	$response = json_encode( $response );
	echo $response;
	
	// save
	$json = json_encode( $_REQUEST[ 'parameters' ] );
	update_post_meta( $_REQUEST[ 'post_id' ], 'MTS Preset Parameters', $json );
	
	die( );

}

// removes unwanted components from presets template
function wmts_remove_unwanted_components( &$template_element, $unwanted_components, $off_limits= array( ) ){
	// iterate over sub elements
	if( isset( $template_element[ 'sub_elements' ] ) ){
		foreach( $template_element[ 'sub_elements' ] as $key => &$sub_element ){
			// check and remove unwanted sub element
			if( ! empty( $sub_element[ 'Name' ] ) ){
				$name = $sub_element[ 'Name' ][ 'name' ];
				if( in_array( $name, $unwanted_components ) ){
					unset( $template_element[ 'sub_elements' ][ $key ] );
					continue;
				}
				if( ! in_array( $name, $off_limits ) ){
					wmts_remove_unwanted_components( $sub_element, $unwanted_components, $off_limits );
				}
			}else{
				wmts_remove_unwanted_components( $sub_element, $unwanted_components, $off_limits );
			}
		}
	}else{
		return;
	}
}

// locate a template element and return its reference
function &wmts_return_template_element_reference( &$template_element, $element_name ){
	// iterate over sub elements
	if( isset( $template_element[ 'sub_elements' ] ) ){
		foreach( $template_element[ 'sub_elements' ] as $key=> &$sub_element ){
			// check and remove unwanted sub element
			if( ! empty( $sub_element[ 'Name' ] ) ){
				$name = $sub_element[ 'Name' ][ 'name' ];
				if( $name === $element_name ){
					return $sub_element;
				}else{
					$found_elm = &wmts_return_template_element_reference( $sub_element, $element_name );
					if( is_array( $found_elm ) ){
						return $found_elm;
					}
				}
			}
		}
		// exhausted all sub elements
		$ret = false;
		return $ret;
	}else{
		$ret = false;
		return $ret;
	}
}

/**
 * Ensure order meta key is set
 */
function wmts_ensure_order( $post_id ){
	$order = get_post_meta( $post_id, 'MTS Order', true );
	if( ! $order ){
		update_post_meta( $post_id, 'MTS Order', 1 );
	}
}
add_action(  'publish_modernteammembers',  'wmts_ensure_order' );

/**
 * Form presets meta box
 */
function wmts_form_presets_meta_box_callback( $post ){

	// provide js with the presets map
	global $wmts_form_presets; // ### future
	if( $wmts_form_presets ){
		$wmts_presets_json_map = json_encode( $wmts_form_presets[ 'map' ] );
		echo "<script> var wmts_presets_map = $wmts_presets_json_map</script>";
	}

	echo '<div class="wmts_form_presets">';

	// select fields
	//-- purpose
	echo
	'<div style="display: none;">
		<span>'. __( 'Purpose: ', 'modern-team-showcase' ) .'</span>
		<select class="wmts_preset_purpose">
			<option>Edit</option>
			<option>Search</option>
		</select>
	</div>';

	//-- topic
	echo
	'<span>'. __('Topic: ', 'modern-team-showcase') .'</span>
	<select class="wmts_preset_topic">
		<option>Member Details</option>
		<option>RSVP</option>
		<option>Member Order</option>
	</select>';

	// submit
	echo
	'<span class="button wmts_load_this_preset">'. __('Load This Preset Form', 'modern-team-showcase') .'</span>';

	echo '</div>';

}

/**
 * Get form preset via ajax
 */
add_action('wp_ajax_wmts_get_form_preset', 'wmts_get_form_preset');
function wmts_get_form_preset( ){

	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'wph-nonce' ) ) die( 'Not permitted' );

	// get preset parameters
	$parameters = $_REQUEST[ 'parameters' ];

	// get global presets array
	require_once( 'php/presets/form_presets.php' );

	// find the right preset settings
	$topic = strtolower( $parameters[ 'topic' ] );
	$id = $wmts_form_presets[ 'map' ][ 'edit' ][ $topic ];
	$preset = $wmts_form_presets[ $id ][ 0 ];

	$response = array(
		'preset'=> $preset,
	);

	$response = json_encode( $response );
	echo $response;
	die( );

}

/**
 * Preview meta box
 */
function wmts_preview_meta_box_callback( $post ){

	global $current_screen;
	$id = $post->ID;

	//var_export( get_post_meta( $id, 'MTS Template', true ) );

	if( $current_screen->action == 'add' || ! get_post_meta( $id, "MTS Template", true ) ){
		$devices_settings = '{"desktop":{"breakpoint":1600,"cellSpace":10,"columns":4,"fontSize":15,"width":2,"height":3},"laptop":{"breakpoint":1300,"cellSpace":10,"columns":4,"fontSize":15,"width":2,"height":3},"tabletLandscape":{"breakpoint":1020,"cellSpace":5,"columns":3,"fontSize":15,"width":2,"height":3},"tablet":{"breakpoint":760,"cellSpace":5,"columns":3,"fontSize":15,"width":2,"height":3},"mobileLandscape":{"breakpoint":500,"cellSpace":5,"columns":2,"fontSize":15,"width":2,"height":3},"mobile":{"breakpoint":0,"cellSpace":5,"columns":1,"fontSize":15,"width":1,"height":1}}';

		$value =
		'<div class="wmts_container  wph_container wph_key_keeper wmts_loaded" data-wph-key-type="container" data-wph-plugin="wmts" data-wph-post-id="%post-id%" data-wmts-devices-settings= "'. htmlentities( $devices_settings ) .'">
		</div>';
	}else{
		$value = wmts_generate_showcase( $id );
	}
	
	echo '<span class="wmts_form_submit_notice"><strong>'.__('Shortcode', 'modern-team-showcase').':</strong> [wmts id="'.$id.'"]</span>';
	echo "<i class=' fa fa-spin' data-wph-post-id='$id'></i>";
	echo "<span class='wph_post_id' data-wph-post-id='$id'></span>";
	echo "<div class='wmts_preview' style='margin-top:15px;'>".str_replace("%post-id%", $id, $value).'</div>';
	echo '<div class="wmts_form_submit_notice">
		<strong style="display: block;font-size: 20px;line-height: 35px;padding: 10px 0;">MTS Quick Usage Guid</strong>
		<em>This is a basic guide to quickly get you started. For further knowledge please head over to the plugin\'s <a href="http://modernteamshowcase.com/documentation/">Documentation</a> page.</em>
		<hr />
		<ul style="list-style-type: disc;padding-left: 30px;">
		<li>Use the \'<a href="#wmts_presets">MTS: Load New Preset</a>\' section when you start building a new showcase. It will help you make very quick progress while starting a new grid, however, it is not the main editor and its settings are simply reset every time you reload this page. You can apply the settings from this section onto your showcase by clicking the \'Load New Preset\' button at its bottom. When you are happy with the preset and settings you have loaded, click on its \'Save Showcase\' button. After this your shortcode (provided at the top of the MTS: Preview section) will be ready to use on your website. You can paste it on any page, post or widget area.</li>
		<li>Next, you may want to dive into advanced customization of your showcase. The main editor is a much more powerful editing tool. You can open it using the green button <i class="wmts_frontend_editor_trigger fa fa-cog"></i> at the top left of your showcase, in the back-end as well as the front-end of your website.</li>
		<li>The MTS Editor has 3 panels, the first, called Query is dedicated to query settings you make to pull member posts from your website. The second panel, called \'Member Template\' gives you deep customization options for your member templates. You can open its sub panels by using the plus button or double clicking them, to reveal their settings tabs, and sub-elements in case of container elements.</li>
		<li>Likely most useful among the settings tabs will be the \'Style\' tab. Besides providing you basic color and font size settings, it also gives you the opportunity to directly add CSS for any template element.</li>
		<li>Let\'s move on to the editor panel labeled \'Overall\'. It is home to several powerful, yet self-explanatory options provided by the plugin.</li>
		<li>Whenever you configure your showcase settings using this editor, always remember to click Apply Settings to view the changes take place on your showcase, and if you are happy with the changes, click on \'Save Applied Settings\' to actually save those changes so those changes are reflected by the team grid created by your MTS shortcode.</li>
		</ul>
		</div>';
}

/**
 * Save
 */
add_action('wp_ajax_wmts_save', 'wmts_save');
add_action('wp_ajax_nopriv_wmts_save', 'wmts_save');
function wmts_save( ){
	if( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'wph-nonce' ) || ! current_user_can( 'manage_options' ) ) die('Not permitted');
	$id = $_REQUEST['post_id'];


	$template = json_decode( stripslashes( $_REQUEST[ 'template' ] ), true ); // get truncated array otherwise
	update_post_meta( $id, "MTS Template", $template );
	update_post_meta( $id, "MTS Query", $_REQUEST[ 'query' ] );
	update_post_meta( $id, "MTS Overall Settings", $_REQUEST[ 'overall_settings' ] );
	update_post_meta( $id, "MTS Devices Settings", $_REQUEST[ 'devices_settings' ] );

	// remove wph_editor keys from markup
	$markup = $_REQUEST[ 'markup' ];

	// cache
	$overall_settings = $_REQUEST[ 'overall_settings' ];
	if( ! empty( $overall_settings[ 'cache' ] ) && $overall_settings[ 'cache' ] === 'On' ){
		$interval = empty( $overall_settings[ 'cache_purge_time' ] ) || ! is_numeric( $overall_settings[ 'cache_purge_time' ] ) ? false : $overall_settings[ 'cache_purge_time' ] * 24 * 60 * 60;
		update_post_meta( $id, '_wmts_cache_details', array( 'next'=> time( ) + $interval, 'interval'=> $interval ) );
		update_post_meta( $id, "wmts", $markup );
		update_post_meta( $id, "MTS Showcase", $markup );
	}else{
		update_post_meta( $id, '_wmts_cache_details', false);
		update_post_meta( $id, "wmts", false );
		update_post_meta( $id, "MTS Showcase", false );
	}

	$status = get_post_status( $id );
	if( $status !== "publish" ) wp_publish_post( $id );
	echo json_encode( array( "result"=>"success", "message"=> __("The showcase has been saved.", 'modern-team-showcase' ), 'saved_template'=> get_post_meta( $id, "MTS Template", true ) ) );
	die( );
}

/**
 * Cache
 */
function wmts_clear_cache( $post_id ){
	$cache_details = get_post_meta( $post_id, '_wmts_cache_details', true );

	if( ! $cache_details || ! $cache_details[ 'interval' ] ){
		update_post_meta( $post_id, 'MTS Showcase', false );
		return;
	}

	// time for purge?
	$current_time = time( );
	if( $cache_details[ 'interval' ] && $current_time > $cache_details[ 'next' ] ){
		update_post_meta( $post_id, 'MTS Showcase', false );
		update_post_meta( $post_id, '_wmts_cache_details', array( 'next'=> ( $current_time + $cache_details[ 'interval' ] ), 'interval'=> $cache_details[ 'interval' ] ) );
	}
}

/**
 * Switch meta keys in member content
 */
add_action( 'the_content', 'wmts_member_meta_switch' );
function wmts_member_meta_switch( $content ){
	global $post;
	if( 'modernteammembers' === get_post_type( $post ) ){
		$content = WPH_Template::search_and_process_meta( $content );
	}
	return $content;
}


/**
 * Display the form builder
 */
function wmts_form_builder( $post ){
	if( empty( $post ) )
		global $post;
	$id = $post->ID;
	
	echo '<div class="wmts_form_submit_notice">
		<strong style="display: block;font-size: 20px;line-height: 35px;padding: 10px 0;">MTS Form Builder: Quick Usage Guid</strong>
		<em>This is a basic guide to quickly get you started with creating new forms. For further knowledge please head over to the plugin\'s <a href="http://modernteamshowcase.com/documentation/">Documentation</a> page.</em>
		<hr /> 
		<ul style="list-style-type: disc;padding-left: 30px;">
		<li>First of all you need to be sure if you actually need a <em>new form</em>. For most users, the \'Member Details\' form which is already included on the member editor pages by default is enough.</li>
		<li>You do not need to build a form entirely from scratch. Presets have been included in the plugin for you to quickly get started with them. Use the <a href="#wmts_form_presets">Load New Preset</a> section to use one.</li>
		<li>To open the form editor, click on the grey cog icon at its top rght corner. Within the editor you will find 2 panels. The \'Add Form Element\' panel lets you add new elements to your form and the \'Edit Form Element\' panel gives you customization options for your form elements.</li>
		<li>It is essential you give each form element a unique \'Meta Key\' in its editing panel. After you do this, you can go to Showcase Main Editor > Member Template and there you can enter {{Meta Key}} anywhere in the content fields of the template. The plugin will interpret {{Meta Key}} as the value that was entered in the user\'s form. Always ensure you append your meta keys such as \'MTS Last Name\' so that there are no conflicts with meta keys set by other plugins, your theme and WordPress.</li>		
		<li>Once you are done applying your settings and are satisfied with how your form looks, be sure to click the \'Save Form Settings\' button at the base of the form builder to ensure your progress with the form is not lost!</li>
		<li>Use the \'Where Should This Form Show\' section at the bottom of this page to make the form show up in the member editor pages of the desired member groups.</li>
		<li>If you are having difficulty using the form builder or have any queries please feel free to contact the autor via the <a href="http://codecanyon.net/item/modern-team-showcase-wordpress-plugin/12173695/support" target="_blank">support form</a>.</li>
		</ul>
		</div>';
	
	echo '<span class="wmts_form_submit_notice"><strong>Shortcode: [wmts_form form_id="'. $id .'" member_id="<em>enter_id</em>"]</strong></span>';

	// Use the form builder object
	global	$wmts_form;
	$args = array(
		'plugin' => 'wmts-form',
		'id' => $id,
		'form' => get_post_meta( $id, 'MTS Form Markup', true ),
		'meta key prefix' => 'MTS',
	);
	$form = $wmts_form->build_form( $args );
	$form = str_replace('"wmts"', '"wmts-form"', $form);
	// print the form and script
	echo $form;

}

/**
 * Select form display locations
 */
function wmts_form_associated_post_terms( $post ){
	
	echo '<script>
		jQuery( function( $ ){
			function toggle_advanced_wmts_form_location( ){
				if( $( "[name=wmts_form_location_setting_type]:checked" ).val( ) === "advanced" ){
					$( ".wph_select_post_types" ).parent( ).addBack( ).show( );
					$( ".wph_select_terms" ).parent( ).addBack( ).show( );
				}else{
					$( ".wph_select_post_types" ).parent( ).addBack( ).hide( );
					$( ".wph_select_terms" ).parent( ).addBack( ).hide( );					
				}
			}
			
			$( "[name=wmts_form_location_setting_type]" ).on( "click", function( ){
				toggle_advanced_wmts_form_location( );
			} )
			
			toggle_advanced_wmts_form_location( );
		} )
	</script>';
	
	global $post;	
	
	$location_type = get_post_meta( $post->ID, 'MTS Form Location Type', true );
	$locations = get_post_meta( $post->ID, 'MTS Form Locations', true );
	
	if( ! $locations && $location_type !== 'advanced' ){
		// simple
		$simple_checked = 'checked="checked"';
		$advanced_checked = '';
	}else{
		//advanced
		$simple_checked = '';
		$advanced_checked = 'checked="checked"';
	}
	
	echo '<br>';
	
	echo '<input type="radio" value="simple" name="wmts_form_location_setting_type" '. $simple_checked .'> <strong>Simple setting:</strong> Makes this form appear on the backend editor pages of all team members.<br><br>';
	
	echo '<input type="radio" value="advanced" name="wmts_form_location_setting_type" '. $advanced_checked .'> <strong>Advanced setting:</strong> Gives you finer control over where the forms shows up in your WordPress backend.<br><br>';

	global $WPH_Select_Post_Type_And_Terms;
	$markup = $WPH_Select_Post_Type_And_Terms->markup( );
	echo $markup;

	$nonce = wp_create_nonce( 'wmts-nonce' );
	if( gettype( $locations ) !== 'string' ) $locations = json_encode( $locations );

	echo '
	<p>
		<span class="button wmts_forms_save_post_type_and_terms_selection" style="display:inline-block;" data-wmts-nonce="'. $nonce .'" data-wmts-post-id="'. $post->ID .'" data-wmts-location="'. htmlentities( $locations ) .'">Save Form Locations</span>
	</p>
	';

}

// ajax save form locations
add_action( 'wp_ajax_wmts_save_form_locations', 'wmts_save_form_locations' );
function wmts_save_form_locations( ){
	if ( ! isset( $_REQUEST[ 'nonce' ] ) || ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'wmts-nonce' ) ) die( 'Not permitted' );
	
	$location_type = $_REQUEST[ 'location_type' ];
	update_post_meta( $_REQUEST[ 'post_id' ], 'MTS Form Location Type', $location_type );
	
	$locations = json_encode( $_REQUEST[ 'locations' ] );
	update_post_meta( $_REQUEST[ 'post_id' ], 'MTS Form Locations', $locations );

	$response = array( 'result' => 'success', 'terms'=>$_REQUEST[ 'terms' ], 'post_types' => $_REQUEST[ 'post_types' ], 'meta' => get_post_meta( $_REQUEST[ 'post_id' ], 'MTS Form Locations', true ), 'locations'=> $locations );
	
	echo json_encode( $response );
	die( );
}

/**
 * Display the form
 */
function wmts_form_display( $post, $args= array( ) ){

	global	$wmts_form;
	global $post;
	$args = array(
		'member_id' => $post->ID,
		'form_id' => $args[ 'args' ][ 'form_id' ],
		'form' => get_post_meta( $args[ 'args' ][ 'form_id' ], 'MTS Form Markup', true ),
		'search_action' => 'wmts_search_form',
		'edit_action' => 'wmts_save_form',
		'nonce' => wp_create_nonce( 'wmts-form-'. $post->ID ),
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	);
	// get the form markup without editing capabilities
	$form = $wmts_form->display_form( $args );

	$prepend = '';
	if( is_admin( ) ){
		$prepend = '<div class="wmts_form_submit_notice"><strong>Please Note:</strong> You need to click on the \'Submit\' button at the end of the form to save its options!</div>';
	}
	
	$append = '<span  class="wmts_form_submit_notice"><strong>Shortcode:</strong> [wmts_form form_id="'. $args[ 'form_id' ] .'" member_id="'. $args[ 'member_id' ] .'"]<br>Using the above shortcode you can display this form, connected to \''. get_the_title( $post->ID ) .'\' on the frontEnd of your website, so they may fill it themselves.</span>';
	
	echo $prepend . $form . $append;
}

/**
 * Print out the frontend editor
 */
add_action ( 'get_footer', 'wmts_print_frontend_editor' );
add_action ( 'admin_footer', 'wmts_print_frontend_editor' );
function wmts_print_frontend_editor( ){
	// check viewer status
	$admin_view = current_user_can( 'manage_options' ) ? true : false;
	if( ! $admin_view || defined( 'WPH_Frontend_Editor' ) ) return;

	$wmts_frontend_editor = new WPH_Frontend_Editor( );
	return $wmts_frontend_editor->echo_markup( );

}

/**
 * Save form build
 */
add_action( 'wp_ajax_wmts_save_form_build', 'wmts_save_form_build' );
function wmts_save_form_build( ){

	if ( ! isset( $_REQUEST[ 'nonce' ] ) || ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'wph-nonce' ) ) die( 'Not permitted' );
	$id = $_REQUEST[ 'post_id' ];
	update_post_meta( $id, 'MTS Form Markup', $_REQUEST[ 'form_html' ] );
	update_post_meta( $id, 'MTS Form Model JSON', $_REQUEST[ 'form_model_json' ] );
	$status = get_post_status( $id );
	if ($status !== "publish") wp_publish_post( $id );

	$form_model = json_decode( $_REQUEST[ 'form_model_json' ], true );

	echo json_encode( array( 'result'=> 'success', 'message'=> 'The Form has been saved!', 'id'=> $id ) );
	die( );

}

/**
 * Save form information for member
 */
add_action( 'wp_ajax_nopriv_wmts_save_form', 'wmts_save_form' );
add_action( 'wp_ajax_wmts_save_form', 'wmts_save_form' );
function wmts_save_form( ){

	if ( ! isset( $_REQUEST[ 'member_id' ] ) || ! isset( $_REQUEST[ 'nonce' ] ) || ! wp_verify_nonce( $_REQUEST[ 'nonce' ], "wmts-form-". $_REQUEST[ 'member_id' ] ) ) die( 'Not permitted' );

	$member_id = $_REQUEST[ 'member_id' ]; // this is the post id which will have its custom fields updated
	$form_values = $_REQUEST[ 'form_values' ]; // ### no need for json_decode

	// get the form model for validation
	$form_id = $_REQUEST[ 'form_id' ];
	$form_model = json_decode( get_post_meta( $form_id, 'MTS Form Model JSON', true ), true ); // needed for validation
//	die( get_post_meta( $form_id, 'MTS Form Model JSON', true ) );

	// ensure hacker can't spoof form type
	/*
	$switch_hack_safe = false;
	// ensure there is at least one button without action or search action
	foreach( $form_model as $field=>$model_arr ){
		// password ( required field )
		if( 'submit' === $model_arr[ 'template' ] ){
			if( ! isset( $model_arr[ 'action' ] ) || $model_arr[ 'action' ] === 'Edit' ){
				$switch_hack_safe = true;
			}
		}
	}

	if( ! $switch_hack_safe ) die( 'Not permitted' );
	*/

	// validate
	$validation_issues = wmts_validate_form( $form_values, $form_model, $member_id );

	if( ! count( $validation_issues ) ){
		// save form values as json
			update_post_meta( $member_id, 'WPH Form ID '. $form_id , json_encode( $form_values ) );

		// save individual form values as meta keys
		foreach( $form_values as $key => $value ){
			if( is_array( $value ) ) $value = json_encode( $value );
			$prev_val = get_post_meta( $member_id, $key, true );
			if( ! ( empty( $prev_val ) && empty( $value ) ) ) // dont unnecesarily populate with keys
				update_post_meta( $member_id, $key, $value );
		}

		$result = 'success';
	}else{
		$result = 'fail';
	}

	// response to client
	echo json_encode(
		array(
			'result'=>$result,
			'validation issues'=>$validation_issues,
			'validation issues count'=>count( $validation_issues ),
		)
	);

	die( );

}

/**
 * Search form
 */
//add_action( 'wp_ajax_nopriv_wmts_search_form', 'wmts_search_form' );
//add_action( 'wp_ajax_wmts_search_form', 'wmts_search_form' );
/*
function wmts_search_form( ){

	if ( ! isset( $_REQUEST[ 'nonce' ] ) || ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'wph-nonce' ) ) die( 'Not permitted nonce' );

	$member_id = $_REQUEST[ 'member_id' ]; // this is the post id which will have its custom fields updated
	$form_values = $_REQUEST[ 'form_values' ]; // ### no need for json_decode
	$members = false;

	// get the form model for validation
	$form_id = $_REQUEST[ 'form_id' ];
	$form_model = json_decode( get_post_meta( $form_id, 'MTS Form Model JSON', true ), true ); // needed for validation

	// ensure hacker can't switching edit between save
	$switch_hack_safe = false;
	foreach( $form_model as $field=>$model_arr ){
		// password ( required field )
		if( 'submit' === $model_arr[ 'template' ] ){
			if( isset( $model_arr[ 'action' ] ) && $model_arr[ 'action' ] === 'Search' ){
				$switch_hack_safe = true;
			}
		}
	}

	if( ! $switch_hack_safe ) die( 'Not permitted  switch hack' );

	// validate
	$validation_issues = wmts_validate_form( $form_values, $form_model );
	$result = 'fail';

	if( ! count( $validation_issues ) ){
		// search through associated post terms
		$locations_json = get_post_meta( $form_id, 'MTS Form Locations', true );
		if( ! empty( $locations_json ) ){
			$locations = json_decode( $locations_json, true );
			$post_types = $locations[ 'post_types' ];
			$terms = $locations[ 'terms' ];

			// query
			$args = array(
				'post_type' => $post_types,
				'tax_query' => array(
					array(
						'terms'    => $terms,
					),
				),
			);
			$members = array( );
			$query = new WP_Query( $args );
			if ( have_posts( ) ) {
				while ( have_posts( ) ) {
					the_post( );
					$members[ ] = get_the_title( );
				}
			}

		};

		$result = 'success';
	}

	// response to client
	echo json_encode(
		array(
			'result'=> $result,
			'validation issues'=> $validation_issues,
			'validation issues count'=> count( $validation_issues ),
			'members'=> $members,
//			'member_id'=> $member_id,
//			'form_id'=> $form_id,
//			'form_values'=>$form_values,
//			'form_values_count'=>count( $form_values ),
			'form_model'=>$form_model,
		)
	);

	die( );

}
*/

/**
 * Validate form information
 */
function wmts_validate_form( &$form_values, &$form_model, $member_id= false ){

	$validation_issues = array( );
	$admin = current_user_can( 'manage_options' );
	
	if( ! is_array( $form_model ) ) die( );
	
	foreach( $form_model as $field=>$model_arr ){

		// password ( required field )
		if( 'password' === $model_arr[ 'template' ] && $member_id ){
			if( ! $admin ){
				if( $form_values[ $field ] !== get_post_meta( $member_id, $field, true ) )
					$validation_issues[ $field ] = __( 'Incorrect password.', 'modern-team-showcase' );
			}
		}

		// no value available
		if( empty( $form_values[ $field ] ) ){
			// check if required field
			if( ! empty( $model_arr[ 'required' ] ) ){
				if( 'Both' === $model_arr[ 'required' ] || ( $admin && 'Admin only' === $model_arr[ 'required' ] ) || ( ! $admin && 'Public only' === $model_arr[ 'required' ] ) )
					$validation_issues[ $field ] = __( 'This is a required field. Please enter a value', 'modern-team-showcase' );
			}
			continue;
		}

		// tags only permitted on html input
		if( 'html' !== $model_arr[ 'template' ] && gettype( $form_values[ $field ] ) !== 'array' ){
			if( $form_values[ $field ] != strip_tags( $form_values[ $field ] ) )
				$validation_issues[ $field ] = __( 'HTML tags not allowed here', 'modern-team-showcase' );
		}

		// number
		if( 'number' === $model_arr[ 'template' ] ){
			if( ! filter_var( $form_values[ $field ], FILTER_VALIDATE_INT ) )
				$validation_issues[ $field ] = __( 'Please enter a number', 'modern-team-showcase' );

		// email
		}else if( 'email' === $model_arr[ 'template' ] ){
			if( ! filter_var( $form_values[ $field ], FILTER_VALIDATE_EMAIL ) )
				$validation_issues[ $field ] = __( 'Not a valid email id', 'modern-team-showcase' );

		// date
		}else if( 'date' === $model_arr[ 'template' ] ){
			$date = date_parse( $form_values[ $field ] );
			if( $date["error_count"] != 0 || ! checkdate( $date["month"], $date["day"], $date["year"] ) )
				$validation_issues[ $field ] = __( 'Not a valid date', 'modern-team-showcase' );

		// link
		}else if( 'link' === $model_arr[ 'template' ] ){
			$form_values[ $field ] = strip_tags( $form_values[ $field ] );
			if( $parts = parse_url( $form_values[ $field ] ) ){
				if( ! isset( $parts[ "scheme" ] ) ) $form_values[ $field ] = "http://". $form_values[ $field ]; // add an http if not preset
				if( ! filter_var( $form_values[ $field ], FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED ) ) $validation_issues[ $field ] = __( 'Not a valid link', 'modern-team-showcase' );
			}else{
				$validation_issues[ $field ] = __( 'Not a valid link', 'modern-team-showcase' );
			}

		// select
		}else if( 'select' === $model_arr[ 'template' ] || 'radio' === $model_arr[ 'template' ] ){
			if( ! in_array( $form_values[ $field ], array_column( $model_arr[ 'options' ], 'value' ) ) ){
				$validation_issues[ $field ] = __( 'Selected option was not made available in the form.', 'modern-team-showcase' );
			};

		// checkbox
		}else if( 'checkbox' === $model_arr[ 'template' ] ){
			foreach( $form_values[ $field ] as $checked_value ){
				if( ! in_array( $checked_value, array_column( $model_arr[ 'options' ], 'value' ) ) ){
					$validation_issues[ $field ] = __( 'Selected option was not made available in the form.', 'modern-team-showcase' );
				}
			}

		}

	}

	return $validation_issues;
}

/**
 * Adding the array column function for older php
 */
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

/**
 * Deploy forms to admin locations
 */
add_action( 'add_meta_boxes', 'wmts_deploy_forms_to_locations' );
function wmts_deploy_forms_to_locations( ){
	if( defined( 'WPH_FORM_LOCATION' ) ) return; // constant for all my form post types themselves

	global $post;
	if( empty( $post ) ) return;
	$member_id = $post->ID;
	$current_post_type = get_post_type( $post );
	$current_taxonomies = get_object_taxonomies( $post, 'names' );
	$current_term_objects = wp_get_object_terms( $member_id, $current_taxonomies );
	$current_terms= array( );
	foreach( $current_term_objects as $key => $val ){
		$current_terms[ ] = $val->term_id;
	}

	$cache_post = $post;
	// query all forms
	$args = array(
			'post_type' => 'modernteamforms',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
	$forms_query = new WP_Query( $args );

	if( $forms_query->have_posts( ) ){
	  while( $forms_query->have_posts( ) ) : $forms_query->the_post( );
		$form_id = $post->ID;
		
		$location_type = get_post_meta( $form_id, 'MTS Form Location Type', true );
		$skip = ( $location_type && $location_type=== 'simple' && $current_post_type === 'modernteammembers' ) ? true : false;		
		
		if( ! $skip  ){
			
			$locations = get_post_meta( $form_id, 'MTS Form Locations', true );
			if( empty( $locations ) ) continue;
			
			if( gettype( $locations ) === 'array' ){ // erroneously set
				delete_post_meta( $form_id, 'MTS Form Locations' );
			}

			$locations = json_decode( $locations, true );

			// match post types
			$form_post_types = $locations[ 'post_types' ];
			if( ! is_array( $form_post_types ) || ! in_array( $current_post_type, $form_post_types ) ) continue; // no match

			// match terms
			$form_terms = $locations[ 'terms' ];
			if( empty( $current_terms ) || empty( $form_terms ) ) continue; // no terms
			$mutual_terms = array_intersect( $current_terms, $form_terms );
			if( empty( $mutual_terms ) ) continue; // no match

		}
		$form_title = get_the_title( $form_id );

		// qualified for the form
		add_meta_box(
			'wmts_form_display_'. $form_id,
			$form_title,
			'wmts_form_display',
			$current_post_type,
			'normal',
			'high',
			array( 'form_id' => $form_id )
		);

	  endwhile;
	}
	$post = $cache_post;

}

/**
 * Deploy forms front end
 */
add_shortcode( 'wmts_form', 'wmts_form_shortcode' );
function wmts_form_shortcode( $atts ){

	extract ( shortcode_atts ( array (
			'member_id' => false,
			'form_id' => false,
			'deadline'=> false,
			), $atts
		)
	);

	if( ! empty( $deadline ) ){
		if( new DateTime( ) > new DateTime( $deadline ) ){
			$message = _e( 'The deadline for this form has expired.', 'moder-team-showcase' );
			return "<strong>$message</strong>";
		}
	}

	global	$wmts_form;
	$args = array(
		'member_id' => $member_id,
		'form_id' => $form_id,
		'form' => get_post_meta( $form_id, 'MTS Form Markup', true ),
		'search_action' => 'wmts_search_form',
		'edit_action' => 'wmts_save_form',
		'nonce' => wp_create_nonce( 'wmts-form-'. $member_id ),
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	);
	// get the form markup without editing capabilities
	$form = $wmts_form->display_form( $args );
	return $form;

}

/**
 * Licensing
 */
if( ! class_exists( 'WPH_License_Manager' ) )  require_once( plugin_dir_path( __FILE__ ) . '/wph-modules/license-manager/class-wph-license-manager.php' );
$args = array(
		'plugin_name' => 'Modern Team Showcase',
		'plugin_prefix' => 'wmts',
		'page_type_key' => 'post_type',
		'page_type_val' => 'modernteamshowcases',
		'store' => 'http://shop.webfixfast.com',
		'path' => __FILE__,
		'version' => WMTS_VERSION_NUMBER,
		'mode' => 'cc',
		'updates' => true,
);
$wph_license_manager_new = new WPH_License_Manager( $args );

/**
 * Print translations array
 */
if (!isset($wph_editor_translatables_wmts)) $wph_editor_translatables_wmts = array();
if (!isset($wph_editor_translatables_common)) $wph_editor_translatables_common = array();
if (!isset($wph_editor_translation_array_labels)) $wph_editor_translation_array_labels = array();

if (!isset($wph_editor_translation_array_labels['modern-team-showcase'])) $wph_editor_translation_array_labels['modern-team-showcase'] = &$wph_editor_translatables_wmts;
if (!isset($wph_editor_translation_array_labels['wph-editor'])) $wph_editor_translation_array_labels['wph-editor'] = &$wph_editor_translatables_common;
//note to self: enable the following section when collecting translation strings
//disable this -- start
//add_action('wp_after_admin_bar_render', 'wmts_print_wph_editor_translation_array');
//disable this -- end
function wmts_print_wph_editor_translation_array () {
	echo __FILE__;
	//common
	$file_wph_editor_common = 'C:\wamp\www\wordpress\wp-content\plugins\modern-team-showcase\language\wph-editor\common\common.php';

	global $wph_editor_translatables_common;
	$wph_editor_translatables_common = var_export($wph_editor_translatables_common, true);
	$wph_editor_translatables_common = stripslashes($wph_editor_translatables_common);

	$wph_editor_translatables_common = str_replace(" '__(", "__(", $wph_editor_translatables_common);
	$wph_editor_translatables_common = str_replace("',", ",", $wph_editor_translatables_common);

	file_put_contents($file_wph_editor_common, '<?php $wph_editor_translatables_common = '.$wph_editor_translatables_common.'?>');

	//wmts
	$file_wph_editor_wmts = 'C:\wamp\www\wordpress\wp-content\plugins\modern-team-showcase\language\wph-editor\plugin-specific\wmts.php';

	global $wph_editor_translatables_wmts;
	$wph_editor_translatables_wmts = var_export($wph_editor_translatables_wmts, true);
	$wph_editor_translatables_wmts = stripslashes($wph_editor_translatables_wmts);

	$wph_editor_translatables_wmts = str_replace(" '__(", "__(", $wph_editor_translatables_wmts);
	$wph_editor_translatables_wmts = str_replace("',", ",", $wph_editor_translatables_wmts);

	file_put_contents($file_wph_editor_wmts, '<?php $wph_editor_translatables_wmts = '.$wph_editor_translatables_wmts.'?>');
	return;

}

/**
 * Mass update metas

add_action( 'add_meta_boxes', 'wmts_manipulate_metas' );
add_action( 'wp', 'wmts_manipulate_metas' );
function wmts_manipulate_metas( ){

	global $post;

	$metas = array(
		'MTS E-mail' => 'john.doe.7@gmail.com',
		'MTS Telephone' => '666 555 999',
		'MTS Facebook' => 'http://www.facebook.com/user',
		'MTS LinkedIn' => 'http://www.linkedin.com/user',
		'MTS Twitter' => 'http://www.twitter.com/user',
		'MTS YouTube' => false,
		'MTS Vimeo' => false,
		'MTS Reddit' => false,
		'MTS Instagram' => false,
	);

	$args = array( 'post_type' => 'modernteammembers', 'posts_per_page'=> -1 );
	$the_query = new WP_Query( $args );
	$count = 0;

	if( $the_query->have_posts( )  ){
		while( $the_query->have_posts( ) ){
			$the_query->the_post( );
			foreach( $metas as $key=> $val ){
				update_post_meta( $post->ID, $key, $val );
			}
			$count++;
		}
	}

}

*/

?>