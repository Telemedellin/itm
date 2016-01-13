jQuery( function( $ ){
	
	if( typeof wph_form !== 'object' ){
		var wph_form = {};
	}
	
	// activate
	wph_form.activate = function( $form ){
		if( ! $form )
			$form = $( '.wph_form_container' ).not( '[data-wph-form-editing="enabled"]' );
		
		if( ! $form.length )  return;
		
		$form.each( function( ){
			var 	$_form = $( this ),
					$submit_button = '[data-wph-form-template="submit"].wph_form_element label:first';
			$_form.on( 'click.wph_form_submit', $submit_button, wph_form.submit );
			wph_form.feed_values( $_form );
			
		} )
	}
	
	// deactivate
	wph_form.deactivate = function( $form ){
		if( ! $form )
			$form = $( '.wph_form_container' ).not( '[data-wph-form-editing="enabled"]' );

		if( ! $form.length )  return;
		
		$form.each( function( ){
			var 	$_form = $( this ),
					$submit_button = '[data-wph-form-template="submit"].wph_form_element label:first';
			$_form.off( 'click.wph_form_submit', $submit_button, wph_form.submit );
		} )
	}
	
	// submit
	wph_form.submit = function( event ){
		var $submit_button = $( this ),
				$form = $submit_button.closest( '.wph_form_container' ),
				form_values = {},
				action = $submit_button.closest( '.wph_form_element' ).attr( 'data-wph-form-element-action' ) || 'Edit',
				action = action === 'Edit' ? $form.attr( 'data-wph-edit-action' ) : $form.attr( 'data-wph-search-action' );
		
		$form.find( '.wph_form_element' ).each( function( ){
			var 	$this = $( this ),
					key = $this.attr( 'data-wph-form-element-meta-key' ),
					template = $this.attr( 'data-wph-form-template' ),
					value = '';

			if( ! key || key.trim( ) === '' ) key = 'MTS ' + $this.find( 'label:first' ).text( );
			
			if( 'checkbox' === template ){
				value = $this.find( 'input:checked' ).map( function( ){
					return $( this ).val( );
				}  ).get( );
			}else if( 'radio' === template ){
				value = $this.find( 'input:checked' ).val( );
			}else if( $.inArray( template, [ 'divider', 'label', 'submit' ] ) !== -1 ){
				return;
			}else{
				value = $this.find( 'input, select, textarea' ).val( );
			}
			
			form_values[ key ] = value;

		} )
		console.log( 'form_values: ', form_values );

		// ajax
		$.ajax( {
			type : "post",
			dataType : "json",
			url : $form.attr( 'data-wph-ajax-url' ),
			beforeSend: function ( ){
				$form.find( '.wph_form_element' ).add( $submit_button ).removeAttr( 'data-wph-form-validation' ).qtip( 'destroy', true );
				$submit_button.text('Submitting...');
			},
			data : {
				'action': action,
				'nonce': $form.attr( 'data-wph-nonce' ),
				'form_values': form_values,
				'form_id': $form.attr( 'data-wph-form-id' ),
				'member_id': $form.attr( 'data-wph-member-id' )
			},
			success: function( response ){
//				console.log( response );
				if( ! response || response.result !=="success" ){
					// validation messages
					var 	text = 'Failed. Re-submit?',
							icon = 'remove',
							issue_count = 0;
					$.each( response[ 'validation issues' ], function( key, message ){
						++issue_count;
						$form.find( '.wph_form_element[ data-wph-form-element-meta-key="'+ key +'" ]' ).each( function( ){
							var $this = $( this );
							$this.attr( 'data-wph-form-validation', 'fail' );
							$this.qtip({
								content: {
									text: message
								},
								style: {
									classes: 'qtip-red'
								},
								position: {
									my: 'bottom left', 
									at: 'top right',
									target: $this.find( 'input, select' )
								}
							})
						} )
					} )
					
					$submit_button.parent( ).attr( 'data-wph-form-validation', 'fail' ).end( )
					.qtip({
						content: {
							text: 'There were '+ issue_count +' validation issues. Hover over marked fields to check issue(s) and re-submit after fixing them.'
						},
						style: {
							classes: 'qtip-red'
						},
						position: {
							my: 'left center',
							at: 'right center'
						}
					}).qtip( 'show' );
										
					
				}else{
					// change submit status
					var 	text = 'Success!',
							icon = 'check';
							
					// also feed the right values to the custom fields table
					var $ct_table = $( '#list-table' );
					if( $ct_table.length ){
						$.each( form_values, function( key, value ){
							var $ct_key = $ct_table.find( '.left input[value="'+ key +'"]' );
							$ct_key.closest( 'td' ).next( 'td' ).find( 'textarea' ).val( value );
						} )
					}
					
				}
				if( ! response.result ) response.result = 'fail';
				$submit_button.attr( 'data-wph-form-validation', response.result ).text( text );
				$form.trigger( 'wph_form_success', [ response ] );
			},
			complete: function( ){
				/*
				wph_editor.stop_loader( $submit_button );
				*/
			}

		} );

	}
	
	// feed values
	wph_form.feed_values = function ( $form, values ){
		if( ! values ){
			var values_json_string = $form.attr( 'data-wph-form-values' );
			if( ! values_json_string || values_json_string.length < 2 ) return;
			values = JSON.parse( values_json_string );
		}
		
		$.each( values, function( key, value ){
			var 	$element = $form.find( '.wph_form_element[data-wph-form-element-meta-key="'+key+'"]' ),
					template = $element.attr( 'data-wph-form-template' );
			
			if( template === 'checkbox' ){
				$checkboxes = $element.find( 'input:checkbox' ).prop( 'checked', false );
				if( value.length ){
					value = JSON.parse( value );
					$.each( value, function( key_, value_ ){
						$checkboxes.filter( '[value="'+value_+'"]' ).prop( 'checked', true );
					} )
				}
			}else if( template === 'radio' ){
				$element.find( 'input:radio[value="'+value+'"]' ).prop( 'checked', true );
			}else{
				$element.find( 'input, select, textarea' ).val( value );
			}
			
		} )
		
	}

	wph_form.activate( );
	
} )