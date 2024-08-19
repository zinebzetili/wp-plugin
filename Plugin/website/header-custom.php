<!DOCTYPE html>
<html>

<head>
  <title>Header Example</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <div class="header-content">
      <div class="login">
        <button class="login-button"><a href="loginform.php" style="color: #fff; text-decoration: none;">login</a></button>
      </div>
      <div class="search">
        <form action="home.php" id="search-form" method="post">
          <input type="text" name="search" placeholder="Search...">
          <input type="submit" class="search-button" name="submit" value="Search">
        </form>
      </div>
    </div>
  </header>
</body>

</html>