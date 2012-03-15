<?php 

add_action('admin_menu', 'google_analytics_admin_add_page');
add_action('admin_init', 'google_analytics_admin_init');

function google_analytics_admin_init()
{
	register_setting('plugin_options', 'plugin_options', 'google_analytics_options_validate');
	add_settings_section('plugin_main', 'Main Settings', 'google_analytics_section_text', 'plugin');
	add_settings_field('plugin_text_string', 'Plugin Text Input', 'google_analytics_setting_string', 'plugin', 'plugin_main');
}

function google_analytics_section_text()
{
	echo '<p>Main description of this section here.</p>';
}

function google_analytics_admin_add_page()
{
	add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'google_analytics_options_page');
}

function google_analytics_options_page()
{
?>
	<div>
	<h2>My custom plugin</h2>
	Options relating to the Custom Plugin.
	<form action="options.php" method="post">
	<?php settings_fields('plugin_options'); ?>
	<?php do_settings_sections('plugin'); ?>
	
	<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
	</form></div>	
<?php
}

function google_analytics_setting_string()
{
	$options = get_option('plugin_options');
	echo "<textarea id='plugin_text_string' name='plugin_options[text_string]' cols='40' rows='60'>{$options['text_string']}</textarea>";
}

function google_analytics_options_validate($input)
{
	$newinput['text_string'] = trim($input['text_string']);
	if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
		$newinput['text_string'] = '';
	}
	return $newinput;
}