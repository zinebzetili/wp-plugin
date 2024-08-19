<?php

include("..\wp-config.php") ; 
session_start();
global $wpdb;

if (isset($_POST['login'])) { 
$email = $_POST['email'];
$password = $_POST['password']; 

$user = $wpdb->get_row(
   $wpdb->prepare(
      "SELECT * FROM wp_employee WHERE email_address = %s AND password = %s",
      $email,
      $password
   )
);
//print_r($user) ;  

if ( $user ) {
   require 'profile2.php';
} else {
   echo " failed  " ; 
}
}


?> 
