<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/logincss.css">
</head>
<body>
    <div class="panel">
        <h1>Profalize</h1>
        <div class="formset">
            <form action="login.php" method="post" class="form-group">
                <label class="form-label">Email</label>
                <input class="form-control" type="text" name="email">

                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password">

                <input class="btn" type="submit" name ="submit" value="Log in">
            </form>
        </div>
    </div>
</body>
</html>
