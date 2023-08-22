<?php
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MPPOS - Sign-in</title>
        <link rel="stylesheet" type="text/css" href="signup.css" />
        <!--Bootstrap Library-->
        <link rel = "stylesheet" type = "text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>

    </head>

    <body>
 

      <div class = "container">
        <form class ="form-signup" action="register.php" method="post" >
          <h2>Sign up</h2>

          <div class ="form-group">
            <div class ="row">
              <div class ="col-md-6">
                <label for="first-name">First Name</label>
                <input type="text" class ="form-control" name ="first-name" placeholder="ex. John" required>
              </div>
              

              <div class ="col-md-6">
                <label for="last-name">Last Name</label>
                <input type="text" class ="form-control" name ="last-name" placeholder="ex. Smith" required>
              </div>

             
              <div class ="col-md-6">
                <label for="birthday">Birthdate</label>
                <input type ="date" class = "form-control" name = "birthday" required>
                </div>

                <div class ="col-md-6">
                  <label for="age">Age</label>
                  <input type="number" class ="form-control" name = "age"  placeholder="Must be 18 yrs. old" required>
                </div>
          


          


          <div class ="form-group">
            <label for="email">E-mail</label>

            <input type = "email"  class ="form-control" name = "email" placeholder="ex. john@gmail.com" required>
          </div>

          <div class ="form-group">
            <label for="username">Username</label>

            <input type = "text"  class ="form-control" name = "username" placeholder="userJohn" required>
          </div>

          <div class ="col-md-6">
            <label for="password">Password</label>

            <input type = "password"  class ="form-control" name = "password" placeholder="ex. p@ssw0r10!" required>
          </div>


        
        
        </div>
          <br>


          <div class ="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" >
              <option value=""disabled selected>Please select one…</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
              <option value="Undefined">Perfer not to Answer</option>
            </select>
          </form>
          </div>

          <br>

          <input type="submit" class = "btn btn-success" name = "register" value = "Register">


        </form>





      </div>
       



      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </body>



</html>




