<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "database1";

$con = mysqli_connect("localhost", "root", "", "database1");

if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the email is set in the session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    if ($stmt = $con->prepare('SELECT id FROM logins WHERE email = ?')) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update the password for the given email
            $newPassword = $_POST['password']; // Set your new password here
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            if ($updateStmt = $con->prepare('UPDATE logins SET password = ? WHERE email = ?')) {
                $updateStmt->bind_param('ss', $hashedPassword, $email);
                if ($updateStmt->execute()) {
                    echo "<script>";
                    echo "alert('Password updated successfully!');";
                    echo "window.location.href = 'index.php'";
                    echo "</script>";
                } else {
                    echo "Password update failed.";
                }
                $updateStmt->close();
            } else {
                echo "Password update statement preparation failed.";
            }
        } ;
        }

        $stmt->close();
}

$con->close();
?>




