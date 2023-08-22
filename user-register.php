<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "database1";

$con = mysqli_connect("localhost", "root", "", "database1");

if(mysqli_connect_errno()){
    exit('Failed to connect to MySQL:' .mysqli_connect_error());
}

if(!isset($_POST['username'], $_POST['password'])){
    exit('Could not get the data sent');
}

if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['birthday']) || empty($_POST['age'])){
    exit('Please Complete the Registration Form!');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password must be between 5 and 20 characters long!');
}

//DATABASE WRITING
if($stmt = $con->prepare('SELECT id, password FROM userLogins WHERE username = ?')){
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        echo "<script>";
        echo "alert('Password updated successfully!');";
        echo "window.location.href = 'user-sign-up.php'";
        echo "</script>";
    } else {
        if ($stmt = $con->prepare('INSERT INTO userLogins (username, password, contactNumber, firstName, lastName, birthday, age, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssssssss', $_POST['username'], $password, $_POST['contact_number'], $_POST['first_name'],$_POST['last_name'], $_POST['birthday'], $_POST['age'], $_POST['gender']);
            $stmt->execute();
            header('Location: home_page.php');
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement';
}
?>
