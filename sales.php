<?php
  session_start();

$con = mysqli_connect("localhost", "root", "", "database1");
if (!$con) {
  echo "Problem in database connection! Contact administrator!" . mysqli_errno(mysql:$mysql);
} else {
  $specific_seller = $_SESSION['name']; // Replace this with the desired seller's name

  $sales_sql = "SELECT YEAR(currentDate) AS Year, MONTH(currentDate) AS Month, seller, SUM(price) AS TotalSales
      FROM purchases
      WHERE seller = '$specific_seller' -- Add the WHERE clause
      GROUP BY Year, Month, seller
      ORDER BY Year, Month, seller";

  $sales_result = mysqli_query($con, $sales_sql);
  $sales_data = [];
  
  while ($row = mysqli_fetch_array($sales_result)) {
      $year_month = $row['Year'] . '-' . $row['Month'];
      $sales_data[$year_month] = $row['TotalSales'];
  }
}



?>

<!--GRAPH-->
<!DOCTYPE html>

<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "sales.css">
        <title>Graph</title> 

    </head>
    <body id ="userPage">


     <!--Navbar-->
     <nav class="navbar navbar-expand-lg" id="my-navbar">
    <div class="container-fluid">
            <a class="navbar-brand" href="user.php">
              <img src="images/mpposlogo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
              MyPersonalPOS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav" id="profile-logout">
                <a class="nav-link" href="logout.php" id="logoutButton">Log-out</a>
            </div>
          </div>

          

    </nav>




        <div id = "container">
        <div style="width:60%;height:20%;text-align:center">
            <br>
            <h2 class="page-header" ><?= ucfirst($_SESSION['name'])?>'s Sales Report </h2>
            <canvas  id="chartjs_bar"></canvas> 
            <br>
        </div>    
    </div>



  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
      var sales_data = <?php echo json_encode($sales_data); ?>;
      var labels = Object.keys(sales_data);
      var salesValues = Object.values(sales_data);

      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Total Sales',
                  backgroundColor: [
                      "#5969ff",
                      "#ff407b",
                      "#25d5f2",
                      "#ffc750",
                      "#2ec551",
                      "#7040fa",
                      "#ff004e",
                      "#00bfff", 
                      "#ff6347",
                      "#228b22",
                      "#800080",
                      "#ff8c00"


                  ],
                  data: salesValues,
              }]
          },
          options: {
              legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }
              },
          }
      });


      window.addEventListener("DOMContentLoaded", function() {
    const selectMonth = document.getElementById("select-month");
    const transactionsTable = document.getElementById("transactions-table").querySelector("table");

    selectMonth.addEventListener("change", function() {
        const month = selectMonth.value;

        // Fetch transactions for the selected month using AJAX
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                transactionsTable.innerHTML = xhr.responseText;
            }
        };

        // Send a request to a PHP script that generates the filtered transactions HTML
        if (month === '13') { // '13' represents "All Transactions"
            xhr.open("GET", `get_filtered_transactions.php`, true);
        } else {
            xhr.open("GET", `get_filtered_transactions.php?month=${month}`, true);
        }
        xhr.send();
    });
});



</script>



<br>
        <div class="container">
          <div class="form-floating" id = "month-selector">

          <select class="form-select" aria-label="Floating label select example" id = "select-month" name = "select-month">
          <option value = "13">All Transactions</option>
          <option value = "1">January</option>
          <option value = "2">February</option>
          <option value = "3">March</option>
          <option value = "4">April</option>
          <option value = "5">May</option>
          <option value = "6">June</option>
          <option value = "7">July</option>
          <option value = "8">August</option>
          <option value = "9">September</option>
          <option value = "10">October</option>
          <option value = "11">November</option>
          <option value = "12">December</option>
          </select>

          <label for = "select-month">Select Month:</label>

          </div>
        </div>

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


            $stmt = $con->prepare('SELECT id, seller, currentDate, product_name, price FROM purchases WHERE seller = ? AND currentDate < CURDATE() ORDER BY currentDate DESC');
            $stmt->bind_param("s", $_SESSION['name']);
            $stmt->execute();
            $result = $stmt->get_result();

            $report = '';
        
            
            // Fetch data from the database before entering the loop
            // Assuming $result contains your query result
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['id'] . '</td>';
              echo '<td>' . $row['currentDate'] . '</td>';
              echo '<td>' . $row['product_name'] . '</td>';
              echo '<td>' . $row['price'] . '</td>';
              echo '</tr>';
          }

                // Echo the content within the loop
              
            ?>
            
        
      </table>
        </div>
        


    </body>
</html>
