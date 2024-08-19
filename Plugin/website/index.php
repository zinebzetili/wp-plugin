<head>
  <link rel="stylesheet" href="css/index.css">
</head>
<?php
include("..\wp-config.php");
global $wpdb;

if (isset($_POST['submit'])) {

  $searchTerm = $_POST['search'];
  $query = $wpdb->prepare("SELECT id ,first_name, last_name , position , profile_picture FROM wp_employees WHERE first_name LIKE %s OR last_name LIKE %s", '%' . $searchTerm . '%', '%' . $searchTerm . '%');
} else {

  global $wpdb;
  $query = "SELECT id ,first_name,last_name,position , profile_picture FROM wp_employees";
}

$results = $wpdb->get_results($query, ARRAY_A);

?>
<div class="team-members">
  <?php foreach ($results as $row) : ?>
    <div class="team-member">
      <div class="member-image">
        <img src="genshin-impact-Shenhe-4-550x309.jpg" alt="">
      </div>
      <div class="member-details">
        <a style="text-decoration: none;" href="profile2.php/?id=<?php echo $row['id']; ?>">
          <h3 class="member-name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h3>
        </a>
        <p class="member-position"><?php echo $row['position']; ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>

</body>

</html>