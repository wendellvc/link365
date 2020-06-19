<?php
/**
 * Theme Functions.
 *
 * @package   WDC\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @license   MIT
 *
 *
 *   _       _   _                 _   _
 *  (_)_ __ | |_(_)_ __ ___   __ _| |_(_) ___  _ __
 *  | | '_ \| __| | '_ ` _ \ / _` | __| |/ _ \| '_ \
 *  | | | | | |_| | | | | | | (_| | |_| | (_) | | | |
 *  |_|_| |_|\__|_|_| |_| |_|\__,_|\__|_|\___/|_| |_|
 *
 */

namespace WDC\Theme;

define( 'CHILD_THEME_NAME', 'WDC' );
define( 'CHILD_THEME_URL', 'https://intimation.dev/wdc/theme' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

load_child_theme_textdomain( 'wdc', get_stylesheet_directory() . '/languages' );

include_once __DIR__ . '/includes/theme-setup.php';
include_once __DIR__ . '/includes/theme-markup.php';
include_once __DIR__ . '/includes/theme-assets.php';
include_once __DIR__ . '/includes/theme-page-builder.php';
// Include php files from includes folder
include_once __DIR__ . '/template-parts/cpt/case-studies.php';
include_once __DIR__ . '/template-parts/cpt/testimonials.php';
