<?php
session_start();
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Account Settings UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<style>
		.message {
			color: red;
			font-weight: bold;
			background-color: #ffebee;
			border: 1px solid #ffcdd2;
			padding: 10px;
			margin-bottom: 10px;
			position: absolute;
			left: 50%;
			transform: translate(-50%, -50%);
			top: 60px;
			max-width: 400px;
		}

		/* Styles for the Employee Creation Form */
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
		}

		h3 {
			font-size: 24px;
			margin-bottom: 10px;
		}

		.employee-profile-form {
			max-width: 500px;
			margin: 50px auto;
			background-color: #fff;
			padding: 30px;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			margin-top: 20px;
			margin-right: 160px;
		}


		.form-group {
			margin-bottom: 10px;
		}

		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}

		input[type="text"] {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border-radius: 10px;
			border: 1px solid #ccc;
			display: flex;
			align-items: center;
			margin-bottom: 10px;
			background-color: #e9e9e9;
		}

		input[type="submit"] {
			background-color: #c60;
			color: #fff;
			border: none;
			padding: 10px 20px;
			font-size: 16px;
			border-radius: 3px;
			cursor: pointer;
			margin-top: 10px;
		}

		input[type="submit"]:hover {
			background-color: #555;
		}


		.container {
			background-color: #fff;
			padding: 20px;
			width: 250px;
			height: 450px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			margin-bottom: 10px;
			position: absolute;
			top: 50px;
			left: 30%;
			transform: translateX(-50%);
		}

		.label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		.button {
			background-color: #c60;
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			display: flex;
			justify-content: center;
			margin-bottom: 10px;
			width: 70px;
			margin-left: 70px;
		}

		.text-center {
			text-align: center;
		}

		.profile-picture {
			width: 150px;
			height: 150px;
			border-radius: 50%;
			object-fit: cover;
			border: 2px solid #c60;

		}

		.submit-button {
			background-color: #c60;
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
	</style>
</head>

<body>

	<form method='POST' action="insert.php" class="employee-profile-form">
		<h3>Profile Information</h3>
		<?php
		// Get the fields from WordPress options
		include("..\wp-config.php");
		$fields = get_option('additional_fields');
		$fields = $fields ? json_decode($fields, true) : array();
		foreach ($fields as $field) { ?>
			<div class="form-group">
				<label><?php echo $field; ?></label>
				<input type="text" name="<?php echo $field; ?>">
			</div>
		<?php
		}
		if (isset($_GET['error'])) : ?>
			<p><?php echo $_GET['error']; ?></p>
		<?php endif ?>
		<br>
		<input type="submit" name="submit" value="Update">
		<br>
		</div>
	</form>


	<?php
	if (isset($_SESSION['error_message'])) : ?>
		<div class="message error">
			<p><?php echo $_SESSION['error_message']; ?></p>
		</div>
		<?php unset($_SESSION['error_message']);
	 ?>
	<?php endif ?>
	</div>

	<div class="container">
		<form action="" method="post" enctype="multipart/form-data">
			<label for="profilePicture" class="label">Choose Profile Picture:</label>
			<input type="file" name="profilePicture" id="profilePicture" style="display: none;">
			<label for="profilePicture" class="button">Upload</label>
			<br>
			<div class="text-center">
				<?php
				global $wpdb;
				if (isset($_POST['submit'])) {
					// Check if the user is logged in
					if (!isset($_SESSION['user_id'])) {
						echo "You are not logged in.";
						exit;
					}
					$userId = $_SESSION['user_id'];
					$targetDir = "uploads/";
					$targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
					$file_tmp = $_FILES['profilePicture']['tmp_name'];
					$profile_picture = file_get_contents($file_tmp);

					if (move_uploaded_file($file_tmp, $targetFile)) {
						$table_name = $wpdb->prefix . 'employees';

						$wpdb->update(
							'wp_employees',
							array(
								'profile_picture' => $targetFile,
							),
							array(
								'id' => $userId
							)
						);

							$format = array('%s', '%s', '%s');
							$result = $wpdb->update($table_name, $data, $format);

						if ($wpdb->rows_affected > 0) {
							echo "Error inserting data: " . $wpdb->last_error;
						} else {
							$employee = $wpdb->get_row("SELECT first_name, last_name FROM wp_employees WHERE id = $userId");
							$first_name = $employee->first_name;
							$last_name = $employee->last_name;

							echo "<div class='profile'>";
							echo "<img src='data:image/jpeg;base64," . base64_encode($profile_picture) . "' alt='Profile Picture' class='profile-picture'>";
							echo "<h1>$first_name $last_name</h1>";
							echo "</div>";
						}
					} else {
						echo "Error uploading profile picture.";
					}
				}
				?>
				<input type="submit" name="submit" value="Save Picture " class="submit-button">
			</div>
		</form>
	</div>

	<script>
		// Get the update button
		const updateButton = document.querySelector('.update-btn');
		// Add click event listener to the delete button
		updateButton.addEventListener('click', () => {
			const employeeId = updateButton.getAttribute('data-id');

			jQuery.ajax({
				type: "get",
				url: "../wp-content/plugins/my_plugin/insert.php?id=" + employeeId
			});
		});
	</script>
</body>

</html>