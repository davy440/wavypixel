<?php 
function wavypixel_customize_layout_register($wp_customize) {
    // Add section for layout options
    $wp_customize->add_panel(
		'wavypixel_layout_settings', array(
			'title'		=>	__('Layout', 'wavypixel'),
			'priority'	=>	20
		)
	);

    /**
     * Front Page Options
     */
    $wp_customize->add_section('wavypixel_front_layout_options', array(
        'title'        => __('Front Page', 'wavypixel'),
        'priority'     => 30,
        'panel'        => 'wavypixel_layout_settings'
    ));

    $wp_customize->add_setting('wavypixel_front_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
    ));

    $wp_customize->add_control('wavypixel_front_title_enable', array(
        'label'     =>  __('Show Title', 'wavypixel'),
        'type'      =>  'checkbox',
        'section'   =>  'wavypixel_front_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('wavypixel_front_layout_choice', array(
        'default' => 'boxed',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

    // Add Section for Front Page Layout
    $wp_customize->add_control('wavypixel_front_layout_choice', array(
        'label' => __('Select Front Page', 'wavypixel'),
        'description'   =>  __('Settings for the Front Page.<br>Note that it will only work when Home Page is set to a Static Front Page.', 'wavypixel'),
        'section' => 'wavypixel_front_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'wavypixel'),
            'full-width' => __('Full Width', 'wavypixel'),
            'wide-width' => __('Wide Width', 'wavypixel'),
        ),
    ));

    // Add Setting for Front Page Sidebar
    $wp_customize->add_setting('wavypixel_front_sidebar_choice', array(
        'default' => 'right',
        'sanitize_callback' => 'wavypixel_sanitize_radio', // You can add your custom sanitization function here
    ));

    // Add control for Front Page sidebar choice
    $wp_customize->add_control('wavypixel_front_sidebar_choice', array(
        'label' => __('Select Sidebar Layout', 'wavypixel'),
        'section' => 'wavypixel_front_layout_options',
        'type' => 'radio',
        'choices' => array(
            'right' => __('Right Sidebar', 'wavypixel'),
            'none' => __('No Sidebar', 'wavypixel'),
        ),
    ));

    $wp_customize->add_control(
        new wavypixel_Para_Control (
            $wp_customize, 'wavypixel_meta_controls_notice', array(
                'label'     =>  __('Other pages of the website can be controlled from <strong>Page Options</strong> metabox in Edit area of the page.', 'wavypixel'),
                'section'   =>  'wavypixel_front_layout_options',
                'type'      =>  'wavypixel-para',
                'settings'  =>  []
            )
        )
    );

    /**
     * Blog Page Options
     */
    
    $wp_customize->add_section('wavypixel_layout_options', array(
        'title'        => __('Blog', 'wavypixel'),
        'priority'     => 30,
        'panel'        => 'wavypixel_layout_settings'
    ));

    $wp_customize->add_setting('wavypixel_blog_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
    ));

    $wp_customize->add_control('wavypixel_blog_title_enable', array(
        'label'     =>  __('Show Title', 'wavypixel'),
        'type'      =>  'checkbox',
        'section'   =>  'wavypixel_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('wavypixel_blog_layout_choice', array(
        'default' => 'boxed',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('wavypixel_blog_layout_choice', array(
        'label' => __('Select Layout', 'wavypixel'),
        'section' => 'wavypixel_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'wavypixel'),
            'full-width' => __('Full Width', 'wavypixel'),
            'wide-width' => __('Wide Width', 'wavypixel'),
        ),
    ));

    // Add setting for sidebar choice
     $wp_customize->add_setting('wavypixel_sidebar_choice', array(
        'default' => 'right',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

    // Add control for sidebar choice
    $wp_customize->add_control('wavypixel_sidebar_choice', array(
        'label' => __('Select Sidebar Layout', 'wavypixel'),
        'section' => 'wavypixel_layout_options',
        'type' => 'radio',
        'choices' => array(
            'left' => __('Left Sidebar', 'wavypixel'),
            'right' => __('Right Sidebar', 'wavypixel'),
            'dual' => __('Dual Sidebar', 'wavypixel'),
            'none' => __('No Sidebar', 'wavypixel'),
        ),
    ));

    $wp_customize->add_setting('wavypixel_excerpt_length', array(
        'default'   =>  30,
        'sanitize_callback' =>  'wavypixel_sanitize_radio'
    ));

    /**
     * Single Post Page options
     */

     // Section for Single post page controls
     $wp_customize->add_section('wavypixel_single_layout_options', array(
        'title'        => __('Single', 'wavypixel'),
        'priority'     => 30,
        'panel'        => 'wavypixel_layout_settings'
    ));

    $wp_customize->add_setting('wavypixel_single_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
    ));

    $wp_customize->add_control('wavypixel_single_title_enable', array(
        'label'     =>  __('Show Title', 'wavypixel'),
        'type'      =>  'checkbox',
        'section'   =>  'wavypixel_single_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('wavypixel_single_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('wavypixel_single_layout', array(
        'label' => __('Select Layout', 'wavypixel'),
        'section' => 'wavypixel_single_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'wavypixel'),
            'full-width' => __('Full Width', 'wavypixel'),
            'wide-width' => __('Wide Width', 'wavypixel'),
        ),
    ));

    // Add Setting for Archive Page Sidebar
$wp_customize->add_setting('wavypixel_single_sidebar', array(
    'default' => 'right',
    'sanitize_callback' => 'wavypixel_sanitize_radio',
));

// Add control for Archive Page sidebar choice
$wp_customize->add_control('wavypixel_single_sidebar', array(
    'label' => __('Select Sidebar Layout', 'wavypixel'),
    'section' => 'wavypixel_single_layout_options',
    'type' => 'radio',
    'choices' => array(
        'right' => __('Right Sidebar', 'wavypixel'),
        'none' => __('No Sidebar', 'wavypixel'),
    ),
));

/**
 * Archive Page Layout Options
 */

$wp_customize->add_section('wavypixel_archive_layout_options', array(
    'title'        => __('Archive', 'wavypixel'),
    'priority'     => 30,
    'panel'        => 'wavypixel_layout_settings'
));

$wp_customize->add_setting('wavypixel_archive_title_enable', array(
    'default'           =>  '1',
    'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
));

$wp_customize->add_control('wavypixel_archive_title_enable', array(
    'label'     =>  __('Show Title', 'wavypixel'),
    'type'      =>  'checkbox',
    'section'   =>  'wavypixel_archive_layout_options'
));

// Add setting for layout choice
$wp_customize->add_setting('wavypixel_archive_layout_choice', array(
    'default' => 'boxed',
    'sanitize_callback' => 'wavypixel_sanitize_radio',
));

// Add Section for Front Page Layout
$wp_customize->add_control('wavypixel_archive_layout_choice', array(
    'label' => __('Select Archive Page Layout', 'wavypixel'),
    'section' => 'wavypixel_archive_layout_options',
    'type' => 'radio',
    'choices' => array(
        'boxed'  => __('Boxed Layout', 'wavypixel'),
        'full-width'    => __('Full Width', 'wavypixel'),
        'wide-width'    => __('Wide Width', 'wavypixel'),
    ),
));

// Add Setting for Archive Page Sidebar
$wp_customize->add_setting('wavypixel_archive_sidebar_choice', array(
    'default' => 'right',
    'sanitize_callback' => 'wavypixel_sanitize_radio',
));

// Add control for Archive Page sidebar choice
$wp_customize->add_control('wavypixel_archive_sidebar_choice', array(
    'label' => __('Select Sidebar Layout', 'wavypixel'),
    'section' => 'wavypixel_archive_layout_options',
    'type' => 'radio',
    'choices' => array(
        'right' => __('Right Sidebar', 'wavypixel'),
        'none' => __('No Sidebar', 'wavypixel'),
    ),
));

    // Callback function to determine if the sidebar control should be active
     function wavypixel_is_sidebar_control_active($control) {
        // Get the value of the single layout option
        $layout = get_theme_mod('wavypixel_single_layout', 'boxed');
        
        // Return true if the layout is not full-width
        return ($layout !== 'full-width');
    }

    /**
     * search layout
     */ 

    $wp_customize->add_section('wavypixel_search_layout_options', array(
        'title'        => __('Search', 'wavypixel'),
        'priority'     => 30,
        'panel'        => 'wavypixel_layout_settings'
    ));

    $wp_customize->add_setting('wavypixel_search_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
    ));
    
    $wp_customize->add_control('wavypixel_search_title_enable', array(
        'label'     =>  __('Show Title', 'wavypixel'),
        'type'      =>  'checkbox',
        'section'   =>  'wavypixel_search_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('wavypixel_search_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('wavypixel_search_layout', array(
        'label'     => __('Select Layout', 'wavypixel'),
        'section'   => 'wavypixel_search_layout_options',
        'type'      => 'radio',
        'choices'   => array(
            'boxed'         => __('Boxed Layout', 'wavypixel'),
            'full-width'    => __('Full Width', 'wavypixel'),
            'wide-width'    => __('Wide Width', 'wavypixel'),
        ),
    ));

    // sidebar layout for search page
   $wp_customize->add_setting('wavypixel_search_sidebar', array(
        'default' => 'right',
        'sanitize_callback' => 'wavypixel_sanitize_radio',
    ));

     // Add control for Front Page sidebar choice
     $wp_customize->add_control('wavypixel_search_sidebar', array(
        'label' => __('Select Sidebar Layout', 'wavypixel'),
        'section' => 'wavypixel_search_layout_options',
        'type' => 'radio',
        'choices' => array(
            'right' => __('Right Sidebar', 'wavypixel'),
            'none' => __('No Sidebar', 'wavypixel'),
        ),
    ));
}
add_action('customize_register', 'wavypixel_customize_layout_register');
