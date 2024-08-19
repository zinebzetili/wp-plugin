<?php
session_start();
global $wpdb;
include("../wp-config.php");
if (isset($_POST['submit'])) {

  if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in.";
    exit;
  }
  $userId = $_SESSION['user_id'];
  $fields = get_option('additional_fields');
  $fields = $fields ? json_decode($fields, true) : array();
  $data = array();
  foreach ($fields as $field) {
    if (isset($_POST[$field])) {
      $data[$field] = $_POST[$field];
    }
  }
  $user = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT * FROM wp_employees WHERE id = %d",
      $userId
    )
  );
  $table_name = $wpdb->prefix . 'employees';
  $employeeId = $userId;
  $placeholders = array();

  $fieldValues = array_values($data);
  $queries = array();
  foreach ($data as $field => $value) {
    $placeholders[] = $field;
  }



  for ($i = 0; $i < count($fields); $i++) {
    $queries[$i] = $wpdb->prepare("UPDATE $table_name SET ");
    $queries[$i] .= $wpdb->prepare(current($placeholders));
    current($placeholders) === next($placeholders);
    $queries[$i] .= "=" . $wpdb->prepare("%s", current($fieldValues));
    current($fieldValues) === next($fieldValues);
    $queries[$i] .= $wpdb->prepare("WHERE id = %d", $employeeId);
  }

  for ($i = 0; $i < count($fields); $i++) {

    $wpdb->query($queries[$i]);
  }

  // Check if the update was successful
  if ($wpdb->rows_affected > 0) {
    $_SESSION['user_id'] = $employeeId;
    header("Location: profile.php");
  } else {
    echo 'Error updating data.';
  }
}

