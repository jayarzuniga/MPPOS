<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPPOS - Forgot Password</title>
    <link rel = "stylesheet" type = "text/css" href="forgotpassword.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>


    <div id ="container">

    <div id = "up-design">
        <img src="images/mpposlogo.png" width = 250>
        <h2>Reset your password</h2>
    </div>


    <form class ="form-forgot" action = "forgot_password_authenticate.php" method="post">
        <p>
            Enter your user account's verified email address and we will send you a password reset link.
        </p>

        <div class ="col-md-6">
            <input type="email" class ="form-control" name = "email"  placeholder="Enter your email address" required>
          </div>

          <br>

          <input type="submit" class = "btn btn-success" name = "" value = "Send password reset email">
        

    </form>

    </div>

    

    
</body>
</html>