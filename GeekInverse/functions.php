<?php
/*
 GeekInverse.com 
 Author: Mohamed Makthum Mohamed Ikbal
 

*/
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Geek Inverse only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'geekInverse_setup' ) ) :
/**
 * Geek Inverse setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Geek Inverse 1.0
 */
function geekInverse_setup() {

	/*
	 * Make Geek Inverse available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Geek Inverse, use a find and
	 * replace to change 'geekInverse' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'geekInverse', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', geekInverse_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and  sizes.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'geekInverse-full-width', 1038, 576, true );
	add_image_size('Header-Image', 1000 , 400); 
	add_image_size('post-Image', 255, 328, false); 
	add_image_size('related-post-Image', 372, 255, true); 
	// This theme uses wp_nav_menu() in two locations.
	/*register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'geekInverse' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'geekInverse' ),
	) );*/

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'geekInverse_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // geekInverse_setup
add_action( 'after_setup_theme', 'geekInverse_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Geek Inverse 1.0
 *
 * @return void
 */

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Geek Inverse 1.0
 *
 * @return array An array of WP_Post objects.
 */
/**
 * Register three Geek Inverse widget areas.
 *
 * @since Geek Inverse 1.0
 *
 * @return void
 */
function geekInverse_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	//register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'geekInverse' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'geekInverse' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'geekInverse' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'geekInverse' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'geekInverse' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'geekInverse' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'geekInverse_widgets_init' );

/**
 * Register Lato Google font for Geek Inverse.
 *
 * @since Geek Inverse 1.0
 *
 * @return string
 */
function geekInverse_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'geekInverse' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Geek Inverse 1.0
 *
 * @return void
 */
function geekInverse_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'geekInverse-lato', geekInverse_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'geekInverse-style', get_stylesheet_uri(), array( 'genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'geekInverse-ie', get_template_directory_uri() . '/css/ie.css', array( 'geekInverse-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'geekInverse-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'geekInverse-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'geekInverse-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'geekInverse-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'geekInverse' ),
			'nextText' => __( 'Next', 'geekInverse' )
		) );
	}

	wp_enqueue_script( 'geekInverse-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );
	
	wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.0.1', true );

     wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.0.1', 'all' );

     wp_enqueue_script( 'bootstrap-js' );

     wp_enqueue_style( 'bootstrap-css' );
}
add_action( 'wp_enqueue_scripts', 'geekInverse_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Geek Inverse 1.0
 *
 * @return void
 */
function geekInverse_admin_fonts() {
	wp_enqueue_style( 'geekInverse-lato', geekInverse_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'geekInverse_admin_fonts' );



if ( ! function_exists( 'geekInverse_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Geek Inverse 1.0
 *
 * @return void
 */
function geekInverse_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'geekInverse' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Geek Inverse 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function geekInverse_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'geekInverse_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Geek Inverse 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function geekInverse_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'geekInverse_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Geek Inverse 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function geekInverse_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'geekInverse' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'geekInverse_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

/* Added Custom Menu */
add_action( 'init', 'register_my_menus' );
 
function register_my_menus() {
	register_nav_menus(
		array(
			'Header-nav' => __( 'Header Navigation' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'tertiary-menu' => __( 'Tertiary Menu' )
		)
	);
}


function add_search_to_wp_menu ( $items, $args ) {
	if( 'Header-nav' === $args -> theme_location ) {
$items .= '<li class="menu-item-search">';
$items .= '<form method="get" class="navbar-form navbar-left" action="' . get_bloginfo('home') . '/"><div class="form-group"><input type="text" class="form-control" placeholder="Search"></div></form>';
$items .= '</li>';
	}
return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_theme_support( 'post-thumbnails' );
        if ($post_type == 'Header_Slides'){
            set_post_thumbnail_size( 1200, 500, true ); //portrait
        } else {
            set_post_thumbnail_size( 255, 328, true ); //landscape
        }
		
	
register_post_type('daily-video',
  array(
    'labels'          => make_post_type_labels('Daily Video'),
    'public'          => true,
    'show_ui'         => true,
    'query_var'       => 'daily-video',
    'rewrite'         => array('slug' => 'daily-videos'),
    'hierarchical'    => true,
    'supports'        => array('title'),
 )
);

function make_post_type_labels($singular,$plural=false,$args=array()) {
  if ($plural===false)
    $plural = $singular . 's';
  elseif ($plural===true)
    $plural = $singular;
  $defaults = array(
    'name'               =>_x($plural,'D-Video'),
    'singular_name'      =>_x($singular,'D-Video'),
    'add_new'            =>_x('Add New',$singular),
    'add_new_item'       =>__("Add New $singular"),
    'edit_item'          =>__("Edit $singular"),
    'new_item'           =>__("New $singular"),
    'view_item'          =>__("View $singular"),
    'search_items'       =>__("Search $plural"),
    'not_found'          =>__("No $plural Found"),
    'not_found_in_trash' =>__("No $plural Found in Trash"),
    'parent_item_colon'  =>'',
  );
  return wp_parse_args($args,$defaults);
  }
  
  
  
  add_action( 'add_meta_boxes', 'video_url_box' );
function video_url_box() {
    add_meta_box( 
        'video_url_box',
        __( 'Video url', 'myplugin_textdomain' ),
        'daily_video_url_content',
        'daily-video',
        'advanced',
        'high'
    );
}


function daily_video_url_content( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'daily_video_url_content_nonce' );
	echo '<label for="video_url"></label>';
	echo '<input type="text" id="video_url" name="video_url" placeholder="Enter video url" />';
}


add_action( 'save_post', 'daily_video_url_save' );
function daily_video_url_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( !wp_verify_nonce( $_POST['daily_video_url_content_nonce'], plugin_basename( __FILE__ ) ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	$video_url = $_POST['video_url'];
	update_post_meta( $post_id, 'video_url', $video_url );
}


add_action( 'add_meta_boxes', 'featuredVideo_add_custom_box' );
add_action( 'save_post', 'featuredVideo_save_postdata' );

function featuredVideo_add_custom_box() {
    add_meta_box(  'featuredVideo_sectionid', 'Featured Video', 'featuredVideo_inner_custom_box', 'daily-video', 'side' );
}

function featuredVideo_inner_custom_box( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'featuredVideo_noncename' );
 
    // show featured video if it exists
    echo getFeaturedVideo( $post->ID, 260, 120);   
 
    echo '<h4 style="margin: 10px 0 0 0;">URL [YouTube Only]</h4>';
    echo '<input type="text" id="featuredVideoURL_field" name="featuredVideoURL_field" value="'.get_post_meta($post->ID, 'featuredVideoURL', true).'" style="width: 100%;" />';
}

function getFeaturedVideo($post_id, $width = 680, $height = 360) {
    $featuredVideoURL = get_post_meta($post_id, 'featuredVideoURL', true);
 
    preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $featuredVideoURL, $youTubeMatch);
 
    if ($youTubeMatch[1])
        return '<iframe width="'.$width.'" height="'.$height.'" src="http://ww'.
               'w.youtube.com/embed/'.$youTubeMatch[1].'?rel=0&showinfo=0&cont'.
               'rols=2&autoplay=0&modestbranding=1" frameborder="1" allowfulls'.
               'creen ></iframe>';
    else
        return null;
}




function featuredVideo_save_postdata( $post_id ) {
 
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
 
    // check authorizations
    if ( !wp_verify_nonce( $_POST['featuredVideo_noncename'], plugin_basename( __FILE__ ) ) )
      return;
 
    // update meta/custom field
    update_post_meta( $post_id, 'featuredVideoURL', $_POST['featuredVideoURL_field'] );
	

}



require( get_template_directory() . '/inc/slider/Header_slider_post_type.php' );
// Create Slider Post Type
require( get_template_directory() . '/inc/slider/slider_post_type.php' );
// Create Slider
require( get_template_directory() . '/inc/slider/slider.php' );


	


// Include the Google Analytics Tracking Code (ga.js)
// @ http://code.google.com/apis/analytics/docs/tracking/asyncUsageGuide.html
function google_analytics_tracking_code(){

 ?>

		<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47096835-1', 'geekinverse.com');
  ga('send', 'pageview');

</script>

<?php 
}

// include GA tracking code before the closing head tag
add_action('wp_head', 'google_analytics_tracking_code');

// OR include GA tracking code before the closing body tag
// add_action('wp_footer', 'google_analytics_tracking_code');
// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

add_filter('post_thumbnail_html','add_class_to_thumbnail');
function add_class_to_thumbnail($thumb) {
 $thumb = str_replace('attachment-post-Image wp-post-image', 'img-responsive', $thumb);
return $thumb;
}
