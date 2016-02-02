<?php
/**
 * itm functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package itm
 */

if ( is_plugin_active( 'enhanced-category-pages/enhanced-category-pages.php' ) ) {
    $options = array(
        'labels' => array(
            'not_found' => 'Sin resultados',
            'search_items' => 'Buscar plantilla',
            'add_new_item' => 'Añadir nueva',
            'view_item' => 'Ver Plantilla',
            'edit_item' => 'Editar Plantilla',
        ),
        'label' => 'Plantillas',
        'singular_label' => 'Plantilla',
        'public' => true,
        'show_ui' => true, // UI in admin panel
        '_builtin' => true, // It's a custom post type, not built in
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array("slug" => 'enhancedcategory'), // Permalinks
        'query_var' => 'enhancedcategory', // This goes to the WP_Query schema
        'supports' => array('title','editor','thumbnail','excerpt','custom-fields','comments'), // Let's use custom fields for debugging purposes only
    );

    // Register custom post types
    register_post_type('enhancedcategory', $options);

    if (function_exists('vc_set_default_editor_post_types'))
    {
        vc_set_default_editor_post_types(array(
                'enhancedcategory'
            )
        );
    }
}

/* Portfolio categories new parameter */
function news_categories_settings_field($settings, $value)
{   
    $categories = get_terms('category');
    $dependency = vc_generate_dependencies_attributes($settings);
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    $data .= '<option class="0">Todas</option>';
    foreach($categories as $val)
	{
        $selected = '';
        if ($value!=='' && $val->term_id === $value)
		{
			$selected = ' selected="selected"';
        }
        $data .= '<option class="'.$val->term_id.'" value="'.$val->term_id.'"'.$selected.'>'.$val->name.'</option>';
    }
    $data .= '</select>';

    return $data;
}
add_shortcode_param('news_categories' , 'news_categories_settings_field');

/* VC Grid noticias */
vc_map(
	array(
		"name" => "Grid Noticias",
		"base" => "grid_noticias",
		"category" => "ITM",
		"icon" => get_template_directory_uri()."/images/vc_table.png",
		"params" => array(
			array(
				"type" => "news_categories",
				"holder" => "hidden",
				"heading" => "Categoría",
				"param_name" => "category",
				"description" => "Selecciona la categoría."
			),
			array(
				"type" => "dropdown",
				"holder" => "hidden",
				"class" => "",
				"heading" => "Ordenar por",
				"param_name" => "orderby",
				"value" => array('Seleccione una opción'=>'default', 'Fecha'=>'date', 'ID'=>'ID', 'Titulo'=>'title'),  
				"description" => "Seleccione el campo por el cual desea ordenar."
			),
			array(
				"type" => "dropdown",
				"holder" => "hidden",
				"class" => "",
				"heading" => "Orden",
				"param_name" => "order",
				"value" => array('Seleccione una opción'=>'', 'Ascendente'=>'ASC', 'Descendente'=>'DESC'),
				"description" => "Seleccione el tipo de orden."
			)
		)
	)
);

vc_map(
	array(
		"name" => "Grid Noticias Micrositio",
		"base" => "grid_noticias_micrositio",
		"category" => "ITM",
		"icon" => get_template_directory_uri()."/images/vc_table.png",
		"params" => array(
			array(
				"type" => "news_categories",
				"holder" => "hidden",
				"heading" => "Categoría",
				"param_name" => "category",
				"description" => "Selecciona la categoría."
			),
			array(
				"type" => "dropdown",
				"holder" => "hidden",
				"class" => "",
				"heading" => "Ordenar por",
				"param_name" => "orderby",
				"value" => array('Seleccione una opción'=>'default', 'Fecha'=>'date', 'ID'=>'ID', 'Titulo'=>'title'),  
				"description" => "Seleccione el campo por el cual desea ordenar."
			),
			array(
				"type" => "dropdown",
				"holder" => "hidden",
				"class" => "",
				"heading" => "Orden",
				"param_name" => "order",
				"value" => array('Seleccione una opción'=>'', 'Ascendente'=>'ASC', 'Descendente'=>'DESC'),
				"description" => "Seleccione el tipo de orden."
			)
		)
	)
);
/* END VC Grid noticias */

/* Grid noticias shortcode */
function grid_noticias($atts, $content)
{
    extract(shortcode_atts(array(
		'category'=> '',
		'orderby' => '',
		'order' => ''
	), $atts ) );

    $tax_query = '';

    if($category && $category!='Todas')
	{
        $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $category
            )
		);
    }

    $args = array(
        'post_type' => 'post',
        'orderby' => $orderby,
        'order' => $order,
		'showposts' => 5,
        'tax_query' => $tax_query
    );

    $noticias_posts = new WP_Query($args);

	// Contador de vuelta para el while
	$cont = 0;
	// Inicio de construcción de la grid
	$html = '<div class="ctn__preview-grid">';

    while ($noticias_posts->have_posts()):
        $noticias_posts->the_post();
        $noticias_cat = "";
        if (get_the_terms(get_the_ID(), 'category'))
		{
            $first_item = false;
            foreach (get_the_terms(get_the_ID(), 'category') as $cat)
			{
                if($first_item)
                    $noticias_cat .= " ";

                $first_item = true;
                $noticias_cat .= strtolower(str_replace(" ", "-", $cat->name));
            }
        }

        $noticias_subtitle = get_post_meta(get_the_ID(), '', $single = true);
		$image_class = 'post-thumbnail';

        if (has_post_thumbnail(get_the_ID()))
		{
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_class);
			$image = $image[0];
		}
        else
		{
			$image = get_template_directory_uri() . '/images/no-image.jpg';
        }

		$post_date		= mysql2date('j F Y', get_the_date());
		$post_date		= explode(' ', $post_date);
		$post_date[1]	= ucfirst($post_date[1]);
		$post_date		= join($post_date, " de ");

		if ($cont < 1)
		{
			$html .= '<div class="ctn__preview-grid__primary-col">';
			$html .= '<div class="grid-item">';
			$html .= '<a href="'.get_permalink().'" class="ctn__preview ctn__preview-news">';
			$html .= '<div class="ctn__preview-image" style="background: url('.$image.') no-repeat; background-size: 100%; background-position: center center">';
			$html .= '<img src="'.$image.'" alt="" class="preview-image">';
			$html .= '</div>';
			$html .= '<div class="ctn__preview-title">';
			$html .= '<h2 class="preview-title">'.get_the_title().'</h2>';
			$html .= '</div>';
			$html .= '<div class="ctn__preview-news_date">';
			$html .= '<span class="preview-news_date">'.$post_date.'</span>';
			$html .= '</div>';
			$html .= '</a><!-- ctn__preview -->';
			$html .= '</div><!-- /grid-item -->';
			$html .= '</div>';
			$html .= '<div class="ctn__preview-grid__secondary-col">';
		}
		else
		{
			$html .= '<div class="grid-item">';
			$html .= '<a href="'.get_permalink().'" class="ctn__preview ctn__preview-news">';
			$html .= '<div class="ctn__preview-image" style="background: url('.$image.') no-repeat; background-size: 100%; background-position: center center">';
			$html .= '<img src="'.$image.'" alt="" class="preview-image">';
			$html .= '</div>';
			$html .= '<div class="ctn__preview-title">';
			$html .= '<h2 class="preview-title">'.get_the_title().'</h2>';
			$html .= '</div>';
			$html .= '<div class="ctn__preview-news_date">';
			$html .= '<span class="preview-news_date">'.$post_date.'</span>';
			$html .= '</div>';
			$html .= '</a><!-- ctn__preview -->';
			$html .= '</div><!-- /grid-item -->';
		}

		$cont++;

    endwhile;

	$html .= '</div>';
	$html .= '</div>';

    wp_reset_postdata();

    return $html;
}
add_shortcode("grid_noticias", "grid_noticias");
/* END Grid noticias shortcode */

/* Grid noticias micrositio shortcode */
function grid_noticias_micrositio($atts, $content)
{
    extract(shortcode_atts(array(
		'category'=> '',
		'orderby' => '',
		'order' => ''
	), $atts ) );

    $tax_query = '';

    if($category && $category!='Todas')
	{
        $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $category
            )
		);
    }

    $args = array(
        'post_type' => 'post',
        'orderby' => $orderby,
        'order' => $order,
		'showposts' => 6,
        'tax_query' => $tax_query
    );

    $noticias_posts = new WP_Query($args);

	// Contador de vuelta para el while
	$cont = 0;
	// Inicio de construcción de la grid
	$html = '<div class="ctn__preview-grid">';

    while ($noticias_posts->have_posts()):
        $noticias_posts->the_post();
        $noticias_cat = "";
        if (get_the_terms(get_the_ID(), 'category'))
		{
            $first_item = false;
            foreach (get_the_terms(get_the_ID(), 'category') as $cat)
			{
                if($first_item)
                    $noticias_cat .= " ";

                $first_item = true;
                $noticias_cat .= strtolower(str_replace(" ", "-", $cat->name));
            }
        }

        $noticias_subtitle = get_post_meta(get_the_ID(), '', $single = true);
		$image_class = 'post-thumbnail';

        if (has_post_thumbnail(get_the_ID()))
		{
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_class);
			$image = $image[0];
		}
        else
		{
			$image = get_template_directory_uri() . '/images/no-image.jpg';
        }

		$post_date		= mysql2date('j F Y', get_the_date());
		$post_date		= explode(' ', $post_date);
		$post_date[1]	= ucfirst($post_date[1]);
		$post_date		= join($post_date, " de ");

		$html .= '<div class="grid-item">';
		$html .= '<a href="'.get_permalink().'" class="ctn__preview ctn__preview-news">';
		$html .= '<div class="ctn__preview-image" style="background: url('.$image.') no-repeat; background-size: 100%; background-position: center center">';
		$html .= '<img src="'.$image.'" alt="" class="preview-image">';
		$html .= '</div>';
		$html .= '<div class="ctn__preview-title">';
		$html .= '<h2 class="preview-title">'.get_the_title().'</h2>';
		$html .= '</div>';
		$html .= '<div class="ctn__preview-news_date">';
		$html .= '<span class="preview-news_date">'.$post_date.'</span>';
		$html .= '</div>';
		$html .= '</a><!-- /ctn__preview -->';
		$html .= '</div><!-- /grid-item -->';

    endwhile;

    wp_reset_postdata();

    return $html;
}
add_shortcode("grid_noticias_micrositio", "grid_noticias_micrositio");
/* END Grid noticias micrositio shortcode */
	
function get_ecp_post($category_id = null)
{
	$ecp = new \ecp\Enhanced_Category('', 'ecp_x_category');

	if (is_null($category_id))
	{
		global $ecp_post, $ecp_category;

		$category_id	= get_query_var('cat');
		$ecp_category	= get_category($category_id);
		$ecp_post		= $ecp->get_by_category($category_id);
		$ecp_post		= $ecp_post[0];
	}
	else
	{
		$ecp_category	= get_category($category_id);
		$ecp_post		= $ecp->get_by_category($category_id);
		$ecp_post		= $ecp_post[0];

		return $ecp_post;
	}
}

function get_category_setting($term)
{
	$field		= get_field_object('hereda', $term);
	$hereda		= $field['value'];

	$menu		= null;
	$sidebar	= null;
	$cover		= null;
	$data		= array(
		'menu' => null,
		'sidebar' => null,
		'cover' => null
	);
	
	switch ($hereda)
	{
		case 'si':
			$category	= get_field('categoria', $term);

			$field		= get_field_object('que_hereda', $term);
			$fields		= $field['value'];

			foreach ($fields as $field)
			{
				switch ($field)
				{
					case 'menu':
						$data['menu'] = get_field('menu', $category);
						break;
					case 'sidebar':
						$data['sidebar'] = get_field('sidebar', $category);
						break;
					case 'cover':
						$data['cover'] = (is_bool($cover = get_field('imagen_portada', $category))) ? get_template_directory_uri() . '/images/no-cover.jpg' : $cover;
						break;
				}
			}
			break;
		case false:
		case 'no':
			$data['menu']		= get_field('menu', $term);
			$data['sidebar']	= get_field('sidebar', $term);
			$data['cover']		= (is_bool($cover = get_field('imagen_portada', $term))) ? get_template_directory_uri() . '/images/no-cover.jpg' : $cover;
			break;
	}

	return $data;
}

function get_post_setting($category_id)
{
	$ecpPost	= get_ecp_post($category_id);
	$field		= get_field_object('tipo_de_programa_academico', $ecpPost->ID);
	$tipo		= $field['value'];

	$html 		= "";

	if (!empty($tipo))
	{
		switch ($tipo)
		{
			case 'pregrado':
			case 'posgrado':
				$titulo						= get_field('titulo_otorgado', $ecpPost->ID);
				$registro_calificado 		= get_field('registro_calificado', $ecpPost->ID);
				$codigo_snies 				= get_field('codigo_snies', $ecpPost->ID);
				if ($tipo == 'pregrado')
				{
					$acreditacion_alta_calidad 	= get_field('acreditacion_alta_calidad', $ecpPost->ID);
				}
				else
				{
					$creditos_academicos	 	= get_field('creditos_academicos', $ecpPost->ID);
				}
				$field						= get_field_object('modalidad', $ecpPost->ID);
				$modalidad					= $field['choices'][$field['value'][0]];
				$duracion					= get_field('duracion', $ecpPost->ID);

				$html .= '<div class="ctn__programa-bottom clearfix">';
					$html .= '<dl>';
						$html .= '<dt>Título a otorgar</dt>';
							$html .= '<dd>' . $titulo . '</dd>';
						$html .= '<dt>Registro calificado</dt>';
							$html .= '<dd>' . $registro_calificado . '</dd>';
						$html .= '<dt>Código SNIES</dt>';
							$html .= '<dd>' . $codigo_snies . '</dd>';
						if ($tipo == 'pregrado')
						{
							$html .= '<dt>Acreditación de alta calidad</dt>';
								$html .= '<dd>' . $acreditacion_alta_calidad . '</dd>';
						}
						else
						{
							$html .= '<dt>Créditos académicos</dt>';
								$html .= '<dd>' . $creditos_academicos . '</dd>';
						}
						$html .= '<dt>Modalidad</dt>';
							$html .= '<dd>' . $modalidad . '</dd>';
						$html .= '<dt>Duración</dt>';
							$html .= '<dd>' . $duracion . '</dd>';
					$html .= '</dl>';
				$html .= '</div>';

				break;
			case 'extension':
				$descripcion	= get_field('descripcion', $ecpPost->ID);
				$intensidad		= get_field('intensidad_horaria', $ecpPost->ID);
				$field			= get_field_object('sede', $ecpPost->ID);
				$sede			= $field['choices'][$field['value']];
				$lugar_aula		= get_field('lugar_aula', $ecpPost->ID);
				$field			= get_field_object('ext_tipo_programa', $ecpPost->ID);
				$_tipo			= $field['choices'][$field['value'][0]];

				$html .= '<div class="ctn__programa-bottom clearfix">';
					$html .= '<dl>';
						$html .= '<dt>Descripción</dt>';
							$html .= '<dd>' . $descripcion . '</dd>';
						$html .= '<dt>Intensidad horaria</dt>';
							$html .= '<dd>' . $intensidad . ' horas</dd>';
						$html .= '<dt>Sede</dt>';
							$html .= '<dd>' . $sede . '</dd>';
						$html .= '<dt>Lugar o aula</dt>';
							$html .= '<dd>' . $lugar_aula . '</dd>';
						$html .= '<dt>Tipo de programa</dt>';
							$html .= '<dd>' . $_tipo . '</dd>';
					$html .= '</dl>';
				$html .= '</div>';

				break;
		}
	}

	return $html;
}

function get_class_border($slug)
{
	$class = '';
	switch ($slug)
	{
		case 'facultad-de-artes-y-humanidades':
			$class = ' artes-y-humanidades';
			break;
		case 'facultad-de-ciencias-economicas-y-administrativas':
			$class = ' ciencias-economicas';
			break;
		case 'facultad-de-ciencias-exactas-y-aplicadas':
			$class = ' ciencias-exactas';
			break;
		case 'facultad-de-ingenierias':
			$class = ' ingenierias';
			break;
	}

	return $class;
}

/**
* Funcion para alimentar los search-control en los programas
* Cuando quieres hacer el filtro por una categoria padre que traiga
* sus categorias hijas.
*
* @param parent:  slug es un argumento que indica la categoria padre.
**/
function getProgramasCat()
{
	$content = array();

	if( isset($_POST['parent']) )
	{
		extract($_POST);

		$args = array(
			'type'                     => 'post',
			'child_of'                 => $parent,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 
		);

		$cats = array();
		$categories = array();

		if ($tipo == 'oferta-academica')
		{
			$args['child_of'] = 65;
			foreach (get_categories($args) as $category)
			{
				if (preg_match("[Extensi|Formaci]", $category->name) == true)
				{
					$cats[] = $category->term_id;
				}
			}

			foreach ($cats as $cat)
			{
				$args['child_of'] = $cat;
				$categories = array_merge_recursive($categories, get_categories($args));
			}
		}
		else
			$categories = get_categories($args);

		$cont = 0;
		foreach ($categories as $category)
		{
			$content['result'][$cont]['id'] = $category->term_id;
			$content['result'][$cont]['label'] = $category->name;
			$content['result'][$cont]['value'] = $category->name;
			$content['result'][$cont]['url'] = get_category_link($category->term_id);
			$cont++;
		}

		header('Content-Type: application/json');
		echo json_encode($content);
		die;
	}
}
add_action('wp_ajax_nopriv_getProgramasCat', 'getProgramasCat');
add_action('wp_ajax_getProgramasCat', 'getProgramasCat');

add_action('admin_init', 'admin_category_stuff');
function admin_category_stuff() {
	$template_url = get_bloginfo('template_url');
	wp_register_script('admin_category_stuff_js',$template_url.'/js/admin_category_stuff_js.js');
	wp_enqueue_script('admin_category_stuff_js');
}

if ( ! function_exists( 'itm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function itm_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on itm, use a find and replace
	 * to change 'itm' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'itm', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Menú Principal', 'itm' ),
		'users-menu' => esc_html__( 'Usuarios', 'itm' ),
		'top-bar-menu' => esc_html__( 'Superior', 'itm' ),
		'footer-menu' => esc_html__( 'Pie de página', 'itm' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'itm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // itm_setup
add_action( 'after_setup_theme', 'itm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function itm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'itm_content_width', 640 );
}
add_action( 'after_setup_theme', 'itm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function itm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'itm' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Dirección', 'itm' ),
		'id'            => 'direccion',
		'description'   => 'Espacio para modificar la dirección en el pie de página',
		'before_widget' => '<div id="%1$s" class="ctn__direccion widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'itm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function itm_scripts() {
	wp_enqueue_style( 'itm-style', get_stylesheet_uri() );

	wp_enqueue_script( 'itm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'itm-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151229', true );

	wp_enqueue_script( 'itm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script("jquery-ui-autocomplete");

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'itm_scripts' );

/**
* Skins para los sliders
*/
add_filter('new_royalslider_skins', 'new_royalslider_add_custom_skin', 10, 2);
function new_royalslider_add_custom_skin($skins) {
      $skins['SkinHome'] = array(
           'label' => 'Skin para el slider del home',
           'path' => get_stylesheet_directory_uri() . '/css/slider-home/slider-home.css'  // get_stylesheet_directory_uri returns path to your theme folder
      );
      return $skins;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';