<?php
/*
Plugin Name: Employee Profile Creator
Description: This plugin allows users to create employee profiles.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            S1G7
*/

// Include the wp_db.php file
require_once( plugin_dir_path( __FILE__ ) . 'wp_db.php' );

// Add shortcode to display form on a page
add_shortcode( 'employee_profile_form', 'display_employee_profile_form' );
function enqueue_employee_profile_form_styles() {
    wp_enqueue_style( 'employee-profile-form', plugin_dir_url( __FILE__ ) . 'employee_style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_employee_profile_form_styles', 10 );
// Handle form submission
add_action( 'init', 'create_employee_profile' );
function display_employee_profile_form() {
	ob_start();

	// Output any form submission errors
	if ( isset( $_GET['error'] ) && $_GET['error'] === 'missing_fields' ) {
		echo '<div class="error">' . esc_html__( 'Please fill in all required fields.', 'employee-profile' ) . '</div>';
	} elseif ( isset( $_GET['error'] ) && $_GET['error'] === 'invalid_email' ) {
		echo '<div class="error">' . esc_html__( 'Invalid email address.', 'employee-profile' ) . '</div>';
	}

	// Output the form
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
	wp_nonce_field( 'create_employee_profile', 'employee_profile_nonce' );
	echo '<div class="form-group">';
	echo '<label for="first_name">' . esc_html__( 'First Name*', 'employee-profile' ) . '</label>';
	echo '<input type="text" name="first_name" id="first_name" class="form-control" required>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="last_name">' . esc_html__( 'Last Name*', 'employee-profile' ) . '</label>';
	echo '<input type="text" name="last_name" id="last_name" class="form-control" required>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="email_address">' . esc_html__( 'Email Address*', 'employee-profile' ) . '</label>';
	echo '<input type="email" name="email_address" id="email_address" class="form-control" required>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="password">' . esc_html__( 'Password*', 'employee-profile' ) . '</label>';
	echo '<input type="password" name="password" id="password" class="form-control" required>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="position">' . esc_html__( 'Position*', 'employee-profile' ) . '</label>';
	echo '<input type="text" name="position" id="position" class="form-control" required>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<button type="submit" name="submit" class="btn btn-primary">' . esc_html__( 'Create Profile', 'employee-profile' ) . '</button>';
	echo '</div>';
	echo '</form>';
	echo '</form>';
	return ob_get_clean();
}
function create_employee_profile() {
    if ( isset( $_POST['submit'] ) ) {
        global $wpdb;
        // Get form data and sanitize
        $first_name = sanitize_text_field( $_POST['first_name'] );
        $last_name = sanitize_text_field( $_POST['last_name'] );
        $email = sanitize_email( $_POST['email_address'] );
        $password = sanitize_text_field( $_POST['password'] );
        $position = sanitize_text_field( $_POST['position'] );

        // Validate form data
        if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $password ) || empty( $position ) ) {
            wp_die( esc_html__( 'Please fill in all required fields.', 'employee-profile' ) );
        }
        if ( ! is_email( $email ) ) {
            wp_die( esc_html__( 'Invalid email address.', 'employee-profile' ) );
        }

        // Insert data into database
        $table_name = $wpdb->prefix . 'employee';
        $data = array(
            'email_address' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'position' => $position,
        );
        $wpdb->insert( $table_name, $data );

        // Display success message
        echo '<div class="success">' . esc_html__( 'Profile created successfully!', 'employee-profile' ) . '</div>';
    }
}


// Add menu page
add_action( 'admin_menu', 'employee_profile_menu' );

function employee_profile_menu() {
	add_menu_page(
		'Employee Profile', // Page title
		'Employee Profile', // Menu title
		'manage_options', // Capability required to access the menu page
		'employee_profile', // Menu slug
		'employee_profile_form' // Callback function to display the menu page
	);
}

// Callback function to display the menu page
function employee_profile_form() {
	echo '<h2>' . esc_html__( 'Employee Profile', 'employee-profile' ) . '</h2>';

	// Display the form
	echo display_employee_profile_form();
}


