<?php
/**
 * Breadcrumbs Customizer configuration
 *
 * Panel → Section:
 *   • General
 *   • Styling
 * Selective‐refresh on `.zero-breadcrumbs`.
 */

return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_breadcrumbs',
    'args' => [
      'title'    => __( 'Breadcrumbs', 'zero' ),
      'priority' => 80,
    ],
  ],

  // Section: General
  [
    'type' => 'section',
    'id'   => 'zero_breadcrumbs_general',
    'args' => [
      'title'    => __( 'General', 'zero' ),
      'panel'    => 'zero_breadcrumbs',
      'priority' => 10,
    ],
  ],
  // Show breadcrumbs?
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_show]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_show',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Display Breadcrumbs', 'zero' ),
      'section'  => 'zero_breadcrumbs_general',
      'settings' => 'zero_settings[breadcrumb_show]',
      'type'     => 'checkbox',
    ],
  ],
  // Separator character
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_separator]',
    'args' => [
      'default'           => '>',
      'sanitize_callback' => 'sanitize_text_field',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_separator',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Separator Character', 'zero' ),
      'section'  => 'zero_breadcrumbs_general',
      'settings' => 'zero_settings[breadcrumb_separator]',
      'type'     => 'text',
    ],
  ],

  // Section: Styling
  [
    'type' => 'section',
    'id'   => 'zero_breadcrumbs_style',
    'args' => [
      'title'    => __( 'Styling', 'zero' ),
      'panel'    => 'zero_breadcrumbs',
      'priority' => 20,
    ],
  ],
  // Background Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_bg_color]',
    'args' => [
      'default'           => '#f5f5f5',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_bg_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Background Color', 'zero' ),
      'section'  => 'zero_breadcrumbs_style',
      'settings' => 'zero_settings[breadcrumb_bg_color]',
    ],
  ],
  // Text Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_text_color]',
    'args' => [
      'default'           => '#333333',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_text_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Text Color', 'zero' ),
      'section'  => 'zero_breadcrumbs_style',
      'settings' => 'zero_settings[breadcrumb_text_color]',
    ],
  ],
  // Separator Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_sep_color]',
    'args' => [
      'default'           => '#777777',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_sep_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Separator Color', 'zero' ),
      'section'  => 'zero_breadcrumbs_style',
      'settings' => 'zero_settings[breadcrumb_sep_color]',
    ],
  ],
  // Spacing (padding)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[breadcrumb_padding]',
    'args' => [
      'default'           => 1,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'breadcrumb_padding',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Vertical Padding (rem)', 'zero' ),
      'section'     => 'zero_breadcrumbs_style',
      'settings'    => 'zero_settings[breadcrumb_padding]',
      'input_attrs' => [
        'min'  => 0,
        'max'  => 3,
        'step' => 0.25,
      ],
    ],
  ],

  // Partial: Selective refresh
  [
    'type' => 'partial',
    'id'   => 'zero_partial_breadcrumbs',
    'args' => [
      'selector'        => '.zero-breadcrumbs',
      'settings'        => [
        'zero_settings[breadcrumb_show]',
        'zero_settings[breadcrumb_separator]',
        'zero_settings[breadcrumb_bg_color]',
        'zero_settings[breadcrumb_text_color]',
        'zero_settings[breadcrumb_sep_color]',
        'zero_settings[breadcrumb_padding]',
      ],
      'render_callback' => function() {
        get_template_part( 'template-parts/breadcrumbs' );
      },
    ],
  ],
];
