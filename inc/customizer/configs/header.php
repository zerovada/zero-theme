<?php
/**
 * Header Customizer configuration
 */

return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_header',
    'args' => [
      'title'    => __( 'Header', 'zero' ),
      'priority' => 45,
    ],
  ],

  // Section: Layout
  [
    'type' => 'section',
    'id'   => 'zero_header_layout',
    'args' => [
      'title'    => __( 'Layout', 'zero' ),
      'panel'    => 'zero_header',
      'priority' => 10,
    ],
  ],
  // Header Layout choice
  [
    'type' => 'setting',
    'id'   => 'zero_settings[header_layout]',
    'args' => [
      'default'           => 'logo-left-menu-right',
      'sanitize_callback' => 'sanitize_key',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'header_layout',
    'control_class' => \Zero\Core\Customizer\Controls\Radio_Image::class,
    'args'          => [
      'label'    => __( 'Header Layout', 'zero' ),
      'section'  => 'zero_header_layout',
      'settings' => 'zero_settings[header_layout]',
      'choices'  => [
        'logo-left-menu-right' => get_template_directory_uri() . '/assets/images/header-layout-1.png',
        'logo-center-menu-below' => get_template_directory_uri() . '/assets/images/header-layout-2.png',
        'logo-right-menu-left' => get_template_directory_uri() . '/assets/images/header-layout-3.png',
      ],
    ],
  ],

  // Section: Colors
  [
    'type' => 'section',
    'id'   => 'zero_header_colors',
    'args' => [
      'title'    => __( 'Colors', 'zero' ),
      'panel'    => 'zero_header',
      'priority' => 20,
    ],
  ],
  // Background Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[header_bg_color]',
    'args' => [
      'default'           => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'header_bg_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Background Color', 'zero' ),
      'section'  => 'zero_header_colors',
      'settings' => 'zero_settings[header_bg_color]',
    ],
  ],
  // Text & Link Color
  [
    'type' => 'setting',
    'id'   => 'zero_settings[header_text_color]',
    'args' => [
      'default'           => '#333333',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'header_text_color',
    'control_class' => \Zero\Core\Customizer\Controls\Color::class,
    'args'          => [
      'label'    => __( 'Text & Link Color', 'zero' ),
      'section'  => 'zero_header_colors',
      'settings' => 'zero_settings[header_text_color]',
    ],
  ],

  // Section: Sticky Header
  [
    'type' => 'section',
    'id'   => 'zero_header_sticky',
    'args' => [
      'title'    => __( 'Sticky Header', 'zero' ),
      'panel'    => 'zero_header',
      'priority' => 30,
    ],
  ],
  [
    'type' => 'setting',
    'id'   => 'zero_settings[header_sticky]',
    'args' => [
      'default'           => false,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'header_sticky',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Enable Sticky Header', 'zero' ),
      'section'  => 'zero_header_sticky',
      'settings' => 'zero_settings[header_sticky]',
      'type'     => 'checkbox',
    ],
  ],

  // Partial for Colors & Layout
  [
    'type' => 'partial',
    'id'   => 'zero_partial_header',
    'args' => [
      'selector'        => '.site-header',
      'settings'        => [
        'zero_settings[header_layout]',
        'zero_settings[header_bg_color]',
        'zero_settings[header_text_color]',
        'zero_settings[header_sticky]',
      ],
      'render_callback' => '__return_empty_string',
    ],
  ],
];
