<?php
/**
 * Created by PhpStorm.
 * User: mstei
 * Date: 10/5/2019
 * Time: 4:50 PM
 */
$plugin_url = plugin_dir_url( __FILE__ );
function eye_p_enqueue_scripts()
{
    wp_register_style('eye_p_style',plugins_url('/eye-p/assets/css/style.css') );
    wp_enqueue_style('eye_p_style');
    wp_enqueue_style('dashicons');

    wp_register_script('eye-p', plugins_url('/eye-p/assets/js/eye_p.js'));
    wp_enqueue_script('eye-p');
    wp_localize_script( 'eye-p', 'eyepBlockData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'pluginUrl' => plugins_url('/eye-p/includes/process/')  ,
        'nonce'    => wp_create_nonce( 'my_nonce' ),
    ) );
}

function eye_p_enqueue_block_editor_assets()
{
    wp_register_script('eye-p', plugins_url('/eye-p/assets/js/eye_p.js'));
    wp_enqueue_script('eye-p');
    wp_localize_script( 'eye-p', 'eyepBlockData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'pluginUrl' => plugins_url('/eye-p/includes/process/'),
        'nonce'    => wp_create_nonce( 'my_nonce' ),
    ) );
}
