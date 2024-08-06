<?php
/**
 * wavypixel Theme Customizer
 *
 * @package wavypixel
 */

function wavypixel_header_customize_register( $wp_customize ) {

    $wp_customize->get_section( 'title_tagline' )->panel  = 'wavypixel_header_panel';
    $wp_customize->get_section( 'header_image' )->panel   = 'wavypixel_header_panel';

    $wp_customize->add_panel(
        'wavypixel_header_panel', array(
            'title'     =>  __('Header', 'wavypixel'),
            'priority'  =>  10
        )
    );

    $wp_customize->add_section(
        'wavypixel_header_options', array(
            'title'     =>  __('Header Options', 'wavypixel'),
            'priority'  =>  80,
            'panel'     =>  'wavypixel_header_panel'
        )
    );

    $wp_customize->add_setting(
        'wavypixel_header_layout', array(
            'sanitize_callback' =>  'wavypixel_sanitize_radio',
            'default'           =>  'default'
        )
    );

    $wp_customize->add_control(
        'wavypixel_header_layout', array(
            'title'         =>  __('Header Layout', 'wavypixel'),
            'description'   =>  __('Choose the header layout for the theme', 'wavypixel'),
            'type'          =>  'select',
            'section'       =>  'wavypixel_header_options',
            'priority'      =>  5,
            'choices'       =>  array(
                'default'       =>  __('Default', 'wavypixel'),
                'full'          =>  __('Full', 'wavypixel'),
                'center'        =>  __('Center', 'wavypixel'),
                'top'           =>  __('Top', 'wavypixel'),
                'widget'        =>  __('Widget', 'wavypixel')
            )
        )
    );

    $wp_customize->add_control(
        new wavypixel_Custom_Button_Control(
            $wp_customize, 'wavypixel_header_widget_btn', array(
                'label'     =>  __('Manage Header Widget', 'wavypixel'),
                'section'   =>  'wavypixel_header_options',
                'type'      =>  'wavypixel-button',
                'settings'  =>  []
            )
        )
    );

    $control = $wp_customize->get_control('wavypixel_header_widget_btn');
    $control->active_callback = function( $control ) {
        $setting = $control->manager->get_setting( 'wavypixel_header_layout' );
        return $setting->value() == 'widget' ? true : false;
    };

    $wp_customize->add_setting('wavypixel_header_layout', array(
        'default'       =>  'boxed',
        'sanitize_callback' =>  'wavypixel_sanitize_select'
    ));

    $wp_customize->add_section(
        'wavypixel_top_bar', array(
            'title'     =>  __('Top Bar', 'wavypixel'),
            'panel'     =>  'wavypixel_header_panel',
            'priority'  =>  5
        )
    );

    $wp_customize->add_control(
        new wavypixel_Heading_Control(
            $wp_customize, 'wavypixel_top_menu_title', array(
                'label'     =>  __('Top Menu', 'wavypixel'),
                'section'   =>  'wavypixel_top_bar',
                'settings'  =>  [],
                'type'      =>  'wavypixel-heading'
            )
        )
    );

    $wp_customize->add_setting(
        'wavypixel_top_menu_enable', array(
            'default'   =>  '',
            'sanitize_callback' =>  'wavypixel_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'wavypixel_top_menu_enable', array(
            'label'     =>  __('Enable Top Menu', 'wavypixel'),
            'type'      =>  'checkbox',
            'section'   =>  'wavypixel_top_bar',
        )
    );

    $wp_customize->add_control(
        new wavypixel_Separator_Control(
            $wp_customize, 'wavypixel-sep1', array(
                'type'  =>  'wavypixel-separator',
                'section'   =>  'wavypixel_top_bar',
                'settings'  =>  [],
            )
        )
    );

    $wp_customize->add_control(
        new wavypixel_Heading_Control(
            $wp_customize, 'wavypixel_social_icons_title', array(
                'label'     =>  __('Social icons', 'wavypixel'),
                'section'   =>  'wavypixel_top_bar',
                'settings'  =>  [],
                'type'      =>  'wavypixel-heading'
            )
        )
    );

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' 			=> esc_html__('-','wavypixel'),
        'facebook-alt' 	=> esc_html__('Facebook', 'wavypixel'),
        'twitter' 		=> esc_html__('Twitter', 'wavypixel'),
        'instagram' 	=> esc_html__('Instagram', 'wavypixel'),
        'linkedin'      => esc_html__('LinkedIn', 'wavypixel'),
        'youtube' 		=> esc_html__('Youtube', 'wavypixel'),
    );

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting(
            "wavypixel_{$i}_icon", array(
                'default'           =>  'none',
                'sanitize_callback' =>  'wavypixel_sanitize_social'
            )
        );

        $wp_customize->add_control(
            "wavypixel_{$i}_icon", array(
                'label'     =>  __("Icon {$i}", 'wavypixel'),
                'section'   =>  'wavypixel_top_bar',
                'type'      =>  'select',
                'choices'   =>  $social_networks
            )
        );

        $wp_customize->add_setting(
			'wavypixel_social_url_'.$i, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'wavypixel_social_url_' . $i, array(
			'label' 		=> esc_html__('Icon ','wavypixel') . $i . esc_html__(' Url','wavypixel'),
            'settings' 		=> 'wavypixel_social_url_' . $i,
            'section' 		=> 'wavypixel_top_bar',
            'type' 			=> 'url'
		));
    }

}
add_action('customize_register', 'wavypixel_header_customize_register');