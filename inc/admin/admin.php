<?php 
add_action('admin_menu', 'paew_admin_menu');
function paew_admin_menu(){
	// $parent_slug = 'options-general.php';
    $capability = 'manage_options';
//     add_menu_page( __('Roof Cost Calculator', 'paew'), esc_html('Roof Calculator', 'paew'), $capability, 'paew-upload-settings', 'rcc_plugin_seetings', 'dashicons-calculator');
    // add_submenu_page( $parent_slug, __('ROOF REPLACEMENT COST CALCULATOR', 'paew'), esc_html('ROOF REPLACEMENT COST CALCULATOR', 'quick_start'), $capability, 'flyer-upload-settings', 'plugin_seetings');
    
}

function paew_plugin_seetings()
{
?>
<form method="POST" action="options.php">
<?php
    settings_fields('paew_plugin_opt');
    do_settings_sections('paew_plugin_opt');

    submit_button();
    ?>
</form>
<?php 
}

/***  */
add_action( 'admin_init', 'paew_settings_init' );
function paew_settings_init(  ) { 
    register_setting( 'paew_plugin_opt', 'paew_settings' );

    add_settings_section(
        'paew_plugin_opt_section', 
        __( 'ROOF REPLACEMENT COST CALCULATOR SETTINGS', 'paew' ), 
        'paew_settings_section_callback', 
        'paew_plugin_opt'
    );
	
	add_settings_field( 
		'paew_single_upload_id_option', 
		__( 'Quick Start Option Field', 'paew' ), 
		'paew_single_upload_id_option_render', 
		'paew_plugin_opt', 
		'paew_plugin_opt_section'
	);

    // // New field 
    // add_settings_field( 
	// 	'paew_single_upload_id_option', 
	// 	__( 'Quick Start Option Field', 'paew' ), 
	// 	'paew_single_upload_id_option_render', 
	// 	'paew_plugin_opt', 
	// 	'paew_plugin_opt_section'
	// );

	
}

function paew_settings_section_callback(){
	return;
}

function paew_single_upload_id_option_render(){
	$options = get_option( 'paew_settings' );
	?>
    <input class="" type='number' name='paew_settings[paew_single_upload_id_option]' value='<?php echo isset($options['paew_single_upload_id_option']) ? $options['paew_single_upload_id_option'] : ''; ?>'>
	<?php
}
