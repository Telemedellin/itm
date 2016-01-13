<?php

// use after post is established 

class WPH_Get_Post_Type_Taxonomy_And_Terms{
	
	function data( ){
		if( ! empty( $this->markup ) ) return $this->markup;

		$post_types_data = array( );
		
		// post type loop
		$post_types = get_post_types( array( 'public' => true ), 'objects', 'and' ); 	
		foreach( $post_types as $post_type ){
			$name = $post_type->name;
			$label = $post_type->label;
			
			$current_post_type_data = array(
				'name'=> $name,
				'label'=> $label,
				'taxonomies'=> array( ),
				'terms'=> array( ),
			);
			
			// taxonomies
			$taxonomies = get_object_taxonomies( $name, 'objects' );
			if( count( $taxonomies ) ){
				foreach( $taxonomies as $taxonomy => $taxonomy_object ){
					$current_taxonomy_data = array(
						'name'=> $taxonomy,
						'label'=> $taxonomy_object->labels->name,
					);
					$current_post_type_data[ 'taxonomies' ][ ] = $current_taxonomy_data;
				}
			}
			
			
			// terms
			$terms = get_terms( get_object_taxonomies( $name, 'names' ), array( 'hide_empty'=> false ) );
			if( count( $terms ) ){
				foreach( $terms as $key => $term_object ){
					$current_term_data = array(
						'term_id'=> $term_object->term_id,
						'name'=> $term_object->name,
						'slug'=> $term_object->slug,
					);
					$current_post_type_data[ 'terms' ][ ] = $current_term_data;
				}
			}

			$post_types_data[ ] = $current_post_type_data;
		}
		
		return $post_types_data;
	}
	
}

?>