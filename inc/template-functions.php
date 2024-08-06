<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wavypixel
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wavypixel_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wavypixel_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wavypixel_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wavypixel_pingback_header' );

/**
 * Change the excerpt more string
 */


function wavypixel_excerpt_more($more) {
	if (!is_admin()) {
		global $post;

		// Check if the "Disable Read More" setting is enabled
		$enable_read_more = get_theme_mod('wavypixel-disable-readmore_set', true);

		if ($enable_read_more) {
			// Append "Read More" link to excerpt
			$more_link = sprintf(' <br><a class="read-more" href="%s"><span>%s</span></a>',
				esc_url(get_permalink($post->ID)),
				__('Read More', 'wavypixel') // Customize the "Read More" text
			);

			return ' ...' . $more_link;
		} else {
			// Return ellipsis if "Disable Read More" setting is disabled
			return ' ...';
		}
	}

	return $more;
}
add_filter('excerpt_more', 'wavypixel_excerpt_more');

/**
 * Custom Color functionality
 */
function wavypixel_custom_color() {
	$color = get_theme_mod('wavypixel_theme_color', '#336d84');

	$css = '';
	if ($color !== '#336d84') {
		$css .= ":root{--primary-color: {$color}}";
	}
	wp_add_inline_style('wavypixel-main-css', $css);
}
add_action('wp_enqueue_scripts', 'wavypixel_custom_color');