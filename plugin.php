<?php 
/*
Plugin Name: Better Google Forms
Plugin URI: https://github.com/mojowen/Better-Google-Forms
Description: Embeds Google forms in posts, but better!
Author: Scott Duncombe
Version: 0.5
Author URI: http://scottduncombe.com/
*/

// Setting a base path. Easy change if the code is going to be incorporated into a theme, use get_bloginfo('theme_directory') instead
$base = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));
define('better_googleforms_base', $base);


include_once('googleform_embed.php');
include_once('googleform_shortcode.php');

?>