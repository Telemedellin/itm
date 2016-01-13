<div class="wmts_query_panel wmts_panel" data-wph-type="wmts-query">

	<?php 
		$post_types_data_object = new WPH_Get_Post_Type_Taxonomy_And_Terms( );
		$post_types_data = $post_types_data_object->data( );
	?>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Select post types</label>
		<select data-wph-type="post_type" class='wmts_select_post_types' multiple>
			<?php 
				foreach( $post_types_data as $key=> $post_type ){
					$name = $post_type[ 'name' ];
					$label = $post_type[ 'label' ];
					
					$terms = $post_type[ 'terms' ];
					$terms_string = '';
					foreach( $terms as $term_key=> $term ){
						$terms_string .= $term[ 'slug' ];
						if( isset( $terms[ $term_key + 1 ] ) ){
							$terms_string .= ', ';
						}
					}
					
					echo "<option value='$name' data-wmts-terms='$terms_string'>$label</option>";
				}
			?>
		</select>
	</p>
	
	<p class="wph_editor_p wmts_select_pages_container">
		<label class="wph_editor_label">Select pages</label>
		<select data-wph-type="pages" class='wmts_select_pages' multiple style="width: 270px; max-width: 270px;">
			<?php
				$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'page',
					'post_status'      => 'publish',
				);
				$pages_array = get_posts( $args );
				foreach( $pages_array as $page ){
					$id = $page->ID;
					$title = $page->post_title;
					echo "<option value='$id'>[$id] $title</option>";
				}				
				wp_reset_postdata();
			?>
		</select>
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Select terms</label>
		<select data-wph-type="terms" class='wmts_select_terms' multiple>
			<?php 
				$all_terms = array( );
				foreach( $post_types_data as $key=> $post_type ){
					$terms = $post_type[ 'terms' ];
					foreach( $terms as $key=> $term ){
						if( ! in_array( $term[ 'slug' ], $all_terms ) ){
							$all_terms[ $term[ 'slug' ] ] = $term[ 'name' ];
						}
					}
				}
				foreach( $all_terms as $slug=> $name ){
					echo "<option class='wmts_hidden_terms' value='$slug' >$name</option>";
				}
			?>
		</select>
	</p>

	<p class="wph_editor_p">
		<label class="wph_editor_label">Number of posts</label>
		<input data-wph-type="posts_per_page" type="number" style="width: 70px;" placeholder="-1">
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Additional query args</label>
		<input data-wph-type="additional_args">
	</p>

	<p class="wph_editor_p" style="margin-top: 20px;">
		<button class="wmts_get_markup">Apply Settings</button>
		<button class="wph_editor_save_trigger">Save Applied Settings</button>
	</p>

</div>