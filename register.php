<?php
// Load PHPMailer classes
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// ... Your existing database and form validation code ...
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
 
 if ($stmt = $con->prepare('SELECT id FROM logins WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        exit('Email is already registered. Please use a different email.');
    }
}


//DATABASE WRITING
if ($stmt = $con->prepare('SELECT id, password FROM logins WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Username exists, please choose another!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO logins (username, password, email, firstName, lastName, birthdate, gender, age, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            // ... Your existing data insertion code ...
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $uniqid = uniqid();
            $stmt->bind_param('sssssssss', $_POST['username'], $password, $_POST['email'], $_POST['first-name'],$_POST['last-name'], $_POST['birthday'], $_POST['gender'], $_POST ['age'], $uniqid );
            $stmt->execute();
            // Initialize PHPMailer
            $mail = new PHPMailer();

            // Set up SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'personalpos123@gmail.com'; // Your Gmail address
            $mail->Password   = 'glketjsfujrlqept'; // Your Gmail password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use SSL or TLS
            $mail->Port       = 587; // Gmail SMTP port

            // Set email details
            $mail->setFrom('personalpos123@gmail.com', 'WEBPOS');
            $mail->addAddress($_POST['email'], $_POST['first-name'] . ' ' . $_POST['last-name']);
            $mail->isHTML(true);
            $mail->Subject = 'Account Activation Required';
            
            // Update the activation variable below
            $activate_link = 'http://localhost/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
            $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
            
            $mail->Body = $message;

            // Send the email
            if ($mail->send()) {

                
                echo "<script>";
                echo "alert('Please check your email to activate your account!');";
                echo "window.location.href = 'index.php'";
                echo "</script>";

            } else {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement';
}
?>






