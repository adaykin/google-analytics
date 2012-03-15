<?php
/*
Plugin Name: Google Analytics Management
Plugin URI: http://andydaykin.com
Description: Management for google analytics placement
Version: 0.1
Author: Andy Daykin
Author URI: http://andydaykin.com
License: MIT
*/

add_action('wp_footer', 'outputAnalytics');

if(is_admin()) {
	add_filter('plugin_action_links', 'google_analytics_plugin_action_links', 10, 2);
}

function outputAnalytics()
{
	$option = get_option('plugin_options');
	echo $options['text_string'];
}

function google_analytics_plugin_action_links($links, $file)
{
	if($file == plugin_basename(dirname(__FILE__) . '/google-analytics.php')) {
		$links[] = '<a href="options-general.php?page=google-analytics-admin.php">'.__('Settings').'</a>';
	}

	return $links;
}

?>