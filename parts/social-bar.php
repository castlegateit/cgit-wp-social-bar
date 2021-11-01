<?php

$sites = $sites ?? [];

// Restrict output to items with a URL.
foreach ($sites as $key => $site) {
    if (!$site['url']) {
        unset($sites[$key]);
    }
}

if (!$sites) {
    return;
}

?>

<div class="cgit-wp-social-bar cgit-wp-social-bar--<?= $position ?>">
    <?php

    foreach ($sites as $key => $site) {
        $file = dirname(CGIT_SOCIAL_BAR_PLUGIN) . "/images/$key.svg";
        $icon = '<span class="cgit-wp-social-bar__link-icon-initial">' . strtoupper(substr($site['name'], 0, 1)) . '</span>';

        if (is_file($file)) {
            $icon = file_get_contents($file);
        }

        ?>
        <span class="cgit-wp-social-bar__item">
            <a href="<?= $site['url'] ?>" class="cgit-wp-social-bar__link cgit-wp-social-bar__link--<?= $key ?>">
                <span class="cgit-wp-social-bar__link-icon">
                    <?= $icon ?>
                </span>

                <span class="cgit-wp-social-bar__link-text">
                    <?= $site['name'] ?>
                </span>
            </a>
        </span>
        <?php
    }

    ?>
</div>
