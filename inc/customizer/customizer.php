<?php
/**
 * wavypixel Theme Customizer
 *
 * @package wavypixel
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wavypixel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wavypixel_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wavypixel_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'wavypixel_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wavypixel_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wavypixel_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wavypixel_customize_preview_js() {
	wp_enqueue_script( 'wavypixel-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), wavypixel_VERSION, true );
}
add_action( 'customize_preview_init', 'wavypixel_customize_preview_js' );

require_once wavypixel_PATH . 'inc/customizer/sanitization.php';
require_once wavypixel_PATH . 'inc/customizer/custom_controls.php';
require_once wavypixel_PATH . 'inc/customizer/header.php';
require_once wavypixel_PATH . 'inc/customizer/panel-footer.php';
require_once wavypixel_PATH . 'inc/customizer/fa-style.php';
require_once wavypixel_PATH . 'inc/customizer/featured-post.php';
require_once wavypixel_PATH . 'inc/customizer/featured-post-module2.php';
require_once wavypixel_PATH . 'inc/customizer/blog-style.php';
require_once wavypixel_PATH . 'inc/customizer/post-category.php';