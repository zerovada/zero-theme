<?php
/**
 * WooCommerce Customizer configuration
 *
 * Panel → Sections:
 *   • Shop Archive
 *   • Single Product
 *   • Cart & Checkout
 * Selective-refresh on key wrappers.
 */
return [

  // Panel
  [
    'type' => 'panel',
    'id'   => 'zero_woocommerce',
    'args' => [
      'title'    => __( 'WooCommerce', 'zero' ),
      'priority' => 95,
    ],
  ],

  // Section: Shop Archive
  [
    'type' => 'section',
    'id'   => 'zero_wc_archive',
    'args' => [
      'title'    => __( 'Shop Archive', 'zero' ),
      'panel'    => 'zero_woocommerce',
      'priority' => 10,
    ],
  ],
  // Products per row
  [
    'type' => 'setting',
    'id'   => 'zero_settings[wc_products_per_row]',
    'args' => [
      'default'           => 4,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'wc_products_per_row',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Products per row', 'zero' ),
      'section'     => 'zero_wc_archive',
      'settings'    => 'zero_settings[wc_products_per_row]',
      'input_attrs' => [
        'min'  => 1,
        'max'  => 6,
        'step' => 1,
      ],
    ],
  ],
  // Shop columns
  [
    'type' => 'setting',
    'id'   => 'zero_settings[wc_columns]',
    'args' => [
      'default'           => 3,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'wc_columns',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Archive Columns', 'zero' ),
      'section'  => 'zero_wc_archive',
      'settings' => 'zero_settings[wc_columns]',
      'type'     => 'select',
      'choices'  => [
        1 => '1', 2 => '2', 3 => '3', 4 => '4',
      ],
    ],
  ],

  // Section: Single Product
  [
    'type' => 'section',
    'id'   => 'zero_wc_single',
    'args' => [
      'title'    => __( 'Single Product', 'zero' ),
      'panel'    => 'zero_woocommerce',
      'priority' => 20,
    ],
  ],
  // Sidebar on single product
  [
    'type' => 'setting',
    'id'   => 'zero_settings[wc_single_sidebar]',
    'args' => [
      'default'           => 'none',
      'sanitize_callback' => 'sanitize_key',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'wc_single_sidebar',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Sidebar Position', 'zero' ),
      'section'  => 'zero_wc_single',
      'settings' => 'zero_settings[wc_single_sidebar]',
      'type'     => 'select',
      'choices'  => [
        'none'        => __( 'None', 'zero' ),
        'left'        => __( 'Left', 'zero' ),
        'right'       => __( 'Right', 'zero' ),
      ],
    ],
  ],
  // Image zoom enable
  [
    'type' => 'setting',
    'id'   => 'zero_settings[wc_image_zoom]',
    'args' => [
      'default'           => true,
      'sanitize_callback' => 'rest_sanitize_boolean',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'wc_image_zoom',
    'control_class' => \WP_Customize_Control::class,
    'args'          => [
      'label'    => __( 'Enable Image Zoom', 'zero' ),
      'section'  => 'zero_wc_single',
      'settings' => 'zero_settings[wc_image_zoom]',
      'type'     => 'checkbox',
    ],
  ],

  // Section: Cart & Checkout
  [
    'type' => 'section',
    'id'   => 'zero_wc_cart',
    'args' => [
      'title'    => __( 'Cart & Checkout', 'zero' ),
      'panel'    => 'zero_woocommerce',
      'priority' => 30,
    ],
  ],
  // Columns in cart table
  [
    'type' => 'setting',
    'id'   => 'zero_settings[wc_cart_columns]',
    'args' => [
      'default'           => 5,
      'sanitize_callback' => 'absint',
      'transport'         => 'postMessage',
    ],
  ],
  [
    'type'          => 'control',
    'id'            => 'wc_cart_columns',
    'control_class' => \Zero\Core\Customizer\Controls\Range::class,
    'args'          => [
      'label'       => __( 'Cart Table Columns', 'zero' ),
      'section'     => 'zero_wc_cart',
      'settings'    => 'zero_settings[wc_cart_columns]',
      'input_attrs' => [
        'min'  => 3,
        'max'  => 7,
        'step' => 1,
      ],
    ],
  ],

  // Partial: Selective Refresh (wrap shop and single)
  [
    'type' => 'partial',
    'id'   => 'zero_partial_wc_shop',
    'args' => [
      'selector'        => '.woocommerce',
      'settings'        => [
        'zero_settings[wc_products_per_row]',
        'zero_settings[wc_columns]',
      ],
      'render_callback' => function() {
        // re-render shop loop
        wc_set_loop_prop( 'columns', get_theme_mod( 'zero_settings[wc_columns]', 3 ) );
        woocommerce_content();
      },
    ],
  ],
  [
    'type' => 'partial',
    'id'   => 'zero_partial_wc_single',
    'args' => [
      'selector'        => '.single-product',
      'settings'        => [
        'zero_settings[wc_single_sidebar]',
        'zero_settings[wc_image_zoom]',
      ],
      'render_callback' => function() {
        get_template_part( 'template-parts/woocommerce/single', 'product' );
      },
    ],
  ],
];
