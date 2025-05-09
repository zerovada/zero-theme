<?php
/**
 * Zero Theme functions and definitions
 *
 * @package Zero
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/inc/Autoloader.php';
\Zero\Autoloader::register();

\Zero\Core\Theme::init();