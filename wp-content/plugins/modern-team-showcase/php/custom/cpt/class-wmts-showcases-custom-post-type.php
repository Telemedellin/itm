<?php

class WMTS_Showcases_Custom_Post_Type {

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
		

		// Regsiter post type
		add_action( 'init' , array( $this, 'register_post_type' ) );

		// Display custom update messages for posts edits
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
		
		//ajax for saving post title
		add_action('wp_ajax_wph_save_title', array( $this, 'save_title'));
		
		// Add sub menus
		add_action( 'admin_menu' , array( $this, 'add_sub_menus'));

		// modify screen layout
		add_filter( 'get_user_option_screen_layout_modernteamshowcases', array( $this, 'set_screen_layout_columns' ) );

	}
	
	function set_screen_layout_columns( ){
		return 1;
	}

	// add new member
	function add_sub_menus( ){
		
		$parent_menu_slug = 'edit.php?post_type=modernteamshowcases';
		$capability = 'manage_options';
		
		// members
		$submenu_page_title = __( 'All Members', 'modern-team-showcase' );
		$submenu_title = __( 'All Members', 'modern-team-showcase' );
		$submenu_slug = 'edit.php?post_type=modernteammembers';
		add_submenu_page( $parent_menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug );
		
		// add new members
		$submenu_page_title = __( 'Add New Member', 'modern-team-showcase' );
		$submenu_title = __( 'Add New Member', 'modern-team-showcase' );
		$submenu_slug = 'post-new.php?post_type=modernteammembers';
		add_submenu_page( $parent_menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug );
		
		// manage groups
		$submenu_page_title = __( 'Manage Groups', 'modern-team-showcase' );
		$submenu_title = __( 'Manage Groups', 'modern-team-showcase' );
		$submenu_slug = 'edit-tags.php?taxonomy=modernteamgroups';
		add_submenu_page( $parent_menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug );

		// forms
		$submenu_page_title = __( 'All Forms', 'modern-team-showcase' );
		$submenu_title = __( 'All Forms', 'modern-team-showcase' );
		$submenu_slug = 'edit.php?post_type=modernteamforms';
		add_submenu_page( $parent_menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug );
		
		// add new forms
		$submenu_page_title = __( 'Build New Forms', 'modern-team-showcase' );
		$submenu_title = __( 'Build New Form', 'modern-team-showcase' );
		$submenu_slug = 'post-new.php?post_type=modernteamforms';
		add_submenu_page( $parent_menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug );
	}

	/**
	 * Register new post type
	 * @return void
	 */
	public function register_post_type () {

		$labels = array(
			'name' => $this->plural,
			'singular_name' => $this->single,
			'name_admin_bar' => __( 'Team Showcase', 'modern-team-showcase' ),
			'add_new' => __( 'Build New Showcase', 'modern-team-showcase' ),
			'add_new_item' => __( 'Build New Showcase' , 'modern-team-showcase' ),
			'edit_item' => sprintf( __( 'Edit %s' , 'modern-team-showcase' ), $this->single ),
			'new_item' => sprintf( __( 'New %s' , 'modern-team-showcase' ), $this->single ),
			'all_items' => __( 'All Showcases' , 'modern-team-showcase' ),
			'view_item' => sprintf( __( 'View %s' , 'modern-team-showcase' ), $this->single ),
			'search_items' => sprintf( __( 'Search %s' , 'modern-team-showcase' ), $this->plural ),
			'not_found' =>  sprintf( __( 'No %s Found' , 'modern-team-showcase' ), $this->plural ),
			'not_found_in_trash' => sprintf( __( 'No %s Found In Trash' , 'modern-team-showcase' ), $this->plural ),
			'parent_item_colon' => sprintf( __( 'Parent %s' ), $this->single ),
			'menu_name' => $this->single,
		);

		$args = array(
			'labels' => apply_filters( $this->post_type . '_labels', $labels ),
			'description' => $this->description,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'supports' => array( 'title' ),
			'menu_position' => 5,
			'menu_icon' => $this->icon_url,
			'rewrite' => array(
							'slug' => 'team-showcase' // You can change url slug here
						)
		);

		register_post_type( $this->post_type, apply_filters( $this->post_type . '_register_args', $args, $this->post_type ) );
	}

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