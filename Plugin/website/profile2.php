<?php

include("..\wp-config.php");
$id = $_GET['id'];
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
  <style>
    .sidebar {
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      width: 180px;
      background-color: #f8f8f8;
      padding: 20px;
      box-sizing: border-box;
      float: left;
    }


    .sidebar ul {
      font-size: 1.1em;
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      margin-bottom: 5px;
      display: flex;
      align-items: center;
    }

    .sidebar a {
      display: block;
      padding: 5px;
      color: #333;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #ddd;
    }

    .main-content {
      align-items: center;
    }

    .material-icons {
      vertical-align: middle;
    }

    .picture {
      left: 42%;
      position: relative;
      width: 200px;
      /* Set the desired width */
      height: 200px;
      /* Set the desired height */
      border-radius: 50%;
      overflow: hidden;
      /* Set the desired height */
    }

    .picture img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      /* Make the image fill the width of the parent div */
      height: 100%;
      /* Make the image fill the height of the parent div */
      object-fit: cover;
      /* Optional: Maintain aspect ratio and cover the entire div */
    }

    hr {
      left: 60%;
      color: #C60;
    }

    .under-pic {
      text-align: center;
    }

    .container2 {
      display: flex;
    }

    .left {
      width: 45%;
      float: left;
      min-height: 242px;
      background-color: #C60;
      color: #fff;
      margin-bottom: 40px;
      margin-left: 30px;
    }

    .right {
      width: 45%;
      float: right;
      min-height: 242px;
      background-color: #C60;
      color: #fff;
      margin-bottom: 40px;
      margin-right: 35px;
    }

    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    #animation-container {
      display: flex;
      top: 0;
      left: 0;
      flex-direction: column;
      justify-content: center;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-image: url('../images/tm-bg-slide-1.jpg');
      background-size: cover;
      animation-name: imageAnimation;
      animation-duration: 12s;
      /* Increase the duration for a slower and more relaxed animation */
      animation-iteration-count: infinite;
      animation-timing-function: ease-in-out;
    }

    @keyframes imageAnimation {
      0% {
        background-image: url('../images/tm-bg-slide-1.jpg');
      }

      33.33% {
        background-image: url('../images/tm-bg-slide-2.jpg');
      }

      66.66% {
        background-image: url('../images/tm-bg-slide-3.jpg');
      }

      100% {
        background-image: url('../images/tm-bg-slide-1.jpg');
      }
    }

    .inner {
      margin-left: 30px;
    }

    h1 {
      font-size: 35px;
    }

    h2 {
      font-size: 30px;
    }

    h3 {
      font-size: 30px;
    }

    h4 {
      font-size: 24px;
    }

    h5 {
      font-size: 20px;
    }

    h6 {
      font-size: 18px;
    }

    h2 {
      padding-bottom: 14px;
    }

    .content-wrapper {
      height: 100%;
    }

    .content {
      white-space: normal;
    }

    .row-container {
      display: flex;
      align-items: center;
      /* Align items vertically */
    }

    .row-container i {
      margin-right: 5px;
      /* Add spacing between the icon and text */
    }
  </style>
</head>

<body>
  <div id="animation-container">

    <div class="main-content">
      <a href="../home.php" style="color: #C60;">
        <h2 style="color: #C60; text-align: center; font-family: 'Proxima', sans-serif;">Home</h2>
      </a>
      <br>
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