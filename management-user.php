<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database1";

    // Retrieve the cart items from the AJAX request
    $requestData = json_decode(file_get_contents('php://input'), true);
    $cartItems = $requestData['cartItems'];

     // Store the cart items data in a session variable
    session_start();
    $_SESSION['receiptData'] = $cartItems;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the purchases table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS purchases (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL
    )";
    if ($conn->query($createTableSQL) !== true) {
        die("Error creating table: " . $conn->error);
    }
    $currentDate = date('m-d-Y');

    // Prepare and execute the SQL query to insert the cart items into the database
    $stmt = $conn->prepare("INSERT INTO purchases (currentDate, product_name, price) VALUES (?, ?)");
    $stmt->bind_param("ssd",$currentDate, $productName, $price);

    foreach ($cartItems as $item) {
        $productName = $item['productName'];
        $price = $item['price'];
        if ($stmt->execute() !== true) {
            die("Error inserting data into the database: " . $stmt->error);
        }
    }

    // Close the connection
    $stmt->close();
    $conn->close();

    // Send a JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
}
?>