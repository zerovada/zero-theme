<?php
namespace Zero\Core;

defined( 'ABSPATH' ) || exit;

/**
 * Dynamic_CSS
 *
 * Generates and injects all theme CSS based on user settings,
 * broken into feature-specific methods for easy extension.
 */
class Dynamic_CSS {

    /**
     * Bootstrap: hook into wp_enqueue_scripts and expose a filter.
     */
    public static function init() {
        add_action( 'wp_enqueue_scripts',   [ __CLASS__, 'print_css' ], 999 );
        add_filter( 'zero_dynamic_css',     [ __CLASS__, 'filter_css' ], 10, 2 );
    }

    /**
     * Print the combined CSS inline.
     */
    public static function print_css() {
        $css = self::generate_css();
        // Allow child themes/plugins to modify the full CSS string
        $css = apply_filters( 'zero_dynamic_css', $css, '' );
        wp_add_inline_style( 'zero-style', $css );
    }

    /**
     * Placeholder filter callback (optional override).
     */
    public static function filter_css( $css, $context ) {
        return $css;
    }

    /**
     * Master generator: concatenates each section’s CSS.
     *
     * @return string
     */
    private static function generate_css(): string {
        $opts = Theme_Options::get_options();

        // Core sections
        $css  = self::colors_css(       $opts );
        $css .= self::typography_css(   $opts );
        $css .= self::layout_css(       $opts );

        // Extended sections
        $css .= self::buttons_css(      $opts );
        $css .= self::header_css(       $opts );
        $css .= self::footer_css(       $opts );
        $css .= self::breadcrumbs_css(  $opts );
        $css .= self::woocommerce_css(  $opts );

        return $css;
    }

    /**
     * :root { --color-*: value; }
     */
    private static function colors_css( array $opts ): string {
        $map = [
            'primary_color'    => '--color-primary',
            'secondary_color'  => '--color-secondary',
            'text_color'       => '--color-text',
            'link_color'       => '--color-link',
            'heading_color'    => '--color-heading',
            'background_color' => '--color-background',
        ];
        $out = ':root{';
        foreach ( $map as $key => $var ) {
            if ( isset( $opts[ $key ] ) ) {
                $out .= "{$var}:". esc_attr( $opts[ $key ] ) .';';
            }
        }
        $out .= '}';
        return $out;
    }

    /**
     * Body + h1–h6 typography.
     */
    private static function typography_css( array $opts ): string {
        $out = '';

        // Body
        if ( isset( $opts['body_font_family'], $opts['body_font_size'], $opts['body_line_height'] ) ) {
            $out .= "body{";
            $out .= "font-family:". esc_attr( $opts['body_font_family'] ) .";";
            $out .= "font-size:". absint( $opts['body_font_size'] ) ."px;";
            $out .= "line-height:". floatval( $opts['body_line_height'] ) .";";
            $out .= '}';
        }

        // Headings H1–H6
        for ( $i = 1; $i <= 6; $i++ ) {
            $size_key = "heading_font_size_h{$i}";
            if ( isset( $opts[ $size_key ] ) ) {
                $out .= "h{$i}{";
                $out .= "font-family:". esc_attr( $opts['heading_font_family'] ) .";";
                $out .= "font-weight:". absint( $opts['heading_font_weight'] ) .";";
                $out .= "font-size:". absint( $opts[ $size_key ] ) ."px;";
                $out .= "line-height:". floatval( $opts['heading_line_height'] ) .";";
                $out .= '}';
            }
        }

        return $out;
    }

    /**
     * Layout: container width & sidebar.
     */
    private static function layout_css( array $opts ): string {
        $out = '';

        if ( isset( $opts['container_width'] ) ) {
            $out .= ".site-container{max-width:". absint( $opts['container_width'] ) ."px;}";
        }
        if ( isset( $opts['sidebar_width'] ) ) {
            $out .= ".sidebar{width:". absint( $opts['sidebar_width'] ) ."px;}";
        }

        return $out;
    }

    /**
     * Button styles & hover.
     */
    private static function buttons_css( array $opts ): string {
        $out  = '';
        if ( isset( $opts['button_text_color'], $opts['button_bg_color'] ) ) {
            $out .= ".btn,button,input[type=\"button\"],input[type=\"submit\"]{";
            $out .= "color:". esc_attr( $opts['button_text_color'] ) .";";
            $out .= "background-color:". esc_attr( $opts['button_bg_color'] ) .";";
            $out .= "border-radius:". absint( $opts['button_border_radius'] ) ."px;";
            $out .= "padding:". absint( $opts['button_padding'] ) ."px;";
            $out .= '}';
        }
        if ( isset( $opts['button_hover_text_color'], $opts['button_hover_bg_color'] ) ) {
            $out .= ".btn:hover,button:hover,input[type=\"button\"]:hover,input[type=\"submit\"]:hover{";
            $out .= "color:". esc_attr( $opts['button_hover_text_color'] ) .";";
            $out .= "background-color:". esc_attr( $opts['button_hover_bg_color'] ) .";";
            $out .= '}';
        }
        return $out;
    }

    /**
     * Header: sticky, transparent, bg-color.
     */
    private static function header_css( array $opts ): string {
        $out = '';
        if ( ! empty( $opts['header_sticky'] ) ) {
            $out .= '.site-header{position:sticky;top:0;z-index:1000;}';
        }
        if ( ! empty( $opts['header_transparent'] ) ) {
            $out .= '.site-header{background:transparent;}';
        } elseif ( ! empty( $opts['header_bg_color'] ) ) {
            $out .= ".site-header{background-color:". esc_attr( $opts['header_bg_color'] ) .";}";
        }
        return $out;
    }

    /**
     * Footer: background, text, links, padding.
     */
    private static function footer_css( array $opts ): string {
        $out  = '';
        $out .= '.site-footer{';
        if ( ! empty( $opts['footer_bg_color'] ) ) {
            $out .= "background-color:". esc_attr( $opts['footer_bg_color'] ) .";";
        }
        if ( ! empty( $opts['footer_text_color'] ) ) {
            $out .= "color:". esc_attr( $opts['footer_text_color'] ) .";";
        }
        if ( isset( $opts['footer_padding'] ) ) {
            $out .= "padding:". absint( $opts['footer_padding'] ) ."px;";
        }
        $out .= '}';

        if ( ! empty( $opts['footer_link_color'] ) ) {
            $out .= ".site-footer a{color:". esc_attr( $opts['footer_link_color'] ) .";}";
            $out .= ".site-footer a:hover{text-decoration:underline;}";
        }
        return $out;
    }

    /**
     * Breadcrumbs: show/hide and separator.
     */
    private static function breadcrumbs_css( array $opts ): string {
        if ( empty( $opts['breadcrumbs_enable'] ) ) {
            return '.breadcrumbs{display:none;}';
        }
        $sep = esc_html( $opts['breadcrumbs_separator'] );
        return ".breadcrumbs li+li:before{content:'{$sep}';padding:0 0.5em;}";
    }

    /**
     * WooCommerce: columns, sale badge, image position.
     */
    private static function woocommerce_css( array $opts ): string {
        $out = '';
        if ( class_exists( 'WooCommerce' ) ) {
            if ( isset( $opts['wc_shop_columns'] ) ) {
                $cols = absint( $opts['wc_shop_columns'] );
                $out .= ".woocommerce ul.products{grid-template-columns:repeat({$cols},1fr);}";
            }
            if ( ! empty( $opts['wc_sale_badge_color'] ) ) {
                $out .= ".woocommerce .onsale{color:". esc_attr( $opts['wc_sale_badge_color'] ) .";";
                $out .= "background-color:". esc_attr( $opts['wc_sale_badge_bg_color'] ) .";}";
            }
            if ( ! empty( $opts['wc_single_image_position'] ) ) {
                $pos = esc_attr( $opts['wc_single_image_position'] );
                $out .= ".woocommerce div.product .images{float:{$pos};}";
            }
        }
        return $out;
    }
}

// Bootstrap
Dynamic_CSS::init();
