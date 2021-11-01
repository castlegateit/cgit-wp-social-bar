<?php

$enabled = $site['enabled'];
$sort = $site['sort'];
$url = $site['url'];

$enabled_checked = '';

if ($enabled) {
    $enabled_checked = 'checked';
}

?>

<li class="cgit-wp-social-bar-settings__item">
    <div class="cgit-wp-social-bar-settings__item-grid">
        <div class="cgit-wp-social-bar-settings__site-name">
            <?= $site['name'] ?>
        </div>

        <div class="cgit-wp-social-bar-settings__enabled-field">
            <label class="cgit-wp-social-bar-settings__enabled-label">
                <input type="checkbox" name="sites[<?= $key ?>][enabled]" value="1" class="cgit-wp-social-bar-settings__enabled-input" <?= $enabled_checked ?>>
                Enabled
            </label>
        </div>

        <div class="cgit-wp-social-bar-settings__sort-field">
            <label for="cgit-wp-social-bar-sort-<?= $key ?>" class="cgit-wp-social-bar-settings__sort-label">
                Sort order
            </label>

            <input type="number" name="sites[<?= $key ?>][sort]" id="cgit-wp-social-bar-sort-<?= $key ?>" value="<?= htmlspecialchars($sort) ?>" class="cgit-wp-social-bar-settings__sort-input">
        </div>

        <div class="cgit-wp-social-bar-settings__url-field">
            <label for="cgit-wp-social-bar-url-<?= $key ?>" class="cgit-wp-social-bar-settings__url-label">
                URL
            </label>

            <input type="text" name="sites[<?= $key ?>][url]" id="cgit-wp-social-bar-url-<?= $key ?>" value="<?= htmlspecialchars($url) ?>" class="cgit-wp-social-bar-settings__url-input">
        </div>
    </div>
</li>
