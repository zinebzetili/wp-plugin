
  <html>
  <head>
    Employee Creation Form 
<style>
  .employee-profile-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }
  
  .employee-profile-form input[type="text"],
  .employee-profile-form input[type="email"],
  .employee-profile-form input[type="password"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    box-sizing: border-box;
  }
  
  .employee-profile-form input[type="submit"] {
    background-color: #7282d4;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .employee-profile-form input[type="submit"]:hover {
    background-color: #45a049;
  }
  
  .employee-profile-form .form-group {
    margin-bottom: 20px;
  }
  
  </style> 
  </head>
<body>
  <form method="post" action="insertemployee.php" class="employee-profile-form">
    <div class="form-group">
      <label for="first_name">First Name*</label>
      <input type="text" name="first_name" id="first_name" required>
    </div>
    <div class="form-group">
      <label for="last_name">Last Name*</label>
      <input type="text" name="last_name" id="last_name" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address*</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password*</label>
       <input type="password" name="password" id="password" required>
    </div>
    <div class="form-group">
      <label for="department">Department*</label>
      <input type="text" name="department" id="department" required>
    </div>
    <div class="form-group">
      <button type="submit" name="submit">Create Profile</button>
    </div>
  </form>
</body>
</html>


