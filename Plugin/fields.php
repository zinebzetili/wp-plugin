<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
.employees {
  display: flex;
  flex-wrap: wrap;
  margin: -20px;
}

.employee {
  flex-basis: calc(33.33% - 40px);
  margin: 20px;
  background-color: #f4f4f4;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.employee-image {
  flex-shrink: 0;
  width: 80px;
  height: 80px;
  margin-right: 20px;
  overflow: hidden;
  border-radius: 50%;
}

.employee-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.employee-info h2 {
  margin-top: 10px;
  margin-bottom: 5px;
  font-size: 20px;
}

.employee-info p {
  margin: 0;
  margin-bottom: 5px;
  font-size: 14px;
}

    </style>


</head>

<body>
    <?php
        include('../wp-config.php');
        // Connect to the database
        global $wpdb;
        $query="SELECT first_name,last_name,email_address,position FROM wp_employee";
        // Retrieve data from the database
        $results = $wpdb->get_results($query, ARRAY_A);
    ?>
    <div class="employees">
        <?php foreach ($results as $row): ?>
            <div class="employee">
                <div class="employee-image">
                    <img src="<?php echo $row['profile_picture']; ?>" alt="Employee Image">
                </div>
                <div class="employee-info">
                    <h2> <a href="profile.php/?email=<?php echo $row['email_address'];?>">
                        <?php echo $row['first_name'];
                        echo $row['last_name']; ?></h2></a>
                    <p>Email:<?php echo $row['email_address']; ?></p>
                    <p>Position: <?php echo $row['position']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
