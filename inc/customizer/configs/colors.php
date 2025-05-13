<?php
/**
 * Global Colors Customizer configuration
 *
 * Panel → Sections:
 *   • Primary & Secondary
 *   • Text & Background
 * Settings & controls for six colors + live-refresh partial.
 */

return [

    // 1) Panel
    [
        'type' => 'panel',
        'id'   => 'zero_colors',
        'args' => [
            'title'    => __( 'Global Colors', 'zero' ),
            'priority' => 20,
        ],
    ],

    // 2) Section: Primary & Secondary
    [
        'type' => 'section',
        'id'   => 'zero_colors_primary',
        'args' => [
            'title'    => __( 'Primary & Secondary', 'zero' ),
            'panel'    => 'zero_colors',
            'priority' => 10,
        ],
    ],

    // Primary Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[primary_color]',
        'args' => [
            'default'           => '#3D52A0',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'primary_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Primary Color', 'zero' ),
            'section'  => 'zero_colors_primary',
            'settings' => 'zero_settings[primary_color]',
        ],
    ],

    // Secondary Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[secondary_color]',
        'args' => [
            'default'           => '#7091E6',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'secondary_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Secondary Color', 'zero' ),
            'section'  => 'zero_colors_primary',
            'settings' => 'zero_settings[secondary_color]',
        ],
    ],

    
        // 3) Section: Text & Background
    
        [
        'type' => 'section',
        'id'   => 'zero_colors_text',
        'args' => [
            'title'    => __( 'Text & Background', 'zero' ),
            'panel'    => 'zero_colors',
            'priority' => 20,
        ],
    ],

    // Accent Color
         [
        'type' => 'setting',
        'id'   => 'zero_settings[accent_color]',
        'args' => [
            'default'           => '#FFA84C ',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
                  ],
        ],
         [
        'type'          => 'control',
        'id'            => 'accent_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Accent Color', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[accent_color]',
                 ],
          ],
    
    
    
    // Text Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[text_color]',
        'args' => [
            'default'           => '#626577',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'text_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Text Color', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[text_color]',
        ],
    ],

    // Link Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[link_color]',
        'args' => [
            'default'           => '#146EB4',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'link_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Link Color', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[link_color]',
        ],
    ],

    // Link Hover Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[link_hover_color]',
        'args' => [
            'default'           => '#FF9900',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'link_hover_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Link Hover Color', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[link_hover_color]',
        ],
    ],

    // Background Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[background_color]',
        'args' => [
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'background_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Site Background', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[background_color]',
        ],
    ],

    // Surface Color
    [
        'type' => 'setting',
        'id'   => 'zero_settings[surface_color]',
        'args' => [
            'default'           => '#EEEEEE',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ],
    ],
    [
        'type'          => 'control',
        'id'            => 'surface_color',
        'control_class' => \Zero\Core\Customizer\Controls\Color::class,
        'args'          => [
            'label'    => __( 'Content Background', 'zero' ),
            'section'  => 'zero_colors_text',
            'settings' => 'zero_settings[surface_color]',
        ],
    ],

    // 4) Partial: Update CSS variables on change
    [
        'type' => 'partial',
        'id'   => 'zero_partial_colors',
        'args' => [
            'selector'        => ':root',
            'settings'        => [
                'zero_settings[primary_color]',
                'zero_settings[secondary_color]',
                'zero_settings[text_color]',
                'zero_settings[link_color]',
                'zero_settings[background_color]',
                'zero_settings[accent_color]',
                'zero_settings[surface_color]',
                'zero_settings[link_hover_color]',
            ],
            'render_callback' => '__return_empty_string',
        ],
    ],
];
