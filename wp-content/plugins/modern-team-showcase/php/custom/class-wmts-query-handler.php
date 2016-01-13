<?php
	
	$last_WMTS_Query_Handler_result = false;
	class WMTS_Query_Handler{
		
		function get_posts( $args= array( ) ){
			
			// default query
			if( empty( $args ) ){
				$query_args = array( 'post_type'=> 'modernteammembers', 'posts_per_page'=> '20' );
				apply_filters( 'wmts_query_args', $query_args );
				$the_query = new WP_Query( $query_args );
			
			// user input query
			}else{
				
				$query_args = array(
					'post_type' => empty( $args[ 'post_type' ] ) ? 'modernteammembers' : $args[ 'post_type' ],
					'posts_per_page' => empty( $args[ 'posts_per_page' ] ) ? 10 : $args[ 'posts_per_page' ],
					'pages' => empty( $args[ 'pages' ] ) ? null : $args[ 'pages' ],
					'terms' => empty( $args[ 'terms' ] ) ? null : $args[ 'terms' ],
					'order' => 'ASC',
				);
				
				apply_filters( 'wmts_query_args', $query_args );
				
				if( ! empty( $args[ 'post__in' ] ) ){
					if( ! is_array( $args[ 'post__in' ] ) ) $args[ 'post__in' ] = explode( ',', $args[ 'post__in' ] );
					$query_args[ 'post__in' ] = $args[ 'post__in' ];
				}
				
				// only modernteammembers can be assumed to own MTS Order meta key. Don't want to exclude others from query as well 
				if( is_array( $args[ 'post_type' ] ) && in_array( 'modernteammembers', $args[ 'post_type' ] ) && count( $args[ 'post_type' ] ) == 1 ){
					$query_args[ 'orderby' ] = 'meta_value_num';
					$query_args[ 'meta_key' ] = 'MTS Order';
				}
				
				if( $args[ 'post_type' ] === 'page' ){
					$query_args[ 'post__in' ] = $args[ 'post__in' ];					
				}

				// process custom query
				if( ! empty( $args[ 'additional_args' ] ) ){
					// convert to array
					$args[ 'additional_args' ] = wp_parse_args( $args[ 'additional_args' ] );
					// convert values to array
					foreach( $args[ 'additional_args' ] as $key => $val ){
						$val = trim( $val );
						if( strtolower( substr( $val, 0, 5 ) ) === 'array' ){
							$val_string = substr( $val, 5 );
							$val_array = explode( ',', str_replace( array( '(', ')' ), '', $val_string ) );
							$args[ 'additional_args' ][ $key ] = $val_array;
						}
					}
					$query_args = array_merge( $query_args, $args[ 'additional_args' ] );			
				}

				// tax_query
				if( is_array( $query_args[ 'post_type' ] ) ){
					$query_args[ 'tax_query' ] = array( 'relation' => 'OR' );
					foreach( $query_args[ 'post_type' ] as $post_type ){
						if( $post_type === 'page' ) continue;
						$taxonomies = get_object_taxonomies( $post_type );
						$terms = $query_args[ 'terms' ];
						if( count( $taxonomies ) ){
							foreach( $taxonomies as $tax_slug ){
								$query_args[ 'tax_query' ][ ] = array(
									'taxonomy' => $tax_slug,
									'field' => 'slug',
									'terms' => $terms,
								);
							}
						}
					}
				}
				
				// build query
				$the_query = new WP_Query( $query_args );
				
				// run a separate query on pages if users included them, then merge
				if( is_array( $query_args[ 'post_type' ] ) && in_array( 'page', $query_args[ 'post_type' ] ) ){
					$query_args[ 'post__in' ] = $query_args[ 'pages' ];
					$query_args[ 'post_type' ] = 'page';
					unset( $query_args[ 'tax_query' ] );
					unset( $query_args[ 'terms' ] );
					$page_query = $this->get_posts( $query_args );					

					if( is_object( $page_query ) && is_object( $the_query ) ) // merge if both queries return results
						$the_query->posts = array_merge( $page_query->posts, $the_query->posts );
					if( is_object( $page_query ) && ! is_object( $the_query ) ) // if only page query returns results
						$the_query = $page_query;

				}
				
			}
			
			global $last_WMTS_Query_Handler_result;
			$last_WMTS_Query_Handler_result = $the_query;
			
			return $the_query;
		}

	}

?>