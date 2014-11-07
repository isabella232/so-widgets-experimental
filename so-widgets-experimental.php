<?php

/*
Plugin Name: SiteOrigin Experimental Widgets
Description: A collection of experimental widgets
Version: trunk
Author: SiteOrigin
Author URI: http://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

function so_widgets_experimental_add_folder($folders){
	$folders[] = plugin_dir_path(__FILE__).'widgets/';
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'so_widgets_experimental_add_folder');