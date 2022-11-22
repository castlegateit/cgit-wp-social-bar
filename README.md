# Castlegate IT WP Social Bar #

Castlegate IT Social Bar is a WordPress plugin that provides the ability to insert a floating social media bar. 

The plugin will currently support the following networks, links can be added via the sits options page: 
1) Facebook
2) Twitter
3) Linkedin
4) Instagram
5) Youtube
6) Pinterest
7) Ebay

The plugin provides a function that can be used in your plugin or theme:

~~~ php
$socialbar = new \Cgit\Socialbar\Plugin();
$socialbar->render_social_bar();
~~~

You can also pass an array arguments to alter the appearance of the social bar. Currently this just support floating the bar "right". 

~~~ php
$socialbar->render_social_bar([
    'right',
]);
~~~

## License

Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
