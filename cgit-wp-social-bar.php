<?php


/*
 *  Plugin Name: Castlegate IT Social Bar
 *  Plugin URI: https://github.com/castlegateit/cgit-social-bar
 *  Description: Add a sticky social bar to your site.
 *  Version: 1.0
 *  Author: Castlegate IT
 *  Author URI: https://www.castlegateit.co.uk/
 *  Network: true
 *
 *
 * Copyright (c) 2019 Castlegate IT. All rights reserved.
 *
 */

if (!defined('ABSPATH')) {
    wp_die('Access Denied');
}

define('CGIT_WP_SOCIAL_BAR', __FILE__);

require_once __DIR__ . '/classes/autoload.php';

$plugin = new \Cgit\Socialbar\Plugin;

do_action('cgit_wp_social_bar', $plugin);
do_action('cgit_wp_social_bar_loaded');