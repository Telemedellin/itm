<?php
/**
 * Build dummy members
 */
 
if( ! empty( $_REQUEST[ 'wmts_action' ] ) && $_REQUEST[ 'wmts_action' ] === 'add_dummy_members' && ! empty( $_REQUEST[ 'post_type' ] ) && $_REQUEST[ 'post_type' ] === 'modernteammembers' ){
	add_action( 'admin_init', 'wmts_add_dummy_members_and_redirect' );
}

function wmts_add_dummy_members_and_redirect( ){
	wmts_add_dummy_members( );
	
	// don't want this script bad repeated
	wp_redirect( get_site_url( ) .'/wp-admin/edit.php?post_type=modernteammembers' );
	exit;
}

function wmts_add_dummy_members( ){
	
	// add tax term
	wp_insert_term( 'Marketing', 'modernteamgroups' );
	wp_insert_term( 'Finance', 'modernteamgroups' );	
	
	// common member details
	$member_post = array(
		'post_content' => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.",
		'post_name'      => 'john-richmond', // The name (slug) for your post
		'post_title'     => 'John Richmond', // The title of your post.
		'post_status'    => 'publish', // Default 'draft'
		'post_type'      => 'modernteammembers', // Default 'post'.
	);
	
	// different names
	$member_names = array(
		'John Duke',
		'Ella Stonem',
		'Terrance Ross',
		'Mindy Hill',
		'Sarah Walters',
		'Rahul Kumar',
		'Eric Goldstein',
		'Martha Smith',
		'Bruno Dupont',
		'Diana Baker',
	);
	
	// special status
	$special_status = array( 
		'Saboteur',
		'Rogue',
		'Hammer',
		'Damsel',
		'Oracle',
		'Whiz',
		'Knight',
		'Rocker',
		'Italian',
		'Hacker',
	);
	
	// common meta
	$member_metas = array(
		'MTS Job Title' => 'Senior Manager',
		'MTS Description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat',
		'MTS E-mail' => 'john.doe.7@gmail.com',
		'MTS Telephone' => '666 555 999',
		'MTS Location' => 'New York, USA',
		'MTS Website' => 'http://webfixfast.com/',
		'MTS Facebook' => 'http://facebook.com',
		'MTS LinkedIn' => 'http://linkedin.com',
		'MTS Twitter' => 'http://twitter.com',
		'MTS Quote' => 'Et iusto odio dignissimos ducimus qui blanditiis praesentium',
	);

	// inset posts
	foreach( $member_names as $i=> $name ){
		$member_post[ 'post_title' ] = $name;
		$member_post[ 'post_name' ] = str_replace( ' ', '-', strtolower( $name ) );
		$member_post[ 'tax_input' ] = array( 'modernteamgroups'=> array( 'marketing' ) );
		$post_id = wp_insert_post( $member_post );
		wmts_attach_featured_image( $post_id );
		foreach( $member_metas as $key=> $val ){
			update_post_meta( $post_id, $key, $val );
		}
		update_post_meta( $post_id, 'MTS Special Status', $special_status[ $i ] );
		update_post_meta( $post_id, 'MTS Order', $i + 1 );
		$term = $post_id&1? 'Marketing' : 'Finance';
		wp_set_object_terms( $post_id, $term, 'modernteamgroups' );
	}

}

// upload dummy image
function wmts_upload_dummy_image( $post_id ){
	$image_url = plugins_url( ).'/modern-team-showcase/assets/images/dummy-member.jpg';
	$media = media_sideload_image( $image_url, $post_id );
	
	// get the attachment post id
	$args = array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post_status' => 'any',
		'post_parent' => $post_id
	);
	$attachments = get_posts( $args ); // all the attachments of the parent post	
	$attachment_id = 0;
	foreach( $attachments as $attachment ){
		$image = wp_get_attachment_image_src( $attachment->ID, 'full' );
		// determine if in the $media image we created, the string of the URL exists
		if( strpos( $media, $image[0] ) !== false ){
			$attachment_id = $attachment->ID;
			break;
		}
	}
	
	update_option( 'wmts_dummy_attachment_id', $attachment_id );
	return $attachment_id;
};

// attach featured image
function wmts_attach_featured_image( $post_id ){
	
	$attachment_id = get_option( 'wmts_dummy_attachment_id' );
	
	if( ! $attachment_id ){ // first member ever
		$attachment_id = wmts_upload_dummy_image( $post_id );
	}
	
	set_post_thumbnail( $post_id, $attachment_id );	
}

?>