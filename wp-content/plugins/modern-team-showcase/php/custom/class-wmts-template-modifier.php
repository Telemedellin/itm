<?php
/**
 * Modifies the member template applying MTS conventions before it is processed
 */
class WMTS_Template_Modifier{
	
	function __construct( &$template ){
		
		$this->iterator( $template );
		
		// targeting member containers
		if( ! isset( $template[ 'sub_elements' ] ) ) return;
		foreach( $template[ 'sub_elements' ] as &$member ){
			$member[ 'Class' ][ 'classes' ] .= ' wmts_member ';
		}
	}
	
	function iterator( &$template ){
		if( isset( $template[ 'Class' ] ) ){
			$template[ 'Class' ][ 'classes' ] .= ' wmts_element ';
		}
		
		if( isset( $template[ 'Type' ] ) ){
			if( 'lightbox' === $template[ 'Type' ] ){
				$template[ 'Class' ][ 'classes' ] .= ' wmts_lightbox ';
				// setup its image for lazy load
				if( isset( $template[ 'sub_elements' ] ) ){
					foreach( $template[ 'sub_elements' ] as &$sub_element ){
						// check if image centering container
						if( $sub_element[ 'Type' ] == 'container' && strpos( $sub_element[ 'Class' ][ 'classes' ], 'wmts_image_centering' ) !== false ){
							if( isset( $sub_element[ 'sub_elements' ] ) ){
								// locate image
								foreach( $sub_element[ 'sub_elements' ] as &$sub_sub_element ){
									if( $sub_sub_element[ 'Type' ] == 'image' ){
										$src = isset( $sub_sub_element[ 'Content' ][ 'source' ] ) ? $sub_sub_element[ 'Content' ][ 'source' ] : '';
										// place new source
										$sub_sub_element[ 'Content' ][ 'source' ] = 'about:blank';
										$sub_sub_element[ 'Attr' ][ 'attrs' ] .= " data-wmts-lazysrc='". $src ."' ";
									}
								}
							}
						}
					}
				}
			}
			
			if( 'ribbon' === $template[ 'Type' ] ){
				$template[ 'Class' ][ 'classes' ] .= ' wmts_ribbon ';
			}

			if( 'attribute' === $template[ 'Type' ] ){
				$template[ 'Class' ][ 'classes' ] .= ' wmts_attribute ';
			}
		}
		
		if( isset( $template[ 'sub_elements' ] ) ){
			foreach( $template[ 'sub_elements' ] as &$element ){
				$this->iterator( $element );
			}
		}
	}

}
?>