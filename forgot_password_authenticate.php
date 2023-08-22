<?php
session_start();

$servername = "localhost";
$username = "root";
$password = '';
$db_name = "database1";

$con = mysqli_connect('localhost', 'root', '', 'database1');

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


if ($stmt = $con->prepare('SELECT id FROM logins WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION ['email'] = $_POST['email'];
        header('Location: reset_password.php');
    }else{
        echo "<script>";
        echo "alert('Email is not registered.');";
        echo "window.location.href = 'forgot_password.php'";
        echo "</script>";
    }
}

$stmt->close();

?>