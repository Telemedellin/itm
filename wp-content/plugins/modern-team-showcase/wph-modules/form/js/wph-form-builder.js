jQuery( function( $ ){
	
	// init 	
	if( typeof( wph_form_builder )  !== 'object' ){
		wph_form_builder = { };
		wph_form_builder.model = { };
		
		// extract model from form element
		/*If you want to add new options to the editor, first add them in the model here. The element model is first built in 'extract_from_element'
		and then injected with new values in 'extract_from_editor' and finally while submitting, the form element is recreated in 'transform_into_element' */
		wph_form_builder.model.extract_from_element = function( $source ){
			var 	input = $source.find( 'input, select' ),
					model = {
							$element : $source,
							label : $source.children( 'label:first' ).text( ),
							sub_label : $source.children( 'label:first-child+label' ).length ? $source.children( 'label:first-child+label' ).html( ) : '',
							label : $source.find( 'label' ).html( ),
							meta_key : $source.attr( 'data-wph-form-element-meta-key' ),
							required : $source.attr( 'data-wph-form-element-required' ),
							action : $source.attr( 'data-wph-form-element-action' ),
							template : $source.attr( 'data-wph-form-template' ),
							type : input.attr( 'type' ),
							value : input.attr( 'value' ),
							placeholder : input.attr( 'placeholder' ),
							classes : $source.attr( 'data-wph-form-element-classes' ),
							width : $source.attr( 'data-wph-form-element-width' ),
						};

			if( input.is( ':checkbox, :radio, select' ) ){
				model.options = [ ];
				input.parent( ).find( 'option, input' ).each( function( ){
					var 	$this = $( this ),
							option = {
								value : $this.attr( 'value' ),
								label : $this.next( 'label' ).length ? $this.next( 'label' ).html( ) : $this.text( ), // second part for select
								checked : $this.attr( 'checked' ) ? true : false,
								selected : ( $this.is( ':radio' ) && $this.attr( 'checked' ) ) || $this.attr( 'selected' ) ? true : false, // only one
								classes : $this.attr( 'data-wph-form-element-classes' ),
								width : $this.attr( 'data-wph-form-element-width' ),
							};
					model.options.push( option );
				} )
			}

			return model;
		}

		wph_form_builder.model.extract_from_form = function( form ){
			var 	form = $( form ),
					model = {};

			form.find( '.wph_form_element' ).each( function( ){
				var 	$this = $( this ),
						meta_key = $this.attr( 'data-wph-form-element-meta-key' );

				model[ meta_key ] = wph_form_builder.model.extract_from_element( $( this ) );
			} )

			return model;		
		}
		
		wph_form_builder.model.extract_from_editor = function( ){
			var 	editor = $( '.wph_editor_form_options' ),
					model = editor.data( 'wph-form-element-model' );

				$.each( model, function( key, value ){
					if( key === 'options' ){
						model[key] = [];

						editor.find( '.wph_editor_form_option_tray' ).each( function( ){
							var option = {};
							$( this ).find( '[data-wph-form-editor-option]' ).each( function( ){
								var 	$this = $( this );
										_key = $this.attr( 'data-wph-form-editor-option' ).substr( 8 ),
										value = $( this ).val( );
								if( $this.is( ':radio, :checkbox' ) )
									value = $this.is( ':checked' ) ? true : false;
								option[ _key ] = value;
							} )
							model[key].push( option );
						} )

					}else if( key=== '$element' ){
						return;
					}else{
						var option = editor.find( '[data-wph-form-editor-option="'+key+'"]' );
						if( option.is( ':radio' ) )
							model[ key ] = editor.find( '[data-wph-form-editor-option="'+key+'"]:checked' ).val( );
						else
							model[ key ] = editor.find( '[data-wph-form-editor-option="'+key+'"]' ).val( );
					}
				} )

			return model;		
		}
		
		wph_form_builder.editor = {};	
		
		// represent an element in the editor
		wph_form_builder.editor.represent_element = function( $element ){
			var 	model = wph_form_builder.model.extract_from_element( $element ),
					template = model.template,
					$editor = $( '.wph_editor_form_options' );
			
			$( '.wph_editor_form_options' ).attr( 'data-wph-form-template', template ); // css view
			
			// options
			wph_form_builder.editor.develop_option_tray( $editor.find( '.wph_editor_form_option_tray' ), model );
			
			// select / check right options
			$.each( model, function( key, value ){
				var $option = $editor.find( '[data-wph-form-editor-option="'+key+'"]' );
				if( $option.is( ':radio' ) )
					$option.filter( '[value="' + value + '"]' ).attr( 'checked', true );
				else
					$option.val( value );
			} )
			
			$editor.data( 'wph-form-element-model', model );
		}


		// develop element's option tray in the editor
		wph_form_builder.editor.develop_option_tray = function( tray, model ){
			var 	options = model.options;
			
			if( ! options ){
				return;
			} 
			
			var 	option_template = tray.first( ),
					first_option = true;
			
			tray = tray.not( option_template ).remove( ); // clear previous options, leave a template

			$.each( options, function( key, options_object ){

				var current_option = option_template;

				if( first_option ) first_option = false;
				else{
					var clone_tray = option_template.clone( );
					clone_tray.find( '[data-wph-form-editor-option="options selected"]' ).attr( 'checked', false );
					clone_tray.insertAfter( $( '.wph_editor_form_option_tray' ).last( ) );
					current_option = $( '.wph_editor_form_option_tray' ).last( );
				} 
				
				current_option.find( '[data-wph-form-editor-option="options label"]' ).val( options_object[ 'label' ] );
				current_option.find( '[data-wph-form-editor-option="options value"]' ).val( options_object[ 'value' ] );
				current_option.find( '[data-wph-form-editor-option="options checked"]' ).attr( 'checked', options_object[ 'checked' ] );
				current_option.find( '[data-wph-form-editor-option="options selected"]' ).attr( 'checked', options_object[ 'selected' ] );
				
				// hide 'checked' in case of select and 'select' in case of radio and checkbox
				//-- checkbox
				if( $( '.wph_editor_form_options' ).attr( 'data-wph-form-template' ) === 'checkbox' ){
					current_option.find( '[data-wph-form-editor-option="options selected"]' ).prev( ).addBack( ).hide( );
					current_option.find( '[data-wph-form-editor-option="options checked"]' ).prev( ).addBack( ).show( );
				}else{ //-- radio / select
					current_option.find( '[data-wph-form-editor-option="options checked"]' ).prev( ).addBack( ).hide( );
					current_option.find( '[data-wph-form-editor-option="options selected"]' ).prev( ).addBack( ).show( );
				}

			} )
		}

		$( '.wph_form_container[data-wph-form-editing="enabled"]' ).on( 'click', '.wph_form_element', function( ){
			var 	$this = $( this ),
					$form = $this.closest( '.wph_form_container' ),
					focus_class = 'wph_form_editor_focus';
			$( '.' + focus_class ).removeClass( focus_class );
			$this.addClass( focus_class );
			wph_form_builder.editor.represent_element( $this );
		} )
		
		//build form element from editor
		wph_form_builder.editor.build_element = function( ){

			var 	editor = $( '.wph_editor_form_options' ),
					model = wph_form_builder.model.extract_from_editor( ),
					$element = model.$element,
					template_name = $element.attr( 'data-wph-form-template' ),
					template = wph_form_element_templates[ template_name ],
					element = wph_form_builder.model.transform_into_element( template_name, template, model ),
					classes = model.classes + ' wph_form_element wph_form_editor_focus';
			//$element is the element's container with the class 'wph_form_element'
			$element.attr( {
				'data-wph-form-element-meta-key': model.meta_key,
				'data-wph-form-element-required': model.required,
				'data-wph-form-element-classes': model.classes,
				'data-wph-form-element-width': model.width,
				'class': classes,
			} ).html( element );
			
			if( template_name === 'submit' ) $element.attr( 'data-wph-form-element-action', model.action )

		};
		
		// transform editor options into form element - works on inners of the element, not container with class 'wph_form_element'
		wph_form_builder.model.transform_into_element = function( template_name, template, model ){

			template = $( template ).not( 'label' );
			var element = $( '<label>' + model.label + '</label><label>' + model.sub_label + '</label>' ).add( template );
			
			// the input[text / link / email], text area, or select element gets these attrs
			element.not( 'label' ).attr( {
				'value': model.value,
				'placeholder': model.placeholder,
			} );

			if( template_name === 'select' ){
				element.find( 'option' ).remove( );
				var select = element.filter( 'select' );
				$.each( model.options, function( pos, op_model ){
					var selected = op_model.selected ? 'selected' : '';
					select.append( $( '<option value="' + op_model.value + '" ' + selected + ' >'+ op_model.label + '</option>' ) );
				} )

			}else if( template_name === 'radio' || template_name === 'checkbox' ){
				var 	input = element.filter( 'input:first' ), // main template of input
						element = element.not( 'input' ),
						name = 'wph_name_' + new Date().getTime();
						
				$.each( model.options, function( pos, op_model ){
					var 	checked = ( template_name === 'radio' ) ? op_model.selected : op_model.checked, // checked can be multiple unlike selected
							new_input = input.clone( ).attr( {'value': op_model.value, 'checked': checked, 'name': name } ),
							label = $( '<label>' + op_model.label + '</label>' ),
							new_option = new_input.add( label );
					element = element.add( new_option );
				} )
				
			}

			return element;
		}
		
		// auto add meta key with prefix
		$( '.wph_editor_form_options' ).on( 'blur', '[data-wph-form-editor-option="label"]', function( ){
			var 	$this = $( this ),
					meta_key_prefix = wph_editor.target.container.attr( 'data-wph-meta-key-prefix' ),
					meta_key = $this.closest( '.wph_editor_form_options' ).find( '[data-wph-form-editor-option="meta_key"]' );
			if( ! meta_key.val( ).trim( ) ) meta_key.val( meta_key_prefix + ' ' + $this.val( ) );
		} )
		
		// tray
		//-- clone options
		wph_form_builder.editor.clone_option = function( $this ){
			var option = $this.closest( '.wph_editor_form_option_tray' );
			option.clone( ).insertAfter( option );
		}
		$( '.wph_editor_form_options' ).on( 'click', '.wph_editor_form_option_tray [data-wph-form-editor-button="clone"]', function( ){
			wph_form_builder.editor.clone_option( $( this ) );
		} )

		//-- remove options
		wph_form_builder.editor.remove_option = function( $this ){
			var option = $this.closest( '.wph_editor_form_option_tray' );
			if( option.siblings( '.wph_editor_form_option_tray' ).length )
				option.remove( )
		}
		$( '.wph_editor_form_options' ).on( 'click', '.wph_editor_form_option_tray [data-wph-form-editor-button="delete"]', function( ){
			wph_form_builder.editor.remove_option( $( this ) );		
		} )
		
		// form overall
		//-- submit
		$( '.wph_editor_form_options' ).on( 'click', '.wph_editor_form_options_submit', function( ){
			wph_form_builder.editor.build_element( );
			var $element = $( '.wph_editor_form_options').data( 'wph-form-element-model').$element;
		} )
		//-- delete
		$( '.wph_editor_form_options' ).on( 'click', '.wph_editor_form_delete_element', function( ){
			var modal = confirm( 'Proceed to delete this element?' );
			if( ! modal ) return;
			var $element = $( '.wph_editor_form_options').data( 'wph-form-element-model').$element;
			$element.remove( );
		} )
		//-- duplicate
		$( '.wph_editor_form_options' ).on( 'click', '.wph_editor_form_duplicate_element', function( ){
			var 	$element = $( '.wph_editor_form_options').data( 'wph-form-element-model').$element,
					$element_clone = $element.clone( true, true );
			$element_clone.insertAfter( $element );
		} )
		
		// event listeners
		//-- focus on element
		$( 'body' ).on( 'click', '[data-wph-form-editing="enabled"] .wph_form_element', function( ){
			if( ! $( '.wph_editor_body' ).is( ':visible' ) ){ // init form builder if it has not already been init
				$( '[data-wph-trigger="wph_container_settings"]' ).click( )
			}
			$( '[data-wph-type="Edit Element"]' ).click( );
		} )
		
		//-- element live changes
		function wph_form_live_submit( ){
			$( '.wph_editor_form_options_submit' ).click( );
		};
		$( 'body' ).on( 'keyup click', '.wph_editor_form_option input, .wph_editor_form_option select', wph_form_live_submit );
		
		//-- save settings
		$( 'body' ).on( 'click', '.wph_editor_form_options_save', function( ){
			$( '.wph_editor_save' ).click( );
		} )
		
		// remove focus at init
		$( '.wph_form_editor_focus' ).removeClass( 'wph_form_editor_focus' );

	};
	
	
	// init jQueryUI
	wph_form_builder.init_jquery_ui = function( ){
		
		// draggable
		$( ".wph_editor_form_elements span" ).draggable( {
			connectToSortable: ".wph_form_container[data-wph-form-editing='enabled']",
			helper: "clone"
		} ) 

		// sortable
		$( ".wph_form_container[data-wph-form-editing='enabled']" ).sortable( {
				receive: function( event, ui ){
					$( this ).addClass( 'wph_form_received_element' );
				},
				update: function( event, ui ){
					var 	elment_button = ui.item,
							template_name = elment_button.attr( 'data-wph-editor-form-element' ),
							form = $( this );

					if( form.hasClass( 'wph_form_received_element' ) )
						wph_form_builder.transform_button( form, template_name, elment_button );
					else
						$( '.wph_form_placeholder' ).width( ui.item.outerWidth( ) );

					form.removeClass( 'wph_form_received_element' );

				},
				placeholder : "wph_form_placeholder",
				cancel: ".wph_key_keeper"
		} );

	}

	// transform button to form element
	wph_form_builder.transform_button = function( form, template_name, elment_button ){
		var template = wph_form_element_templates[ template_name ];
		var $new_element = $( '<div class="wph_form_element" data-wph-form-template="' + template_name + '" >' + template + '</div>' );
		$new_element.insertAfter( elment_button );
		elment_button.remove( );
		// uique name attr
		if( template_name === 'radio' || template_name === 'checkbox' ){
			var name = 'wph_name_' + new Date().getTime();
			$new_element.find( 'input' ).each( function( ){ $( this ).attr( 'name', name ) } );
		}
		
		$new_element.click( ); // focus editor on new element
	}

	wph_form_builder.init_jquery_ui( );
	wph_editor.add_action( 'init', wph_form_builder.init_jquery_ui );

} )