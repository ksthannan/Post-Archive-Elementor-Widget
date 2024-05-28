<?php
/*
Plugin Name: Post Archive Elementor Widget
Description: Elementor addon for Post Archive Widget
Version: 1.0.0
Author: PAEW
Author URI: #
License: GPLv2
Text Domain: paew
 */

if (!defined('ABSPATH')) {
    exit;
}


define('PAEW_VERSION', time());
define('PAEW_FILE', __FILE__);
define('PAEW_PATH', __DIR__);
define('PAEW_URL', plugins_url('', PAEW_FILE));
define('PAEW_ASSETS', PAEW_URL . '/assets');

register_activation_hook(__FILE__, 'paew_activation');
function paew_activation(){

}

add_action('plugins_loaded', 'paew_init_plugin');
function paew_init_plugin(){
	load_plugin_textdomain('paew', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

add_action('init', 'paew_run');
function paew_run(){

}

add_action('admin_enqueue_scripts', 'paew_admin_scripts');
function paew_admin_scripts()
{
    wp_enqueue_style('paew-admin-style', PAEW_ASSETS . '/css/admin_style.css', array(), PAEW_VERSION, 'all');
	
    wp_enqueue_script('paew-admin-script', PAEW_ASSETS . '/js/admin_script.js', array('jquery' ), PAEW_VERSION, true);
}

add_action('wp_enqueue_scripts', 'paew_frontend_scripts');
function paew_frontend_scripts()
{
    wp_enqueue_style('paew-style', PAEW_ASSETS . '/css/style.css', array(), PAEW_VERSION, 'all');	

    wp_enqueue_script('paew-script', PAEW_ASSETS . '/js/script.js', array('jquery'), PAEW_VERSION, true);

    wp_localize_script( 'paew-script', 'paew_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ), 
	));

}

require_once('inc//functions.php');
require_once('inc/admin/admin.php');
require_once('inc/widgets/widgets.php');

