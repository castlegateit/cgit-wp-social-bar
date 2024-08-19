<?php

/**
 * Plugin Name:  Castlegate IT WP Social Bar
 * Plugin URI:   https://github.com/castlegateit/cgit-wp-social-bar
 * Description:  Sticky social bar for WordPress.
 * Version:      2.0.5
 * Requires PHP: 8.2
 * Author:       Castlegate IT
 * Author URI:   https://www.castlegateit.co.uk/
 * License:      MIT
 * Update URI:   https://github.com/castlegateit/cgit-wp-social-bar
 */

use Castlegate\SocialBar\Plugin;

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_WP_SOCIAL_BAR_VERSION', '2.0.5');
define('CGIT_WP_SOCIAL_BAR_PLUGIN_FILE', __FILE__);
define('CGIT_WP_SOCIAL_BAR_PLUGIN_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

Plugin::init();
