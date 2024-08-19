<?php

declare(strict_types=1);

namespace Castlegate\SocialBar;

class Plugin
{
    /**
     * Initialization
     *
     * @return void
     */
    public static function init(): void
    {
        Settings::init();

        $plugin = new static();

        add_action('wp_enqueue_scripts', [$plugin, 'enqueueStyle']);
        add_action('wp_footer', [$plugin, 'print']);
    }

    /**
     * Enqueue CSS
     *
     * @return void
     */
    public function enqueueStyle(): void
    {
        Style::enqueue('cgit-wp-social-bar-style', 'dist/css/style.min.css');
    }

    /**
     * Print social bar
     *
     * @return void
     */
    public function print(): void
    {
        $sites = Settings::sites();
        $position = Settings::position();

        if (!$sites) {
            return;
        }

        include CGIT_WP_SOCIAL_BAR_PLUGIN_DIR . '/parts/social-bar.php';
    }
}
