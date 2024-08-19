
<!DOCTYPE html>
<html>
<head>
	<title>Employee Profile</title>
  <style>
body {
	background-color: #0096FF
}

/* style the form */
form {
	background-color: #fff;
	padding: 50px;
	margin: 250px;
	border-radius: 20px;
	box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
}

/* style the headings */
h1{
	text-align: center;
	margin-bottom: 20px;
}

h2,h3,h4,h5{
    color:#e0b4b4;
    text-align: left;
	margin-bottom: 20px;}

/* style the labels */
label {
	display: inline;
	width: 150px;
	margin-bottom: 10px;
}

/* style the inputs and textareas */
input[type="text"], input[type="email"], input[type="time"], select, textarea {
	padding: 10px;
	border-radius: 5px;
	border: 1px solid #ccc;
	width: 70%;
	margin-bottom: 20px;
}

/* style the submit button */
input[type="submit"] {
	background-color: #4CAF50;
	color: #fff;
	border: none;
	padding: 10px 20px;
	border-radius: 5px;
	cursor: pointer;
  }

input[type="submit"]:hover {
	background-color: #3e8e41;
}

/* style the textareas */
textarea {
	height: 100px;
}

/* style the error messages */
.error {
	color: red;
	margin-bottom: 10px;
}

  .fancy-button {
    background-color: #f5f5f5;
    border: none;
    color: #333;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    float: left;
  
  }
  
  .fancy-button:hover {
    background-color: #ddd;
  }
  
  .fancy-button:focus {
    outline: none;
  }
  
  .fancy-button:active {
    box-shadow: none;
    transform: translateY(1px);
  }
</style>

</head>

<body>
	<h1><b><i>Additional Fields</i></b></h1>
	<form method="POST">
        <label for ="age">Age</label>
        <input type="checkbox" id="age" name="field[]" value="age"><br>
        <label for ="address">Address</label>
        <input type="checkbox" id="address" name="field[]" value="address"><br>
        <label for ="availability_time">Availability Time</label>
        <input type="checkbox" id="availability_time" name="field[]" value="availability_time"><br>
        <label for ="awards_and_recognition">Awards And Recognition</label>
        <input type="checkbox" id="awards_and_recognition" name="field[]" value="awards_and_recognition"><br>
        <label for ="biography">Biography</label>
        <input type="checkbox" id="biography" name="field[]" value="biography"><br>
        <label for ="department">Department</label>
        <input type="checkbox" id="department" name="field[]" value="department"><br>
        <label for ="education_and_certifications">Education And Certifications</label>
        <input type="checkbox" id="education_and_certifications" name="field[]" value="education_and_certifications"><br>
        <label for ="employment_status">Employment Status</label>
        <input type="checkbox" id="employment_status" name="field[]" value="employment_status"><br>
        <label for ="office_location">Office Location</label>
        <input type="checkbox" id="office_location" name="field[]" value="office_location"><br>
        <label for ="office_work_hours">Office Work Hours</label>
        <input type="checkbox" id="office_work_hours" name="field[]" value="office_work_hours"><br>
        <label for ="performance_metrics">Performance Metrics</label>
        <input type="checkbox" id="performance_metrics" name="field[]" value="performance_metrics"><br>
        <label for ="personal_interests">Personal Interests</label>
        <input type="checkbox" id="personal_interests" name="field[]" value="personal_interests"><br>
        <label for ="phonenumber">Phone Number</label>
        <input type="checkbox" id="phonenumber" name="field[]" value="phonenumber"><br>
        <label for ="position">Position</label>
        <input type="checkbox" id="position" name="field[]" value="position"><br>
        <label for ="professional_development_goals">Professional Development Goals</label>
        <input type="checkbox" id="professional_development_goals" name="field[]" value="professional_development_goals"><br>
        <label for ="projects_and_contributions">Projects And Contributions</label>
        <input type="checkbox" id="projects_and_contributions" name="field[]" value="projects_and_contributions"><br>
        <label for ="reporting_structure">Reporting Structure</label>
        <input type="checkbox" id="reporting_structure" name="field[]" value="reporting_structure"><br>
        <label for ="security_clearances">Security Clearances</label>
        <input type="checkbox" id="security_clearances" name="field[]" value="security_clearances"><br>
        <label for ="skills_and_abilities">Skills And Abilities</label>
        <input type="checkbox" id="skills_and_abilities" name="field[]" value="skills_and_abilities"><br>
        <label for ="speciality">Speciality</label>
        <input type="checkbox" id="speciality" name="field[]" value="speciality"><br>
        <label for ="speciality">Speciality</label>
        <input type="checkbox" id="speciality" name="field[]" value="speciality"><br>
        <label for ="training_and_development">Training and Development</label>
        <input type="checkbox" id="training_and_development" name="field[]" value="training_and_development"><br>
        <label for ="work_experience">Work Experience</label>
        <input type="checkbox" id="work_experience" name="field[]" value="work_experience"><br>
        <input type="submit" name="submit" value="Submit">
	</form>
        
   	

	<?php
    $fields=[];
	// handle form submission
	if (isset($_POST['submit'])) {
		$fields = $_POST['field'];
		// encode fields as JSON
		$json_fields = json_encode($fields);
		update_option('additional_fields', $json_fields);
		echo '<p>Fields saved!/p>';
        $fields = get_option('additional_fields');
        $fields_array = json_decode($fields, true);  

	}
	?>
</body>
</html>
