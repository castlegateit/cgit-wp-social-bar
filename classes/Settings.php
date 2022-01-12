<?php

declare(strict_types=1);

namespace Castlegate\SocialBar;

class Settings
{
    /**
     * Settings page title
     *
     * @var string
     */
    private static $title = 'Social Bar';

    /**
     * Settings page slug
     *
     * @var string
     */
    private static $slug = 'cgit-wp-social-bar';

    /**
     * Settings page capability
     *
     * @var string
     */
    private static $capability = 'manage_options';

    /**
     * Option name for sites
     *
     * @var string
     */
    private static $sitesOption = 'cgit_wp_social_bar_sites';

    /**
     * Option name for position
     *
     * @var string
     */
    private static $positionOption = 'cgit_wp_social_bar_position';

    /**
     * Available positions
     *
     * @var array
     */
    private static $positions = [
        'left' => 'Left',
        'right' => 'Right',
        'top' => 'Top',
        'bottom' => 'Bottom',
    ];

    /**
     * Settings form ID
     *
     * @var string
     */
    private static $formId = 'cgit_wp_social_bar_settings';

    /**
     * Initialization
     *
     * @return void
     */
    public static function init(): void
    {
        $settings = new static();

        add_action('admin_enqueue_scripts', [$settings, 'enqueueScript']);
        add_action('admin_enqueue_scripts', [$settings, 'enqueueStyle']);
        add_action('admin_init', [$settings, 'save']);
        add_action('admin_menu', [$settings, 'registerSettingsPage']);
    }

    /**
     * Enqueue admin JavaScript
     *
     * @return void
     */
    public function enqueueScript(): void
    {
        Script::enqueue('cgit-wp-social-bar-admin', 'dist/admin-js/script.min.js', [
            'jquery-ui-sortable',
        ]);
    }

    /**
     * Enqueue admin CSS
     *
     * @return void
     */
    public function enqueueStyle(): void
    {
        Style::enqueue('cgit-wp-social-bar-admin', 'dist/css/admin.min.css');
    }

    /**
     * Save settings
     *
     * @return void
     */
    public function save(): void
    {
        $submitted_form_id = $_POST['form_id'] ?? null;

        if (!$submitted_form_id || $submitted_form_id !== static::$formId) {
            return;
        }

        $sites = (array) ($_POST['sites'] ?? []);
        $position = static::sanitizePosition((string) ($_POST['position'] ?? ''));

        static::saveOption(static::$sitesOption, $sites);
        static::saveOption(static::$positionOption, $position);

        add_action('admin_notices', [$this, 'renderSaveMessage']);
    }

    /**
     * Save option
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private static function saveOption(string $key, $value): void
    {
        if (get_option($key) === false) {
            add_option($key, $value);
            return;
        }

        update_option($key, $value);
    }

    /**
     * Return saved sites
     *
     * @param bool $disabled Include disabled sites.
     * @return array
     */
    public static function sites($disabled = false): array
    {
        $settings = static::sanitizeSites((array) get_option(static::$sitesOption));

        if ($disabled) {
            return $settings;
        }

        return array_filter($settings, function ($setting) {
            return $setting['enabled'];
        });
    }

    /**
     * Return saved position
     *
     * @return string
     */
    public static function position(): string
    {
        return static::sanitizePosition((string) get_option(static::$positionOption));
    }

    /**
     * Sanitize settings
     *
     * @param array $settings
     * @return array
     */
    public static function sanitizeSites(array $settings): array
    {
        $sites = Sites::sites();
        $items = [];

        foreach ($sites as $key => $site) {
            $items[$key] = [
                'enabled' => (bool) ($settings[$key]['enabled'] ?? false),
                'sort' => (int) ($settings[$key]['sort'] ?? 0),
                'url' => (string) ($settings[$key]['url'] ?? ''),
                'name' => $site['name'],
            ];
        }

        uasort($items, static::class . '::sort');

        return $items;
    }

    /**
     * Compare site settings for sort
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    private static function sort(array $a, array $b): int
    {
        if ($a['enabled'] === $b['enabled']) {
            if ($a['sort'] === $b['sort']) {
                return $a['name'] <=> $b['name'];
            }

            return $a['sort'] <=> $b['sort'];
        }

        return $b['enabled'] <=> $a['enabled'];
    }

    /**
     * Sanitize position
     *
     * @param string $position
     * @return string
     */
    private static function sanitizePosition(string $position): string
    {
        $position = strtolower($position);

        if ($position || array_key_exists($position, static::$positions)) {
            return $position;
        }

        return array_key_first(static::$positions);
    }

    /**
     * Register settings page
     *
     * @return void
     */
    public function registerSettingsPage(): void
    {
        add_submenu_page(
            'options-general.php',
            static::$title,
            static::$title,
            static::$capability,
            static::$slug,
            [$this, 'renderSettingsPage']
        );
    }

    /**
     * Render settings page
     *
     * @return void
     */
    public function renderSettingsPage(): void
    {
        $sites = static::sites(true);
        $position = static::position();
        $available_positions = static::$positions;
        $form_id = static::$formId;

        include dirname(CGIT_SOCIAL_BAR_PLUGIN) . '/parts/settings.php';
    }

    /**
     * Render save message
     *
     * @return void
     */
    public function renderSaveMessage(): void
    {
        include dirname(CGIT_SOCIAL_BAR_PLUGIN) . '/parts/settings-save-message.php';
    }
}
