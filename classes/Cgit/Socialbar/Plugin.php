<?php

namespace Cgit\Socialbar;

class Plugin
{

    //Register our default social links.
    private $socials = [
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'ebay',
        'pinterest',
    ];


    /**
     * Plugin constructor.
     *
     * @return void
     */

    public function __construct()
    {
        register_activation_hook(
            CGIT_WP_SOCIAL_BAR,
            [$this, 'activation']
        );
        add_action(
            'init',
            [$this, 'init']
        );
    }

    /**
     * Activation
     *
     * @return void
     */

    public function activation()
    {
        if (!function_exists('acf_add_local_field_group')) {
            wp_die('Advanced Custom Fields is a required plugin, please activate it and try again.');
        }
    }

    /**
     * Initialization
     *
     *
     * @return void
     */

    public function init()
    {
        wp_enqueue_style('style.css', plugin_dir_url(CGIT_WP_SOCIAL_BAR) . 'resources/style.css');

        $this->register_fields();
    }

    /**
     * Register Custom Fields
     *
     *
     * @return void
     */

    public function register_fields()
    {
        $location = [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site-options',
                ],
            ],
        ];

        acf_add_options_page([
            'page_title' => 'Options',
            'menu_slug' => 'site-options',
            'capability' => 'edit_others_posts',
        ]);

        acf_add_local_field_group([
            'title' => 'Social Media',
            'location' => $location,
            'menu_order' => 10,
            'fields' => [
                [
                    'key' => 'options__social_repeater',
                    'label' => 'Social Icons',
                    'name' => 'options_social_repeater',
                    'type' => 'repeater',
                    'button_label' => 'Add Social Link',
                    'sub_fields' => [
                        [
                            'key' => 'social__choices',
                            'label' => 'Social Choice',
                            'name' => 'social_choices',
                            'type' => 'select',
                            'choices' => [
                                'facebook' => 'Facebook',
                                'twitter' => 'Twitter',
                                'linkedin' => 'Linkedin',
                                'instagram' => 'Instagram',
                                'youtube' => 'Youtube',
                                'ebay' => 'Ebay',
                                'pinterest' => 'Pinterest',
                            ],
                        ],
                        [
                            'key' => 'social__link',
                            'label' => 'Social Link',
                            'name' => 'social_link',
                            'type' => 'link',
                            'return_format' => 'array',
                            'wrapper' => [
                                'width' => '50',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Render Social Bar
     *
     * Takes optional args to switch colors etc. //TODO
     *
     * @param array $args
     */

    public function render_social_bar($args = [])
    {
        $args = implode(' -', $args);

        echo '<div class="social-icons ' . $args . '">';
        if (have_rows('options__social_repeater', 'options')) :
            while (have_rows('options__social_repeater', 'options')) : the_row();
                if (get_sub_field('social__link')) {
                    $social = get_sub_field('social__choices');
                    $link = get_sub_field('social__link', 'options');

?>
                    <a href="<?= $link['url'] ?>" class="single <?= $social ?>" target="<?= $link['target'] ?: '_self' ?>">
                        <?= file_get_contents(dirname(CGIT_WP_SOCIAL_BAR) . '/resources/icons/' . $social . '.svg'); ?>
                    </a>
<?php
                }
            endwhile;
        endif;
        echo '</div>';
    }
}
