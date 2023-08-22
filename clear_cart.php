<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "database1";

$con = mysqli_connect($servername, $username, $password, $db_name);

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$credentialsCorrect = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adminUsername']) && isset($_POST['adminPassword'])) {
    $enteredUsername = $_POST['adminUsername'];
    $enteredPassword = $_POST['adminPassword'];

    // Verify admin username and password
    $query = 'SELECT password FROM logins WHERE username = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $enteredUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($storedPasswordHash);
        $stmt->fetch();

        // Compare the entered password with the stored password hash
        if (password_verify($enteredPassword, $storedPasswordHash)) {
            // Admin username and password are correct
            // Clear the cart and reset variables
           
            $credentialsCorrect = true;

        }
    }
    
    echo json_encode(array('credentialsCorrect' => $credentialsCorrect));


    $stmt->close();
} 
?>






