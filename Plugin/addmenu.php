<?php
/*
 * Plugin Name:       p
 * Description:       add menu
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            S1
 */
// Add a new top-level menu item
function my_custom_dashboard_menu() {
    add_menu_page(
        'Employee', // Page title
        'Employee',     // Menu title
        'manage_options',   // Capability required to access the page
        'my-dashboard-menu', // Menu slug
        'my_dashboard_menu_callback', // Callback function
        'dashicons-dashboard', // Icon URL
        25 // Position in the menu
    );

    // Add a submenu item to the custom dashboard menu
    add_submenu_page(
        'my-dashboard-menu', // Parent menu slug
        'profile',        // Page title
        'Profile',        // Menu title
        'manage_options',   // Capability required to access the page
        'my-submenu-1',     // Menu slug
        'my_submenu_1_callback' // Callback function
    );

    // Add another submenu item to the custom dashboard menu
    add_submenu_page(
        'my-dashboard-menu', // Parent menu slug
        'Settings',        // Page title
        'Settings',        // Menu title
        'manage_options',   // Capability required to access the page
        'my-submenu-2',     // Menu slug
        'my_submenu_2_callback', // Callback function
        
    );
}
add_action( 'admin_menu', 'my_custom_dashboard_menu' );

// Callback function for the top-level menu item
function my_dashboard_menu_callback() {
    echo '<h1>Employee</h1>';
}

// Callback function for the first submenu item
function my_submenu_1_callback() {
    //echo '<h1>Profile</h1>';
    include('employee.php' ); 
}

// Callback function for the second submenu item
function my_submenu_2_callback() {
   // echo '<h1>Settings</h1>';
    include('additiona_fields.php' ); 
}
?>
