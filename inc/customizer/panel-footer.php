<?php
/*
* Custom Copyright Text
* Enable Additional Footer Menu
* 
*/
function wavypixel_footer_customize_register($wp_customize) {

	$wp_customize->add_panel(
		'wavypixel-footer-panel', array(
			'title'		=>	__('Footer', 'wavypixel'),
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_section(
		'wavypixel-footer-section', array(
			'title'		=>	__('Copyright Text', 'wavypixel'),
			'panel'		=> 'wavypixel-footer-panel',
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_setting(
		'wavypixel-copyright-text', array(
			'sanitize_callback'	=>	'sanitize_text_field', 
			'default'		=>	__('&copy; ','wavypixel').esc_html(get_bloginfo('name')).__(" ", 'wavypixel').date('Y'),
			
		)
	);
	
	$wp_customize->add_control(
		'wavypixel-copyright-text', array(
			  'type' => 'text',
			  'section'		=>	'wavypixel-footer-section',
			  'label' => __( 'Copyright Text','wavypixel' ),
			  'description' => __( 'Enter your own Copyright text. Default Copyright Message is (c) Sitename and Year.','wavypixel' ),
			)	
	);

		
	$wp_customize->add_section(
		'wavypixel-footer-layout', array(
			'title'		=>	__('Footer Layout', 'wavypixel'),
			'panel'		=> 'wavypixel-footer-panel',
			'priority'	=>	20
		)
	);

	 // Add Setting
	 $wp_customize->add_setting( 'wavypixel_footer_column_choice', array(
        'default'           => 'four-columns', // Set default value
        'sanitize_callback' => 'wavypixel_sanitize_select', // Sanitize input
        'transport'         => 'refresh', // How the customizer should update the setting (refresh the page by default)
    ));

    // Add Control
    $wp_customize->add_control( 'wavypixel_footer_column_choice', array(
        'label'       => __( 'Footer Column Layout', 'wavypixel' ),
        'section'     => 'wavypixel-footer-layout',
        'settings'    => 'wavypixel_footer_column_choice',
        'type'        => 'select',
        'choices'     => array(
            'one-column'   => __( 'One Column', 'wavypixel' ),
            'two-columns'  => __( 'Two Columns', 'wavypixel' ),
            'three-columns' => __( 'Three Columns', 'wavypixel' ),
            'four-columns' => __( 'Four Columns', 'wavypixel' ),
        ),
	));


		// Add section for footer settings
		$wp_customize->add_section('wavypixel_footer_section', array(
			'title'    => __('Footer Background Image', 'wavypixel'),
			'priority' => 30,
			'panel'    => 'wavypixel-footer-panel'
		));
		
		// Add setting for footer background image
		$wp_customize->add_setting('wavypixel_footer_background_image', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		));
		
		// Add control for footer background image
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wavypixel_footer_background_image', array(
			'label'    => __('Footer Background Image', 'wavypixel'),
			'section'  => 'wavypixel_footer_section',
			'settings' => 'wavypixel_footer_background_image',
		)));	
				// Add setting for footer background image
			$wp_customize->add_setting('wavypixel_footer_parallax_effect', array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'wavypixel_sanitize_checkbox',
			));

        	$wp_customize->add_control(
	    	   'wavypixel_footer_parallax_enable_ctrl', array(
		 	   'type' => 'checkbox',
			   'settings'       =>  'wavypixel_footer_parallax_effect',
			   'section'        =>  'wavypixel_footer_section',
			   'label'          => __( 'Parallax Effect','wavypixel' ),
			   'description'    => __( 'Click the box if you want to enable parallax effect','wavypixel' ),
			)	
	      );
		
	}

add_action('customize_register','wavypixel_footer_customize_register');