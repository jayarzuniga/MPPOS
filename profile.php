<?php
  session_start();

  if (!isset($_SESSION['loggedin'])){
    header('Location: index.php');
    exit;
  }

  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'database1';

  $con = mysqli_connect($servername, $username, $password, $db_name);

  if (mysqli_connect_errno()){
    exit('Failed to connect to MySQL: ' .mysqli_connect_error());
  }

  $stmt = $con->prepare('SELECT password, email, firstName, lastName, birthdate, age, gender FROM logins WHERE id = ?');

  $stmt->bind_param('i', $_SESSION['id']);
  $stmt->execute();
  $stmt->bind_result($password, $email, $firstName, $lastName, $birthdate, $age, $gender);
  $stmt->fetch();
  $stmt->close();

?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MPPOS - Sign-in</title>
        <link rel="stylesheet" type="text/css" href="profile-style.css" />
        <!--Bootstrap Library-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

    <!--Navbar-->
    <nav class="navbar" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="home_page.php">
        <img src="images/mpposlogo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        MyPersonalPOS
      </a>

     
      <div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Log-out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--Title-->
  <h1 class = "text-center">Profile Page</h1>
  <hr>

  <!--Content-->

  <div class="container-fluid">
    <h3>Account Details</h3>

    <table class="table table-striped table-hover">
      <tr class="table-secondary">
        <td>
          Username:
        </td>
        <td>
          <?=$_SESSION['name']?>
        </td>
      </tr>

      <tr>
        <td>
          Password:
        </td>

        <td>
          <?=$password?>
        </td>
      </tr>

      <tr>
        <td>
          E-mail:
        </td>
        <td>
          <?=$email?>
        </td>
      </tr>

      <tr>
        <td>
          First Name:
        </td>
        <td>
          <?=$firstName?>
        </td>
      </tr>

      <tr>
        <td>
          Last Name:
        </td>
        <td>
          <?=$lastName?>
        </td>
      </tr>

      
      <tr>
        <td>
          Gender:
        </td>
        <td>
          <?=$gender?>
        </td>
      </tr>

      <tr>
        <td>
          Birthday:
        </td>
        <td>
          <?=$birthdate?>
        </td>
      </tr>

      <tr>
        <td>
          Age:
        </td>
        <td>
          <?=$age?>
        </td>
      </tr>

    </table>


  </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</body>
</html>