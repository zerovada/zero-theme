<?php
/**
 * Zero Theme functions and definitions
 *
 * @package Zero
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$composer = get_template_directory() . '/vendor/autoload.php';
if ( file_exists( $composer ) ) {
    require_once $composer;
}

require_once get_template_directory() . '/inc/Autoloader.php';
\Zero\Autoloader::register();

\Zero\Core\Theme::init();