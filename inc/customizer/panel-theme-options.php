<?php
/**
 *  Font Sizes
 *  Google fonts
 *  Excerpt Lenth Controller
 *  Sticky Sidebar
 */ 

function wavypixel_options_settings_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'wavypixel-general-settings', array(
			'title'		=>	__('WavyPixel Options', 'wavypixel'),
			'priority'	=>	20
		)
	);

	// Theme Color Section
	$wp_customize->add_section( 'wavypixel_colors_section', array(
		'title'    => __( 'Theme Color', 'wavypixel' ),
		'priority' => 25,
		'panel'    => 'wavypixel-general-settings', // Associate with the 'wavypixel Options' panel
	) );

	$wp_customize->add_setting( 'wavypixel_theme_color', array(
			'default'	=>	'#fc6239',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wavypixel_theme_color', array(
				'label'		=>	esc_html__('Theme Color', 'wavypixel'),
				'section'	=>	'wavypixel_colors_section',
				'settings'	=>	'wavypixel_theme_color'
			)
		)
	);

	
  // Add a section within the panel for excerpt length
	$wp_customize->add_section( 'wavypixel-general-options-excerpt', array(
		'title'    => __( 'Excerpt Settings', 'wavypixel' ),
		'priority' => 30,
		'panel'    => 'wavypixel-general-settings', // Associate with the 'wavypixel Options' panel
	) );

	// Add a setting for excerpt length
	$wp_customize->add_setting( 'wavypixel-excerpt_length', array(
		'default'           => 20,
		'sanitize_callback' => 'absint', // Ensure it's an integer
	) );

	// Add a control to set the excerpt length
	$wp_customize->add_control( 'wavypixel-excerpt_length', array(
		'label'    => __( 'Excerpt Length', 'wavypixel' ),
		'description'	=>	__('Number of words to show in excerpt', 'wavypixel'),
		'section'  => 'wavypixel-general-options-excerpt',
		'settings' => 'wavypixel-excerpt_length',
		'type'     => 'number',
		'priority' => 10,
	) );

// Add a section within the panel for sticky sidebar
	$wp_customize->add_section( 'wavypixel-sticky-sidebar', array(
		'title'    => __( 'Sticky Sidebar', 'wavypixel' ),
		'priority' => 30,
		'panel'    => 'wavypixel-general-settings', // Associate with the 'General Settings' panel
	) );

// Add a setting for sticky sidebar
	$wp_customize->add_setting( 'wavypixel-sticky-sidebar_set', array(
		'default'           => true,
		'sanitize_callback' => 'wavypixel_sanitize_checkbox', 
	) );

// Add a control to set the excerpt length
	$wp_customize->add_control( 'wavypixel-sticky-sidebar_set_ctrl', array(
		'label'    => __( 'Sticky Sidebar', 'wavypixel' ),
		'section'  => 'wavypixel-sticky-sidebar',
		'settings' => 'wavypixel-sticky-sidebar_set',
		'type'     => 'checkbox',
		'priority' => 10,
	) );

	// Add a section within the panel for sticky sidebar
	$wp_customize->add_section( 'wavypixel-disable-readmore', array(
		'title'    => __( 'Read More', 'wavypixel' ),
		'priority' => 30,
		'panel'    => 'wavypixel-general-settings', // Associate with the 'General Settings' panel
	) );

// Add a setting for sticky sidebar
	$wp_customize->add_setting( 'wavypixel-disable-readmore_set', array(
		'default'           => true,
		'sanitize_callback' => 'wavypixel_sanitize_checkbox', 
	) );

// Add a control to set the excerpt length
	$wp_customize->add_control( 'wavypixel-disable-readmore_set_ctrl', array(
		'label'    => __( 'Read More', 'wavypixel' ),
		'section'  => 'wavypixel-disable-readmore',
		'settings' => 'wavypixel-disable-readmore_set',
		'type'     => 'checkbox',
		'description' => 'Check the box to enable "Read More" button on posts',
		'priority' => 10,
	) );

// Register customizer setting for heading font sizes

    // Add a section for typography settings
    $wp_customize->add_section('wavypixel_heading_typography', array(
        'title' => __('Typography', 'wavypixel'),
        'priority' => 30,
		'panel'   => 'wavypixel-general-settings',
    ));

    // Add settings for each heading level
    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting('wavypixel_heading_size_h' . $i, array(
            'default' => '', // Set your default font size here
            'sanitize_callback' => 'absint', // Ensure value is a positive integer
        ));

        $wp_customize->add_control('wavypixel_heading_size_h' . $i, array(
            'label' => __('Heading ' . $i . ' Font Size (px)', 'wavypixel'),
            'section' => 'wavypixel_heading_typography',
            'type' => 'number',
        ));
    }


// Google fonts
 // Add a section for Google Fonts selection
 $wp_customize->add_section('wavypixel_google_fonts', array(
	'title' => 'Google Fonts',
	'priority' => 30,
	'panel' => 'wavypixel-general-settings'
));

// Fetch the Google Fonts data from the API
$google_fonts_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBdzoIiUKLHx5IAI3dTSym0x16Q3B7qrJc';
$response = wp_remote_get($google_fonts_api_url);

if (!is_wp_error($response)) {
	$body = wp_remote_retrieve_body($response);
	$data = json_decode($body, true);

	if (isset($data['items']) && is_array($data['items'])) {
		$fonts = array();

		// Limit to the top twenty most popular fonts
		$top_twenty_fonts = array_slice($data['items'], 0, 20);

		foreach ($top_twenty_fonts as $font) {
			$font_family = str_replace(' ', '+', $font['family']);
			$fonts[$font_family] = $font['family'];
		}

		// Add setting and control for body text font
		$wp_customize->add_setting('wavypixel_selected_font', array(
			'default' => 'Poppins',
			'sanitize_callback' => 'wavypixel_sanitize_font',
		));

		$wp_customize->add_control('wavypixel_selected_font', array(
			'type' => 'select',
			'section' => 'wavypixel_google_fonts',
			'label' => 'Select a Font for Body Text',
			'description' => 'Select a font for your content',
			'choices' => $fonts,
		));

		// Add setting and control for heading font
		$wp_customize->add_setting('wavypixel_selected_font_heading', array(
			'default' => 'Poppins',
			'sanitize_callback' => 'wavypixel_sanitize_font',
		));

		$wp_customize->add_control('wavypixel_selected_font_heading', array(
			'type' => 'select',
			'section' => 'wavypixel_google_fonts',
			'label' => 'Select a Font for Headings',
			'description' => 'Select a font for your headings',
			'choices' => $fonts,
		));
	}
}

	function wavypixel_enqueue_selected_font() {
		$selected_font = get_theme_mod('wavypixel_selected_font', 'Poppins');
		$selected_font_heading = get_theme_mod('wavypixel_selected_font_heading', 'Poppins');

		// Generate the URL for the selected font with font-display: swap
		$font_url = 'https://fonts.googleapis.com/css?family=' . urlencode($selected_font) . ':400&display=swap';
		wp_enqueue_style('selected-google-font', $font_url);

		// Generate the URL for the selected heading font with font-display: swap
		$font_url_heading = 'https://fonts.googleapis.com/css?family=' . urlencode($selected_font_heading) . ':400&display=swap';
		wp_enqueue_style('selected-google-font-heading', $font_url_heading);
	}
	add_action('wp_enqueue_scripts', 'wavypixel_enqueue_selected_font');

function wavypixel_sanitize_font($input) {
	// Ensure that the input is a valid string (font name)
	return sanitize_text_field($input);
  }
}
add_action('customize_register', 'wavypixel_options_settings_customize_register');
