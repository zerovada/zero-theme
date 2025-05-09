<?php
declare( strict_types=1 );

namespace Zero\Core;
use Zero\Builder\Helper;

class Theme {

    public static function init(): void {
        \Zero\Autoloader::register();

        add_action( 'after_setup_theme', [ __CLASS__, 'setup' ] );
        add_action( 'wp', [ __CLASS__, 'set_content_width' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );
        add_action( 'enqueue_block_editor_assets', [ __CLASS__, 'enqueue_assets' ] );
    }

    public static function enqueue_assets(): void {
//        $ver = filemtime( get_template_directory() . '/assets/dist/js/main.js' );
//        wp_enqueue_style(  'zero-style',      get_template_directory_uri() . '/assets/dist/css/style.css', [], $ver );
//        wp_enqueue_script( 'zero-frontend',   get_template_directory_uri() . '/assets/dist/js/main.js', [], $ver, true );
//        wp_enqueue_script( 'zero-customizer', get_template_directory_uri() . '/assets/dist/js/customizer.js', [], $ver, true );
//        add_editor_style( 'assets/dist/css/editor-style.css' );
        $theme_version = wp_get_theme()->get( 'Version' );
        $dist_dir      = get_template_directory() . '/assets/dist';
        $dist_uri      = get_template_directory_uri() . '/assets/dist';

        $manifest_path = $dist_dir . '/manifest.json';
        if ( file_exists( $manifest_path ) ) {
            $manifest = json_decode( file_get_contents( $manifest_path ), true );
            foreach ( $manifest as $key => $entry ) {
                if ( empty( $entry['isEntry'] ) ) {
                    continue;
                }
                if ( ! empty( $entry['css'] ) ) {
                    foreach ( $entry['css'] as $css_file ) {
                        wp_enqueue_style(
                            "zero-{$key}",
                            "{$dist_uri}/{$css_file}",
                            [],
                            $theme_version
                        );
                    }
                }
                $deps = [];
                if ( ! empty( $entry['imports'] ) ) {
                    foreach ( $entry['imports'] as $import ) {
                        $deps[] = "zero-{$import}";
                    }
                }
                wp_enqueue_script(
                    "zero-{$key}",
                    "{$dist_uri}/{$entry['file']}",
                    $deps,
                    $theme_version,
                    true
                );
            }
        } else {
            wp_enqueue_style( 'zero-style', "{$dist_uri}/css/style.css", [], $theme_version );
            wp_enqueue_script( 'zero-main', "{$dist_uri}/js/main.js", [], $theme_version, true );
        }
        add_editor_style( 'assets/dist/css/editor-style.css' );
    }

    public static function setup(): void {
        load_theme_textdomain( 'zero', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', [
            'navigation-widgets',
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        ] );

        add_theme_support( 'post-formats', [
            'gallery',
            'image',
            'link',
            'quote',
            'video',
            'audio',
            'status',
            'aside',
        ] );

        add_theme_support( 'custom-logo',[
            'width'       => 180,
            'height'      => 60,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/dist/css/editor-style.css' );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'rank-math-breadcrumbs' );
        add_theme_support( 'amp', [ 'paired' => true ] );
        remove_theme_support( 'block-templates' );

        add_theme_support( 'align-wide' );
        add_theme_support( 'align-full' );

        add_filter(
            'embed_oembed_html',
            [ __CLASS__, 'responsive_oembed_wrapper' ],
            10,
            3
        );

        register_nav_menus( [
            'primary'   => __( 'Primary Menu', 'zero' ),
            'secondary' => __( 'Secondary Menu', 'zero' ),
            'social'    => __( 'Social Links Menu', 'zero' ),
            'mobile_menu'    => __( 'Off-Canvas Menu', 'zero' ),
            'loggedin_account_menu' => __( 'Logged In Account Menu', 'zero' ),
            'footer_menu'           => __( 'Footer Menu',           'zero' ),
        ] );

        // Dynamically register extra header menus
        for ( $i = 3; $i <= Helper::$component_limit; $i++ ) {
            register_nav_menus( [
                'menu_' . $i => sprintf( __( 'Menu %d', 'zero' ), $i ),
            ] );
        }
       
        add_action( 'widgets_init', [ __CLASS__, 'register_sidebars' ] );   
     
    }

    public static function responsive_oembed_wrapper( string $html, string $url, array $attr ): string {
        return sprintf(
            '<div class="zero-responsive-embed">%s</div>',
            $html
        );
    }


    public static function set_content_width(): void {
        global $content_width;
        if ( ! isset( $content_width ) ) {
            $content_width = apply_filters( 'zero_content_width', 800 );
        }
    }

    public static function register_sidebars(): void {
        $areas = [
            'header'    => 'Header Widget Area',
            'sidebar-1' => 'Sidebar',
            'footer-1'  => 'Footer 1',
            'footer-2'  => 'Footer 2',
        ];

        foreach ( $areas as $id => $name ) {
            register_sidebar( [
                'name'          => __( $name, 'zero' ),
                'id'            => $id,
                'description'   => sprintf( __( '%s for widgets.', 'zero' ), $name ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ] );
        }
    }
}