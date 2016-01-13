<?php 
/**
 * Special class for collecting form presets
 */

class WPH_Form_Preset_Handler extends WPH_Preset_Handler {
	
	// gather presets from among the form custom posts into an array
	function gather_presets() {
		$presets = array(
			'map'=>array(),
		);
		$offset = 1; // offset caused by string keys. update this while adding more string keys
		$posttype = $this->posttype;
		$query = new WP_Query(array('post_type' => $posttype, 'posts_per_page'=>-1));		

		while ($query->have_posts()) : $query->the_post();
			$title = strtolower( get_the_title( ) );
			if ( strpos( $title, $this->title_needle ) !== false ){ // if the title is marked as preset the proceed
				
				// get the preset HTML
				$preset[ 0 ] = get_post_meta( get_the_ID(), $this->meta_key, true ); // $this->meta_key = "MTS Form Markup";
				
				// get the preset Form Model
				$preset[ 1 ] = get_post_meta( get_the_ID(), 'MTS Form Model JSON', true );

				// add the preset to the array
				$presets[ ] = $preset;
				// now updating the map:
				// clip and trim title - prepare for explosion to extract the hierarchy in the map
				$title = trim( str_replace( $this->title_needle, '', $title ) );
				// exploding - splitting the title into an array
				$exploded = explode( '|', $title );
				// creating an array hierarchy based on pipes
				$presets_map_depth = &$presets['map'];
				foreach( $exploded as $val ) {
					$val = trim( $val );
					if ( ! isset( $presets_map_depth[ $val ] ) ) $presets_map_depth[ $val ] = "";
					$presets_map_depth = &$presets_map_depth[ $val ];
				}
				// add preset position to the map
				$presets_map_depth = count( $presets ) - $offset - 1; // removing offset caused by associative keys and index difference from length
			}
		endwhile;
		wp_reset_postdata();
		return $presets;
	}

}
?>