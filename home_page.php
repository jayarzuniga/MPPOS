<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

?>



<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    <title>MPPOS - Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="home.css" rel="stylesheet">
  </head>
  <body>
 

    

    
    <header data-bs-theme="dark">
      <nav class="navbar navbar-expand-md  fixed-top" style="background-color: #4693ff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MPPOS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" aria-disabled="true"><?=$_SESSION['name']?></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

    <main>

      <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/sales-pic.jpg" alt="user Image" width="100%" height="100%">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>View your overall Sales.</h1>
                <p class="opacity-75">"Unlocking Sales Insights: Explore the Numbers"</p>
                <p><a class="btn btn-lg btn-primary" href="#">Sales Report</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/manage-user-pic.jpg" alt="user Image" width="100%">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
            <div class="container">
              <div class="carousel-caption">
                <h1>Manage your User Here</h1>
                <p>"Effortless POS Management: Elevate Your Sales Experience"</p>
                <p><a class="btn btn-lg btn-primary" href="#">Manage Users</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/product-manage-pic.jpg" alt="user Image" width="100%" height="140%">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>Update your Products</h1>
                <p>"Seamless Product Updates: Keeping Your Inventory Current"</p>
                <p><a class="btn btn-lg btn-primary" href="#">Product Update</a></p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>



      <div class="container marketing">

        <!-- Three columns of text below the carousel -->

        <h1 class="text-center">Welcome to our Point of Sale System!</h1>
        <p class="text-center"> Whether you're a dedicated user or a supervising authority, we're delighted to have you on board. Log in now to explore and manage your sales, products, and more. Your journey with us starts here.</p>
        <br>
        <br>
        <div class="row">
          <div class="col-lg-4">
            <div class="rounded-circle img-circle-container">
              <img src="images/chibi.png" alt="User Image" class="rounded-circle img-circle" width="140" height="140">
            </div>
            <h2 class="fw-normal">User Login</h2>
            <p>
              "Welcome back! Please log in to access your account."</p>
            <p><a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#userLoginModal">User Login &raquo;</a></p>
          </div><!-- /.col-lg-4 -->

          <!-- User Login Modal -->
          <div class="modal fade" id="userLoginModal" tabindex="-1" aria-labelledby="userLoginModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="userLoginModalLabel">User Login</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="user-authenticate.php" method="post">
                              <div class="mb-3">
                                  <label for="username" class="form-label">Username</label>
                                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                              </div>
                              <div class="mb-3">
                                  <label for="password" class="form-label">Password</label>
                                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                              </div>
                              <button type="submit" class="btn btn-primary">Login</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>





          <div class="col-lg-4">
            <div class="rounded-circle img-circle-container">
              <img src="images/user.png" alt="User Image" class="rounded-circle img-circle" width="140" height="140">
            </div>
            <h2 class="fw-normal">Create your User Account</h2>
            <p>"Unlock Your Account's Potential: Start by Creating a User Profile."</p>
            <p><a class="btn btn-info" href="user-sign-up.php">Create User &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="rounded-circle img-circle-container">
              <img src="images/Management Logo.png" alt="User Image"  width="140" height="140">
            </div>
            <h2 class="fw-normal">Create your Supervisor Account</h2>
            <p>"Elevate Control: Experience Authority with Supervisor Accounts."</p>
            <p><a class="btn btn-info" href="sign_up.php">Create Supervisor Account &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2023 AMAU MPPOS, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


    </body>
</html>