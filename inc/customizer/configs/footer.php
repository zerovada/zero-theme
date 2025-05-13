<?php
/**
 * Footer Customizer configuration
 *
 * Panel → Sections:
 *   • Layout
 *   • Colors
 *   • Spacing
 * Selective-refresh on `.site-footer`.
 */

return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_footer',
    'args' => [
      'title'    => __( 'Footer', 'zero' ),
      'priority' => 50,
    ],
  ],

  // Section: Layout (columns)
  [
    'type' => 'section',
    'id'   => 'zero_footer_layout',
    'args' => [
      'title'    => __( 'Layout', 'zero' ),
      'panel'    => 'zero_footer',
      'priority' => 10,
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[footer_columns]',
    'args' => [
      'default'           => 4,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'footer_columns',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Number of Widget Columns', 'zero' ),
      'section'     => 'zero_footer_layout',
      'settings'    => 'zero_settings[footer_columns]',
      'input_attrs' => [
        'min'  => 1,
        'max'  => 4,
        'step' => 1,
      ],
    ],
  ],

  // Section: Colors
  [
    'type' => 'section',
    'id'   => 'zero_footer_colors',
    'args' => [
      'title'    => __( 'Colors', 'zero' ),
      'panel'    => 'zero_footer',
      'priority' => 20,
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[footer_bg_color]',
    'args' => [
      'default'           => '#222222',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'footer_bg_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Background Color', 'zero' ),
      'section'  => 'zero_footer_colors',
      'settings' => 'zero_settings[footer_bg_color]',
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[footer_text_color]',
    'args' => [
      'default'           => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'footer_text_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Text Color', 'zero' ),
      'section'  => 'zero_footer_colors',
      'settings' => 'zero_settings[footer_text_color]',
    ],
  ],

  // Section: Spacing
  [
    'type' => 'section',
    'id'   => 'zero_footer_spacing',
    'args' => [
      'title'    => __( 'Spacing', 'zero' ),
      'panel'    => 'zero_footer',
      'priority' => 30,
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[footer_padding_top]',
    'args' => [
      'default'           => 2,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'footer_padding_top',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding Top (rem)', 'zero' ),
      'section'     => 'zero_footer_spacing',
      'settings'    => 'zero_settings[footer_padding_top]',
      'input_attrs' => [
        'min'  => 0,
        'max'  => 5,
        'step' => 0.25,
      ],
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[footer_padding_bottom]',
    'args' => [
      'default'           => 2,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'footer_padding_bottom',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding Bottom (rem)', 'zero' ),
      'section'     => 'zero_footer_spacing',
      'settings'    => 'zero_settings[footer_padding_bottom]',
      'input_attrs' => [
        'min'  => 0,
        'max'  => 5,
        'step' => 0.25,
      ],
    ],
  ],

  // Selective‐refresh Partial
  [
    'type' => 'partial',
    'id'   => 'zero_partial_footer',
    'args' => [
      'selector'        => '.site-footer',
      'settings'        => [
        'zero_settings[footer_columns]',
        'zero_settings[footer_bg_color]',
        'zero_settings[footer_text_color]',
        'zero_settings[footer_padding_top]',
        'zero_settings[footer_padding_bottom]',
      ],
      'render_callback' => function() {
        get_template_part( 'template-parts/footer/site-footer' );
      },
    ],
  ],
];
