<?php
/**
 * Theme Functions.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @license   MIT
 *
 */

namespace Link365\Theme;

define( 'CHILD_THEME_NAME', 'Link365' );
define( 'CHILD_THEME_URL', 'http://link365.test/link365' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

load_child_theme_textdomain( 'link365', get_stylesheet_directory() . '/languages' );

include_once __DIR__ . '/includes/theme-setup.php';
include_once __DIR__ . '/includes/theme-markup.php';
include_once __DIR__ . '/includes/theme-assets.php';
include_once __DIR__ . '/includes/theme-page-builder.php';

// Include php files from includes folder
include_once __DIR__ . '/template-parts/cpt/invoices.php';
