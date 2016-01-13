if( ! wph_editor  )
	var wph_editor = {};

if( ! wph_editor.visual_template  )
	wph_editor.visual_template = {};

jQuery( function( $ ){
	
	// init a template container
	wph_editor.visual_template.init = function( $template ){
		
		$template.off( 'wph_template_element_added' );

		// helps id the delegation element
		$template.addClass( 'wph_template_element' );
		
		// create labels
		wph_editor.visual_template.add_labels( $template );

		// add settings buttons
		wph_editor.visual_template.add_settings_buttons( $template );
		wph_editor.visual_template.init_settings_buttons( $template );
		
		// init double click toggle
		$template.off( 'dblclick.wph_template_dblclick_toggle' );
		wph_editor.visual_template.init_dblclick_toggle( $template );

		// add settings tabs
		wph_editor.visual_template.add_settings_tabs( $template );
		wph_editor.visual_template.init_settings_tab( $template );
		
		// spectrum color picker
		wph_editor.visual_template.init_spectrum( $template );

		// init icon picker
		wph_editor.visual_template.init_icon_picker( $template );

		// set tab values
		wph_editor.visual_template.set_tab_values( $template );
		
		// live name modifications
		wph_editor.visual_template.init_live_names( $template );

		// add component appender
		wph_editor.visual_template.add_component_appender( $template );
		wph_editor.visual_template.init_component_appended( $template )

		// init jquery ui
		wph_editor.visual_template.init_sortability( $template );
		
		// hide settings tabs and inner children
		var exclude = '.wph_template_element_settings_keys, .wph_template_element_label';
		$template.find( '.wph_template_element' ).children( ).not( exclude ).hide( );
		
		// init import & export
		wph_editor.visual_template.init_transfers( $template );
		
		// event listener for new element addition - it will have its markup completed
		$template.on( 'wph_template_element_added', function( e ){
			wph_editor.visual_template.add_labels( $template );
			wph_editor.visual_template.add_settings_buttons( $template );
			wph_editor.visual_template.add_settings_tabs( $template );
			wph_editor.visual_template.add_component_appender( $template );
			wph_editor.visual_template.set_tab_values( $template );
		} )

	}
	
	// init spectrum
	wph_editor.visual_template.init_spectrum = function( $template ){
		$template.on( 'click', '[data-wph-type="Style"].wph_template_settings_tab_key', wph_editor.visual_template.build_spectrum );
	}
	
	// build spectrum
	wph_editor.visual_template.build_spectrum = function( ){
		var 	$template_settings_tab = $( this ).closest( '.wph_template_settings_tab' ),
					$style_tab = $template_settings_tab.children( '.wph_template_settings_tab_boxes' ).children( '[data-wph-type="Style"]' );
		$style_tab.find( '[data-wph-spectrum="true"]' ).each( function( ){
		
			var $this = $( this );
			if( ! $this.data( )[ 'spectrum.id' ] ){
				$this.spectrum( {
					showAlpha: true,
					showInput: true,
					preferredFormat: "rgb",
					allowEmpty: true
				} );
			}
			
		} )
	}
	
	//	init double click toggle
	wph_editor.visual_template.init_dblclick_toggle = function( $template ){
		$template.on( 'dblclick.wph_template_dblclick_toggle', '.wph_template_element', function( e ){
			if( $( e.target ).is( 'input, select, textarea' ) ) return; // avoid false trigger
			var $this = $( this ),
					$settings_keys = $this.children( '.wph_template_element_settings_keys' ),
					$expand_key = $settings_keys.children( '[data-wph-type="Expand"]' ),
					$contract_key = $settings_keys.children( '[data-wph-type="Contract"]' );
			if( $expand_key.css( 'display' ) === 'none' ){
				$contract_key.click( );
			}else{
				$expand_key.click( );
			}
			
			$( 'body' ).trigger( 'wph_template_double_click_resized' );
			
			return false;
			
		} )
	}
	
	// add labels
	wph_editor.visual_template.add_labels = function( $template ){
		$template.find( '.wph_template_element' ).each( function( ){
			var 	$this = $( this ),
					label = $this.attr( 'data-wph-label' );
			if( ! label ) label = 'Nameless';
			if( ! $this.children( '.wph_template_element_label' ).length )
				$this.prepend( '<label class="wph_template_element_label">'+ label +'</label>' );
			
		} )
		
	}
	
	// add settings buttons
	wph_editor.visual_template.add_settings_buttons = function( $template ){
	
		// add buttons
		$template.find( '.wph_template_element' ).each( function( ){
			if( ! $( this ).children( '.wph_template_element_settings_keys' ).length ){
				var 	$this = $( this ),
						class_append = 'wph_template_element_settings_key',
						copy = '<i class="fa fa-files-o '+ class_append +'" data-wph-type="Copy"></i>',
						remove = '<i class="fa fa-trash-o '+ class_append +'" data-wph-type="Remove"></i>',
						expand = '<i class="fa fa-plus '+ class_append +'" data-wph-type="Expand"></i>',
						contract = '<i class="fa fa-minus '+ class_append +'" data-wph-type="Contract" style="display:none;"></i>',
						move = '<i class="fa fa-arrows-v '+ class_append +'" data-wph-type="Move"></i>',
						settings_buttons = $( '<div class="wph_template_element_settings_keys">'+ copy + remove + expand + contract + move +'</div>' );
				$this.prepend( settings_buttons );
			}
		} )
	}
	
	// add settings buttons
	wph_editor.visual_template.init_settings_buttons = function( $template ){
		
		// add event listeners
		//-- copy
		$template
		.off( 'click.wph_template_element_settings_key', '[data-wph-type="Copy"]' )
		.on( 'click.wph_template_element_settings_key', '[data-wph-type="Copy"]', function( ){
			// value is select is not cloned. It needs to be noted
			var 	$this = $( this ),
					$element= $this.closest( '.wph_template_element' );
			$element.find( 'select, textarea' ).each( function( ){
				var 	$this_  = $( this ),
						val = $this_.val( );
				$this_.attr( 'data-wph-select-val', val );
			} ) 
			
			var $clone = $element.clone( );

			$clone
				.find( 'select, textarea' ).each( function( ){
					var 	$this_ = $( this ),
								val = $this_.attr( 'data-wph-select-val' );
					$this_.val( val );
				} )
				.end().find( '.sp-replacer' ).remove(  );

			$element.after( $clone );
			// firing off the added element event
			$clone.trigger( 'wph_template_element_added' );
			
			var style_triggers = $clone.find( '.wph_template_settings_tab_key.wph_selected[ data-wph-type="Style"]' );
			if( style_triggers.length ){
				style_triggers.each( function( ){
					wph_editor.visual_template.build_spectrum.call( this );
				} )
			}

		} )

		//-- remove
		$template
		.off( 'click.wph_template_element_settings_key', '[data-wph-type="Remove"]' )
		.on( 'click.wph_template_element_settings_key', '[data-wph-type="Remove"]', function( ){
			var 	$this = $( this ),
					$element= $this.closest( '.wph_template_element' );
			$element.remove( );
		} )
		
		//-- expand
		var exclude = '.wph_template_element_settings_keys, .wph_template_element_label';

		$template
		.off( 'click.wph_template_element_settings_key', '[data-wph-type="Expand"]' )
		.on( 'click.wph_template_element_settings_key', '[data-wph-type="Expand"]', function( ){
			var 	$this = $( this ),
					$contract = $this.siblings( '[data-wph-type="Contract"]' ),
					$element= $this.closest( '.wph_template_element' );
			$element.children( ).not( exclude ).show( );
			$this.hide( );
			$contract.show( );
		} )
		
		//-- contract
		$template
		.off( 'click.wph_template_element_settings_key', '[data-wph-type="Contract"]' )
		.on( 'click.wph_template_element_settings_key', '[data-wph-type="Contract"]', function( ){
			var 	$this = $( this ),
					$expand = $this.siblings( '[data-wph-type="Expand"]' ),
					$element= $this.closest( '.wph_template_element' );
			$element.children( ).not( exclude ).hide( );
			$this.hide( );
			$expand.show( );
		} )
			
	}

	// init sortability
	wph_editor.visual_template.init_sortability = function( $template ){
		var 	$containers = $template.find( '.wph_template_sortable_container' );		
				args = {
					items: '.wph_template_element',
					connectWith: $containers,
					handle: ">.wph_template_element_settings_keys [data-wph-type='Move']",
					scroll: false
				};
		$containers.sortable( args );
		
		// event listener for new element added
		$template.on( 'wph_template_element_added', function( e ){
			wph_editor.visual_template.init_sortability( $template );
		} )		
	}
	
	// add settings tabs
	wph_editor.visual_template.add_settings_tabs = function( $template ){
		var settings_tab = $( '.wph_template_settings_tab.wph_original' );
		$template.find( '.wph_template_element' ).each( function( ){			
			var 	$this = $( this );
			if( $this.children( '.wph_template_settings_tab' ).length ) return;
			
			var clone = settings_tab.clone( ).removeClass( 'wph_original' );
			$this.prepend( clone );
			
			// container type elements do not get 'Content' key
			if( $this.attr( 'data-wph-component' ) === 'container' || $this.attr( 'data-wph-component' ) === 'lightbox' ){
				clone.find( '.wph_template_settings_tab_key[data-wph-type="Content"]' ).remove( );
			}
			
		} ) 
	}
	
	// tabs init
	wph_editor.visual_template.init_settings_tab = function( $template ){
		$template
		.off( 'click.wph_template_tab', '.wph_template_settings_tab_key' )
		.on( 'click.wph_template_tab', '.wph_template_settings_tab_key', function( ){
			var 	$this = $( this ),
					key = $this.attr( 'data-wph-type' ),
					boxes = $this.closest( '.wph_template_settings_tab' ).children( '.wph_template_settings_tab_boxes' ).children( '.wph_template_settings_tab_box' ),
					box = boxes.filter( '[data-wph-type="'+ key +'"]' );
			
			if( $this.hasClass( 'wph_selected' ) ){ // deselect if clicked again
				box.hide( );
			}else{ // select and reveal box if clicked first time
				$this.siblings( ).removeClass( 'wph_selected' );
				box.show( );				
			}
			
			$this.toggleClass( 'wph_selected' );
			box.siblings( ).hide( );
		} )

		// start it off
		/*
		var $tab_keys = $template.find( '.wph_template_settings_tab_key' );
		$tab_keys.filter( ':first-child' ).trigger( 'click.wph_template_tab' );
		*/
	}
	
	// set tab values
	wph_editor.visual_template.set_tab_values = function( $template ){
		$template.find( '.wph_template_element' ).each( function( ){
			var 	$this = $( this ),
					$tab = $this.children( '.wph_template_settings_tab' ),
					values_object = $this.data( 'wph-values' );
			// use the values data for each element to fill its tab input values
			if( values_object ){
				$.each( values_object, function( category, category_values_object ){
					
					if( typeof category_values_object !== 'object' ) return; // only dealing with value objects
					var 	$box = $tab.find( '.wph_template_settings_tab_box[data-wph-type="'+ category +'"]' ), // current cat box to target
							$inputs = $box.find( 'input, select, textarea' );
					$.each( category_values_object, function( label, value ){
						$input = $inputs.filter( '[data-wph-type="'+ label +'"]' );
						if( $input.is( ':checkbox' ) ){
							$input.prop( 'checked', true ).change( );
						}else{
							$input.val( value ).change( );
						}
					} )
				} )
			}
			
			// remove values
			$this.removeData( 'wph-values' );

		} )
	}
	
	// live names
	wph_editor.visual_template.init_live_names = function( $template ){
		$template.on( 'keyup change', '[data-wph-type="name"]', function( ){
			var 	$this = $( this ),
					name = $this.val( ),
					$element = $this.closest( '.wph_template_element' ),
					label = $element.children( '.wph_template_element_label' );
			if( ! name.length ){
				name = $element.attr( 'data-wph-component' );
				name = name.charAt( 0 ).toUpperCase( ) + name.slice( 1 ); // capitalize first letter
			}
			if( label.length ) label.text( name );
		} )
		
	};

	// add component appender
	wph_editor.visual_template.add_component_appender = function( $template ){
		// build component appender markup
		var 	components = { 'Text' : 'text', 'HTML' : 'HTML', 'Image': 'image', 'Link': 'link', 'Video': 'video', 'Sub container': 'container', 'Attribute': 'attribute', 'Ribbon': 'ribbon', 'Lightbox': 'lightbox' },
				$component_appender = $( '<div class="wph_template_component_appender"></div>' ),
				$component_appender_select = $( '<select class="wph_template_component_appender_select"></select>' ),
				$component_appender_button = $( '<button class="wph_template_component_appender_button">Add Component</button>' );

		// append select with options
		$.each( components, function( key, val ){
			$component_appender_select.append( '<option value="'+ val +'">'+ key +'</option>' );
		} )
		
		// append the main appender element with select and button
		$component_appender
		.append( $component_appender_select )
		.append( $component_appender_button );

		$template.find( '[ data-wph-component="container" ], [ data-wph-component="lightbox" ]' ).addBack( ).each( function( i ){
			var $this = $( this );
			if( ! $this.children( '.wph_template_component_appender' ).length ){
				$this.append( $component_appender.clone( ) );
			}
		} )
		
	}
	
	// init component appended
	wph_editor.visual_template.init_component_appended = function( $template ){
		$template.off( 'click.wph_template_component_appended', '.wph_template_component_appender_button' );
		$template.on( 'click.wph_template_component_appended', '.wph_template_component_appender_button', function( ){
			var 	$this = $( this ), // button
					component = $this.siblings( '.wph_template_component_appender_select' ).val( ), // value of select
					label = component.charAt( 0 ).toUpperCase( ) + component.slice( 1 ); // capitalize first letter
					$component_appender = $this.parent( '.wph_template_component_appender' ), // parent
					sortable = component === 'container' ? '<div class="wph_template_sortable_container"></div>' : '';
					$element = $( '<div class="wph_template_element" data-wph-component="'+ component +'" data-wph-label="'+ label +'">'+ sortable +'</div>' );
					
			// add the new element to sortable sibling
			var $sortable_sibling =  $component_appender.siblings( '.wph_template_sortable_container' );
			if( ! $sortable_sibling.length ) $component_appender.before( '<div class="wph_template_sortable_container"></div>' );
			$component_appender.siblings( '.wph_template_sortable_container' ).append( $element );
			
			// trigger 'wph_template_element_added' on the new element to complete its markup
			$element.trigger( 'wph_template_element_added' );
		} )
	}
	
	// add icon picker
	wph_editor.visual_template.add_icon_picker = function( $element ){
			var $icon_picker = $( '<div class="wph_icon_picker" style="display: none;"><i>None</i></div>' );
			$.each( wph_font_awesome_json, function( key, value ){
				if( key === 'filter' || key === 'spinner' || key === 'new' ) // lose these categories
					return;
				var $group = $( '<div class="wph_icon_picker_group"><strong style="text-transform: capitalize; display: block;">'+ key +'</strong></div>' );
				$.each( value, function( icon_name, icon_class ){
					$group.append( '<i class="'+icon_class+'"></i>' );
				} )
				$icon_picker.append( $group );
			} )
			$element.after( $icon_picker );
			return $icon_picker;
	}
	
	// init icon picker
	wph_editor.visual_template.init_icon_picker = function( $template ){
		
		// add event listener
		$template
		// show
		.off( 'focus.wph_template_icon_picker_revealed', '[data-wph-icon="true"]' )
		.on( 'focus.wph_template_icon_picker_revealed', '[data-wph-icon="true"]', function( e ){
			var 	$this = $( this ),
						$icon_picker = $this.next( '.wph_icon_picker' );
			if( ! $icon_picker.length ){
				$icon_picker = wph_editor.visual_template.add_icon_picker( $this );
			}
			$icon_picker.show( );
			$( '.wph_icon_picker' ).not( $icon_picker ).hide( );
			// hide upon clicking elsewhere
			$( 'body' ).on( 'click.wph_template_shutdown_icon_picker', function( e ){ // this click is triggered right after focus			
				if( ! $( e.target ).closest( '.wph_icon_picker_group' ).length && e.target !== $this[ 0 ] ){
					$icon_picker.hide( );
					
					$( 'body' ).off( 'click.wph_template_shutdown_icon_picker' );
				}
			} )
		} )
		// hide upon selecting
		.off( 'click.wph_selected_a_template_icon' )
		.on( 'click.wph_selected_a_template_icon', '.wph_icon_picker i', function( e ){
			var 	$this_ = $( this ),
					class_ = $this_.attr( 'class' ),
					$parent = $this_.closest( '.wph_icon_picker' ),
					$input = $parent.prev( '[data-wph-icon="true"]' );
			$input.val( class_ );
			$parent.hide( );
		} )
		
		
		/*
		// add event listener
		$template
		// show
		.off( 'focus.wph_template_icon_picker_revelaed' )
		.on( 'focus.wph_template_icon_picker_revelaed', '[data-wph-icon="true"]', function( e ){
			var 	$this = $( this ),
						$icon_picker = $this.next( '.wph_icon_picker' );
			if( ! $icon_picker.length ){
				$icon_picker = wph_editor.visual_template.add_icon_picker( $this );
			}
			$icon_picker.show( );
			$( 'body' ).one( 'click', function( ){ // close on clicking elsewhere 
				$( 'body' ).one( 'click', function( event ){ // needed twice as first event taken by click on input
					if( ! $( event.target ).closest( '.wph_icon_picker_group' ).length && event.target !== this ){
						$icon_picker.hide( );
					}
				} )
			} )
		} )
		// select and hide
		.off( 'click.wph_template_icon_selected' )
		.on( 'click.wph_template_icon_selected', '.wph_icon_picker i', function( e ){
			var 	$this_ = $( this ),
					class_ = $this_.attr( 'class' ),
					$parent = $this_.closest( '.wph_icon_picker' ),
					$input = $parent.prev( '[data-wph-icon="true"]' );
			$input.val( class_ );
			$parent.hide( );
		} )
		*/

	}
	
	// init transfer functionality
	wph_editor.visual_template.init_transfers = function( $template ){
		// import
		$template.on( 'click', '.wph_editor_template_import', function( ){
			var 	$this = $( this ),
					$transfer_box = $this.siblings( '.wph_editor_transfer_box' ),
					import_code = $transfer_box.val( ),
					$element = $this.closest( '.wph_template_element' );
			import_code = JSON.parse( import_code );
			wph_editor.visual_template.set_template_element( import_code, $element );
		} )
		
		// export		
		$template.on( 'click', '.wph_editor_template_export', function( ){
			var 	$this = $( this ),
					$transfer_box = $this.siblings( '.wph_editor_transfer_box' ),
					$element = $this.closest( '.wph_template_element' );
			var export_code = JSON.stringify(wph_editor.visual_template.get_template_element( $element ) );
			$transfer_box.val( export_code );
		} )
		
	}
	
	// get template element
	wph_editor.visual_template.get_template_element = function( $element ){

		var 	element_template = { Type: $element.attr( 'data-wph-component' ) };		
		// target the tab boxes for input value collection
		$element.children( '.wph_template_settings_tab' ).find( '.wph_template_settings_tab_box[data-wph-type]' ).each( function( ){
			var 	$this = $( this ),
					sub_component_type = $( this ).attr( 'data-wph-type' );
			element_template[ sub_component_type ] = { };
			// target the inputs within current tab box for value collection
			$this.find( 'textarea, input, select' ).each( function( ){
				var $input = $( this ),
						property = $input.attr( 'data-wph-type' );
				if( $input.is( ':checkbox' ) && ! $input.is( ':checked' ) ) return; 
				element_template[ sub_component_type ][ property ] = $input.val( );
			} )
		} )

		// iterate over child elements in case of container
		var $sortable_container = $element.children( '.wph_template_sortable_container' );
		if( $sortable_container.length  ){
			element_template[ 'sub_elements' ] = [ ];
			$children = $sortable_container.children( '.wph_template_element' );
			$children.each( function( ){
				var sub_element_template = wph_editor.visual_template.get_template_element( $( this ) );
				element_template[ 'sub_elements' ].push( sub_element_template );
			} )			
		}

		return element_template;
	}

	// set template element
	wph_editor.visual_template.set_template_element = function( object, $element, inner ){
		
		if( ! object ) object = { };		
		// clearing out element's past children
		$element.empty( );
	
		// set up template attrs
		var 	type = object.Type || 'container',
				name = object.Name ? object.Name.name.trim( ) : '',
				name = name.length ? name : type.charAt( 0 ).toUpperCase( ) + type.slice( 1 );
		$element.attr( {
			'data-wph-component': type,
			'data-wph-label': name
		} )
		
		// settings tabs values
		$element.data( 'wph-values', object );
		
		// case of containers
		if( type === 'container' || type === 'lightbox' ){
			// adding sortable container
			$element.append( '<div class="wph_template_sortable_container"></div>' );
			var $element_sortable = $element.children( '.wph_template_sortable_container' );
			// adding sub elements
			if( object.sub_elements ){
				$.each( object.sub_elements, function( key, sub_element ){
					var $child_element = $('<div class="wph_template_element"></div>');
					$element_sortable.append( $child_element );
					wph_editor.visual_template.set_template_element( sub_element, $child_element, true );
				} )
			}
		}
		
		// event should be triggered just once, on outer most element
		if( ! inner ) $element.trigger( 'wph_template_element_added' );
		
	}
	
} )