<?php

function msip_admin_menus() {
    add_menu_page(
        __('Eye-P', 'eye-p' ),
        __('Eye-P', 'eye-p' ),
        'edit_theme_options',
        'eye-p-options',
        'eye_p_options_page',
        plugins_url('/img/lock-eye-svgrepo.svg', EYE_P_PLUGIN_DIR . "/assets/img/" )
    );
    // Add a submenu item under the "Eye-P" menu
    add_submenu_page(
        'eye-p-options',  // Parent slug
        __('Submenu Title', 'eye-p'),  // Page title
        __('Submenu Title', 'eye-p'),  // Menu title
        'edit_theme_options',  // Capability
        'eye-p-submenu',  // Menu slug
        'eye_p_submenu_page'  // Function to display the submenu content
    );
}

function load_custom_wp_admin_style(){
    wp_register_style( 'custom_wp_admin_css', plugins_url() . '/eye-p/assets/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
    wp_localize_script( 'eye-p', 'eyepBlockData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'pluginUrl' => plugins_url('/eye-p/includes/process/'),
        'nonce'    => wp_create_nonce( 'my_nonce' ),
    ));
}

function my_custom_admin_scripts($hook_suffix) {
 //   if ('edit.php' !== $hook_suffix) {
 //       return;
//    }
    if ('toplevel_page_eye-p-options' === $hook_suffix) {
        wp_enqueue_script('eye-p-admin-js', plugins_url('/eye-p/assets/js/eye_p_admin.js'), array('jquery'), null, true);
        wp_localize_script('eye-p-admin-js', 'eyePAdmin', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    wp_register_script('eye-p', plugins_url('/eye-p/assets/js/eye_p.js'));
    wp_enqueue_script('eye-p');
    wp_localize_script( 'eye-p', 'eyepBlockData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'pluginUrl' => plugins_url('/eye-p/includes/process/'),
        'nonce'    => wp_create_nonce( 'my_nonce' ),
    ) );
}