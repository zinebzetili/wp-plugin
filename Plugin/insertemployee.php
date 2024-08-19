<?php

// Include the wp_db.php file
//require_once(plugin_dir_path(__FILE__) . 'wp_db.php');

// Enqueue styles
//add_action('wp_enqueue_scripts', 'enqueue_employee_profile_form_styles');

// Handle form submission
/*add_action('admin_post_create_employee_profile', 'create_employee_profile');
add_action('admin_post_nopriv_create_employee_profile', 'create_employee_profile');

    // Verify the nonce for security
    if (!isset($_POST['employee_profile_nonce']) || !wp_verify_nonce($_POST['employee_profile_nonce'], 'create_employee_profile')) {
        wp_die('Invalid nonce.');
    }

    // Get form data and sanitize
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $department = sanitize_text_field($_POST['department']);

    // Validate form data
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($department)) {
        wp_redirect(add_query_arg('error', 'missing_fields', get_permalink()));
        exit;
    }
    if (!is_email($email)) {
        wp_redirect(add_query_arg('error', 'invalid_email', get_permalink()));
        exit;
    }

    // Insert data into database
    global $wpdb;
    $table_name = 'wp_employee';
    $data = array(
        'email_address' => $email,
        'password' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'department' => $department,
    );
    $wpdb->insert($table_name, $data);

    // Redirect to a success page
    wp_redirect(add_query_arg('success', 'true', get_permalink()));
    exit;*/


/*function display_employee_profile_form()
{
    ob_start();
    ?>
    
    <?php
    return ob_get_clean();
}

// Add shortcode to display form on a page
// Add shortcode to display form on a page
add_shortcode('employee_profile_form', 'display_employee_profile_form');*/

include("..\wp-config.php") ; 
session_start();

// Include WordPress functions
require_once('wp-load.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {

  // Get form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $department = $_POST['department'];

  // Insert data into WordPress database
  global $wpdb;
  $table_name ='wp_employee';
  $data = array(
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email_address' => $email,
    'password' => $password,
    'department' => $department,
  );
  $wpdb->insert($table_name, $data);

  // Redirect to the employee profile page
  wp_redirect('employee-profile.php');
  exit();
}

?>
