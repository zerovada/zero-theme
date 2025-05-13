<?php
/**
 * Buttons Customizer configuration
 *
 * Panel → Sections:
 *   • Primary Button
 *   • Secondary Button
 * Settings & controls for background, text color, padding, and border-radius.
 */

return [

  // 1) Panel
  [
    'type' => 'panel',
    'id'   => 'zero_buttons',
    'args' => [
      'title'    => __( 'Buttons', 'zero' ),
      'priority' => 70,
    ],
  ],

  // 2) Section: Primary Button
  [
    'type' => 'section',
    'id'   => 'zero_buttons_primary',
    'args' => [
      'title'    => __( 'Primary Button', 'zero' ),
      'panel'    => 'zero_buttons',
      'priority' => 10,
    ],
  ],

  // Primary BG Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_primary_bg]',
    'args' => [
      'default'           => '#0073e6',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_primary_bg',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Background Color', 'zero' ),
      'section'  => 'zero_buttons_primary',
      'settings' => 'zero_settings[btn_primary_bg]',
    ],
  ],

  // Primary Text Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_primary_color]',
    'args' => [
      'default'           => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_primary_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Text Color', 'zero' ),
      'section'  => 'zero_buttons_primary',
      'settings' => 'zero_settings[btn_primary_color]',
    ],
  ],

  // Primary Padding Y (vertical)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_primary_padding_y]',
    'args' => [
      'default'           => 0.75,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_primary_padding_y',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding: Top/Bottom (rem)', 'zero' ),
      'section'     => 'zero_buttons_primary',
      'settings'    => 'zero_settings[btn_primary_padding_y]',
      'input_attrs' => [
        'min'  => 0.5,
        'max'  => 2,
        'step' => 0.1,
      ],
    ],
  ],

  // Primary Padding X (horizontal)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_primary_padding_x]',
    'args' => [
      'default'           => 1.5,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_primary_padding_x',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding: Left/Right (rem)', 'zero' ),
      'section'     => 'zero_buttons_primary',
      'settings'    => 'zero_settings[btn_primary_padding_x]',
      'input_attrs' => [
        'min'  => 1,
        'max'  => 3,
        'step' => 0.1,
      ],
    ],
  ],

  // Primary Border Radius
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_primary_radius]',
    'args' => [
      'default'           => 4,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_primary_radius',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Border Radius (px)', 'zero' ),
      'section'     => 'zero_buttons_primary',
      'settings'    => 'zero_settings[btn_primary_radius]',
      'input_attrs' => [
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
      ],
    ],
  ],

  // 3) Section: Secondary Button
  [
    'type' => 'section',
    'id'   => 'zero_buttons_secondary',
    'args' => [
      'title'    => __( 'Secondary Button', 'zero' ),
      'panel'    => 'zero_buttons',
      'priority' => 20,
    ],
  ],

  // (repeat same settings/controls, but keys btn_secondary_…)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_secondary_bg]',
    'args' => [
      'default'           => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_secondary_bg',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Background Color', 'zero' ),
      'section'  => 'zero_buttons_secondary',
      'settings' => 'zero_settings[btn_secondary_bg]',
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_secondary_color]',
    'args' => [
      'default'           => '#0073e6',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_secondary_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Text Color', 'zero' ),
      'section'  => 'zero_buttons_secondary',
      'settings' => 'zero_settings[btn_secondary_color]',
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_secondary_padding_y]',
    'args' => [
      'default'           => 0.75,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_secondary_padding_y',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding: Top/Bottom (rem)', 'zero' ),
      'section'     => 'zero_buttons_secondary',
      'settings'    => 'zero_settings[btn_secondary_padding_y]',
      'input_attrs' => [ 'min'=>0.5,'max'=>2,'step'=>0.1 ],
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_secondary_padding_x]',
    'args' => [
      'default'           => 1.5,
      'sanitize_callback' => 'floatval',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_secondary_padding_x',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Padding: Left/Right (rem)', 'zero' ),
      'section'     => 'zero_buttons_secondary',
      'settings'    => 'zero_settings[btn_secondary_padding_x]',
      'input_attrs' => [ 'min'=>1,'max'=>3,'step'=>0.1 ],
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[btn_secondary_radius]',
    'args' => [
      'default'           => 4,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'btn_secondary_radius',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Border Radius (px)', 'zero' ),
      'section'     => 'zero_buttons_secondary',
      'settings'    => 'zero_settings[btn_secondary_radius]',
      'input_attrs' => [ 'min'=>0,'max'=>50,'step'=>1 ],
    ],
  ],

  // 4) Live‐refresh Partial
  [
    'type' => 'partial',
    'id'   => 'zero_partial_buttons',
    'args' => [
      'selector'        => 'body',
      'settings'        => [
        'zero_settings[btn_primary_bg]',
        'zero_settings[btn_primary_color]',
        'zero_settings[btn_primary_padding_y]',
        'zero_settings[btn_primary_padding_x]',
        'zero_settings[btn_primary_radius]',
        'zero_settings[btn_secondary_bg]',
        'zero_settings[btn_secondary_color]',
        'zero_settings[btn_secondary_padding_y]',
        'zero_settings[btn_secondary_padding_x]',
        'zero_settings[btn_secondary_radius]',
      ],
      'render_callback' => '__return_empty_string',
    ],
  ],

];
