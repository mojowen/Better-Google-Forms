<?php 
/*
Plugin Name: Better Google Forms
Plugin URI: https://github.com/mojowen/Better-Google-Forms
Description: Embeds Google forms in posts, but better!
Author: Scott Duncombe
Version: 0.6
Author URI: http://scottduncombe.com/
*/

// Setting a base path. Easy change if the code is going to be incorporated into a theme, use get_bloginfo('theme_directory') instead
$base = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));
define('better_googleforms_base', $base);


include_once('googleform_embed.php');
include_once('googleform_shortcode.php');

/*  Copyright 2012  Scott Duncombe  (email : srduncombe@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


?>