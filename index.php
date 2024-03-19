<?php

/**
* Plugin Name:       Eye-P
* Plugin URI:        https://www.archangel-media.com/
* Description:       Eye-P Let's you See what's happening on your site!
* Version:           1.0.0
* Requires at least: 5.9
* Requires PHP:      7.2
* Author:            Archangel Media Development
* Author URI:        https://www.archangel-media.com
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:        https://example.com/my-plugin/
* Text Domain:       eye-p
* Domain Path:       /languages
*/

if(!function_exists('add_action')){
    echo "Bad execution of plugin file";
    exit;
}

// Setup
define ('EYE_P_PLUGIN_DIR', plugin_dir_path(__FILE__));
const EYE_P_PLUGIN_FILE = __FILE__;


// Includes
$rootFiles = glob( EYE_P_PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob( EYE_P_PLUGIN_DIR . 'includes/**/*.php');
$allFiles =  array_merge($rootFiles, $subdirectoryFiles);
require_once 'vendor/autoload.php';


foreach($allFiles as $filename) {
    include_once($filename);
}

// Hooks
add_action('init', 'eye_p_register_blocks');
add_action( 'wp_enqueue_scripts', 'eye_p_enqueue_scripts',1 );
add_action( 'enqueue_block_editor_assets', 'eye_p_enqueue_block_editor_assets' );
add_action('admin_menu', 'msip_admin_menus');
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
add_action('admin_enqueue_scripts', 'my_custom_admin_scripts', 1);
register_activation_hook(__FILE__,'eye_p_activate_plugin');
add_action('wp_ajax_eye_p_log_ip_ajax', 'eye_p_log_ip_ajax');
add_action('wp_ajax_nopriv_eye_p_log_ip_ajax', 'eye_p_log_ip_ajax');
add_action('template_redirect', 'log_page_visit_to_db');
add_action('wp_ajax_handle_leaving', 'handle_leaving_action');
add_action('wp_ajax_nopriv_handle_leaving', 'handle_leaving_action');
add_action('wp_ajax_eye_p_fetch_data', 'eye_p_fetch_data');