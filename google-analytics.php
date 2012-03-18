<?php
/*
Plugin Name: Google Analytics Management
Plugin URI: https://github.com/adaykin/google-analytics
Description: Management for google analytics placement
Version: 0.1
Author: Andy Daykin
Author URI: http://andydaykin.com
License: MIT
*/

add_action('wp_footer', 'outputAnalytics');

if(is_admin()) {
	require_once 'google-analytics-admin.php';
}

function outputAnalytics()
{
	$options = get_option('analytics_code');
	echo $options['google_analytics_code'];
}

?>