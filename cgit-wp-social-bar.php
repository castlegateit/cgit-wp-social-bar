<?php

/**
 * Plugin Name: Castlegate IT WP Social Bar
 * Plugin URI: https://github.com/castlegateit/cgit-wp-social-bar
 * Description: Sticky social bar for WordPress.
 * Version: 2.0.1
 * Author: Castlegate IT
 * Author URI: https://www.castlegateit.co.uk/
 * License: MIT
 */

use Castlegate\SocialBar\Plugin;

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_SOCIAL_BAR_PLUGIN', __FILE__);

require_once __DIR__ . '/vendor/autoload.php';

Plugin::init();
