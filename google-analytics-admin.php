<?php 

add_action('admin_menu', 'google_analytics_admin_page');
add_filter('plugin_action_links', 'google_analytics_plugin_action_links', 10, 2);


function google_analytics_admin_init()
{
	register_setting('plugin_options', 'analytics_code', 'google_analytics_options_validate');
}

function google_analytics_section_text()
{
	echo '<p>Enter your code given to you by google analytics in the field below.</p>';
}

function google_analytics_admin_page()
{
	add_options_page('Google Analytics Plugin Settings', 'Google Analytics', 'manage_options', 'google-analytics-options', 'google_analytics_options_page');
	add_settings_section('plugin_main', 'Code', 'google_analytics_section_text', 'plugin');
	add_settings_field('analytics_code_display', 'Google Analytics Code', 'google_analytics_setting_string', 'plugin', 'plugin_main');
	
	add_action('admin_init', 'google_analytics_admin_init');
}

function google_analytics_options_page()
{
?>
	<div>
	<h2>Google Analytics</h2>
	<form action="options.php" method="post">
	<?php settings_fields('plugin_options'); ?>
	<?php do_settings_sections('plugin'); ?>
	
	<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
	</form></div>	
<?php
}

function google_analytics_setting_string()
{
	$options = get_option('analytics_code');
	echo "<textarea id='google_analytics_code' name='analytics_code[google_analytics_code]' cols='100' rows='10'>{$options['google_analytics_code']}</textarea>";
}

function google_analytics_options_validate($input)
{
	$newinput['google_analytics_code'] = trim($input['google_analytics_code']);
	// Later on add some better validation
	/*if(!preg_match('/[a-z0-9]/i', $newinput['google_analytics_code'])) {
		$newinput['google_analytics_code'] = '';
	}*/
	
	return $newinput;
}

function google_analytics_plugin_action_links($links, $file)
{
	if($file == plugin_basename(dirname(__FILE__) . '/google-analytics.php')) {
		$links[] = '<a href="options-general.php?page=google-analytics-admin.php">'.__('Settings').'</a>';
	}

	return $links;
}