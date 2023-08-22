<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPPOS - Reset Password</title>
    <link rel = "stylesheet" type = "text/css" href="reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>



    <div id ="container col-6">

        <div id = "up-design">
            <img src="images/mpposlogo.png" width = 250>
            <h2>Change password</h2>
        </div>
    
        <form class ="form-reset" method="post" action="password_reset.php">

            <label for="password">Password</label>
            <input type="password" class ="form-control" name = "password" required>

            <label for="confirm-password">Confirm password</label>
            <input type="password" class ="form-control" name = "confirm-password" required>

            <br>


            <input type="submit" class = "btn btn-success" name = "" value = "Change password">


        </form>
      
    
        </div>
    
    
</body>
</html>