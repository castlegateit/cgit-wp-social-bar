# Castlegate IT WP Social Bar

Castlegate IT WP Social Bar is a WordPress plugin that adds fixed position social network links to a site. After installing and activating the plugin, you can add, edit, sort, and position the links on its options page in **Settings | Social Bar**.

## Filters ##

The `cgit_wp_social_bar_sites` filter lets you customise the list of sites available. Note that colours are not added to the theme automatically; you must add colours to any custom items with CSS. For example:

~~~ css
.cgit-wp-social-bar__link--my-custom-site {
    color: #000;
    background: #ff0;
}

.cgit-wp-social-bar__link--my-custom-site:hover {
    color: #000;
    background: #ff3; /* lighten by 15% */
}
~~~

The `cgit_wp_social_bar_icon` filter allows you to customise the SVG icon output for each item in the social bar. The second parameter is the site key. For example:

~~~ php
add_filter('cgit_wp_social_bar_icon', function ($icon, $key) {
    if ($key === 'my-custom-site') {
        $icon = '<svg>...</svg>';
    }

    return $icon;
}, 10, 2);
~~~

## Changes since version 2.0

Version 2.x is **not compatible** with version 1.x of this plugin. The plugin no longer uses Advanced Custom Fields to manage its options. Therefore, links will need to migrated manually from version 1.x to version 2.x. Also, version 2.x uses the `wp_footer` action for output, so you do not need to modify your theme to display the links on your site.

## Credits

*   Colours: [Lockedown SEO](https://www.lockedownseo.com/social-media-colors/)
*   Icons: [Material Design Icons](https://materialdesignicons.com/)

## License

Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
