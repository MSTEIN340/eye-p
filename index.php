<?php

/**
* Plugin Name:       plugin-template
* Plugin URI:        https://www.archangel-media.com/
* Description:       Revised Block Plugin
* Version:           1.0.0
* Requires at least: 5.9
* Requires PHP:      7.2
* Author:            Archangel Media Development
* Author URI:        https://www.archangel-media.com
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:        https://example.com/my-plugin/
* Text Domain:       plugin-template
* Domain Path:       /languages
*/

if(!function_exists('add_action')){
    echo "Bad execution of plugin file";
    exit;
}

// Setup
define ('UP_PLUGIN_DIR', plugin_dir_path(__FILE__));


// Includes
$rootFiles = glob( UP_PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob( UP_PLUGIN_DIR . 'includes/**/*.php');
$allFiles =  array_merge($rootFiles, $subdirectoryFiles);

foreach($allFiles as $filename) {
    include_once($filename);
}

// Hooks
add_action('init', 'up_register_blocks');
add_action( 'wp_enqueue_scripts', 'aa_enqueue_scripts',1 );
add_action( 'enqueue_block_editor_assets', 'msaa_enqueue_block_editor_assets' );


