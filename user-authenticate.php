
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

if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill the username and password fields!');
}

$stmt = $con->prepare('SELECT id, password FROM userLogins WHERE username = ?');
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();

$stmt->store_result();


if ($stmt->num_rows > 0) {

    $stmt->bind_result($id, $password);
    $stmt->fetch();

    if (password_verify($_POST['password'], $password )) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: user.php');
    } else {

        echo "<script>";
        echo "alert('Incorrect Username or Password!');";
        echo "window.location.href = 'home_page.php'";
        echo "</script>";;
    }
} else {
    echo "<script>";
    echo "alert('Incorrect Username or Password!');";
    echo "window.location.href = 'home_page.php'";
    echo "</script>";;
}

$stmt->close();

?>