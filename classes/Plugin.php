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

        include dirname(CGIT_SOCIAL_BAR_PLUGIN) . '/parts/social-bar.php';
    }
}
