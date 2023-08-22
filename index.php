<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MPPOS - Sign-in</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <!--Bootstrap Library-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
 
        <!--Side Design-->
        <div class="sign-in-full-page">
        <!--NAVBAR-->

          

        
        <div id= "side-design" class = "col-6">
          <img id="side-image"  src="images/POS Device.png" alt="" width="100%"height="" >
          <h2 class="heading1">Unlock Efficiency and Boost Profits</h2>
          <h3 class="heading2">"Track your sales and serve with ease to your customers"</h3>
        </div>
        
        <!--Sign-up FORM-->

        <div id="sign-in-form">
        <main class="form-signin w-50 m-auto text-center">
            <form action="authenticate.php" method="post">
              <img class="mb-4" src="images/MPPOS LOGO.png" alt="" width="72" height="57">
              <h1 class="h3 mb-3 fw-normal">Sign in</h1>
          
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name ="username" placeholder="username" required>
                <label for="floatingInput">Username</label>
                <br>

              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name = "password" placeholder="Password" required>
                <label for="floatingPassword">Password</label> 
              </div>
          
              <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Remember me
                </label>
              </div>

            
              <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

              <div class="forgot-password">
                <a href="forgot_password.php">Forgot Password?</a>
              </div>


              <div class = "sign-up">
                Create an account <a href ="sign_up.php">Signup now</a>
              </div>


            </form>
        </main>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>



</html>