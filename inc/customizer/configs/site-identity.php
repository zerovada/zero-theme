<?php
/**
 * Site Identity Customizer configuration
 *
 * Returns an array of panels, sections, settings, controls, and partials
 * for the Site Title / Tagline toggles and Custom Logo.
 */

return [

    // 1) Panel
    [
        'type' => 'panel',
        'id'   => 'zero_site_identity',
        'args' => [
            'title'    => __( 'Site Title & Logo', 'zero' ),
            'priority' => 10,
        ],
    ],

    // 2) Section: Title & Tagline toggles
    [
        'type' => 'section',
        'id'   => 'zero_site_identity_text',
        'args' => [
            'title'    => __( 'Title & Tagline', 'zero' ),
            'panel'    => 'zero_site_identity',
            'priority' => 10,
        ],
    ],

    // 3) Setting: Show Site Title (default: true)
    [
        'type' => 'setting',
        'id'   => 'zero_settings[site_title_toggle]',
        'args' => [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'postMessage',
        ],
    ],

    // 4) Control: Show Site Title
    [
        'type'          => 'control',
        'id'            => 'site_title_toggle',
        'control_class' => \WP_Customize_Control::class,
        'args'          => [
            'label'    => __( 'Display Site Title', 'zero' ),
            'section'  => 'zero_site_identity_text',
            'settings' => 'zero_settings[site_title_toggle]',
            'type'     => 'checkbox',
        ],
    ],

    // 5) Setting: Show Tagline (default: true)
    [
        'type' => 'setting',
        'id'   => 'zero_settings[site_tagline_toggle]',
        'args' => [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'postMessage',
        ],
    ],

    // 6) Control: Show Tagline
    [
        'type'          => 'control',
        'id'            => 'site_tagline_toggle',
        'control_class' => \WP_Customize_Control::class,
        'args'          => [
            'label'    => __( 'Display Tagline', 'zero' ),
            'section'  => 'zero_site_identity_text',
            'settings' => 'zero_settings[site_tagline_toggle]',
            'type'     => 'checkbox',
        ],
    ],

    // 7) Section: Custom Logo
    [
        'type' => 'section',
        'id'   => 'zero_site_identity_logo',
        'args' => [
            'title'    => __( 'Logo', 'zero' ),
            'panel'    => 'zero_site_identity',
            'priority' => 20,
        ],
    ],

    // 8) Core setting/control for Custom Logo
    [
        'type' => 'setting',
        'id'   => 'custom_logo',
        'args' => [
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'custom_logo',
        'control_class' => \WP_Customize_Cropped_Image_Control::class,
        'args'          => [
            'label'       => __( 'Upload Logo', 'zero' ),
            'section'     => 'zero_site_identity_logo',
            'settings'    => 'custom_logo',
            'width'       => 180,
            'height'      => 60,
            'flex_height' => true,
            'flex_width'  => true,
        ],
    ],

    // 9) Partial: Site Title selective refresh
    [
        'type' => 'partial',
        'id'   => 'zero_partial_site_title',
        'args' => [
            'selector'        => '.site-title',
            'settings'        => [ 'zero_settings[site_title_toggle]' ],
            'render_callback' => function() {
                if ( get_theme_mod( 'zero_settings[site_title_toggle]', true ) ) {
                    printf(
                        '<a class="site-title" href="%s">%s</a>',
                        esc_url( home_url( '/' ) ),
                        get_bloginfo( 'name' )
                    );
                }
            },
        ],
    ],

    // 10) Partial: Tagline selective refresh
    [
        'type' => 'partial',
        'id'   => 'zero_partial_site_tagline',
        'args' => [
            'selector'        => '.site-description',
            'settings'        => [ 'zero_settings[site_tagline_toggle]' ],
            'render_callback' => function() {
                if ( get_theme_mod( 'zero_settings[site_tagline_toggle]', true ) ) {
                    printf(
                        '<p class="site-description">%s</p>',
                        get_bloginfo( 'description' )
                    );
                }
            },
        ],
    ],
];
