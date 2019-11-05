# Castlegate IT WP Social Bar #

Castlegate IT Social Bar is a WordPress plugin that provides the ability to insert a floating social media bar. 

The plugin will currently support the following networks, links can be added via the sits options page: 
1) Facebook
2) Twitter
3) Linkedin
4) Instagram
5) Youtube
6) Ebay

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

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.