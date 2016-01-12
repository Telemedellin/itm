var wmts_admin = true;

if( typeof( wph_editor ) === 'undefined' ) wph_editor = {};

/*--------------
WMTS Form
----------------*/
//-- provides wmts specific callbacks for the editor
wph_editor.plugins['wmts-form'] = {};

//-- return components to wph editor interface
wph_editor.plugins['wmts-form'].get_components = function (elm) {
	return { };
};

jQuery( function( $ ){	
	// search
	$( '#wmts_preview .inside' ).on( 'click', '.wmts_container', function( e ){
		if( $( e.target ).is( '.wmts_search_submit' ) || $( e.target ).closest( '.wmts_search_submit' ).length ) 
			e.preventDefault( );
	} )
	
	// append dummy content button
	var $body = $( 'body' );
	if( $body.hasClass( 'wp-admin' ) && $body.hasClass( 'post-type-modernteammembers' ) && $body.hasClass( 'edit-php' ) ){
		var add_new = $( '.add-new-h2' );
		if( add_new.length ){
			var 	url = window.location.origin + window.location.pathname + '?post_type=modernteammembers&wmts_action=add_dummy_members',
					add_dummy = '<a href="'+ url +'" class="wmts_add_dummy_members">Add Dummy Members</a>';
			$( add_dummy ).insertAfter( add_new );
		}
	}
	
	// feed form location values
	$( '.wmts_forms_save_post_type_and_terms_selection' ).each( function( ){
		var 	$this = $( this ),
				json = $this.attr( 'data-wmts-location' ),
				$terms_select = $this.parent( ).siblings( ).children( '.wph_select_terms' ),
				$post_types_select = $this.parent( ).siblings( ).children( '.wph_select_post_types' );
		
		if( ! json || json.length < 2 ) return;
		json = JSON.parse( json );
		$post_types_select.val( json.post_types );
		$terms_select.val( json.terms );
	} )
	
	// ajax save form display locations
	$( '.wmts_forms_save_post_type_and_terms_selection' ).click( function( ){
		var 	$this = $( this ),
				nonce = $this.attr( 'data-wmts-nonce' ),
				post_id = $this.attr( 'data-wmts-post-id' );
				terms = $this.parent( ).siblings( ).children( '.wph_select_terms' ).val( ),
				post_types = $this.parent( ).siblings( ).children( '.wph_select_post_types' ).val( ),
				locations = { terms: terms, post_types: post_types },
				location_type = $( '[name="wmts_form_location_setting_type"]:checked' ).val( );

		$.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			beforeSend: function( ){
				wph_editor.start_loader( $this );
			},
			data : { 
					"action": "wmts_save_form_locations", 
					"nonce": nonce, 
					"post_id": post_id, 
					"locations": locations,
					"location_type": location_type
				},
			complete: function( response ){		
				wph_editor.stop_loader( $this );
			}
			
		} );
		
	} )
	
	//save form
	wph_editor.add_action( 'save', wmts_save_form );
	function wmts_save_form( $form ){

		if( wph_editor.target.plugin !== "wmts-form" ) return;
		
		// form html
		var $form_clone = $form.clone( true, true );
		$form_clone.find( '.wph_keys_center' ).not( ':first' ).remove( );
		$form_clone.find('.wph_editor_target_element, .wph_editor_target_pseudo_row').removeClass('wph_editor_target_element wph_editor_target_pseudo_row');
		$form_clone.find( 'a[onclick]' ).removeAttr( 'onclick' );
		var form_html = $form_clone[0].outerHTML;
		
		// form model
		var 	form_model = wph_form_builder.model.extract_from_form( $form );
		$.each( form_model, function( key, val ){
			delete val.$element;
		} )
		var form_model_json = JSON.stringify( form_model );

	   $.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			beforeSend: function ( ){
				wph_editor.start_loader( );
			},
			data : { 'action': 'wmts_save_form_build', 'nonce': wph_ajax.nonce, 'form_html': form_html, 'form_model_json': form_model_json, 'post_id': $form.attr( 'data-wph-post-id' ) },
			success: function ( response ){
				// console.log( 'response: ', response );					
				if( response && response.result === "success" ){
					wph_editor.stop_loader( );
				}else{
					alert( response.message );
				};
			}
		} );
	};	
	
	// wph_editor init
	$( '.wph_editor_body' ).on( 'after_load_data_to_editor', wmts_init_form_builder );	
	function wmts_init_form_builder( ){
		var $this = $( this );
		if( 'wmts-form' !== $this.attr( 'data-wph-plugin' ) ) return;
		$this.find( '.wph_form_editor_settingsType [data-wph-type="Add Element"]' ).click( );
	}
	
} )

/*--------------
WMTS Plugin
----------------*/
//-- provides wmts specific callbacks for the editor
wph_editor.plugins['wmts'] = {};

//-- return components to wph editor interface
wph_editor.plugins['wmts'].get_components = function (elm) {
	return {};
};

jQuery( function( $ ){
	
	// sortables
	$( '.wmts_sortable' ).sortable( );
	
	// ensure editor template stays in view
	$( 'body' ).on( 'wph_template_double_click_resized', wph_editor.safe_position );
	$( '.wph_editor_body' ).on( 'after_load_data_to_editor', wph_editor.safe_position );
	
	// mousewheel scroll on editor
	$( '.wph_editor_body' ).on( 'mousewheel DOMMouseScroll', function( event ){
		// icon picker exception
		if( $( event.target ).closest( '.wph_icon_picker_group' ).length ) return;
		// scroll editor
		var 	$this = $( this ),
				offset_top = $this.offset( ).top,
				height = $this.outerHeight( );
		if( event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0 ) { // scrolling up
			if( offset_top + 120 < event.originalEvent.pageY ) // about to push editor down by 120. But only if its top won't end up below the mouse position
				$this.css( 'top', '+='+ 120 );
		}else{ // scrolling down
			if( offset_top + height - 120 > event.originalEvent.pageY )
				$this.css( 'top', '-='+ 120 );
		}
		return false;
	} )
	
	// trigger front end editor externally
	$( '.wmts_frontend_editor_trigger' ).click( function( ){
		$( '[data-wph-trigger="wph_container_settings"]' ).click( );
	} )

	// load template and query data via ajax
	$( '.wmts_container' ).each( wmts_retrieve_json_data );
	function wmts_retrieve_json_data( ){
		var $this = $( this ),
 				post_id = $this.attr( 'data-wph-post-id' ),
				action = 'wmts_retrieve_json_data';
		if( ! post_id ) return;

		// ajax
		$.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			data : { "action": action, "nonce": wph_ajax.nonce, 'post_id': post_id },
			success: function( response ){
				// add the data
				$this.data( {
					'wmts-template': response.template,
					'wmts-query': response.query
				} )
				
				// needs to be known as a key keeper
				.addClass( 'wph_key_keeper wph_container' )
				
				// add the editor key
				.append( '<div class="wph_keys_center wph_keys_center_horizontal"><div class="wph_keys wph_container_keys"><div class="wph_editor_key_settings wph_key fa fa-cog" data-wph-trigger="wph_container_settings"></div></div></div>' );
				
				// re-bind editor keys
				wph_editor.init_keys( );				
			}
		} );
		
	}
	
	// init
	$( '.wph_editor_body' ).on( 'after_load_data_to_editor', wmts_admin_init );
	
	function wmts_admin_init( ){
		
		$( 'body' ).trigger( 'wmts_admin_init_start' );

		var $this = $( this );
		if( 'wmts' !== $this.attr( 'data-wph-plugin' ) ) return;

		var $showcase = $( '.wph_editor_target_element' );		
		if( ! $showcase.length ) return;
		
		// select settings type
		if( ! $( '.wmts_editor_settingsType' ).children( '[data-wph-type].wph_editor_selected' ).length ){
			$( '.wmts_editor_settingsType' ).children( '[data-wph-type]' ).first( ).click( );
		}
		
		// build template
		var 	template_object = $showcase.data( 'wmts-template' ),
				template = $( '.wmts_member_template_panel .wph_template' );
		wph_editor.visual_template.set_template_element( template_object, template );
		wph_editor.visual_template.init( template );
		wph_editor.safe_position( ); // reposition editor in case out of view
		
		// query options
		var query_options = $showcase.data( 'wmts-query' ) || { };
		wmts_show_settings( query_options, $( '.wmts_query_panel' ) );
		
		// overall settings
		var overall_settings = $showcase.data( 'wmts-overall-settings' ) || { };
		wmts_show_settings( overall_settings, $( '.wmts_overall_settings_panel' ) );
		
		//-- device specific settings
		// get the screen size
		// get the device settings
		// find which device qualifies
		var device = wmts.showcase.get_settings( $showcase ).device;
		$( '.wmts_select_device i[data-wmts-device="'+ device+ '"]' ).click( );

		$( 'body' ).trigger( 'wmts_admin_init_end' );

	}
	
	// read settings from showcase into the panels
	function wmts_show_settings( settings, $panel ){
		var settings = $.extend( { }, settings ); // sometimes hidden elements are triggered by visible trigger elements. This can activate .change( ) on hidden elements and set their values. This would change the original settings object's value for the hidden element. Now the object will re-feed that incorrect value to the hidden element when its turn comes. So we need a duplicate to use instead.

		$panel.find( 'input, select, textarea' ).each( function( key, val ){
			var $this = $( this ),
					type = $this.attr( 'data-wph-type' ),
					defaultValue = $this.is( 'select' ) ? $this.attr( 'data-wph-defaultSelected' ) : this.defaultValue,
					defaultChecked = this.defaultChecked;
					
			// apply default values
			if( $this.is( ':checkbox, :radio' ) ) $this.prop( 'checked', defaultChecked );
			else $this.val( defaultValue );
			
			// set new value
			if( settings && settings[ type ] ){
				if( $this.is( ':checkbox, :radio' ) ){
					var val = settings[ type ];
					if( $this.val( ) === val ) $this.prop( 'checked', true ).trigger( 'change' )
					else $this.prop( 'checked', false ).trigger( 'change' )
				}else{
					$this.val( settings[ type ] ).trigger( 'change' );
				}
			}
			
		} )
		
		// stubborn exceptions
		if( $panel.is( '.wmts_overall_settings_panel' ) ){
			if( $panel.find( '[data-wph-type=layoutMode]' ).val( ) == null ){
				$panel.find( '[data-wph-type=layoutMode]' ).val( 'masonry' );
			}
		}

	}

	$( '[data-wph-type="filtering_details"]' ).on( 'change', wmts_filtering_details );	
	// 'change' event listener on input[data-wph-type="filtering_details"]
	// it helps build up the sortable list of filters.
	// Simply reacts to the JSON in the input value.
	// Does not build that JSON with categories or anything.
	function wmts_filtering_details( ){
		var 	$panel = $( '.wmts_filtering_details' ),
				possible_filters = $( 'input[data-wph-type="filtering_details"]' ).val( ),
				markup = '';
		
		if( possible_filters ){
			possible_filters = JSON.parse( possible_filters );
			
			$.each( possible_filters, function( order, val ){
				var checked= '';
				if( val[ 'live' ] ) checked = 'checked="checked"';
				markup += '<div class="wmts_filter_item_details" data-wmts-filter-name="'+ val[ 'name' ] +'"><i class="fa fa-sort"></i><input class="wmts_filter_item_toggle" type="checkbox" '+ checked +' /><span>'+ val[ 'name' ] +':</span> <input class="wmts_filter_item_content" value="" /></div>';
			} )
			
			$panel.html( markup );
			
			// feed content values separately as concatenation screws up if HTML was entered
			$panel.find( '.wmts_filter_item_content' ).each( function( n ){
				$( this ).val( possible_filters[ n ][ 'content' ] );
			} )
		
			$panel.sortable( );

		}else{
			markup = $panel.attr( 'data-wmts-message' );
			$panel.html( markup );
		}
	}

	// collect information from filtering details sub panel. Build json into input[data-wph-type="filtering_details"]
	// do this while user sorts the category order or toggles and re-labels them
	$( '.wmts_filtering_details' ).on( 'sortupdate', wmts_filtering_details_reset_a )
	$( '.wmts_filtering_details' ).on( 'change', 'input', wmts_filtering_details_reset_a )	
	function wmts_filtering_details_reset_a( ){
		var options = [ ];
		$( '.wmts_filter_item_details' ).each( function( ){
			var 	$this = $( this ),
					name = $this.attr( 'data-wmts-filter-name' ),
					content =  $this.find( 'input.wmts_filter_item_content' ).val( ),
					live = $this.find( 'input.wmts_filter_item_toggle:checked' ).length ? true : false;

			options.push( { name: name, content: content, live: live } );
		} )
		
		options = JSON.stringify( options );
		
		$( 'input[data-wph-type="filtering_details"]' ).val( options );
		$( 'input[data-wph-type="filtering_details"]' ).change( );
	}
	

	// filters need to be reset whenever there is a change in the query terms and / or filtering_key
	$( 'body' ).on( 'wmts_admin_init_start', function( ){ // but for now turn it off as artificial .change( ) are taking place
		$( '[data-wph-type="filtering_key"], [data-wph-type="terms"]' ).off( 'change', wmts_filtering_details_reset_b );
		$( '[data-wph-type="filtering_details"]' ).val( '' ); // need to force trigger change, otherwise the filtering panel will not be cleared
		wmts_filtering_details( ) // but don't call by change otherwise it will null the value of filtering_details in the showcase which will later feed back as null
	} )

	$( 'body' ).on( 'wmts_admin_init_end', function( ){ // turn on as artificial .change( ) are done taking place
		$( '[data-wph-type="filtering_key"], [data-wph-type="terms"]' ).on( 'change', wmts_filtering_details_reset_b );
		// first time load hack where showcase was saved before this feature was available
		// load category filters in the filtering panel if there is indication of that requirement
		// this needs to be done manually as there is no overall_settings[ 'filtering_details' ] value
		// case where category based filters need to be setup for first time for this showcase.
		if( ! $( '[data-wph-type="filtering_details"]' ).val( ).trim( ) || $( '[data-wph-type="filtering_details"]' ).val( ) === '[]' ){ // case of first time init, a showcase from prev version, or was saved during filtering reset message
			var filtering_key = $( '[data-wph-type="filtering_key"]' ).val( );
			if( filtering_key.replace( '{{', '' ).replace( '}}', '' ).trim( ) === 'category' || ! filtering_key.trim( ) ){
				$( '[data-wph-type="filtering_key"]' ).change( );
			}
		}

	} )

	// change event listener on query terms and filtering_key input
	function wmts_filtering_details_reset_b( e ){
		var $this= $( e.target );
		if( $this.is( '[data-wph-type="terms"]' ) || $this.val( ).replace( '{{', '' ).replace( '}}', '' ).trim( ) === 'category' || ! $this.val( ).trim( ) ){
			
			var terms = [ ];
			$( '[data-wph-type="terms"] *:selected' ).each( function( ){
				var name = $( this ).text( );
				terms.push( { name: name, content: name, live: true } );
				
			} )
			terms = JSON.stringify( terms );
		}else{ // case of meta key. We need to get possible_filters from server
			terms = '';
		}
		$( 'input[data-wph-type="filtering_details"]' ).val( terms ).change( );
		// if this input is empty, then it will get re-built upon next 'Apply Settings' where possible_filters will be re-received
		
	}

	// 'change' event listener to save query and overall settings to showcase .data( )
	$( '.wmts_query_panel, .wmts_overall_settings_panel' ).on( 'change', 'input, select, textarea', function( ){
		var 	$showcase = $( '.wph_editor_target_element' ),
				$this = $( this ),
				type = $this.attr( 'data-wph-type' ),
				panel = $this.closest( '.wmts_panel' ).attr( 'data-wph-type' );
		// create .data on $showcase for the panel
		if( ! $showcase.data( panel ) ) $showcase.data( panel, { } );
		
		var panel_vals = $showcase.data( panel ) || { };
		if( $this.is( ':checkbox' ) ){
			if( $this.prop( 'checked' ) ){
				panel_vals[ type ] = $this.val( );
			}else{
				delete panel_vals[ type ];
			}
		}else{
			panel_vals[ type ] = $this.val( );
		}
		$showcase.data( { panel: panel_vals } );
		
		// reveal / hide sub options toggle
		//-- cache
		if( $this.is( '[data-wph-type="cache"]' ) ){
			var $affected = $this.closest( '.wph_editor_p' ).next( );
			if( $this.val( ) == 'Off' ){
				$affected.slideUp( );
			}else{
				$affected.slideDown( );
			}
		}
		
		//-- filtering
		else if( $this.is( '[data-wph-type="filtering"]' ) ){
			var $affected = $this.closest( '.wph_editor_p' ).nextAll( ':lt(3)' );
			if( $this.val( ) == 'Disabled' ){
				$affected.slideUp( );
			}else{
				$affected.slideDown( );
			}
		}

		//-- search
		else if( $this.is( '[data-wph-type="search"]' ) ){
			var $affected = $this.closest( '.wph_editor_p' ).nextAll( ':lt(3)' );
			if( $this.val( ) == 'Disabled' ){
				$affected.slideUp( );
			}else{
				$affected.slideDown( );
			}
		}
		
		//-- pagination
		else if( $this.is( '[data-wph-type="pagination"]' ) ){
			if( $this.val( ) == 'Disabled' ){
				$this.closest( '.wph_editor_p' ).nextAll( ':lt(2)' ).slideUp( );
			}else{
				var affected = $this.closest( '.wph_editor_p' ).nextAll( ':lt(1)' );
				affected.slideDown( );
				affected.find( 'select' ).trigger( 'change' ); // cascade changes down
			}
		}
		
		//-- pagination load more text input reveal
		else if( $this.is( '[data-wph-type="pagination_type"]' ) ){
			var $affected = $this.closest( '.wph_editor_p' ).nextAll( ':lt(1)' );
			if( $this.val( ) !== 'load_more' ){
				$affected.slideUp( );
			}else{
				$affected.slideDown( );
			}
		}

	} )

	// select device
	$( '.wmts_select_device i' ).click( function(  ){
		var $this = $( this ),
				device = $this.attr( 'data-wmts-device' ),
				$showcase = $( '.wph_editor_target_element' ),
				// showcase related settings
				devices_settings = $showcase.data( 'wmts-devices-settings' );
				
		// console.log( 'devices_settings: ', devices_settings );
		var current_device_settings = devices_settings[ device ];
		
		$this.siblings( ).removeClass( 'wmts_selected_device' ).end( ).addClass( 'wmts_selected_device' );		
		
		// set its properties to inputs
		$( '.wmts_device_settings' ).find( 'input, select, textarea' ).each( function( ){
			var $this = $( this ),
					prop = $this.attr( 'data-wph-type' ),
					defaultValue = $this.is( 'select' ) ? $this.attr( 'data-wph-defaultSelected' ) : this.defaultValue,
					val = current_device_settings[ prop ];
			if( val ) $this.val( val );
			else $this.val( defaultValue );
		} )
		
	} )

	// 'change' event listener to save devices settings to showcase
	$( '.wmts_device_settings' ).on( 'change', 'input, select, textarea', function( ){
		var 	$this = $( this ),
				prop = $this.attr( 'data-wph-type' ),
				device = $( '.wmts_selected_device' ).attr( 'data-wmts-device' ),
				val = $this.val( ),
				$showcase = $( '.wph_editor_target_element' );
		
		var 	showcase_devices_settings = $showcase.data( 'wmts-devices-settings' );
		
		showcase_devices_settings[ device ][ prop ] = val;
		$showcase.data( { 'wmts-devices-settings': showcase_devices_settings } );
	} )
	
	// getting markup / apply settings
	$( '.wmts_get_markup' ).click( function( ){
		var $this = $( this );
		wmts_ajax( 'wph_template', $this );
	} )
	
	// saving showcase
	$( '.wph_editor_save, .wph_editor_save_trigger' ).click( function( ){
		var $this = $( this );
		wmts_ajax( 'wmts_save', $this );
	} )
	
	// ajax: build by template / save showcase
	function wmts_ajax( action, $this ){
		
		var  trigger = ! $this.closest( '.wph_editor_body' ).length ? true : false, // special case where save is triggered externally. Editor might not even have been loaded. Saving directly from preset loader
				$showcase = trigger ? $( '.wmts_container' ) : $( '.wph_editor_target_element' ),
				post_id = $showcase.attr( 'data-wph-post-id' ),
				plugin = $showcase.attr( 'data-wph-plugin' ),
				$clone = $showcase.clone( );

		if( 'wmts' !== plugin ) return;
		
		if( ! trigger ){ // save button triggered from editor, so editor must have been loaded
			
			// collect query
			var query = { };
			$( '.wmts_query_panel' ).find( 'input, select, textarea' ).each( function( ){
				var 	$this = $( this ),
						prop = $this.attr( 'data-wph-type' ),
						val = $this.val( );
				query[ prop ] = val;
			} )
			$showcase.data( { 'wmts-query': query } );
			
			// collect overall settings
			var overall_settings = { };
			$( '.wmts_overall_settings_panel' ).children( '.wph_editor_p' ).find( 'input, select, textarea' ).each( function( ){
				var 	$this = $( this ),
						prop = $this.attr( 'data-wph-type' ),
						val = $this.val( );
				overall_settings[ prop ] = val;
			} )
			$showcase.data( { 'wmts-overall-settings': overall_settings } );
			$clone.attr( 'data-wmts-overall-settings', JSON.stringify( overall_settings || { } ) );
			
			// devices settings
			var devices_settings = $showcase.data( 'wmts-devices-settings' );
			$clone.attr( 'data-wmts-devices-settings', JSON.stringify( devices_settings || { } ) );

			// get template
			var template = wph_editor.visual_template.get_template_element( $( '.wmts_member_template_panel .wph_template' ) );
			$showcase.data( { 'wmts-template': template } );
			template = JSON.stringify( template );

			// saving container
			$clone.removeClass( 'wmts_loaded wph_container wph_key_keeper' ).find( '.wph_keys_center' ).remove( );
			
			//markup
			var markup = false;
			$clone.find( 'a[onclick]' ).removeAttr( 'onclick' );
			if( action === 'wmts_save' ) markup = $clone[ 0 ].outerHTML;
			
		}else{ // save button triggered externally, editor might not even be loaded
			var query = $showcase.data( 'wmts-query' );
			var overall_settings = $showcase.data( 'wmts-overall-settings' );
			$clone.attr( 'data-wmts-overall-settings', JSON.stringify( overall_settings || { } ) );
			var devices_settings = $showcase.data( 'wmts-devices-settings' );
			$clone.attr( 'data-wmts-devices-settings', JSON.stringify( devices_settings || { } ) );
			var template = JSON.stringify( $showcase.data( 'wmts-template' ) );
			// saving container
			$clone.removeClass( 'wmts_loaded wph_container wph_key_keeper' ).find( '.wph_keys_center' ).remove( );
			
			//markup
			var markup = false;
			$clone.find( 'a[onclick]' ).removeAttr( 'onclick' );
			if( action === 'wmts_save' ) markup = $clone[ 0 ].outerHTML;
		}
		
		// ajax
		$.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			beforeSend: function( ){
				if( $this.hasClass( 'wph_editor_save' ) )
					wph_editor.start_loader( );
				else 
					wph_editor.start_loader( $this );
			},
			data : { "action": action, "nonce": wph_ajax.nonce, "query": query, "overall_settings": overall_settings, "devices_settings": devices_settings, 'modifier': 'WMTS_Template_Modifier',  'query_handler': 'WMTS_Query_Handler', 'default_query': { 'post_type': 'modernteammembers' }, 'post_id': post_id, 'markup': markup, "template": template },
			success: function( response ){
				if( ! response )
					alert( ' There was an error with the ajax action' );
				else{
					if( action === 'wmts_save' ) return;
					// console.log( 'response: ', response );
					wmts_apply_ajax_returned_markup( response );
				}
			},
			complete: function( ){
				if( $this.hasClass( 'wph_editor_save' ) )
					wph_editor.stop_loader( );
				else 
					wph_editor.stop_loader( $this );
			}
		} );
		
	}
	
	// apply showcase markup returned by ajax
	function wmts_apply_ajax_returned_markup( response ){
		//console.log( response );
		// add members
		var 	$showcase = $( '.wph_editor_target_element.wmts_container' ).length ? $( '.wph_editor_target_element.wmts_container' ) : $( '.wmts_container' ),
				$members_container = $showcase.children( '.wmts_members' ),
				$filters_container = $showcase.children( '.wmts_filters' ),
				$search_container = $showcase.children( '.wmts_search' );
				$pagination_container = $showcase.children( '.wmts_pagination' );
		
		// remove backslashes
		$.each( response.markup, function( key, val ){
			if( typeof val === 'string' ){
				response.markup[ key ] = val.replace(/\\"/g, '"');
				response.markup[ key ] = val.replace(/\\"/g, '"');
			} 
		} )
		
		//add members
		if( ! $members_container.length ){ // first time
			$showcase.append( '<div class="wmts_members"></div>' );
			$members_container = $showcase.children( '.wmts_members' );
		}else{
			if( $showcase.children( '.wmts_members' ).data( 'isotope' ) )
				$showcase.children( '.wmts_members' ).isotope( 'destroy' );
		}
		$members_container.html( response.markup.members );
		
		// add filter
		if( response.markup.filters ){
			if( ! $filters_container.length ){ // first time
				$showcase.prepend( '<div class="wmts_filters"></div>' );
				$filters_container = $showcase.children( '.wmts_filters' );
			}
			$filters_container.html( response.markup.filters );
		}else{ // filters disabled / no filters found
			$filters_container.remove( );
		}
		
		// build filtering json 
		var possible_filters = response.possible_filters;
		if( possible_filters && ! $( '[data-wph-type="filtering_details"]' ).val( ).trim( ) ){
			var filtering_details = [ ];
			$.each( possible_filters, function( order, value ){
				filtering_details.push( { name: value, content: value, live: true } );
			} )
			$( '[data-wph-type="filtering_details"]' ).val( JSON.stringify( filtering_details ) ).change( );
		}
		
		// add search
		if( response.markup.search ){
			if( $search_container.length ){ // first time
				$search_container.replaceWith( response.markup.search );
			}else{
				$showcase.prepend( response.markup.search );
			}
		}else{ // filters disabled / no filters found
			$search_container.remove( );
		}
		
		// add pagination
		if( response.markup.pagination ){
			if( ! $pagination_container.length ){ // first time
				$showcase.append( '<div class="wmts_pagination"></div>' );
				$pagination_container = $showcase.children( '.wmts_pagination' );
			}
			$pagination_container.html( response.markup.pagination );
			$pagination_container.removeClass( 'wmts_hide' );
		}else{ // filters disabled / no filters found
			$pagination_container.remove( );
		}
		
		// add media queries css
		$showcase.prev( 'style' ).remove( );
		if( response.markup.css ) $showcase.before( '<style>'+ response.markup.css +'</style>' );
		
		// init
		wmts.showcase.init( $showcase );
	}
	
	// load presets: settings toggle
	
	//-- cell description
	$( '[value="Description"][name="wmts_preset_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_description_field' ).show( );
		}else{
			$( '.wmts_description_field' ).hide( );
		}
	} )
	
	//-- attributes components toggle
	$( '[value="Attributes"][name="wmts_preset_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_attributes_components_section' ).show( );
		}else{
			if( ! $( '[value="Attributes"][name="wmts_lightbox_components"]:checked' ).length )
				$( '.wmts_attributes_components_section' ).hide( );
		}
	} )
	
	//-- links components toggle
	$( '[value="Links"][name="wmts_preset_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_links_components_section' ).show( );
		}else{
			$( '.wmts_links_components_section' ).hide( );
		}
	} )
	
	//-- lightbox components toggle
	$( '[value="Lightbox"][name="wmts_preset_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_lightbox_components_section' ).show( );
		}else{
			$( '.wmts_lightbox_components_section' ).hide( );
		}
	} )
	
	//-- lightbox description
	$( '[value="Description"][name="wmts_lightbox_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_lightbox_description_field' ).show( );
		}else{
			$( '.wmts_lightbox_description_field' ).hide( );
		}
	} )
	
	//-- attributes components toggle
	$( '[value="Attributes"][name="wmts_lightbox_components"]' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_attributes_components_section' ).show( );
		}else{
			if( ! $( '[value="Attributes"][name="wmts_preset_components"]:checked' ).length )
				$( '.wmts_attributes_components_section' ).hide( );
		}
	} )
	
	//-- remap meta keys
	$( '.wmts_remap_metas' ).change( function( ){
		if( $( this ).attr( 'checked' ) ){
			$( '.wmts_remap_metas_container' ).show( );
		}else{
			$( '.wmts_remap_metas_container' ).hide( );
		}
	} ) 
	
	// load preset showcase
	$( '.wmts_presets' ).on( 'click', '.wmts_load_this_preset', wmts_load_this_preset );
	
	function wmts_load_this_preset( ){

		var 	$this = $( this ),
				action = 'wmts_get_showcase_preset',
				$showcase = $( '.wmts_container' ),
				query = $showcase.data( 'wmts-query' ),
				post_id = $showcase.length ? $showcase.attr( 'data-wph-post-id' ) : $( '#post_ID' ).val( ),
				parameters = { };
				
		// columns
		parameters.columns = $( '.wmts_presets .wmts_preset_columns' ).val( );

		// get preset parameters
		parameters.type = $( '.wmts_preset_type' ).val( );
		parameters.style = $( '.wmts_preset_style' ).val( );
		
		// get list of selected cell components
		parameters.components = [ ];
		$( '[name="wmts_preset_components"]:checkbox' ).each( function( ){
			var $this = $( this );
			if( $this.prop( 'checked' ) ) parameters.components.push( $this.val( ) );
		} )

		// get cell description details if it has been selected
		if( parameters.components.indexOf( 'Description' ) !== -1 ){
			parameters.description_details = {};
			parameters.description_details.content_source = $( '.wmts_description_field [name=descp_content]:checked' ).val( );
			parameters.description_details.limit = $( '.wmts_description_field .wmts_description_limit' ).val( );
			parameters.description_details.append = $( '.wmts_description_field .wmts_description_append' ).val( );
		}

		// get list of lightbox components if lightbox has been selected
		if( parameters.components.indexOf( 'Lightbox' ) !== -1 ){
			parameters.lightbox_components = [ ];
			$( '[name="wmts_lightbox_components"]:checkbox' ).each( function( ){
				var $this = $( this );
				if( $this.prop( 'checked' ) ) parameters.lightbox_components.push( $this.val( ) );
			} )

			// orientation
			parameters.lightbox_orientation = $( '[name="wmts_lightbox_orientation"]:checked' ).val( );

			// color theme
			parameters.lightbox_color_theme = $( '[name="wmts_lightbox_color_theme"]:checked' ).val( );

			// get lightbox description details if it has been selected
			if( parameters.lightbox_components.indexOf( 'Description' ) !== -1 ){
				parameters.lightbox_description_details = {};
				parameters.lightbox_description_details.content_source = $( '.wmts_lightbox_description_field [name=wmts_lightbox_descp_content]:checked' ).val( );
				parameters.lightbox_description_details.limit = $( '.wmts_lightbox_description_field .wmts_lightbox_description_limit' ).val( );
				parameters.lightbox_description_details.append = $( '.wmts_lightbox_description_field .wmts_lightbox_description_append' ).val( );
			}
		}
		
		// get list of attributes components if Attributes cell component has been toggled on
		if( parameters.components.indexOf( 'Attributes' ) !== -1 || ( parameters.components.indexOf( 'Lightbox' ) !== -1 && parameters.lightbox_components.indexOf( 'Attributes' ) !== -1 ) ){
			parameters.attributes_components = [ ];
			$( '[name="wmts_attributes_components"]:checkbox' ).each( function( ){
				var $this = $( this );
				if( $this.prop( 'checked' ) ) parameters.attributes_components.push( $this.val( ) );
			} )
		}
		
		// get list of links components if Links cell component has been toggled on
		if( parameters.components.indexOf( 'Links' ) !== -1 ){
			parameters.links_components = [ ];
			$( '[name="wmts_links_components"]:checkbox' ).each( function( ){
				var $this = $( this );
				if( $this.prop( 'checked' ) ) parameters.links_components.push( $this.val( ) );
			} )
		}
		
		// enable profile link
		if( $( '[name=wmts_enable_profile_link]:checked' ).length ) parameters.enable_profile_link =  true; 
		
		// grayscale
		if( $( '[name=wmts_grayscale_image]:checked' ).length ) parameters.grayscale =  true; 
		
		// custom css
		parameters.general_css =  encodeURI( $( '.wmts_custom_css' ).val( ) ); // encode for /n
		
		// posts per page
		parameters.posts_per_page = $( '.wmts_posts_per_page' ).val( );

		// specific IDs
		parameters.post__in = $( '.wmts_specific_ids' ).val( );
		
		// tax terms
		if( $( '[name=wmts_selected_terms]:checked' ).length ) {
			parameters.terms = [ ];
			$( '[name="wmts_selected_terms"]:checkbox' ).each( function( ){
				var $this = $( this );
				if( $this.prop( 'checked' ) ) parameters.terms.push( $this.val( ) );
			} )
		}
		
		// pagination
		if( $( '[name=wmts_enable_pagination]:checked' ).length ) parameters.pagination =  true;

		// filtering
		if( $( '[name=wmts_enable_filtering]:checked' ).length ){
			parameters.filtering = true;
			parameters.filtering_details = [ ];
			$( '.wmts_groups [name="wmts_selected_terms"]' ).each( function( ){
				var 	$this = $( this ),
						name = $this.next( ).text( ),
						content =  $this.next( ).text( ),
						live = $this.is( ':checked' ) ? true : false;

				parameters.filtering_details.push( { name: name, content: content, live: live } );
			} )
			parameters.filtering_details = JSON.stringify( parameters.filtering_details );
		}
		
		// filtering details
		
		// search
		if( $( '[name=wmts_enable_search]:checked' ).length ) parameters.search =  true;
		
		// pagination
		if( $( '[name=wmts_enable_pagination]:checked' ).length ) parameters.pagination =  true;

		// remap meta keys details
		if( $( '.wmts_remap_metas' ).is( ':checked' ) ){
			parameters.remap_metas = { };
			var metas = $( '.wmts_remap_metas_container' ).find( 'input' );
			metas.each( function( ){
				var 	$this = $( this ),
						label = $this.attr( 'data-wmts-type' ),
						val = $this.val( );
				parameters.remap_metas[ label ] = val;
			} )
			
		}
		
		// console.log( 'parameters: ', parameters );
		
		// ajax
		$.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			beforeSend: function( ){
				wph_editor.start_loader( $this );
			},
			data : { "action": action, 'nonce': wph_ajax.nonce, 'modifier': 'WMTS_Template_Modifier', parameters: parameters, query: query, query_handler: 'WMTS_Query_Handler', default_query: { 'post_type': 'modernteammembers' }, post_id: post_id },
			success: function( response ){
				if( ! response )
					alert( "Error in retrieving the preset." );
				else{
					// console.log( response );
					var 	$showcase = $( '.wmts_container' ),
							preset = response.preset,
							data = {
								'wmts-query': preset[ 'query' ],
								'wmts-overall-settings': preset[ 'overall settings' ],
								'wmts-devices-settings': preset[ 'devices settings' ],
								'wmts-template': preset[ 'template' ]
							};
					$showcase.data( data );
					wmts_apply_ajax_returned_markup( response );
					$( '.wph_editor_body:visible' ).trigger( 'after_load_data_to_editor' );
				}
			},
			complete: function( ){
				wph_editor.stop_loader( $this );
			}
		} );

	}
	
	// load showcase preset settings when page loads
	var preset_parameters = $( '.wmts_presets' ).attr( 'data-wmts-preset-parameters' );
	if( preset_parameters && preset_parameters.length > 3 ){
		preset_parameters = JSON.parse( preset_parameters );
		
		// preset
		$( '.wmts_preset_type' ).val( preset_parameters[ 'type' ] );
		
		// columns
		$( '.wmts_preset_columns' ).val( preset_parameters[ 'columns' ] );
		
		// cell components
		if( typeof preset_parameters[ 'components' ] === 'undefined' )
			preset_parameters[ 'components' ] = [ ];
		$( '.wmts_preset_components input:checkbox' ).each( function( ){
			var value = $( this ).val( );
			if( $.inArray( value, preset_parameters[ 'components' ] ) === -1 )
				$( this ).attr( 'checked', false );
			else
				$( this ).attr( 'checked', true );
			$( this ).change( );
		} )
		
		if( preset_parameters[ 'description_details' ] ){
			// description content source
			$( '[name="descp_content"][value="'+ preset_parameters[ 'description_details' ][ 'content_source' ] +'"]' ).attr( 'checked', true );
			
			// description word limit
			$( '.wmts_description_limit' ).val( preset_parameters[ 'description_details' ][ 'limit' ] );
			
			// append after description word limit
			if( preset_parameters[ 'description_details' ][ 'append' ] ){
				$( '.wmts_description_append' ).val( preset_parameters[ 'description_details' ][ 'append' ] );
			}
		}
		
		// lightbox components
		if( typeof preset_parameters[ 'lightbox_components' ] === 'undefined' )
			preset_parameters[ 'lightbox_components' ] = [ ];
		$( '.wmts_lightbox_components input:checkbox' ).each( function( ){
			var value = $( this ).val( );
			if( $.inArray( value, preset_parameters[ 'lightbox_components' ] ) === -1 )
				$( this ).attr( 'checked', false );
			else
				$( this ).attr( 'checked', true );
			$( this ).change( );
		} )
		
		// orientation
		if( preset_parameters[ 'lightbox_orientation' ] ){
			$( '[name="wmts_lightbox_orientation"][value="'+ preset_parameters[ 'lightbox_orientation' ] +'"]' ).attr( 'checked', true );
		}
		
		// color theme
		if( preset_parameters[ 'lightbox_color_theme' ] ){
			$( '[name="wmts_lightbox_color_theme"][value="'+ preset_parameters[ 'lightbox_color_theme' ] +'"]' ).attr( 'checked', true );
		}
		
		if( preset_parameters[ 'lightbox_description_details' ] ){
			// lightbox description content source
			$( '[name="wmts_lightbox_descp_content"][value="'+ preset_parameters[ 'lightbox_description_details' ][ 'content_source' ] +'"]' ).attr( 'checked', true );
			
			// lightbox description word limit
			$( '.wmts_lightbox_description_limit' ).val( preset_parameters[ 'lightbox_description_details' ][ 'limit' ] );
			
			// lightbox append after description word limit
			if( preset_parameters[ 'lightbox_description_details' ][ 'append' ] ){
				$( '.wmts_lightbox_description_append' ).val( preset_parameters[ 'lightbox_description_details' ][ 'append' ] );
			}
		}
		
		// attribute components
		if( typeof preset_parameters[ 'attributes_components' ] !== 'undefined' ){
			var arr = preset_parameters[ 'attributes_components' ].reverse( );
			$( '[name="wmts_attributes_components"]' ).attr( 'checked', false ).change( );
			$.each( arr, function( order, val ){
				var $item = $( '[name="wmts_attributes_components"][value="'+ val +'"]' );
				$item.attr( 'checked', true );
				$item.parent( ).prependTo( '.wmts_attributes_components' );
			} )
		}
		
		// link components
		if( typeof preset_parameters[ 'links_components' ] !== 'undefined' ){
			var arr = preset_parameters[ 'links_components' ].reverse( );
			$( '[name="wmts_links_components"]' ).attr( 'checked', false ).change( );
			$.each( arr, function( order, val ){
				var $item = $( '[name="wmts_links_components"][value="'+ val +'"]' );
				$item.attr( 'checked', true );
				$item.parent( ).prependTo( '.wmts_links_components' );
			} )
		}
		
		// enable link to profile
		if( typeof preset_parameters[ 'enable_profile_link' ] !== 'undefined' ){
			$( '[name="wmts_enable_profile_link"]' ).attr( 'checked', true );
		}else{
			$( '[name="wmts_enable_profile_link"]' ).attr( 'checked', false );
		}
		
		// grayscale member image
		if( typeof preset_parameters[ 'grayscale' ] !== 'undefined' ){
			$( '[name="wmts_grayscale_image"]' ).attr( 'checked', true );
		}else{
			$( '[name="wmts_grayscale_image"]' ).attr( 'checked', false );			
		}
		
		// custom css
		if( typeof preset_parameters[ 'general_css' ] !== 'undefined' )
			$( '.wmts_custom_css' ).val( decodeURI( preset_parameters[ 'general_css' ] ) );
		
		// posts per page
		$( '.wmts_posts_per_page' ).val( preset_parameters[ 'posts_per_page' ] );
		
		// specific IDs to show
		$( '.wmts_specific_ids' ).val( preset_parameters[ 'post__in' ] );
		
		// select groups
		if( typeof preset_parameters[ 'terms' ] === 'undefined' )
			preset_parameters[ 'terms' ] = [ ];
		$( '.wmts_groups input:checkbox' ).each( function( ){
			var value = $( this ).val( );
			if( $.inArray( value, preset_parameters[ 'terms' ] ) === -1 )
				$( this ).attr( 'checked', false );
			else
				$( this ).attr( 'checked', true );
			$( this ).change( );
		} )
		
		// filtering
		if( typeof preset_parameters[ 'filtering' ] !== 'undefined' ){
			$( '[name="wmts_enable_filtering"]' ).attr( 'checked', true );
		}
		
		// pagination
		if( typeof preset_parameters[ 'pagination' ] !== 'undefined' ){
			$( '[name="wmts_enable_pagination"]' ).attr( 'checked', true );
		}
		
		// search
		if( typeof preset_parameters[ 'search' ] !== 'undefined' ){
			$( '[name="wmts_enable_search"]' ).attr( 'checked', true );
		}
		
		// filtering
		if( typeof preset_parameters[ 'filtering' ] !== 'undefined' ){
			$( '[name="wmts_enable_filtering"]' ).attr( 'checked', true );
		}
		
		// remap metas
		if( typeof preset_parameters[ 'remap_metas' ] !== 'undefined' ){
			$( '.wmts_remap_metas' ).attr( 'checked', true );
			$( '.wmts_remap_metas' ).change( );
			
			//-- remap meta keys
			$.each( preset_parameters[ 'remap_metas' ], function( key, val ){
				$( '.wmts_remap_metas_container [data-wmts-type="'+ key +'"]' ).val( val );
			} )
		}		

	}

	// load preset form 
	$( '.wmts_preset_purpose' ).on( 'change', function( ){
		var 	$this = $( this ),
				$topic = $this.siblings( '.wmts_preset_topic' );
		if( $this.val( ) === 'Search' ){
			$topic.add( $topic.prev( ) ).hide( );
		}else{
			$topic.add( $topic.prev( ) ).show( );
		}
	} )
	
	$( '.wmts_form_presets' ).on( 'click', '.wmts_load_this_preset', wmts_load_this_from_preset );
	function wmts_load_this_from_preset( ){

		var 	$this = $( this ),
				action = 'wmts_get_form_preset',
				$form = $( '.wph_form_container' ),
				post_id= $form.attr( 'data-wph-post-id' ),
				parameters = { };

		// get preset parameters
		parameters.purpose = $( '.wmts_preset_purpose' ).val( );
		parameters.topic = $( '.wmts_preset_topic' ).val( );
		
		// ajax
		$.ajax( {
			type : "post",
			dataType : "json",
			url : wph_ajax.url,
			beforeSend: function( ){
				wph_editor.start_loader( $this );
			},
			data : { "action": action, 'nonce': wph_ajax.nonce, parameters: parameters, post_id: post_id },
			success: function( response ){				
				if( ! response ) 
					alert( "Error in retrieving the preset." );
				else{
					// console.log( response );
					response_logged = response;
					var new_form_contents = $( response.preset ).filter( '.wph_form_container' ).children( '.wph_key_keeper' ).remove( ).end( ).html( );
					$form.children( ).not( '.wph_key_keeper' ).remove( );
					$form.append( new_form_contents );
					wph_form_builder.init_jquery_ui( );
					// hide editor
					if( $( '.wph_editor_body' ).is( ':visible' ) ) $form.find( '.wph_editor_key_settings' ).click( );
				}
			},
			complete: function( ){
				wph_editor.stop_loader( $this );
			}
		} );

	}
	
	// display list of extended meta keys with magnificPopup
	$( '.wmts_meta_key_list_button' ).magnificPopup( {
		items: {
			src: $( '.wmts_meta_key_list' ),
			type: 'inline'
		},
		callbacks: {
			open: function( item ){
				$( '.wph_editor_body' ).hide( );
			},
			close: function( item ){
				$( '.wph_editor_body' ).show( );
			}
		}
	} );
	
	// select post types and terms
	$( '.wmts_select_post_types' ).on( 'change', function( ){
		var 	$this = $( this ),
				selected_post_types = $this.children( 'option' ).filter( ':selected' ),
				terms = [ ];
		selected_post_types.each( function( ){
			var 	$this = $( this ),
					current_terms = $this.attr( 'data-wmts-terms' );
			if( current_terms.length ){
				current_terms = current_terms.split( ', ' );
				$.each( current_terms, function( key, val ){
					if( terms.indexOf( val ) === -1 ) terms.push( val );
				} )
			}
		} )
		
		// show correct terms
		var 	$terms_selector = $( '.wmts_select_terms' ),
				$terms_options = $terms_selector.children( 'option' );
		
		$terms_options.addClass( 'wmts_hidden_terms' );		
		$.each( terms, function( key, val ){
			$terms_options.filter( '[value='+ val +']' ).removeClass( 'wmts_hidden_terms' );
		} )
		$terms_options.filter( '.wmts_hidden_terms' ).prop( 'selected', false );
		
		// pages
		var $wmts_select_pages_container = $( '.wmts_select_pages_container' );
		if( selected_post_types.filter( '[value=page]' ).length ){
			$wmts_select_pages_container.show( )
		}else{
			$wmts_select_pages_container.hide( );
			$wmts_select_pages_container.children( ).prop( 'selected', false );
		}
		
	} )
	
	// guides
	$( '.wmts_guide_key' ).click( function( ){
		var $this = $( this ),
				index = $this.index( );
		$this.toggleClass( 'wmts_selected' ).siblings( ).removeClass( 'wmts_selected' );		
		$( '.wmts_guide').eq( index ).toggle( ).siblings( ).hide( );
	} )
	
	// faqs
	$( '.wmts_faqs_q' ).click( function( ){
		$( this ).next( ).stop( ).slideToggle( 100 );
		$( this ).toggleClass( 'wmts_faqs_selected' )
		var $icon = $( this ).children( 'i:first-child' );
		if( $( this ).hasClass( 'wmts_faqs_selected' ) ){
			$icon.removeClass( 'fa-plus-circle' ).addClass( 'fa-minus-circle' );
		}else{
			$icon.removeClass( 'fa-minus-circle' ).addClass( 'fa-plus-circle' );
		}
	} )
	
	// page leave warning
	window.onbeforeunload = function( ){
		var post_type = $( '#post_type' ).val( );
//		if( post_type && post_type === 'modernteamshowcases' ) return "Are you sure you want to leave this pagex?";
		if( post_type && post_type === 'modernteamshowcases' ) return " ";
	}
	
} )
