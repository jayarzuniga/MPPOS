<?php
  session_start();

$servername = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'database1';

  $con = mysqli_connect($servername, $username, $password, $db_name);

  if (mysqli_connect_errno()){
    exit('Failed to connect to MySQL: ' .mysqli_connect_error());
}


?>


<!DOCTYPE html>

<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "sales.css">
        <title>Graph</title> 
       

    </head>
    <body>


    <!--Recent Transactions-->
    <div id = "transactions-table">
    <table class="table table-striped table-hover">
            <tr class="table-secondary"> 
                <td>
                Item Tag
               </td>
              <td>
                Date
              </td>
              <td>
                Product
              </td>
              <td>
                Price
              </td>
            </tr>


            <?php

            


            if (isset($_GET['month']) && is_numeric($_GET['month'])) {
                $selectedMonth = intval($_GET['month']);

                $stmt = $con->prepare('SELECT id, seller, currentDate, product_name, price FROM purchases WHERE seller = ? AND MONTH(currentDate) = ? ORDER BY currentDate DESC');
                $stmt->bind_param("si", $_SESSION['name'], $selectedMonth);
            } else {
                $stmt = $con->prepare('SELECT id, seller, currentDate, product_name, price FROM purchases WHERE seller = ? AND currentDate < CURDATE() ORDER BY currentDate DESC');
                $stmt->bind_param("s", $_SESSION['name']);
            }


            $stmt->execute();
            $result = $stmt->get_result();

            $report = '';

            while ($row = mysqli_fetch_assoc($result)) {
                $report .= '<tr>';
                $report .= '<td>' . $row['id'] .'</td>';
                $report .= '<td>' . $row['currentDate'] . '</td>';
                $report .= '<td>' . $row['product_name'] . '</td>';
                $report .= '<td>' . $row['price'] . '</td>';
                $report .= '</tr>';
            }

            echo $report;

            

            ?>




</body>
</html>