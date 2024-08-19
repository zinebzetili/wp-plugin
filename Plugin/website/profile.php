<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "You are not logged in.";
  exit;
}
require_once("../wp-config.php");
$id = $_SESSION['user_id'];
global $wpdb;
$email = '';
$query = "SELECT * FROM wp_employees WHERE id = '$id'";
$row = $wpdb->get_row($query, ARRAY_A);
if ($row) {
  $email = $row['email_address'];
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $position = $row['position'];
  $picture = $row['profile_picture'];
  $filledColumns = array();
  foreach ($row as $column => $value) {
    if (!empty($value)) {
      $filledColumns[] = $column;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="css/profilecss.css">
</head>

<body>
  <div id="animation-container">
    <div class="sidebar">
      <div class="sidebar-section">
        <br><br>
        <ul>

          <li><a href="home-login.php">
              <i class="material-icons" style="color: #C60">home</i>&nbsp; Home</a></li>
          <li><a href="edit.php">
              <i class="material-icons" style="color: #C60; ">settings</i>&nbsp;Settings</a></li>
          <li><a href="login-edit.php">
              <i class="material-icons" style="color: #C60 ">edit</i>&nbsp; Edit</a></li>
          <li><a href="logout.php">
              <i class="material-icons" style="color: #C60">logout</i>&nbsp;Logout</li></a>
        </ul>
      </div>
    </div>
    <div class="main-content">
      <div class="container">
        <div class="picture">
          <img src="../<?php echo $row['profile_picture']; ?>">
        </div>
        <br>
        <hr style="width: 200px;">
        <div class="under-pic">
          <h1 style="font-family: 'Proxima', sans-serif; color: #C60;"><?php echo $fname . " " . $lname; ?></h2>
            <h2 style="font-family: 'Proxima', sans-serif; "><?php echo $position; ?></h3>
        </div>
      </div>
      <br><br><br><br>
      <div class="left" style="background-color: #fff;">
        <div class="inner">
          <br>
          <h2 class="accent" style="font-family: 'Proxima', sans-serif; color: #C60; margin-bottom: 0.1px;">Contact</h2>
          <?php
          foreach ($filledColumns as $field) {
            if ($field == 'email_address') {
          ?>
              <div class="row-container">
                <i class="material-icons" style="color: #C60">email</i>
                <p style="color: #000;"><?php echo $row[$field]; ?></p>
              </div>
            <?php
            }
            if ($field == 'address') {
            ?>
              <div class="row-container">
                <i class="material-icons" style="color: #C60">place</i>
                <p style="color: #000;"><?php echo $row[$field]; ?></p>
              </div>
            <?php
            }
            if ($field == 'phone_number') {
            ?>
              <div class="row-container">
                <i class="material-icons" style="color: #C60">phone</i>
                <p style="color: #000;"><?php echo $row[$field]; ?></p>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
      <?php
      $new = array();
      for ($i = 0; $i < count($filledColumns); $i++) {
        if ($filledColumns[$i] != 'profile_picture' && $filledColumns[$i] != 'first_name' && $filledColumns[$i] != 'last_name' && $filledColumns[$i] != 'position' && $filledColumns[$i] != 'id' && $filledColumns[$i] != 'password' && $filledColumns[$i] != 'email_address' && $filledColumns[$i] != 'address' && $filledColumns[$i] != 'phone_number') {
          $new[] = $filledColumns[$i];
        }
      }

      $size =  count($new);
      for ($i = 0; $i < $size; $i += 2) {
        $field2 = $new[$i];
        $field1 = isset($new[$i + 1]) ? $new[$i + 1] : null;

      ?>

        <div class="right">
          <div class="inner">
            <br>
            <?php
            $field2 = str_replace('_', ' ', $field2);
            ?>
            <h2 class="accent" style="font-family: 'Proxima', sans-serif;"><?php echo $field2; ?></h2>
            <?php
            $field2 = str_replace(' ', '_', $field2);
            ?>
            <p class="text"><?php echo $row[$field2]; ?></p>
          </div>
        </div>
        <?php
        if ($field1 != null) {
        ?>

          <div class="left">
            <div class="inner">
              <br>
              <?php
              $field1 = str_replace('_', ' ', $field1);
              ?>
              <h2 class="accent" style="font-family: 'Proxima', sans-serif;"><?php echo $field1; ?></h2>
              <?php
              $field1 = str_replace(' ', '_', $field1);
              ?>
              <p class="text"><?php echo $row[$field1]; ?></p>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</body>

</html>