<?php
/**
 * Performance Customizer configuration
 *
 * Panel → Sections:
 *   • Asset Optimization
 *   • Lazy Loading
 *   • Miscellaneous
 */

return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_performance',
    'args' => [
      'title'    => __( 'Performance', 'zero' ),
      'priority' => 90,
    ],
  ],

  // Section: Asset Optimization
  [
    'type' => 'section',
    'id'   => 'zero_perf_assets',
    'args' => [
      'title'    => __( 'Asset Optimization', 'zero' ),
      'panel'    => 'zero_performance',
      'priority' => 10,
    ],
  ],

  // Minify CSS
  [
    'type' => 'setting',
    'id'   => 'zero_settings[minify_css]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'minify_css',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Minify CSS', 'zero' ),
      'section'  => 'zero_perf_assets',
      'settings' => 'zero_settings[minify_css]',
      'type'     => 'checkbox',
    ],
  ],

  // Minify JS
  [
    'type' => 'setting',
    'id'   => 'zero_settings[minify_js]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'minify_js',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Minify JavaScript', 'zero' ),
      'section'  => 'zero_perf_assets',
      'settings' => 'zero_settings[minify_js]',
      'type'     => 'checkbox',
    ],
  ],

  // Combine CSS & JS
  [
    'type' => 'setting',
    'id'   => 'zero_settings[combine_assets]',
    'args' => [
      'default'           => false,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'combine_assets',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Combine CSS & JS files', 'zero' ),
      'section'  => 'zero_perf_assets',
      'settings' => 'zero_settings[combine_assets]',
      'type'     => 'checkbox',
    ],
  ],

  // Section: Lazy Loading
  [
    'type' => 'section',
    'id'   => 'zero_perf_lazy',
    'args' => [
      'title'    => __( 'Lazy Loading', 'zero' ),
      'panel'    => 'zero_performance',
      'priority' => 20,
    ],
  ],

  // Lazy-load images
  [
    'type' => 'setting',
    'id'   => 'zero_settings[lazyload_images]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'lazyload_images',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Lazy-load Images', 'zero' ),
      'section'  => 'zero_perf_lazy',
      'settings' => 'zero_settings[lazyload_images]',
      'type'     => 'checkbox',
    ],
  ],

  // Lazy-load iframes/videos
  [
    'type' => 'setting',
    'id'   => 'zero_settings[lazyload_iframes]',
    'args' => [
      'default'           => false,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'lazyload_iframes',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Lazy-load Iframes/Videos', 'zero' ),
      'section'  => 'zero_perf_lazy',
      'settings' => 'zero_settings[lazyload_iframes]',
      'type'     => 'checkbox',
    ],
  ],

  // Section: Miscellaneous
  [
    'type' => 'section',
    'id'   => 'zero_perf_misc',
    'args' => [
      'title'    => __( 'Miscellaneous', 'zero' ),
      'panel'    => 'zero_performance',
      'priority' => 30,
    ],
  ],

  // Disable emojis
  [
    'type' => 'setting',
    'id'   => 'zero_settings[disable_emojis]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'disable_emojis',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Disable Emoji Scripts', 'zero' ),
      'section'  => 'zero_perf_misc',
      'settings' => 'zero_settings[disable_emojis]',
      'type'     => 'checkbox',
    ],
  ],

  // Prefetch DNS domains (comma-separated)
  [
    'type' => 'setting',
    'id'   => 'zero_settings[prefetch_domains]',
    'args' => [
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
      'transport'         => 'refresh',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'prefetch_domains',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'       => __( 'DNS Prefetch Domains', 'zero' ),
      'description' => __( 'Comma-separated list (e.g. `//fonts.gstatic.com, //cdn.example.com`)', 'zero' ),
      'section'     => 'zero_perf_misc',
      'settings'    => 'zero_settings[prefetch_domains]',
      'type'        => 'textarea',
    ],
  ],

];
