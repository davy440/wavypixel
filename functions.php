<?php
/**
 * wavypixel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wavypixel
 */

if ( ! defined( 'wavypixel_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'wavypixel_VERSION', '1.0.0' );
}

if ( ! defined( 'wavypixel_URL' ) ) {
	define( 'wavypixel_URL', trailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'wavypixel_PATH' ) ) {
	define( 'wavypixel_PATH', trailingslashit( get_template_directory() ) );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wavypixel_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wavypixel, use a find and replace
		* to change 'wavypixel' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wavypixel', get_template_directory() . '/languages' );

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
	// block width support
	add_theme_support( 'align-wide' );
	add_theme_support( 'align-full' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' 	=> esc_html__( 'Primary', 'wavypixel' ),
			'menu-top'	=> esc_html__( 'Top', 'wavypixel' )
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wavypixel_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wavypixel_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wavypixel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wavypixel_content_width', 640 );
}
add_action( 'after_setup_theme', 'wavypixel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wavypixel_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar - Right', 'wavypixel' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar - Left', 'wavypixel' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Area - Header', 'wavypixel' ),
			'id'            => 'header-widget',
			'description'   => esc_html__( 'Widget to add blocks in Header - Widget layout. Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 1', 'wavypixel' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 2', 'wavypixel' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 3 ', 'wavypixel' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 4 ', 'wavypixel' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Footer ', 'wavypixel' ),
			'id'            => 'ad-before-footer',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Main Content ', 'wavypixel' ),
			'id'            => 'ad-before-main-content',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'After Header Content ', 'wavypixel' ),
			'id'            => 'ad-after-header-content',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Left ', 'wavypixel' ),
			'id'            => 'ad-before-content-left',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Center ', 'wavypixel' ),
			'id'            => 'ad-before-content-center',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Right ', 'wavypixel' ),
			'id'            => 'ad-before-content-right',
			'description'   => esc_html__( 'Add widgets here.', 'wavypixel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);	
}
add_action( 'widgets_init', 'wavypixel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wavypixel_scripts() {
	wp_enqueue_style( 'wavypixel-style', get_stylesheet_uri(), array(), wavypixel_VERSION );
	wp_style_add_data( 'wavypixel-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wavypixel-navigation', wavypixel_URL . 'js/navigation.js', array(), wavypixel_VERSION, [ 'strategy' => 'defer' ] );
	wp_enqueue_script( 'wavypixel-main-js', wavypixel_URL . 'js/main.js', array(), wavypixel_VERSION, [ 'strategy' => 'defer' ] );
	wp_enqueue_script( 'wavypixel-slider-js', wavypixel_URL . 'js/swiper.js', array(), wavypixel_VERSION, [ 'strategy' => 'defer' ] );

	wp_enqueue_style( 'wavypixel-main-css', wavypixel_URL . 'theme-styles/css/main.css', array('wp-block-library'), wavypixel_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wavypixel_scripts' );


if ( !function_exists('wavypixel_admin_scripts') ) {
	function wavypixel_admin_scripts() {
		$screen = get_current_screen();
		if ( $screen->id === 'appearance_page_wavypixel_options' ) {
			wp_enqueue_script('wavypixel-theme-page-js', wavypixel_URL . 'js/theme-page.js', array('jquery', 'jquery-ui-tabs'), wavypixel_VERSION, true );
		}
	}
}
add_action('admin_enqueue_scripts', 'wavypixel_admin_scripts');

/**
 * Enqueue scripts and styles for the Customizer
 */
if ( !function_exists('wavypixel_customize_controls_enqueue_scripts') ) {
    function wavypixel_customize_controls_enqueue_scripts() {
        wp_enqueue_script('wavypixel-customize-controls-js', esc_url( wavypixel_URL . 'js/customize_controls.js' ), array('jquery'), wavypixel_VERSION, true );
    }
	add_action('customize_controls_enqueue_scripts', 'wavypixel_customize_controls_enqueue_scripts');
}

/**
 * Implement the Custom Header feature.
 */
require wavypixel_PATH . 'inc/custom-header.php';

/**
 * Add Page Options metabox
 */
require wavypixel_PATH . 'inc/metabox/page-options.php';

/**
 * Custom template tags for this theme.
 */
require wavypixel_PATH . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require wavypixel_PATH . 'inc/template-functions.php';

/**
 * Adding the Theme Page
 */
require wavypixel_PATH . 'inc/theme-page.php';

/**
 * Include the Walker Class
 */
require wavypixel_PATH . 'inc/walker.php';

/**
 * Include the PHP dependent Custom CSS styles
 */
require wavypixel_PATH . 'inc/custom-css.php';

/**
 * Customizer additions.
 */
require wavypixel_PATH . 'inc/customizer/customizer.php';

/**
 * Customizer additions.
 */
require wavypixel_PATH . 'inc/customizer/theme-layout.php';

/**
 * Customizer additions.
 */
require wavypixel_PATH . 'inc/customizer/panel-theme-options.php';

/**
 * Customizer additions.
 */
require wavypixel_PATH . 'inc/customizer/popular-post-widget.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require wavypixel_PATH . 'inc/jetpack.php';
}


function wavypixel_footer_parallax_image() {
    // Check if the 'wavypixel_footer_parallax_effect' setting is enabled
    if (get_theme_mod('wavypixel_footer_parallax_effect')) {
        $styles = '';

        // Generate CSS styles for footer parallax effect
        $styles .= "#footer-widgets {";
        $styles .= "    background-attachment: fixed; /* Adding the parallax effect */";
        $styles .= "}";

        // Add inline styles only if the setting is enabled
        if (!empty($styles)) {
            wp_add_inline_style('wavypixel-main-css', $styles);
        }
    }
}
// Hook the function into the wp_enqueue_scripts action to add inline styles
add_action('wp_enqueue_scripts', 'wavypixel_footer_parallax_image');
	
// Enqueue custom styles based on customizer settings
function wavypixel_customizer_styles() {
    $styles = '';

    // Loop through heading levels and add styles if custom size is set
    for ($i = 1; $i <= 6; $i++) {
        $font_size = get_theme_mod('wavypixel_heading_size_h' . $i);

        if ($font_size) {
            $styles .= "h$i { font-size: {$font_size}px; }";
        }
    }

    // Output custom styles only if settings are applied
    if (!empty($styles)) {
        wp_add_inline_style('wavypixel-main-css', $styles);
    }
}
add_action('wp_enqueue_scripts', 'wavypixel_customizer_styles');
		
	function wavypixel_sticky_sidebar_styles() {
		// Retrieve the value of the 'wavypixel-sticky-sidebar_set' setting from the Customizer
		$sticky_sidebar_enabled = get_theme_mod('wavypixel-sticky-sidebar_set');

		// Check if the sticky sidebar setting is enabled
if ($sticky_sidebar_enabled) {
    $styles = '';

    // Generate CSS styles for sticky sidebar with a media query
    $styles .= "@media (min-width: 968px) {";
    $styles .= "    .theme-sidebar {";
    $styles .= "        position: sticky;";
    $styles .= "        top: 0;";
    $styles .= "        height: fit-content;";
    $styles .= "    }";
    $styles .= "}";

    // Add inline styles only if the setting is enabled
    if (!empty($styles)) {
        wp_add_inline_style('wavypixel-main-css', $styles);
    } 
          }

	}

	// Hook the function into the wp_enqueue_scripts action to add inline styles
	add_action('wp_enqueue_scripts', 'wavypixel_sticky_sidebar_styles');

		
	function wavypixel_excerpt_length($length) {
		if (!is_admin()) {
			// Get the custom excerpt length from the Customizer
			$custom_excerpt_length = get_theme_mod('wavypixel-excerpt_length', 30); // Default length is 30

			// Use the custom excerpt length if available, else use the default
			$length = (int) $custom_excerpt_length;
		}

		return $length;
	}
	add_filter('excerpt_length', 'wavypixel_excerpt_length', 999);

	// add css styles for the customizer fonts
	function wavypixel_customizer_google_fonts_styles() {
		$styles = '';
	
		// Get selected fonts from Customizer settings
		$selected_font = get_theme_mod('wavypixel_selected_font', 'Poppins');
		$selected_font_heading = get_theme_mod('wavypixel_selected_font_heading', 'Poppins');
	
		// Generate CSS for body font family
		$styles .= "body { font-family: '$selected_font', sans-serif; }";
	
		// Generate CSS for heading font family (h1 to h6)
		$styles .= "h1, h2, h3, h4, h5, h6 { font-family: '$selected_font_heading', sans-serif; }";
	
		// Output custom styles only if settings are applied
		if (!empty($styles)) {
			wp_add_inline_style('wavypixel-main-css', $styles);
		}
	}
	add_action('wp_enqueue_scripts', 'wavypixel_customizer_google_fonts_styles');


	function wavypixel_enqueue_selected_fonts() {
		$selected_font = get_theme_mod('wavypixel_selected_font', 'Poppins');
		$selected_font_heading = get_theme_mod('wavypixel_selected_font_heading', 'Poppins');
	
		// Generate the URL for the selected font with font-display: swap
		$font_url = 'https://fonts.googleapis.com/css?family=' . urlencode($selected_font) . ':400&display=swap';
		wp_enqueue_style('selected-google-font', $font_url);
	
		// Generate the URL for the selected heading font with font-display: swap
		$font_url_heading = 'https://fonts.googleapis.com/css?family=' . urlencode($selected_font_heading) . ':400&display=swap';
		wp_enqueue_style('selected-google-font-heading', $font_url_heading);
	}
	add_action('wp_enqueue_scripts', 'wavypixel_enqueue_selected_fonts');
	
	function wavypixel_enqueue_swiper() {
		// Enqueue Swiper JS and CSS
		wp_enqueue_style( 'swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
		wp_enqueue_script( 'swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '5.4.5', true );
	}
	add_action( 'wp_enqueue_scripts', 'wavypixel_enqueue_swiper' );
	