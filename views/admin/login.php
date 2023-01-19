<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="/public/css/admin-login.css">
</head>

<body>
    <div id='login-form'>
        <div id="error"><?php echo $vars['errorMessage']; ?></div>
        <h1 class="text-center">Login To Admin Page</h1>
        <hr style="margin-bottom: 3rem;">
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo $vars['email'];?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="">
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-primary">
            </div>
        </form>
        <p class="text-right"><a href="/index.php" alt="homepage">Go to homepage</a></p>
    </div>
</body>

</html>