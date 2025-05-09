<?php
declare( strict_types=1 );

namespace Zero;

/**
 * PSR-4 autoloader for the Zero namespace.
 */
class Autoloader {
    /**
     * Register the autoloader with SPL.
     */
    public static function register(): void {
        spl_autoload_register( [ __CLASS__, 'autoload' ] );
    }

    /**
     * Attempt to load a class file for the given fully-qualified class name.
     *
     * @param string $class Fully-qualified class name.
     */
    public static function autoload( string $class ): void {
        $prefix   = __NAMESPACE__ . '\\';
        $base_dir = __DIR__ . '/';
        $len      = strlen( $prefix );

        // Only handle classes in our namespace.
        if ( strncmp( $prefix, $class, $len ) !== 0 ) {
            return;
        }

        // Translate namespace to file path.
        $relative_class = substr( $class, $len );
        $file           = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

        if ( file_exists( $file ) ) {
            require $file;
        }
    }
}
