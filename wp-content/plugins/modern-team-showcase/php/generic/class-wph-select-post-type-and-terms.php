<?php

class WPH_Select_Post_Type_And_Terms{
	
	function __construct( ){
		
		define( 'WPH_Select_Post_Type_And_Terms', true );
		
		add_action( 'wp_footer', array( $this, 'script' ) );
		add_action( 'admin_footer', array( $this, 'script' ) );
		
	}
	
	function script( ){
		if( ! current_user_can( 'manage_options' ) ) return;

?>
		<script  id="WPH_Select_Post_Type_And_Terms" type="text/javascript">
			jQuery( function( $ ){				
				// event listener for change
				var 	$wph_select_post_types = $( ".wph_select_post_types" );	
				$wph_select_post_types.change( wph_select_post_types_changed );
				$wph_select_post_types.change( );
				function wph_select_post_types_changed( e ){
					var 	$this = $( this ),
							$wph_select_terms = $this.siblings( '.wph_select_terms' ).length ? $this.siblings( '.wph_select_terms' ) : $this.parent( ).siblings( ).children( '.wph_select_terms' ),
							$term_options = $wph_select_terms.children( "option" );

//					$term_options.hide( ).attr( "selected", false );
					$term_options.hide( );

					var $selected_post_types = $wph_select_post_types.children( "option" ).filter( ":selected" );
					$selected_post_types.each( function( ){
						var 	$this = $( this ),
								terms = $this.attr( "data-wph-terms" );
						
						if( terms.length ){
							terms = terms.split( ", " );
							$.each( terms, function( i, val ){
								$term_options.filter( "[value="+ val +"]" ).show( );
							} )  
						}
						
					} )					
				}
				
			} )
		</script>
<?php

	}
	
	public $markup = false;
	
	function markup( ){
		if( ! empty( $this->markup ) ) return $this->markup;
		
		global $post;
		$id = $post->ID;

		$output = 'objects';
		$operator = 'and';

		// collect options markup	
		$options_post_type = '';
		$options_terms = '';
		
		// collect terms
		$terms = array( );
		
		// post type loop
		$post_types = get_post_types( array( 'public' => true ), $output, $operator ); 	
		foreach( $post_types  as $post_type ){
			$name = $post_type->name;
			$label = $post_type->label;
			$associated_taxonomies = array_keys( get_object_taxonomies( $name, 'object' ) );
			
			// get terms
			$term_ids = '';
			if( count( $associated_taxonomies ) ){
				$args = array(
						'hide_empty' => false,
					);
				$associated_terms = get_terms( $associated_taxonomies, $args );
				$count = count( $associated_terms );
				if( $count ){
					$last = $count - 1;
					foreach( $associated_terms as $key => $term ){
						$append = ( $key === $last ) ? '' : ', ';
						$term_ids .= $term->term_id . $append;
						$terms[ $term->term_id ] = $term->name;
					}
				}
			}
			
			$options_post_type .= "<option value='$name' data-wph-terms='$term_ids'>$label</option>";
			
		}

		$post_types = '
			<div style="display:inline-block; margin-right: 20px;">
				<strong style="display:block;">Select Post Type:</strong>
				<select size="7" multiple="multiple" class="wph_select_post_types" style=" min-width: 150px;">'.
					$options_post_type
				.'</select>
			</div>
			';
			
		// terms	
		foreach( $terms as $id => $name ){
			$options_terms .= "<option value='$id' style='display:none;'>$name</option>";
		}
		
		$terms = '
			<div style="display:inline-block;">
				<strong style="display:block;">Select Terms:</strong>
				<select size="7" multiple="multiple" class="wph_select_terms" style=" min-width: 150px;">'.
					$options_terms
				.'</select>
			</div>
			';
		
		$this->markup = $post_types . $terms;
		
		return $this->markup;
	}
	
}

?>