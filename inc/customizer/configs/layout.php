<?php
/**
 * Layout Customizer configuration
 *
 * Panel → Sections:
 *   • Container
 *   • Sidebar
 * Settings & controls for container width, site layout, sidebar width.
 */

return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_layout',
    'args' => [
      'title'    => __( 'Layout', 'zero' ),
      'priority' => 40,
    ],
  ],

  // Section: Container Settings
  [
    'type' => 'section',
    'id'   => 'zero_layout_container',
    'args' => [
      'title'    => __( 'Container', 'zero' ),
      'panel'    => 'zero_layout',
      'priority' => 10,
    ],
  ],

  // Container Max Width
  [
    'type' => 'setting',
    'id'   => 'zero_settings[container_width]',
    'args' => [
      'default'           => 1200,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'container_width',
    'control_class' => \Zero\Core\Customizer\Controls\Dimension::class,
    'args'          => [
      'label'       => __( 'Max Container Width (px)', 'zero' ),
      'section'     => 'zero_layout_container',
      'settings'    => 'zero_settings[container_width]',
      'input_attrs' => [
        'min'  => 600,
        'max'  => 1600,
        'step' => 10,
      ],
    ],
  ],

  // Section: Site Layout
  [
    'type' => 'section',
    'id'   => 'zero_layout_site',
    'args' => [
      'title'    => __( 'Site Layout', 'zero' ),
      'panel'    => 'zero_layout',
      'priority' => 20,
    ],
  ],

  // Layout Preset: full-width, sidebar-left, sidebar-right
  [
    'type' => 'setting',
    'id'   => 'zero_settings[site_layout]',
    'args' => [
      'default'           => 'sidebar-right',
      'sanitize_callback' => 'sanitize_key',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'site_layout',
    'control_class' => \Zero\Core\Customizer\Controls\Radio_Image::class,
    'args'          => [
      'label'       => __( 'Site Layout', 'zero' ),
      'section'     => 'zero_layout_site',
      'settings'    => 'zero_settings[site_layout]',
      'choices'     => [
        'full-width'     => get_template_directory_uri() . '/assets/images/layout-full.png',
        'sidebar-left'   => get_template_directory_uri() . '/assets/images/layout-sidebar-left.png',
        'sidebar-right'  => get_template_directory_uri() . '/assets/images/layout-sidebar-right.png',
      ],
    ],
  ],

  // Section: Sidebar Settings
  [
    'type' => 'section',
    'id'   => 'zero_layout_sidebar',
    'args' => [
      'title'    => __( 'Sidebar', 'zero' ),
      'panel'    => 'zero_layout',
      'priority' => 30,
    ],
  ],

  // Sidebar Width (% of container)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[sidebar_width]',
    'args' => [
      'default'           => 30,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'sidebar_width',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Sidebar Width (%)', 'zero' ),
      'section'     => 'zero_layout_sidebar',
      'settings'    => 'zero_settings[sidebar_width]',
      'input_attrs' => [
        'min'  => 20,
        'max'  => 40,
        'step' => 1,
      ],
    ],
  ],

  // Live‐refresh Partial
  [
    'type' => 'partial',
    'id'   => 'zero_partial_layout',
    'args' => [
      'selector'        => 'body',
      'settings'        => [
        'zero_settings[container_width]',
        'zero_settings[site_layout]',
        'zero_settings[sidebar_width]',
      ],
      'render_callback' => '__return_empty_string',
    ],
  ],
];
