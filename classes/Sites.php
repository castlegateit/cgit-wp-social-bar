<?php

declare(strict_types=1);

namespace Castlegate\SocialBar;

class Sites
{
    /**
     * Return list of sites
     *
     * @return array
     */
    public static function sites(): array
    {
        return apply_filters('cgit_wp_social_bar_sites', static::data());
    }

    /**
     * Return list of sites from data file
     *
     * @return array
     */
    public static function data(): array
    {
        $file = dirname(CGIT_SOCIAL_BAR_PLUGIN) . '/data/sites.json';

        if (!is_file($file)) {
            return [];
        }

        $data = json_decode(file_get_contents($file), true);

        if (!is_array($data)) {
            return [];
        }

        return $data;
    }
}
