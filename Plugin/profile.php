<?php
include("..\wp-config.php") ; 
$email = $_GET['email'];
global $wpdb;
$query = "SELECT * FROM wp_employees WHERE email_address = '$email'";
$results = $wpdb->get_results($query);
//get the fiedls from wp options
$fields = get_option('additional_fields');
$fields = json_decode($fields, true); 
// If an employee profile with the given name was found, display it
if (!empty($results)) :
  $result = $results[0];
  $fname = $result->first_name;
  $lname = $result->last_name;
  $position = $result->position;
  $email = $result->email_address;
  ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
    html, body {
    height: 100%;
    margin: 0;
   } 
   .container {
    width: 100%;  
   }
   .left-container {
    top: 0;
    bottom: 0;
   width: 40%;
   background-color:#fff;
   float: left;
   position: fixed;
   }
   .right-container {
   width: 60%;
   background-color: white;
   float: right;
   }       
    .profile-pic {              
    width: 200px;
    height: 290px;
    background-color: white no-repeat center center;
    background-size: cover;
    position: relative;
    margin-top: 0;
    margin-left: 0;
    cursor: pointer;   
   }
   .profile-pic input[type="file"] {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
   }
    .profile-pic:hover .upload-icon {
    opacity: 0.8;
   }
   .profile-pic .upload-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 24px;
    color: #fff;
    opacity: 0;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    }
    .material-icons {
       vertical-align: middle;  
     }
     input[type="email"], input[type="number"], input[type="text"] {
       vertical-align: middle;  
       line-height: normal;  
     }
    .inner-container {
      height: 80%;
      margin-top: 70px;
      margin-left: 90px;
      margin-right: 90px;
     box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.25);
      background-color: #fff;
    }
     </style>
  </head>
  <body>
  <div class="container">
    <div class="left-container">
    <a href="../index.php" style="color: black; ">
      <h4 style="margin-left: 20px">Back</h4>
      </a>
      <div class="inner-container"> 
     
        <div class="profile-pic ">
        <img src="../image/sillouette.png" alt="img" style="background: white no-repeat center center;  width:  325px; height: 360px;   "> 
                <input type="file" id="profile-pic-input">
                <span class="upload-icon">&#x2193;</span>
		    </div>
        <br><br><br>
          <h1 style="color:rgb(1, 0, 140);  text-align: center;"><?php echo $fname. "  " . $lname; ?></h1>
          <h2 style="color:rgb(1, 0, 140);  text-align: center;"><?php echo $position; ?></h2>
         <?php
        ?>
        </div>
    </div>
    <div class="right-container">
      <br><br><br><br><br>
      <div style="background-color: #fff; margin-top:20px; margin-right: 60px; margin-left: 1px;">
       <h2 style="margin-left: 50px;   color: rgb(1, 0, 140);">contact</h2>
      </div>
       <div style="background-color: #fff; margin-left: 40px; margin-right: 60px;">
          <i class="material-icons" style="color: rgb(1, 0, 140)">email</i>
          <input type="email"> 
          <?php
          foreach($fields as $field){
          if($field == 'phone_number'){ ?>
          <i class="material-icons" style="color: #000029">phone</i>
          <input type="number"> 
           <?php
          } ?>
          <?php
           if($field == 'address'){ ?>
           <br><br>
          <i class="material-icons" style="color: #000029">place</i>
          <input type="text"> 
          <br><br>
          <?php } ?>
          <?php
          if($field == 'age'){ ?>
          <i class="material-icons" style="color: #000029">cake</i>
          <input type="text">
          <?php } 
          } ?>
       </div>
      <?php
         foreach($fields as $field){
          if($field != 'phone_number' && $field != 'address' && $field != 'email_address' && $field != 'age'){ ?>
          <div style="background-color:#fff; margin-right: 60px; margin-left: 1px;">
            <h2 style="margin-left: 50px; color: rgb(1, 0, 140);"><?php echo $field; ?><br></h2>
             </div>
             <div > 
            <textarea name="field" cols="80" rows="1" style="margin-left: 60px; color: #000; background-color: #fff;"></textarea>
            </div>
            <?php
            }
          }
          ?>
        
    </div>
    </div>
    <script type="text/javascript">
		const profilePic = document.querySelector('.profile-pic');
		const profilePicInput = document.querySelector('#profile-pic-input');

		profilePic.addEventListener('click', function() {
			profilePicInput.click();
		});

		profilePicInput.addEventListener('change', function() {
			const file = this.files[0];

			if (file) {
				const reader = new FileReader();

				reader.addEventListener('load', function() {
					profilePic.style.backgroundImage = `url(${this.result})`;
					profilePic.style.backgroundSize = 'cover';
				});

				reader.readAsDataURL(file);
			}
		});
	</script>
  </body>
</html>
  
  <?php
endif;

?>
