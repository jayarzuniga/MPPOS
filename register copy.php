<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $db_name = "database1";

   $con = mysqli_connect("localhost", "root", "", "database1");

   if(mysqli_connect_errno()){
    exit('Failed to connect to MySQL:' .mysqli_connect_error());
   }

   if(!isset($_POST['username'], $_POST['password'], $_POST['email'],)){
    exit('Could not get the data sent');
   }

   if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['first-name']) || empty($_POST['last-name']) || empty($_POST['birthday']) || empty($_POST['age'])){
    exit('Please Complete the Registration Form!');
   }

   if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
    }
    
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Email is not valid!');
    }
    


  //DATABASE WRITING
   if($stmt = $con->prepare('SELECT id, password FROM logins WHERE username = ?')){
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

        if ($stmt->num_rows > 0){
            echo 'Username exists, please choose another!';
        } else {
            if ($stmt = $con->prepare('INSERT INTO logins (username, password, email, firstName, lastName, birthdate, gender, age, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')){
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $uniqid = uniqid();
                $stmt->bind_param('sssssssss', $_POST['username'], $password, $_POST['email'], $_POST['first-name'],$_POST['last-name'], $_POST['birthday'], $_POST['gender'], $_POST ['age'], $uniqid );
                $stmt->execute();

                $from    = 'personalpos123@gmail.com';
                $subject = 'Account Activation Required';
                $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                // Update the activation variable below
                $activate_link = 'http://localhost/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
                $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                mail($_POST['email'], $subject, $message, $headers);
                echo 'Please check your email to activate your account!';
            }
        }
        $stmt->close();
   } else {
    echo 'Could not prepare statement';
   }

?>