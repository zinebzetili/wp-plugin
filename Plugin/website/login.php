<?php

include("..\wp-config.php") ; 

session_start();

global $wpdb;

if (isset($_POST['submit'])) { 
$email = $_POST['email'];
$password = $_POST['password']; 

$user = $wpdb->get_row(
   $wpdb->prepare(
      "SELECT * FROM wp_employees WHERE email_address = %s "/*AND password = %s"*/, 
      $email
      /*$password*/
   )
);
if ($user && password_verify($password, $user->password)){
   $_SESSION['user_id'] = $user->id; 
    if ( $user ) {
      require 'profile.php';
  } else {
   echo " failed " ; 
  }

 }


}
 
?>

    