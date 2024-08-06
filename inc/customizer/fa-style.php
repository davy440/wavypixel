<?php
function wavypixel_fa_style_settings_customize_register( $wp_customize ) {
    // Add panel for featured posts settings
    $wp_customize->add_panel(
        'wavypixel-fa-style-settings', array(
            'title'    => __( 'Featured Posts', 'wavypixel' ),
            'priority' => 20
        )
    );

    // Add section for featured area within the panel
    $wp_customize->add_section( 'wavypixel_fa-style_section', array(
        'title'    => __( 'Featured Area', 'wavypixel' ),
        'priority' => 25,
        'panel'    => 'wavypixel-fa-style-settings',
    ) );

    // Setting and control for the featured posts checkbox
    $wp_customize->add_setting( 'wavypixel_fa-style', array(
        'sanitize_callback' => 'wavypixel_sanitize_checkbox',
        'transport'         => 'refresh', // or 'postMessage' if using live preview
    ) );

    $wp_customize->add_control( 'wavypixel_fa-style_ctrl', array(
        'label'       => __( 'Featured Posts Area', 'wavypixel' ),
        'description' => __( 'This area controls your featured posts section', 'wavypixel' ),
        'section'     => 'wavypixel_fa-style_section',
        'settings'    => 'wavypixel_fa-style',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // Setting and control for the featured area title textbox
    $wp_customize->add_setting( 'wavypixel_fa-title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh', // or 'postMessage'
    ) );

    $wp_customize->add_control( 'wavypixel_fa-title_ctrl', array(
        'label'       => __( 'Featured Posts Area Title', 'wavypixel' ),
        'description' => __( 'Modify Your Title From Here', 'wavypixel' ),
        'section'     => 'wavypixel_fa-style_section',
        'settings'    => 'wavypixel_fa-title',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // Setting and control for the category selection dropdown
    $wp_customize->add_setting( 'wavypixel_fa-category', array(
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh', // or 'postMessage'
    ) );

    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'wavypixel_fa-category_ctrl',
            array(
                'label'       => __( 'Featured Posts Category', 'wavypixel' ),
                'description' => __( 'Select the category for the featured posts', 'wavypixel' ),
                'section'     => 'wavypixel_fa-style_section',
                'settings'    => 'wavypixel_fa-category',
                'priority'    => 30,
            )
        )
    );

        // Function to retrieve categories as options for the dropdown
        function wavypixel_get_categories_dropdown() {
            $categories = get_categories();
            $options = array();
            foreach ( $categories as $category ) {
                $options[$category->term_id] = $category->name;
            }
            return $options;
        }

         // Add setting for post order
         $wp_customize->add_setting( 'wavypixel_fa-style_width', array(
            'default'           => 'Full',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_fa-style_width', array(
            'label'   => esc_html__( 'Featured Posts Width', 'wavypixel' ),
            'section' => 'wavypixel_fa-style_section',
            'type'    => 'select',
            'choices' => array(
                'full-width' => esc_html__( 'Full Width', 'wavypixel' ),
                'boxed'  => esc_html__( 'Boxed Width', 'wavypixel' ),
                'wide-width'  => esc_html__( 'Wide Width', 'wavypixel' ),
               
            ),
        ));
 
        // Add section for featured posts slider
        $wp_customize->add_section( 'wavypixel_featured_posts_slider', array(
            'title'    => esc_html__( 'Featured Posts Slider', 'wavypixel' ),
            'priority' => 35,
            'panel'    => 'wavypixel-fa-style-settings', // Associate with the 'wavypixel Options' panel
        ));
    
        // Add setting for number of posts
        $wp_customize->add_setting( 'wavypixel_featured_posts_slider_number', array(
            'default'           => 4,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_featured_posts_slider_number', array(
            'label'       => esc_html__( 'Number of Posts', 'wavypixel' ),
            'section'     => 'wavypixel_featured_posts_slider',
            'type'        => 'number',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 10,
                'step'  => 1,
            ),
        ));
    
        // Add setting for post category
        $wp_customize->add_setting( 'wavypixel_featured_posts_slider_category', array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_featured_posts_slider_category', array(
            'label'    => esc_html__( 'Category', 'wavypixel' ),
            'section'  => 'wavypixel_featured_posts_slider',
            'type'     => 'select',
            'choices'  => wavypixel_get_categories_dropdown(), // Call the function to retrieve categories
        ));
    
        // Add setting for post order
        $wp_customize->add_setting( 'wavypixel_featured_posts_slider_order', array(
            'default'           => 'DESC',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_featured_posts_slider_order', array(
            'label'   => esc_html__( 'Post Order', 'wavypixel' ),
            'section' => 'wavypixel_featured_posts_slider',
            'type'    => 'select',
            'choices' => array(
                'DESC' => esc_html__( 'Descending', 'wavypixel' ),
                'ASC'  => esc_html__( 'Ascending', 'wavypixel' ),
            ),
        ));

        
         // Add setting for post order
         $wp_customize->add_setting( 'wavypixel_featured_posts_slider_width', array(
            'default'           => 'Full',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_featured_posts_slider_width', array(
            'label'   => esc_html__( 'Slider Width', 'wavypixel' ),
            'section' => 'wavypixel_featured_posts_slider',
            'type'    => 'select',
            'choices' => array(
                'full-width' => esc_html__( 'Full Width', 'wavypixel' ),
                'boxed'  => esc_html__( 'Boxed Width', 'wavypixel' ),
                'wide-width'  => esc_html__( 'Wide Width', 'wavypixel' ),
               
            ),
        ));

        
        // Add section for featured area within the panel
        $wp_customize->add_section( 'wavypixel_featured_posts_widgets_before_content_width', array(
            'title'    => __( 'Widgets Before Main Content Width', 'wavypixel' ),
            'priority' => 25,
            'panel'    => 'wavypixel-fa-style-settings',
        ) );

          // Add setting for post order
          $wp_customize->add_setting( 'wavypixel_featured_posts_widgets_before_content_width', array(
            'default'           => 'Full',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'wavypixel_featured_posts_widgets_before_content_width', array(
            'label'   => esc_html__( 'Widgets Before Main Content Width', 'wavypixel' ),
            'section' => 'wavypixel_featured_posts_widgets_before_content_width',
            'type'    => 'select',
            'choices' => array(
                'full-width' => esc_html__( 'Full Width', 'wavypixel' ),
                'boxed'  => esc_html__( 'Boxed Width', 'wavypixel' ),
                'wide-width'  => esc_html__( 'Wide Width', 'wavypixel' ),
               
            ),
        ));

}

add_action( 'customize_register', 'wavypixel_fa_style_settings_customize_register' );

/**
 * Custom control for category dropdown
 */
if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        public $type = 'dropdown-categories';

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'wavypixel' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            // Replace default name attribute with customizer-specific one
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select">
                    <span class="customize-control-title">%s</span>
                    %s
                </label>',
                esc_html( $this->label ),
                $dropdown
            );
        }
    }
}

