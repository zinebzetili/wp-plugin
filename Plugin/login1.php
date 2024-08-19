<html lang="en">
<head>
	<style>
		body {
  font-family: sans-serif;
  background-color: #f9f9f9;
}

.tab-content {
  padding: 10px;
  border: 1px solid #ccc;
}

.tab-pane {
  margin-bottom: 10px;
}

.form-group {
  margin-bottom: 10px;
}

.form-control {
  border: 1px solid #ccc;
  padding: 10px;
}

.btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
}

.btn-primary {
  background-color: #dc3545;
}

.btn-light {
  background-color: #fff;
  color: #007bff;
}

.error-message {
  color: red;
  font-weight: bold;
}
</style>
</head>
<body>
	

<form method='POST' action="insert.php" >
<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
					
						<h3 class="mb-4">Profile Information</h3>
							
						<?php
						
						// Get the fields from WordPress options
						 include("..\wp-config.php");
						$fields = get_option('additional_fields');
						$fields = $fields ? json_decode($fields, true) : array();
							foreach($fields as $field){?>
							<div class="col-md-6">
							  <div class="form-group">
								  <label><?php echo $field; ?></label>
								  <input type="text" class="form-control" value="" name="<?php echo $field; ?>">
							  </div>
							</div>
						<?php }?>

						<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="profile_picture">

<br>

</form>
						
					</div>
					
					<div>
			
<input style="background-color: #c60;" type="submit" id="updateBtn" name="submit" class="btn btn-primary" value="Update">


<br>
							
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
</scipt>
							</div>
							
							</body>
							</html>