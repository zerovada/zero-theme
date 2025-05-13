<?php
/**
 * Typography Customizer configuration
 *
 * Panel → Sections:
 *   • Body
 *   • Headings
 * Settings & controls for body font size, line height, and headings.
 */

return [

  // 1) Panel
  [
    'type' => 'panel',
    'id'   => 'zero_typography',
    'args' => [
      'title'    => __( 'Typography', 'zero' ),
      'priority' => 30,
    ],
  ],

  // 2) Section: Body Text
  [
    'type' => 'section',
    'id'   => 'zero_typography_body',
    'args' => [
      'title'    => __( 'Body Text', 'zero' ),
      'panel'    => 'zero_typography',
      'priority' => 10,
    ],
  ],

  // Body Font Size
  [
    'type' => 'setting',
    'id'   => 'zero_settings[body_font_size]',
    'args' => [
      'default'           => 1,       // rem
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'body_font_size',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'    => __( 'Font Size (rem)', 'zero' ),
      'section'  => 'zero_typography_body',
      'settings' => 'zero_settings[body_font_size]',
      'input_attrs' => [
        'min'  => 0.75,
        'max'  => 2,
        'step' => 0.05,
      ],
    ],
  ],

  // Body Line Height
  [
    'type' => 'setting',
    'id'   => 'zero_settings[body_line_height]',
    'args' => [
      'default'           => 1.6,
      'sanitize_callback' => 'absfloat',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'body_line_height',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'    => __( 'Line Height', 'zero' ),
      'section'  => 'zero_typography_body',
      'settings' => 'zero_settings[body_line_height]',
      'input_attrs' => [
        'min'  => 1,
        'max'  => 2.5,
        'step' => 0.1,
      ],
    ],
  ],

  // 3) Section: Headings
  [
    'type' => 'section',
    'id'   => 'zero_typography_headings',
    'args' => [
      'title'    => __( 'Headings', 'zero' ),
      'panel'    => 'zero_typography',
      'priority' => 20,
    ],
  ],

  // Heading Font Size Scale (multiplier of body)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[heading_scale]',
    'args' => [
      'default'           => 1.25,
      'sanitize_callback' => 'absfloat',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'heading_scale',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'    => __( 'Heading Scale (h2/body)', 'zero' ),
      'section'  => 'zero_typography_headings',
      'settings' => 'zero_settings[heading_scale]',
      'input_attrs' => [
        'min'  => 1,
        'max'  => 2,
        'step' => 0.05,
      ],
    ],
  ],

  // 4) Live‐refresh Partial
  [
    'type' => 'partial',
    'id'   => 'zero_partial_typography',
    'args' => [
      'selector'        => 'body',
      'settings'        => [
        'zero_settings[body_font_size]',
        'zero_settings[body_line_height]',
        'zero_settings[heading_scale]',
      ],
      'render_callback' => '__return_empty_string',
    ],
  ],
];
