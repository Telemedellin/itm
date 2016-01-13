<?php


class WPH_Template_Cooker {
	
	function cook( $recipe ){
		$structure = &$recipe->structure; // will be iterated over
		$material = &$recipe->material; // pass the chef all the material beforehand
		$chef = new WPH_Writer(  false, $material );
		$chef->class_prefix = "wph_form_";
		$chef->data_prefix = "data-wph-form-";
		$dinner = array( );

		foreach( $structure as $key=>$elm ){
			if( is_numeric( $key ) ){
				$chef->build( array( $elm ) );
				$dinner[ $elm ] = $chef->flush_html( );
				if( ! empty( $material[ $elm ][ 'label' ] ) ){
					$dinner[ $elm ] = '<label>' . $material[ $elm ][ 'label' ] . '</label>' . $dinner[ $elm ];
				}

			}else{
				$chef->build( array( $key=>$elm ) );
				$dinner[ $key ] = $chef->flush_html( );
				if( ! empty( $material[ $key ][ 'label' ] ) ){
					$dinner[ $key ] = '<label>' . $material[ $key ][ 'label' ] . '</label>' . $dinner[ $key ];
				}
				
			}

		}
		return( json_encode( $dinner, true ) ); // home delivery, no extra charge 

	}
	
	function __construct(  ){
		
	}

}

?>