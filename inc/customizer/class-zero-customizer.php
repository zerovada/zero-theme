<?php
/**
 * Zero Theme Customizer Bootstrapper (Data-Driven)
 *
 * @package Zero
 */

namespace Zero\Core\Customizer;

defined( 'ABSPATH' ) || exit;

class Customizer {

    /**
     * Initialize Customizer hooks.
     */
    public static function init(): void {
        add_action( 'customize_register',                [ __CLASS__, 'register_customizer' ],       10 );
        add_action( 'customize_preview_init',            [ __CLASS__, 'enqueue_preview_scripts' ],    10 );
        add_action( 'customize_controls_enqueue_scripts',[ __CLASS__, 'enqueue_control_scripts' ],    10 );
    }

    /**
     * Register all panels, sections, settings, controls, and partials
     * by loading and dispatching the data-driven config files.
     *
     * @param \WP_Customize_Manager $wp_customize
     */
    public static function register_customizer( \WP_Customize_Manager $wp_customize ): void {
        

        //
        // ─── MOVE CORE TITLE & TAGLINE INTO YOUR TOGGLES SECTION ───────────────
        //

        // Site Title (blogname)
        if ( $control = $wp_customize->get_control( 'blogname' ) ) {
            $control->section  = 'zero_site_identity_text';
            $control->priority = 5;
        }

        // Site Tagline (blogdescription)
        if ( $control = $wp_customize->get_control( 'blogdescription' ) ) {
            $control->section  = 'zero_site_identity_text';
            $control->priority = 10;
        }

        // Remove the original Site Identity section
        $wp_customize->remove_section( 'title_tagline' );

       //
       // ─── RELOCATE CORE SITE IDENTITY SECTION INTO ZERO PANEL ───────────────────
       //

       if ( $control = $wp_customize->get_control( 'custom_logo' ) ) {
        $control->section  = 'zero_site_identity_logo';
        $control->priority = 10;
       }
       // ─── Remap the Site Icon control under our Logo section ──────────────────
       if ( $control = $wp_customize->get_control( 'site_icon' ) ) {
        $control->section  = 'zero_site_identity_logo';
        $control->priority = 20;
       }

       // Remove the orphaned favicon section
       $wp_customize->remove_section( 'site_icon' );

        if ( $section = $wp_customize->get_section( 'zero_site_identity' ) ) {
            
        }

     
        // Load all config files from inc/customizer/configs/*.php
        $configs = self::get_configurations();

        // Filter out WooCommerce if it’s not active
        $configs = array_filter( $configs, function( $cfg ) {
            if ( $cfg['id'] === 'zero_woocommerce' ) {
                return class_exists( 'WooCommerce' );
            }
            return true;
        } );
        // ─── ADD THIS DEBUG BLOCK ──────────────────────────────────────────────────
       // foreach ( $configs as $cfg ) {
       // if ( 'setting' === ( $cfg['type'] ?? '' )
       //   && false !== strpos( $cfg['id'], 'primary_color' )
       // ) {
       //     error_log( 'CFG primary_color: ' . wp_json_encode( $cfg ) );
       //     }
       // }
        // ───────────────────────────────────────────────────────────────────────────

       // error_log( 'Zero Customizer configs: ' . print_r( $configs, true ) );
        /**
         * Filter the full customizer configuration array.
         *
         * @param array $configs List of config items (each with 'type','id','args', etc).
         */
        $configs = apply_filters( 'zero_customizer_configurations', $configs );

        // Loop and add each item to the Customizer
        foreach ( $configs as $cfg ) {
            switch ( $cfg['type'] ?? '' ) {
                case 'panel':
                    $wp_customize->add_panel( $cfg['id'], $cfg['args'] );
                    break;

                case 'section':
                    $wp_customize->add_section( $cfg['id'], $cfg['args'] );
                    break;

                case 'setting':
                    $wp_customize->add_setting( $cfg['id'], $cfg['args'] );
                    break;

                case 'control':
                    // If a custom control class is provided, use it
                    if ( ! empty( $cfg['control_class'] ) ) {
                        $wp_customize->add_control( new $cfg['control_class']( $wp_customize, $cfg['id'], $cfg['args'] ) );
                    } else {
                        $wp_customize->add_control( $cfg['id'], $cfg['args'] );
                    }
                    break;

                case 'partial':
                    if ( isset( $wp_customize->selective_refresh ) ) {
                        $wp_customize->selective_refresh->add_partial( $cfg['id'], $cfg['args'] );
                    }
                    break;
            }
        }
    }

    /**
     * Enqueue scripts/styles for the Customizer **preview** (postMessage live updates).
     */
    public static function enqueue_preview_scripts(): void {
        $ver    = wp_get_theme()->get( 'Version' );
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_script(
            'zero-customizer-preview',
            get_template_directory_uri() . "/assets/dist/js/customizer-preview{$suffix}.js",
            [ 'customize-preview', 'zero-frontend' ],
            $ver,
            true
        );
    }

    /**
     * Enqueue scripts/styles for the Customizer **controls** pane.
     */
    public static function enqueue_control_scripts(): void {
        $ver    = wp_get_theme()->get( 'Version' );
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style(
            'zero-customizer-controls',
            get_template_directory_uri() . "/assets/dist/css/customizer-controls{$suffix}.css",
            [],
            $ver
        );
        wp_enqueue_script(
            'zero-customizer-controls',
            get_template_directory_uri() . "/assets/dist/js/customizer-controls-js{$suffix}.js",
            [ 'jquery', 'customize-controls' ],
            $ver,
            true
        );
    }

    /**
     * Load all configuration arrays from the configs directory.
     *
     * Each file in inc/customizer/configs/*.php should return an array
     * of config items, e.g.:
     *   return [
     *     [ 'type'=>'panel', 'id'=>'zero_colors', 'args'=>[...]],
     *     [ 'type'=>'section', 'id'=>'zero_colors_primary', 'args'=>[...]],
     *     [ 'type'=>'setting', 'id'=>'zero_settings[primary_color]', 'args'=>[...] ],
     *     [ 'type'=>'control', 'id'=>'primary_color', 'control_class'=>'\\Zero\\Core\\Customizer\\Controls\\Color', 'args'=>[...] ],
     *     [ 'type'=>'partial', 'id'=>'zero_colors_partial', 'args'=>[...] ],
     *   ];
     *
     * @return array
     */
    protected static function get_configurations(): array {
        $configs = [];
        $files   = glob( get_template_directory() . '/inc/customizer/configs/*.php' );

        if ( $files ) {
            foreach ( $files as $file ) {
                $config = require $file;
                if ( is_array( $config ) ) {
                    $configs = array_merge( $configs, $config );
                }
            }
        }

        return $configs;
    }
}

// Bootstrap the Customizer
Customizer::init();
