<?php

declare(strict_types=1);

namespace Castlegate\SocialBar;

abstract class Resource
{
    /**
     * Enqueue function
     *
     * @var string|null
     */
    protected static $function = null;

    /**
     * Enqueue plugin resource
     *
     * @param string $name
     * @param string $path
     * @param array $deps
     * @return void
     */
    final public static function enqueue(string $name, string $path, array $deps = []): void
    {
        $url = path_join(plugin_dir_url(CGIT_SOCIAL_BAR_PLUGIN), $path);
        $file = path_join(dirname(CGIT_SOCIAL_BAR_PLUGIN), $path);

        if (!is_file($file)) {
            return;
        }

        $function = static::$function;
        $function($name, $url, $deps, md5_file($file));
    }
}
