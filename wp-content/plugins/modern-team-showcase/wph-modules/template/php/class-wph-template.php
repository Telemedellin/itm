<?php

class WPH_Template{

	public $template_builder_css;
	public $template_css;

	public $template_builder_js;
	public $font_awesome_json;

	function __construct( $args=array( ) ){
		
		define( 'WPH_Template', TRUE );

		// require php query
		if( ! class_exists( 'phpQuery' ) ) require_once 'phpQuery/phpQuery.php';

		// locate scripts
		//-- css
		$this->template_css = empty( $args[ 'template_css' ] ) ? plugins_url( '../css/wph-template.css', __FILE__ ) : $args[ 'template_css' ];
		//-- js
		$this->template_js = empty( $args[ 'template_js' ] ) ? plugins_url( '../js/wph-template.js', __FILE__ ) : $args[ 'template_js' ];
		$this->font_awesome_json = empty( $args[ 'font_awesome_json' ] ) ? plugins_url( '../js/wph-font-awesome-json.js', __FILE__ ) : $args[ 'font_awesome_json' ];
		// enqueue
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		
		// ajax
		add_action( 'wp_ajax_wph_template', array( $this, 'ajax' ) );

	}

	function load_scripts( ){
		
		if( ! current_user_can( 'manage_options' ) ) return;
		
		// CSS
		
		//-- template
		wp_register_style('wph-template',  $this->template_css );
		wp_enqueue_style( 'wph-template' );

		//-- fontAwesome
		wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		wp_enqueue_style( 'fontawesome' );
		
		// JS
		
		//-- jquery ui
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-droppable' );

		//-- template
		wp_register_script('wph-template',  $this->template_js, array( 'jquery' ) );
		wp_enqueue_script( 'wph-template' );
		
		//-- font awesome
		wp_register_script('wph-font-awesome-json', $this->font_awesome_json, array( 'jquery' ) );
		wp_enqueue_script( 'wph-font-awesome-json' );
		
		// add the settings tab template
		if( ! defined( 'WPH_Template_Settings_Tabs' ) ){
			define( 'WPH_Template_Settings_Tabs', true );
			include_once( 'settings-tabs.php' );
		}

	}
	
	// ajax 
	function ajax( $args= false ){
		
		if( $args ){ // called directly, not ajax
			$echo = false;
			$query = $args[ 'query' ];
			$template = $args[ 'template' ];
			$overall_settings = $args[ 'overall_settings' ];
			$modifier = $args[ 'modifier' ];
			$query_handler = $args[ 'query_handler' ];
			$post_id = $args[ 'post_id' ];
			
		}else{ // called as ajax, fetched vars from $_REQUEST array
			$echo = true;
			$query = $_REQUEST[ 'query' ];
			$template = json_decode( stripslashes( $_REQUEST[ 'template' ] ), true ); // get truncated array otherwise
			$overall_settings = $_REQUEST[ 'overall_settings' ];
			$modifier = $_REQUEST[ 'modifier' ];
			$query_handler = $_REQUEST[ 'query_handler' ];
			$post_id = $_REQUEST[ 'post_id' ];

		}

		$result = array( 'markup'=> $this->return_markup( $query, $query_handler, $template, $modifier, $post_id, $overall_settings ) );
		$result = apply_filters( 'wph_template_output', $result, array( $query, $template, $overall_settings, $modifier, $query_handler, $post_id ) );

		if( $echo ){ // called by ajax
			$result = json_encode( $result );
			echo $result;
			die( );
			
		}else{ // called directly
			return $result;

		}
		
	}
	
	function process_logic( $arr ){
		
		$initial_state = $arr[ 'initial_state' ];
		
		if( empty( $arr[ 'meta_key' ] ) ) return $initial_state;
		
		$meta_key = trim( $arr[ 'meta_key' ] );
		$condition = $arr[ 'condition' ];
		$comparison = $arr[ 'comparison' ];
		$condition_value = ! empty( $arr[ 'value' ] ) ? $arr[ 'value' ] : '';
		$condition_values = explode( '|', $condition_value );
		$action = isset( $arr[ 'action' ] ) ? $arr[ 'action' ] : 'Show';

		if( strpos( $meta_key, '{{' ) !== false ) $post_meta_value = WPH_Template::search_and_process_meta( $meta_key );
		else $post_meta_value = WPH_Template::process_meta( $meta_key );
		
		switch( $condition ){
			case 'Equal to':
				// Any
				if( $comparison === 'Any' ){
					foreach( $condition_values as $value ){
						if( trim( $value ) === $post_meta_value )
							return $action;
					}
				// All
				}else{
					foreach( $condition_values as $value ){
						if( trim( $value ) !== $post_meta_value )
							break 2;
					}
					return $action;
				}
				break;
				
			case 'Unequal to':
				// Any
				if( $comparison === 'Any' ){
					foreach( $condition_values as $value ){
						if( trim( $value ) !== $post_meta_value )
							return $action;
					}
				// All
				}else{
					foreach( $condition_values as $value ){
						if( trim( $value ) === $post_meta_value )
							break 2;
					}
					return $action;
				}
				break;

			case 'Greater than':
				// Any
				if( $comparison === 'Any' ){
					foreach( $condition_values as $value ){
						if( trim( $value ) < $post_meta_value )
							return $action;
					}
				// All
				}else{
					foreach( $condition_values as $value ){
						if( trim( $value ) > $post_meta_value )
							break 2;
					}
					return $action;
				}
				break;
				
			case 'Less than':
				// Any
				if( $comparison === 'Any' ){
					foreach( $condition_values as $value ){
						if( trim( $value ) > $post_meta_value )
							return $action;
					}
				// All
				}else{
					foreach( $condition_values as $value ){
						if( trim( $value ) < $post_meta_value )
							break 2;
					}
					return $action;
				}
				break;
				
			case 'Is set':
				if( ! empty( $post_meta_value ) )
					return $action;
				break;
				
			case 'Is not set':
				if( empty( $post_meta_value ) )
					return $action;
				break;

			case 'Is true':
				if( $post_meta_value === true )
					return $action;
				break;

			case 'Is false':
				if( $post_meta_value === false )
					return $action;
				break;
			
			default:
				return 'unavailable criteria';
		}
		
		// could not qualify criteria
		return $initial_state;
		
	}
	
	function return_markup( $query, $query_handler, $template, $modifier= false, $post_id, $overall_settings ){
		
		// run template modifier
		if( ! empty( $modifier ) && class_exists( $modifier ) ){
			$x = new $modifier( $template );
		}
		
		
		// filter
		$filtering_key = false;
		$filters = array( );
		if( ! empty( $overall_settings[ 'filtering' ] ) && 'Enabled' === $overall_settings[ 'filtering' ] ){
			$overall_settings[ 'filtering_key' ] = trim( $overall_settings[ 'filtering_key' ] );
			if( empty( $overall_settings[ 'filtering_key' ] ) ) $filtering_key = '{{category}}';
			else $filtering_key = $overall_settings[ 'filtering_key' ];
		}
		
		// query
		$query_handler_instance = new $query_handler( );
		$the_query = $query_handler_instance->get_posts( $query );
		
		// loop
		if( $the_query->have_posts( ) ){
			
			$member_template =& $template[ 'sub_elements' ][ 0 ];
			
			$members = '';
			$elm_id = 0; // id of template element
			$css = '<style type="text/css">';
			
			while ( $the_query->have_posts( ) ){
				$the_query->the_post( );

				//filter
				if( $filtering_key ){
					if( strpos( $filtering_key, '{{' ) !== false ) $filter_val = WPH_Template::search_and_process_meta( $filtering_key );
					else $filter_val = WPH_Template::process_meta( $filtering_key );
					
					$member_template[ 'filters' ] = false;
					
					if( $filter_val ){
						if( $filtering_key === '{{category}}' ) $filter_vals = explode( ', ', $filter_val ); // case of comma separated categories
						else $filter_vals = array( $filter_val );
						
						$filter_val_markup = implode( '| ', $filter_vals );
						$member_template[ 'filters' ] = $filter_val_markup;
						
						foreach( $filter_vals as $filter_val ){
							if( ! in_array( $filter_val, $filters ) ){
								$filters[ ] = $filter_val;
							}
						}
					}
				}
				
				// build the member
				$selector_prepend = array( 'container' => '[data-wph-post-id="'. $post_id .'"]', 'parent' => null );
				$member = '';
				$this->traverse_and_build_elements( $member_template, $member, $css, $elm_id, $selector_prepend );
				$members .= $member;


			}

			$css.= '</style>';
			
			// concatenate filter
			if( count( $filters ) ){
				
				// abstracting out the 'ALL' filter
				if( empty( $overall_settings[ 'filtering_all' ] ) ) $overall_settings[ 'filtering_all' ] = 'All';
				$filters_markup = '<span class="wph_filter" data-wph-filter="*">'. $overall_settings[ 'filtering_all' ] .'</span>';
				
				// custom filter order as per user
				if( ! empty( $overall_settings[ 'filtering_details' ] ) ){
					$filtering_details = json_decode( stripslashes( $overall_settings[ 'filtering_details' ] ), true ); // got from ajax
					if( ! is_array( $filtering_details ) ) $filtering_details = json_decode( $overall_settings[ 'filtering_details' ], true ); // coming out of database
					
					$new_filters = array( );
					foreach( $filtering_details as $user_filter ){
						if( in_array( $user_filter[ 'name' ], $filters ) && $user_filter[ 'live' ] ){ // may not be in case of pagination
							$new_filters[ $user_filter[ 'name' ] ] = $user_filter[ 'content' ];
						}
					}
					
					$filters = $new_filters;
					foreach( $filters as $filter_name=> $filter_content ){
						$filters_markup.= '<span class="wph_filter" data-wph-filter="'. $filter_name .'">'. $filter_content .'</span>';
					}
					$filters = $filters_markup;
					
				}else{
					foreach( $filters as $filter ){
						$filters_markup.= '<span class="wph_filter" data-wph-filter="'. $filter .'">'. $filter .'</span>';
					}
					$filters = $filters_markup;
				}

			}else{
				$filters = false;
			}
			
			// pagination
			$pagination = false;
			if( ! empty( $overall_settings[ 'pagination' ] ) && 'Enabled' === $overall_settings[ 'pagination' ] && $the_query->max_num_pages > 1 ){
				
				if( $overall_settings[ 'pagination_type' ] === 'load_more' && $the_query->max_num_pages > $the_query->get( 'paged' ) ){ // load more
					$load_more_string = __( 'Load More' );
					$overall_settings[ 'load_more_text' ] = empty( $overall_settings[ 'load_more_text' ] ) ? false : trim( $overall_settings[ 'load_more_text' ] );
					$overall_settings[ 'load_more_text' ] = ! empty( $overall_settings[ 'load_more_text' ] ) ? $overall_settings[ 'load_more_text' ] : $load_more_string;
					$pagination = '<div class="wph_pagination_load_more" data-wph-paged="' . $the_query->get( 'paged' ) . '">'. $overall_settings[ 'load_more_text' ] .'</div>';
					
				}else if( $overall_settings[ 'pagination_type' ] === 'numbered' ){ // numbered 1, 2, 3 ... 
					$paged = $the_query->get( 'paged' );
					$pagination = paginate_links( array(
						'current' => ! empty( $paged ) ? $paged : 1,
						'prev_text'=> '<i class="fa fa-angle-left"></i>',
						'next_text'=> '<i class="fa fa-angle-right"></i>',
						'total' => $the_query->max_num_pages,
					) );
					
				}
			}
			
			if( $css === '<style type="text/css"></style>' ) $css = '';
			
			$markup = array( 'members'=> $css . $members, 'filters'=> $filters, 'template'=> $template, 'pagination'=> $pagination, 'total'=> $the_query->max_num_pages );
			wp_reset_query( );

			return apply_filters( 'wph_template_markup', $markup );

		}else{
			return array( 'members'=> '', 'filters'=> '' );
		}

	}
	
	// builds the current element template, appends it to parent and recursively builds its children
	function traverse_and_build_elements( &$element_template, &$member, &$css, &$elm_id, $selector_prepend ){

		// logic check
		if( ! empty( $element_template[ 'Logic' ] ) && ! empty( $element_template[ 'Logic' ][ 'enable_logic' ] ) && $element_template[ 'Logic' ][ 'enable_logic' ] == 'Yes' ){
			$logic_result = $this->process_logic( $element_template[ 'Logic' ] );
			if( 'Hide' === $logic_result ) return;
		}

		// build markup
		$element_markup = '';
		if( empty( $element_template[ 'Type' ] ) ) $element_template[ 'Type' ] = 'container';
		$type = ' data-wph-type="'. $element_template[ 'Type' ] .'" ';
		
		$content = empty(  $element_template[ 'Content' ] ) ? '' : $element_template[ 'Content' ][ 'content' ];
		$tag = empty(  $element_template[ 'Content' ] ) ? '' : trim( $element_template[ 'Content' ][ 'tag' ] );
		$tag_html = empty(  $element_template[ 'Content' ] ) ? '' : $element_template[ 'Content' ][ 'tag_html' ] ? trim( $element_template[ 'Content' ][ 'tag_html' ] ) : 'div';
		if( $element_template[ 'Type' ] === 'image'  ){
			$src = empty(  $element_template[ 'Content' ] ) ? '' : $element_template[ 'Content' ][ 'source' ];
			if( ! empty( $element_template[ 'Content' ][ 'lazy_loading' ] ) ){
				$src = "src='about:blank' data-src = '$src' ";
			}else{
				$src = " src = '$src' ";
			}
		}
		$classes = empty(  $element_template[ 'Class' ] ) ? '' : $element_template[ 'Class' ][ 'classes' ];
		$attrs = empty(  $element_template[ 'Attr' ] ) ? '' : htmlentities( stripslashes( $element_template[ 'Attr' ][ 'attrs' ] ) );
		if( ! empty( $element_template[ 'filters' ] ) ) $attrs.= ' data-wph-filter="' . $element_template[ 'filters' ] . '" ';
		$link_url = empty( $element_template[ 'Content' ][ 'link_url' ] ) ? '#' : $element_template[ 'Content' ][ 'link_url' ];
		$link = '';
		$target = '';
		if( ! empty(  $element_template[ 'Attr' ] ) && ( ! empty(  $element_template[ 'Attr' ][ 'link' ] ) || $element_template[ 'Type' ] === 'link' ) ){
			if( $tag === 'a' || $element_template[ 'Type' ] === 'link' || $element_template[ 'Type' ] === 'text' || $element_template[ 'Type' ] === 'HTML' ){
				// text and html elements get an automatic 'a' tag inside them if href is enabled
				$link = " href='". stripslashes( $element_template[ 'Attr' ][ 'link' ] ) ."' ";
			}else{
				$link = " data-wph-href='". stripslashes( $element_template[ 'Attr' ][ 'link' ] ) ."' ";
			}
			if( ! empty(  $element_template[ 'Attr' ] ) && ! empty(  $element_template[ 'Attr' ][ 'target' ] ) ){
				if( $tag === 'a' || $element_template[ 'Type' ] === 'link' || $element_template[ 'Type' ] === 'text' || $element_template[ 'Type' ] === 'HTML' ){
					$target = " target='". stripslashes( $element_template[ 'Attr' ][ 'target' ] ) ."' ";
				}else{
					$target = " data-wph-target='". stripslashes( $element_template[ 'Attr' ][ 'target' ] ) ."' ";
				}
			}
		}
		
		// CSS
		if( empty( $element_template[ 'css-id' ] ) ){ // avoids re-processing template element's CSS for successive members

			$element_template[ 'css-id' ] = ++$elm_id;
			
			if( ! empty ( $element_template[ 'Style' ] ) ){
				
				$css_idle = '';
				$css_hover = '';
				
				foreach( $element_template[ 'Style' ] as $prop => $val ){
					if( ! $val ) continue;
					
					if( $prop == 'css' ){
						$css_idle .= $val;
					}elseif( $prop == 'hover-css' ){
						$css_hover .= $val;
					}else{
						$hover_prefix = substr( $prop, 0, 6 );
						if( $hover_prefix === 'hover-' ){
							$prop = substr( $prop, 6 );
							$css_hover .= "$prop:$val; ";
						}else{
							$css_idle .= "$prop:$val; ";
						}
					}
				}

				if( ! empty( $selector_prepend[ 'parent' ] ) ){
					if( $css_idle !== '' ) $css_idle = "{$selector_prepend[ 'container' ]} {$selector_prepend[ 'parent' ]} [data-wph-elm='$elm_id'] {". $css_idle ."} ";
					if( $css_hover !== '' ) $css_hover = "{$selector_prepend[ 'container' ]} {$selector_prepend[ 'parent' ]}:hover [data-wph-elm='$elm_id'] {". $css_hover ."} ";
				}else{
					if( $css_idle !== '' ) $css_idle = "{$selector_prepend[ 'container' ]} [data-wph-elm='$elm_id'] {". $css_idle ."} ";
					if( $css_hover !== '' ) $css_hover = "{$selector_prepend[ 'container' ]} [data-wph-elm='$elm_id']:hover {". $css_hover ."} ";
				}
				$css .= $css_idle . ' ' .$css_hover;
			}		
		}

		$data_elm_id = " data-wph-elm='". $element_template[ 'css-id' ] ."' ";

		switch( $element_template[ 'Type' ] ){
			case 'text':
				$content = strip_tags( $content );
				if( $link ) $content = "<a class='wph_auto_a' {$link} {$target}>$content</a>";
				$element_markup = "<{$tag} class='wph_element {$classes}' {$type} {$attrs} {$data_elm_id}> {$content}</{$tag}>";
				break;
			case 'HTML':
				if( $link ) $content = "<a class='wph_auto_a' {$link} {$target}>$content</a>";
				$element_markup = "<{$tag_html} class='wph_element {$classes}' {$type} {$attrs} {$data_elm_id}>{$content}</{$tag_html}>";
				break;
			case 'image':
				$element_markup = "<img class='wph_element {$classes}' {$type} {$src} {$attrs} {$link} {$target} {$data_elm_id} />";
				break;
			case 'link':
				$element_markup = "<a class='wph_element {$classes}' {$type} {$attrs} {$target} {$data_elm_id} href='{$link_url}' ><i class='{$element_template[ 'Content' ][ 'link_icon' ]}'></i><span>{$element_template[ 'Content' ][ 'link_text' ]}</span></a>";
				break;
			case 'video':
				$element_markup = "<div class='wph_element {$classes}' {$type} {$attrs} {$link} {$target} {$data_elm_id} >". wp_oembed_get( $element_template[ 'Content' ][ 'video_link' ] ) ."</div>";
				break;
			case 'ribbon':
				$element_markup = "<{$tag_html} class='wph_element {$classes}' {$type} {$attrs} {$link} {$target} {$data_elm_id}>{$content}</{$tag_html}>";
				break;
			case 'container':
				$element_markup = "<{$tag_html} class='wph_element {$classes}' {$type} {$attrs} {$link} {$target} {$data_elm_id}>";
				$close = "</{$tag_html}>";
				break;
			case 'lightbox':
				$element_markup = "<div class='wph_element {$classes}' {$type} {$attrs} {$data_elm_id}>";
				$close = "</div>";
				break;
			case 'attribute':
				$label_span = ! empty( $element_template[ 'Content' ][ 'label_text' ] ) ? "<span>{$element_template[ 'Content' ][ 'label_text' ]}</span>" : "";
				$element_markup = "<div class='wph_element {$classes}' {$type} {$attrs} {$link} {$target} {$data_elm_id}><span data-wph-type='label'><i class='{$element_template[ 'Content' ][ 'label_icon' ]}'></i>{$label_span}</span><span data-wph-type='value'><span>{$element_template[ 'Content' ][ 'value_text' ]}</span><i class='{$element_template[ 'Content' ][ 'value_icon' ]}'></i></span></div>";
				break;
		}

		// parse meta keys / custom fields
		$element_markup =  WPH_Template::search_and_process_meta( $element_markup );
		
		// absorb element markup
		$member .= $element_markup;

		// iterate over sub elements
		if( ! empty( $element_template[ 'sub_elements' ] ) ){
			
			// case of cell level container
			if( empty( $selector_prepend[ 'parent' ] ) && isset( $element_template[ 'Class' ] ) ){ // very top template elm does not have class so it's excluded here
				$selector_prepend[ 'parent' ] = ' ['. $data_elm_id .']'; // no appending space so :hover sticks to it
			}
			
			foreach( $element_template[ 'sub_elements' ] as $key => &$child_element_template ){
				$this->traverse_and_build_elements( $child_element_template, $member, $css, $elm_id, $selector_prepend ); // now the current element becomes the parent to append to
			}
		}
		
		// closes containers
		if( isset( $close ) ) $member .= $close;

	}
	
	// search for {{meta}} and replace with processed values
	public static function search_and_process_meta( $string ){
		$regx = '/{{(.*?)}}/';
		$string = preg_replace_callback( $regx, array( 'WPH_Template', 'process_meta' ), $string);
		return $string;
	}

	public static function process_meta( $mixed ){
		
		if( gettype( $mixed ) !== 'array' ){
			$meta_key = trim( $mixed );
		}else{
			$meta_key = trim( $mixed[1] );
		}
		
		if( empty( $meta_key ) ) return false;
		
		global $post;
		$post_id = $post->ID;
		
		if( 'post_id' === $meta_key ){
			$meta_val = $post_id;
			
		}else if( 'post_title' === $meta_key || 'title' === $meta_key ){
			$meta_val = get_the_title( );
			
		}else if( 'post_link' === $meta_key ){
			$meta_val = get_permalink( );
			
		}else if( 'post_type' === $meta_key ){
			$meta_val = get_post_type( $post );
			
		}else if( 'post_excerpt' === substr( $meta_key, 0, 12 ) ){
			$meta_val = get_the_excerpt( );
			$parts = explode( '|', $meta_key );
			if( ! empty( $parts[ 1 ] ) &&  is_numeric( $parts[ 1 ] ) && ! empty( $meta_val ) ){
				$word_limit = trim( $parts[ 1 ] );
				if( is_numeric( $word_limit ) ){
					$words = explode( " ", $meta_val );
					$meta_val = implode( " ", array_splice( $words, 0, $word_limit ) );
				}
			}
			
		}else if( 'the_content' === $meta_key ){
			$meta_val = the_content( );
			
		}else if( 'content' === substr( $meta_key, 0, 7 ) ){
			$meta_val = get_the_content( );
			$parts = explode( '|', $meta_key );
			if( isset( $parts[ 1 ] ) ){ // word limit is set
				$word_limit = trim( $parts[ 1 ] );
				if( is_numeric( $word_limit ) ){
					$words = explode( " ", $meta_val );
					if( count( $words ) > $word_limit ){
						$words = implode( " ", array_splice( $words, 0, $word_limit ) );
						if( isset( $parts[ 2 ] ) ) $words .= $parts[ 2 ]; // append string is set
						$meta_val = $words;
					}
				}
			}
			
		}else if( 'featured_image' === substr( $meta_key, 0, 14) ){
			$meta_val = false;
			if( has_post_thumbnail( $post_id ) ){
				$parts = explode( '|', $meta_key );
				// get size
				if( isset( $parts[ 1 ] ) ){
					$size = trim( $parts[ 1 ] );
				}else{
					$size = 'medium';
				}
				// get image
				$thumbnail_id = get_post_thumbnail_id( $post_id );
				$meta_val = wp_get_attachment_image_src( $thumbnail_id, $size );
				$alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
//				$meta_val = $meta_val[ 0 ]."' width='". $meta_val[ 1 ] ."' height='". $meta_val[ 2 ] ."' alt='". $alt ."' ";
				$meta_val = $meta_val[ 0 ]."' width='". $meta_val[ 1 ] ."' height='". $meta_val[ 2 ] ."' alt='". $alt ." "; // the quotes have to be weird like this
			}

		}else if( 'author' === $meta_key ){
			$meta_val = get_the_author( );
			
		}else if( 'author_link' === substr( $meta_key, 0, 11 ) ){
			$parts = explode( '|', $meta_key );
			$meta_val = '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author( ) .'</a>';
			if( isset( $parts[ 1 ] ) ){
				if( trim( $parts[ 1 ] ) === 'website' )
					$meta_val = get_the_author_link( );
			}

		}else if( 'comments' === $meta_key ){
			$meta_val = get_comments_number( $post_id );

		}else if( 'category_link' === substr( $meta_key, 0, 13 ) && $post->taxonomy !== 'page' ){
			$arr = explode( '|', $meta_key );
			$separator = ', ';
			if( isset( $arr[ 1 ] ) ) $separator = $arr[ 1 ];
			$meta_val= '';
			$cats = wp_get_post_categories( $post_id );
			if( ! empty( $cats ) ){
				foreach( $cats as $key=> $val ){
					$meta_val.= '<a href="'. get_category_link( $val ) .'">';
					$meta_val.= get_cat_name( $val );
					$meta_val.= '</a>';
					if( ! empty( $cats[ $key + 1 ] ) ) $meta_val.= $separator;
				}
			}else{
				$cats = wp_get_object_terms( $post_id, get_object_taxonomies( $post ) ); // cpt
				foreach( $cats as $key=> $val ){
					$meta_val.= '<a href="'. get_term_link( $val ) .'">';
					$meta_val.= $val->name;
					$meta_val.= '</a>';
					if( ! empty( $cats[ $key + 1 ] ) ) $meta_val.= $separator;
				}				
			}
		}else if( 'category' === substr( $meta_key, 0, 8 ) && get_post_type( $post ) !== 'page' ){
			$arr = explode( '|', $meta_key );
			$separator = ', ';
			if( isset( $arr[ 1 ] ) ) $separator = $arr[ 1 ];
			$meta_val= '';
			$cats = wp_get_post_categories( $post_id );
			if( ! empty( $cats ) ){
				foreach( $cats as $key=> $val ){
					$meta_val.= get_cat_name( $val );
					if( ! empty( $cats[ $key + 1 ] ) ) $meta_val.= $separator;
				}
			}else{
				$cats = wp_get_object_terms( $post_id, get_object_taxonomies( $post ) ); // cpt
				foreach( $cats as $key=> $val ){
					$meta_val.= $val->name;
					if( ! empty( $cats[ $key + 1 ] ) ) $meta_val.= $separator;
				}				
			}
			
		}else if( 'tags_link' === substr( $meta_key, 0, 9 ) && get_post_type( $post ) !== 'page' ){
			$arr = explode( '|', $meta_key );
			$separator = ', ';
			if( isset( $arr[ 1 ] ) ) $separator = $arr[ 1 ];
			$meta_val= '';
			$tags = wp_get_post_tags( $post_id );
			foreach( $tags as $key=> $val ){
				$meta_val.= '<a href="'. get_tag_link( $val ) .'">';
				$meta_val.= $val->name;
				$meta_val.= '</a>';
				if( ! empty( $tags[ $key + 1 ] ) ) $meta_val.= $separator;
			}

		}else if( 'tags' === substr( $meta_key, 0, 4 ) ){
			$arr = explode( '|', $meta_key );
			$separator = ', ';
			if( isset( $arr[ 1 ] ) ) $separator = $arr[ 1 ];
			$meta_val= '';
			$tags = wp_get_post_tags( $post_id );
			foreach( $tags as $key=> $val ){
				$meta_val.= $val->name;
				if( ! empty( $tags[ $key + 1 ] ) ) $meta_val.= $separator;
			}
			
		}else if( 'date_modified' === substr( $meta_key, 0, 13) ){
			$parts = explode( '|', $meta_key );
			if( isset( $parts[ 1 ] ) ){
				$format = trim( $parts[ 1 ] );
			}else{
				$format = 'D, F j, Y';
			}
			$meta_val = get_the_modified_date( $format, $post_id );
			
		}else if( 'date' === substr( $meta_key, 0, 4) ){
			$parts = explode( '|', $meta_key );
			if( isset( $parts[ 1 ] ) ){
				$format = trim( $parts[ 1 ] );
			}else{
				$format = 'D, F j, Y';
			}
			$meta_val = get_the_date( $format, $post_id );
			
		}else if( 'pretty_link' === substr( $meta_key, 0, 11 ) ){
			$parts = explode( '|', $meta_key );
			
			$url = ! empty( $parts[ 1 ] ) ? get_post_meta( $post_id, trim( $parts[ 1 ] ), true ) : 'http://modernteamshowcase.com/';
			
			if( ! filter_var( $url, FILTER_VALIDATE_EMAIL ) ){ // url
				$parse = parse_url( $url );			
				$text = $parse['host'];

			}else{ // email
				$text = $url;
				$url = 'mailto:'. $url;
				
			}

			$target = ! empty( $parts[ 2 ] ) ? trim( $parts[ 2 ] ) : '_blank';
			$meta_val = '<a href="'.$url.'" target="'. $target .'">'. $text .'</a>';
			
		}else{
			
			// value is a meta value / custom field value
			$parts = explode( '|', $meta_key );
			
			if( count( $parts ) > 1 ){ // word limit set, possibly append string too
				$meta_val = get_post_meta( $post_id, trim( $parts[ 0 ] ), true );
				$word_limit = trim( $parts[ 1 ] );

				if( is_numeric( $word_limit ) && ! empty( $meta_val ) ){
					$words = explode( " ", $meta_val );
					if( count( $words ) > $word_limit ){
						$words = implode( " ", array_splice( $words, 0, $word_limit ) );
						if( isset( $parts[ 2 ] ) ) $words .= $parts[ 2 ]; // append string is set
						$meta_val = $words;
					}
				}

			}else{
				$meta_val = get_post_meta( $post_id, $meta_key, true );
			}

		}
		
		// check for json
		if( gettype( $meta_val ) == 'string' ){
			$first = substr( $meta_val, 0, 1 );
			if( $first === '{' || $first === '[' ){
				$decoded_meta = json_decode( $meta_val );
				if( is_array( $decoded_meta ) ) $meta_val = implode( $decoded_meta, ", " );
			}
		}
		
		return $meta_val;
	}
	

}

?>