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
