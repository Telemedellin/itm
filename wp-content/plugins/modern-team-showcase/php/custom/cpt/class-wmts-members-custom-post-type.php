<?php

class WMTS_Members_Custom_Post_Type {

	public $post_type;
	public $plural;
	public $single;
	public $description;
	public $icon_url;

	public function __construct ( $post_type = '', $plural = '', $single = '', $description = '', $icon_url ) {

		if( ! $post_type || ! $plural || ! $single ) return;

		// Post type name and labels
		$this->post_type = $post_type;
		$this->plural = $plural;
		$this->single = $single;
		$this->description = $description;
		$this->icon_url = $icon_url;
		

		// Register post type
		add_action( 'init' , array( $this, 'register_post_type' ) );
		// Register taxonomy
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		
		// Modify taxonomy edit page
//		add_action( "modernteamgroups_add_form_fields", array( $this, 'modify_taxonomy_form' ) );
//		add_action( "modernteamgroups_edit_form", array( $this, 'modify_taxonomy_form' ) );
		
		// Save taxonomy meta
//		add_action( "create_modernteamgroups", array( $this, 'save_taxonomy_custom_meta' ) );
//		add_action( "edited_modernteamgroups", array( $this, 'save_taxonomy_custom_meta' ) );
		

		// Display custom update messages for posts edits
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
		
		//ajax for saving post title
		add_action('wp_ajax_wph_save_title', array( $this, 'save_title'));

	}

	/**
	 * Register new post type
	 * @return void
	 */
	public function register_post_type () {

		$labels = array(
			'name' => $this->plural,
			'singular_name' => $this->single,
			'name_admin_bar' => $this->single,
			'add_new' => __( 'Add New Member', 'modern-team-showcase' ),
			'add_new_item' => __( 'Add New Member' , 'modern-team-showcase' ),
			'edit_item' => sprintf( __( 'Edit %s' , 'modern-team-showcase' ), $this->single ),
			'new_item' => sprintf( __( 'New %s' , 'modern-team-showcase' ), $this->single ),
			'all_items' => __( 'All Members' , 'modern-team-showcase' ),
			'view_item' => sprintf( __( 'View %s' , 'modern-team-showcase' ), $this->single ),
			'search_items' => sprintf( __( 'Search %s' , 'modern-team-showcase' ), $this->plural ),
			'not_found' =>  sprintf( __( 'No %s Found' , 'modern-team-showcase' ), $this->plural ),
			'not_found_in_trash' => sprintf( __( 'No %s Found In Trash' , 'modern-team-showcase' ), $this->plural ),
			'parent_item_colon' => sprintf( __( 'Parent %s' ), $this->single ),
			'menu_name' => $this->plural,
		);

		$args = array(
			'labels' => apply_filters( $this->post_type . '_labels', $labels ),
			'description' => $this->description,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array(
					'slug' => 'profiles', // You can change url slug here
				),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'menu_position' => 5,
			'menu_icon' => $this->icon_url,
		);
		
		if( ! defined( 'WMTS_READY' ) ){
			$ready = get_option( 'wmts_starter' );
			if( ! $ready || strlen( $ready ) < 10 || ! get_option( 'WMTS_on' ) )
				define( 'WMTS_READY', TRUE );
		}
		
		register_post_type( $this->post_type, apply_filters( $this->post_type . '_register_args', $args, $this->post_type ) );
	}
	
	/**
	 * Register taxonomy
	 */
	function register_taxonomy() {
		register_taxonomy(
			'modernteamgroups',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
			'modernteammembers',        //post type name
			array(
				'hierarchical' => true,
				'label' => 'Groups',  //Display name
				'labels' => array(
						'all_items' => __( 'All Groups' ),
						'edit_item' => __( 'Edit Groups' ),
						'view_item' => __( 'View Group' ),
						'update_item' => __( 'Update Group' ),
						'add_new_item' => __( 'Add New Group' ),
						'parent_item' => __( 'Parent Group' ),
						'parent_item_colon' => __( 'Parent Group:' ),
					),
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'groups', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before 
				)
			)  
		);  
		
		register_taxonomy_for_object_type( 'modernteamgroups', 'modernteammembers' );
	}
	
	/**
	 * Modify taxonomy page
	 */	
	 /*
	function modify_taxonomy_form( $taxonomy ){
		
		// get the term's form
		$term_id = $taxonomy->term_id; // get the term id
		$mts_taxonomy_meta = get_option( 'mts_taxonomy_meta', false ); // get mts term meta array		
		// var_export( $mts_taxonomy_meta );
		$term_form_id = -1; // default form id value
		if( ! empty( $mts_taxonomy_meta ) && ! empty( $mts_taxonomy_meta[ $term_id ] ) && ! empty( $mts_taxonomy_meta[ $term_id ][ 'form' ] ) ){
			$term_form_id = $mts_taxonomy_meta[ $term_id ][ 'form' ];
		}

		// get assoc. array of forms with ids
		$args = array(
				'post_type' => 'modernteamforms',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);
		
		// get select markup for forms
		$forms = new WP_Query( $args );
		$form_select = '<select name="mtsform" id="mtsform" class="mtsform" >';
		
		if( $forms->have_posts( ) ){
			
			while ( $forms->have_posts() ) {
				$forms->the_post();				
				// prepare vars
				$title = get_the_title( );
				$id = get_the_id( );
				$selected = ( $id == $term_form_id ) ? 'selected' : '';
				// add an option
				$form_select .= "<option value='$id' $selected > $title </option>";
			}
		}
		$form_select .= '</select>';
	
		?>
		<div class="form-field term-mtsform-wrap">
			<label for="mtsform"><?php _e( 'Associated Form', 'modern-team-showcase' ) ?></label>
			<?php echo $form_select; ?>
		</div>
		<?php
	}
	*/
	
	/**
	 * Save taxonomy custom meta
	 */	
	 /*
	function save_taxonomy_custom_meta( $term_id ){

		if ( isset( $_POST[ 'mtsform' ] ) ) { // only perform if referring to correct form
			
			$mts_taxonomy_meta = get_option( 'mts_taxonomy_meta', false ); // retrieve meta array
			
			if( empty( $mts_taxonomy_meta ) ){ // ensure meta array
				$mts_taxonomy_meta = array( );
			}

			if( empty( $mts_taxonomy_meta[ $term_id ] ) ){ // ensure array for the term exists
				$mts_taxonomy_meta[ $term_id ] = array( );
			}

			$mts_taxonomy_meta[ $term_id ][ 'form' ] = $_POST['mtsform'];
			
			update_option( 'mts_taxonomy_meta', $mts_taxonomy_meta ); // save the option
		}

	}
	*/

	/**
	 * Set up admin messages for post type
	 * @param  array $messages Default message
	 * @return array           Modified messages
	 */
	public function updated_messages ( $messages = array() ) {
	  global $post, $post_ID;

	  $messages[ $this->post_type ] = array(
	    0 => '',
	    1 => sprintf( __( '%1$s updated. %2$sView %3$s%4$s.' , 'modern-team-showcase' ), $this->single, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
	    2 => __( 'Custom field updated.' , 'modern-team-showcase' ),
	    3 => __( 'Custom field deleted.' , 'modern-team-showcase' ),
	    4 => sprintf( __( '%1$s updated.' , 'modern-team-showcase' ), $this->single ),
	    5 => isset( $_GET['revision'] ) ? sprintf( __( '%1$s restored to revision from %2$s.' , 'modern-team-showcase' ), $this->single, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	    6 => sprintf( __( '%1$s published. %2$sView %3$s%4s.' , 'modern-team-showcase' ), $this->single, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
	    7 => sprintf( __( '%1$s saved.' , 'modern-team-showcase' ), $this->single ),
	    8 => sprintf( __( '%1$s submitted. %2$sPreview post%3$s%4$s.' , 'modern-team-showcase' ), $this->single, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', $this->single, '</a>' ),
	    9 => sprintf( __( '%1$s scheduled for: %2$s. %3$sPreview %4$s%5$s.' , 'modern-team-showcase' ), $this->single, '<strong>' . date_i18n( __( 'M j, Y @ G:i' , 'modern-team-showcase' ), strtotime( $post->post_date ) ) . '</strong>', '<a target="_blank" href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
	    10 => sprintf( __( '%1$s draft updated. %2$sPreview %3$s%4$s.' , 'modern-team-showcase' ), $this->single, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', $this->single, '</a>' ),
	  );

	  return $messages;
	}

	/**
	 * Set up bulk admin messages for post type
	 * @param  array  $bulk_messages Default bulk messages
	 * @param  array  $bulk_counts   Counts of selected posts in each status
	 * @return array                Modified messages
	 */
	public function bulk_updated_messages ( $bulk_messages = array(), $bulk_counts = array() ) {

		$bulk_messages[ $this->post_type ] = array(
	        'updated'   => sprintf( _n( '%1$s %2$s updated.', '%1$s %3$s updated.', $bulk_counts['updated'], 'modern-team-showcase' ), $bulk_counts['updated'], $this->single, $this->plural ),
	        'locked'    => sprintf( _n( '%1$s %2$s not updated, somebody is editing it.', '%1$s %3$s not updated, somebody is editing them.', $bulk_counts['locked'], 'modern-team-showcase' ), $bulk_counts['locked'], $this->single, $this->plural ),
	        'deleted'   => sprintf( _n( '%1$s %2$s permanently deleted.', '%1$s %3$s permanently deleted.', $bulk_counts['deleted'], 'modern-team-showcase' ), $bulk_counts['deleted'], $this->single, $this->plural ),
	        'trashed'   => sprintf( _n( '%1$s %2$s moved to the Trash.', '%1$s %3$s moved to the Trash.', $bulk_counts['trashed'], 'modern-team-showcase' ), $bulk_counts['trashed'], $this->single, $this->plural ),
	        'untrashed' => sprintf( _n( '%1$s %2$s restored from the Trash.', '%1$s %3$s restored from the Trash.', $bulk_counts['untrashed'], 'modern-team-showcase' ), $bulk_counts['untrashed'], $this->single, $this->plural ),
	    );

	    return $bulk_messages;
	}
	
	/**
	 * Save title
	 */
	function save_title () {
		$id = $_REQUEST['post-id'];
		$title = $_REQUEST['title'];
		if ($id && $title) {
			wp_update_post(
					array (
					  'ID'            => $id, 
					  'post_title'    => $title,
					  'post_status' => 'publish',
			));

		}
		die( );
	}

}
?>