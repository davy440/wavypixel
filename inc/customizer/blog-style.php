<?php
function wavypixel_blog_style_settings_customize_register( $wp_customize ) {
    // Add panel for blog style settings
    $wp_customize->add_panel(
        'wavypixel_blog_style_settings', array(
            'title'    => __( 'Blog Style', 'wavypixel' ),
            'priority' => 30,
        )
    );

    // Add section for blog layout
    $wp_customize->add_section( 'wavypixel_blog_layout_section', array(
        'title'    => __( 'Blog Layout', 'wavypixel' ),
        'priority' => 10,
        'panel'    => 'wavypixel_blog_style_settings',
    ) );

    // Setting and control for blog layout (grid or list)
    $wp_customize->add_setting( 'wavypixel_blog_layout', array(
        'default'           => 'list',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh', // or 'postMessage' if using live preview
    ) );

    $wp_customize->add_control( 'wavypixel_blog_layout_ctrl', array(
        'label'       => __( 'Blog Layout', 'wavypixel' ),
        'description' => __( 'Choose between Classic or Card layout for your blog posts. If you want to use dual sidebar then Card layout is recommended.', 'wavypixel' ),
        'section'     => 'wavypixel_blog_layout_section',
        'settings'    => 'wavypixel_blog_layout',
        'type'        => 'select',
        'choices'     => array(
            'classic' => __( 'Classic', 'wavypixel' ),
            'card' => __( 'Cards', 'wavypixel' ),
        ),
        'priority'    => 10,
    ) );

}

add_action( 'customize_register', 'wavypixel_blog_style_settings_customize_register' );
