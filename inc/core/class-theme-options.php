<?php
namespace Zero\Core;

defined( 'ABSPATH' ) || exit;

/**
 * Theme Options Manager
 *
 * Loads, merges, and exposes all theme settings with defaults,
 * section-specific filters, and runtime filters.
 */
class Theme_Options {

    /**
     * Default values for every setting.
     *
     * @var array
     */
    private static $defaults = [];

    /**
     * Cached merged options (saved + defaults).
     *
     * @var array|null
     */
    private static $options = null;

    /**
     * Bootstrap: register defaults early and sanitize on update.
     */
    public static function init() {
        // 1) Populate defaults at after_setup_theme priority 1
        add_action( 'after_setup_theme', [ __CLASS__, 'register_defaults' ], 1 );

        // 2) Sanitize all options before saving
        add_filter( 'pre_update_option_zero_settings', [ __CLASS__, 'sanitize_all' ], 10, 2 );
    }

    /**
     * Define the default values for each setting key,
     * with section-specific and global filters.
     */
    public static function register_defaults() {
        // Core defaults array
        $defs = [
            // Site Identity
            'site_title_toggle'      => true,
            'site_tagline_toggle'    => true,

            // Colors
            'primary_color'          => '#3D52A0',
            'secondary_color'        => '#7091E6',
            'text_color'             => '#626577',
            'link_color'             => '#146EB4',
            'heading_color'          => '#27293B',
            'background_color'       => '#FFFFFF',

            // Typography
            'body_font_family'       => 'sans',
            'body_font_size'         => 16,
            'body_line_height'       => 1.5,
            'heading_font_family'    => 'serif',
            'heading_font_weight'    => 700,
            'heading_font_size_h1'   => 32,
            'heading_font_size_h2'   => 28,
            'heading_font_size_h3'   => 24,
            'heading_font_size_h4'   => 20,
            'heading_font_size_h5'   => 18,
            'heading_font_size_h6'   => 16,
            'heading_line_height'    => 1.2,

            // Buttons
            'button_text_color'       => '#ffffff',
            'button_bg_color'         => '#0073e6',
            'button_hover_text_color' => '#ffffff',
            'button_hover_bg_color'   => '#005bb5',
            'button_border_radius'    => 4,
            'button_padding'          => 12,

            // Layout (Container & Sidebar)
            'container_width'        => 1200,
            'content_layout'         => 'boxed',
            'content_padding'        => 20,
            'sidebar_width'          => 300,
            'sidebar_position'       => 'right',

            // Header
            'header_sticky'          => false,
            'header_transparent'     => false,
            'header_bg_color'        => '#ffffff',

            // Footer
            'footer_bg_color'        => '#222222',
            'footer_text_color'      => '#ffffff',
            'footer_link_color'      => '#0073e6',
            'footer_padding'         => 40,

            // Breadcrumbs
            'breadcrumbs_enable'     => true,
            'breadcrumbs_separator'  => '/',

            // Performance
            'disable_emoji'          => true,
            'disable_embeds'         => true,
            'load_local_fonts'       => true,

            // WooCommerce
            'wc_shop_columns'         => 3,
            'wc_single_image_position'=> 'left',
            'wc_sale_badge_color'     => '#ffffff',
            'wc_sale_badge_bg_color'  => '#e22d2d',
        ];

        // Section-specific filters
        $defs = apply_filters( 'zero_site_identity_defaults',     $defs );
        $defs = apply_filters( 'zero_color_defaults',             $defs );
        $defs = apply_filters( 'zero_typography_defaults',        $defs );
        $defs = apply_filters( 'zero_button_defaults',            $defs );
        $defs = apply_filters( 'zero_layout_defaults',            $defs );
        $defs = apply_filters( 'zero_header_defaults',            $defs );
        $defs = apply_filters( 'zero_footer_defaults',            $defs );
        $defs = apply_filters( 'zero_breadcrumbs_defaults',       $defs );
        $defs = apply_filters( 'zero_performance_defaults',       $defs );
        $defs = apply_filters( 'zero_woocommerce_defaults',       $defs );

        // Global fallback filter
        self::$defaults = apply_filters( 'zero_theme_defaults', $defs );
    }

    /**
     * Retrieve merged options (saved + defaults), cached per request.
     *
     * @return array
     */
    public static function get_options(): array {
        if ( null === self::$options ) {
            $saved = get_option( 'zero_settings', [] );
            self::$options = wp_parse_args( (array) $saved, self::$defaults );

            /**
             * Filter the full merged options array at runtime.
             *
             * @param array $options The merged options.
             */
            self::$options = apply_filters( 'zero_get_all_options', self::$options );
        }
        return self::$options;
    }

    /**
     * Get a single option value.
     *
     * @param string $key Option key.
     * @return mixed|null
     */
    public static function get( string $key ) {
        $options = self::get_options();
        return $options[ $key ] ?? null;
    }

    /**
     * Sanitize all settings before saving to the database.
     *
     * @param mixed $new_value New raw value.
     * @param mixed $old_value Old value.
     * @return array Sanitized options.
     */
    public static function sanitize_all( $new_value, $old_value ): array {
        $output = [];
        $new    = is_array( $new_value ) ? $new_value : [];

        foreach ( self::$defaults as $key => $default ) {
            $val = $new[ $key ] ?? $default;

            switch ( gettype( $default ) ) {
                case 'boolean':
                    $output[ $key ] = (bool) $val;
                    break;

                case 'integer':
                    $output[ $key ] = absint( $val );
                    break;

                default:
                    // Color keys
                    if ( strpos( $key, '_color' ) !== false ) {
                        $output[ $key ] = sanitize_hex_color( $val ) ?: $default;
                    }
                    // URL or image
                    elseif ( strpos( $key, 'url' ) !== false || strpos( $key, 'logo' ) !== false ) {
                        $output[ $key ] = esc_url_raw( $val );
                    }
                    // Text fallback
                    else {
                        $output[ $key ] = sanitize_text_field( $val );
                    }
                    break;
            }
        }

        return $output;
    }
}

// Bootstrap the class
Theme_Options::init();

// Procedural wrapper
if ( ! function_exists( 'zero_get_option' ) ) {
    /**
     * Fetch a single theme option.
     *
     * @param string $key Option key.
     * @return mixed|null
     */
    function zero_get_option( $key ) {
        return Theme_Options::get( $key );
    }
}
