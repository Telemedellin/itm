<?php

class WPH_Form{

	public $form_builder_css;
	public $form_css;

	public $form_builder_js;
	public $form_js;

	function __construct( $args=array( ) ){

		// require
		if( ! class_exists( 'phpQuery' ) ) require_once 'phpQuery/phpQuery.php';

		// locate scripts
		$this->form_builder_css = empty( $args[ 'form_builder_css' ] ) ? plugins_url( '../css/wph-form-builder.css', __FILE__ ) : $args[ 'form_builder_css' ];
		$this->form_css = empty( $args[ 'form_css' ] ) ? plugins_url( '../css/wph-form.css', __FILE__ ) : $args[ 'form_css' ];
		$this->qtip_css = empty( $args[ 'qtip_css' ] ) ? plugins_url( '../css/jquery.qtip.min.css', __FILE__ ) : $args[ 'qtip_css' ];
		
		$this->form_builder_js = empty( $args[ 'form_builder_js' ] ) ? plugins_url( '../js/wph-form-builder.js', __FILE__ ) : $args[ 'form_builder_js' ];
		$this->form_js = empty( $args[ 'form_js' ] ) ? plugins_url( '../js/wph-form.js', __FILE__ ) : $args[ 'form_js' ];
		$this->imagesloaded_js = empty( $args[ 'qtip_js' ] ) ? plugins_url( '../js/imagesloaded.pkg.min.js', __FILE__ ) : $args[ 'imagesloaded' ];
		$this->qtip_js = empty( $args[ 'qtip_js' ] ) ? plugins_url( '../js/jquery.qtip.min.js', __FILE__ ) : $args[ 'qtip' ];

		// enqueue scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		
		// modify editor
		add_action( 'plugins_loaded', array( $this, 'modify_editor' ) );
		
	}

	
	function load_scripts( ){
		
		$admin = current_user_can( 'manage_options' );
		
		// css
		//-- form
		wp_register_style('wph-form-css',  $this->form_css );
		wp_enqueue_style( 'wph-form-css' );

		//-- qtip
		/*
		wp_register_style('qtip-css',  $this->qtip_css );
		wp_enqueue_style( 'qtip-css' );
		*/
		
		if( $admin ){
			//-- form builder
			wp_register_style('wph-form-builder-css',  $this->form_builder_css );
			wp_enqueue_style( 'wph-form-builder-css' );
		}

		// js
		//-- form
		wp_register_script('wph-form-js',  $this->form_js, array( 'jquery' ) );
		wp_enqueue_script( 'wph-form-js' );
		
		//-- images loaded
		/*
		wp_register_script('images-loaded',  $this->imagesloaded_js, array( 'jquery' ), '', true );
		wp_enqueue_script( 'images-loaded' );
		*/
		
		//-- qtip
		/*
		wp_register_script('qtip-js',  $this->qtip_js, array( 'jquery' ) );
		wp_enqueue_script( 'qtip-js' );
		*/

		if( $admin ){
			//-- form builder
			wp_register_script('wph-form-builder-js',  $this->form_builder_js, array( 'jquery', 'wph_editor_privileged' ) );
			wp_enqueue_script( 'wph-form-builder-js' );		

			//-- jquery ui
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
		}

	}

	function modify_editor( ){
		add_filter( 'wph-frontend-editor-assemble', array( $this, 'add_panels' ) );		
	}

	function add_panels( $html ){
		// add settings menu
		if( ! class_exists( 'WPH_Form_Settings_Menu' ) )  
			require_once( 'class-wph-form-settings-menu.php' );	
		$setting_menu = new WPH_Form_Settings_Menu( );
		$setting_menu->build( );
		$setting_menu_div = $setting_menu->flush_html( );
		
		// add new form element
		if( ! class_exists( 'WPH_Add_Form_Element' ) )  
			require_once( 'class-wph-add-form-element.php' );	
		$add_form_element = new WPH_Add_Form_Element( );
		$add_form_element_panel = $add_form_element->panel;

		// edit form element
		ob_start( );
		require_once( 'wph-edit-form-element-panel.php' );
		$edit_form_element_panel = ob_get_contents( );
		ob_end_clean( );
		
		// save
		$save_button = '<button class="wph_editor_form_options_save">Save Form Settings</button>';

		return $html . $setting_menu_div . $add_form_element_panel . $edit_form_element_panel . $save_button;
	}
	
	function build_templates( ){
		
		if( ! class_exists( 'WPH_Form_Elements_Template_Recipe' ) ) 
			require_once( 'class-wph-form-elements-template-recipe.php' );

		$templates_recipe = new WPH_Form_Elements_Template_Recipe( );
		$templates_cooker = new WPH_Template_Cooker( );
		$json_dinner = $templates_cooker->cook( $templates_recipe );

		return $json_dinner;
	}

	function build_form( $args ){

		$plugin = $args[ 'plugin' ];
		$id = $args[ 'id' ];
		$prev_form = $args[ 'form' ];
		$meta_key_prefix = $args[ 'meta key prefix' ];

		$id_span = "<span class='wph_post_id' data-wph-post-id='$id'></span>";

		if( ! $prev_form ){
			$form = "
				<div class='wph_form_$plugin wph_form_container wph_container' data-wph-plugin='$plugin' data-wph-post-id='' data-wph-meta-key-prefix='$meta_key_prefix' data-wph-form-editing='enabled'>
				
					<div class='wph_key_keeper' data-wph-key-type='container'>
					</div>

					<div class='wph_form_element' data-wph-form-template='submit' data-wph-form-element-admin-label='Submit' data-wph-form-element-classes='' data-wph-form-element-width='1'>
						<label>Submit</label>
					</div>
					
				</div>
				";
		}else{
			$form = $prev_form;
			$form_pq = phpQuery::newDocumentHTML( $form );
			$form_container_pq = $form_pq->find( '.wph_form_container' );
			$form_container_pq->find( '.wph_key_keeper' )->not( ':first' )->remove( );
			if( ! count( $form_container_pq->find( '.wph_key_keeper' ) ) ){
				$form_container_pq->prepend( '
					<div class="wph_key_keeper" data-wph-key-type="container">
						<div class="wph_keys_center wph_keys_center_horizontal">
							<div class="wph_keys wph_container_keys">
								<div class="wph_editor_key_settings wph_key fa fa-cog" data-wph-trigger="wph_container_settings"></div>
							</div>
						</div>
					</div>
				' );
			}
			$form = $form_container_pq->htmlOuter( );
		}
		
		$json_templates = $this->build_templates( );
		
		$script = "
			<script>
				var wph_form_element_templates = $json_templates;
				wph_form_element_templates.checkbox = \"<label>Checkbox Options</label><label></label><input class='wph_form_input_checkbox' type='checkbox' value='Some option' checked='checked' ><label>Some option</label><input class='wph_form_input_checkbox' type='checkbox' value='Another option'><label>Another option</label><input class='wph_form_input_checkbox' type='checkbox' value='Yet another'><label>Yet another</label>\";
				wph_form_element_templates.radio = \"<label>Radio Options</label><label></label><input class='wph_form_input_radio' type='radio' value='Some option' checked='checked' ><label>Some option</label><input class='wph_form_input_radio' type='radio' value='Another option'><label>Another option</label><input class='wph_form_input_radio' type='radio' value='Yet another'><label>Yet another</label>\";
			</script>
			";
			
		// $script = "
			// <script>
				// var wph_form_element_templates = $json_templates;
				// wph_form_element_templates.checkbox = \"<label>Select checkbox</label><label></label><input class='wph_form_input_checkbox' type='checkbox' value='first'><label>First option</label>\";
			// </script>
			// ";

		return $id_span . $form . $script;

	}
	
	function display_form( $args ){
		// vars
		$form_id = $args[ 'form_id' ];
		$member_id = $args[ 'member_id' ];
		$form = $args[ 'form' ];
		$search_action = $args[ 'search_action' ];
		$edit_action = $args[ 'edit_action' ];
		$nonce = $args[ 'nonce' ];
		$ajax_url = $args[ 'ajax_url' ];
		
		$form_pq = phpQuery::newDocumentHTML( $form );
		$form_container_pq = $form_pq->find( '.wph_form_container' );
		$form_container_pq->attr( 'data-wph-nonce', $nonce )->attr( 'data-wph-ajax-url', $ajax_url );
		$form_container_pq->attr( 'data-wph-search-action', $search_action )->attr( 'data-wph-edit-action', $edit_action );

		// update form values
		$form_values = array( );
		$wph_form_elements = $form_container_pq->find( '.wph_form_element' );
		
		foreach( $wph_form_elements as $element ){
			$key = pq( $element )->attr( 'data-wph-form-element-meta-key' );
			$val = get_post_meta( $member_id, $key, true );
			if( $val ) $form_values[ $key ] = $val;
		}
		
		// hide password from public
		if( ! current_user_can( 'manage_options' ) ){
			$password_elements = $form_container_pq->find( '.wph_form_element' )->filter( '[data-wph-form-template="password"]' );

			foreach( $password_elements as $element ){
				pq( $element )->find( 'input' )->val( '' );
				$requirement = pq( $element )->attr( 'data-wph-form-element-required' );
				if( $requirement && ( 'Public only' === $requirement || 'Both' === $requirement ) ){
					$field = pq( $element )->attr( 'data-wph-form-element-meta-key' );
					if( ! empty( $form_values[ $field ] ) ) unset( $form_values[ $field ] );
				}
			}
			
		}
		
		// add information
		if( $form_values ) $form_container_pq->attr( 'data-wph-form-values', json_encode( $form_values ) );
		$form_container_pq->attr( 'data-wph-form-id', $form_id );
		$form_container_pq->attr( 'data-wph-member-id', $member_id );
		
		// disable editing
		$this->disable_editing( $form_container_pq );

		return $form_pq->html( );
	}

	function disable_editing( &$form_container_pq ){
		$form_container_pq->removeClass( 'ui-sortable' );
		$form_container_pq->attr( 'data-wph-form-editing', 'disabled' )->removeAttr( 'data-wph-post-id' );
		$form_container_pq->find( '.wph_key_keeper' )->remove( );
	}

}

?>