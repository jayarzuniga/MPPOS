<?php
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "database1";
  
  $con = mysqli_connect($servername, $username, $password, $db_name);
  
  if (mysqli_connect_errno()) {
      exit('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
 


  $stmt = $con->prepare('SELECT seller, currentDate, product_name, price FROM purchases WHERE seller = ? AND currentDate < CURDATE() ORDER BY currentDate DESC');
  $stmt->bind_param("s", $_SESSION['name']);
  $stmt->execute();
  $result = $stmt->get_result();
  
  $report = '';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <Title>User</Title>
    <!--Bootstrap Library-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="user_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
  </head>

<body id="userPage">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg" id="my-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="images/mpposlogo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            MyPersonalPOS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" id="navbar-items">
                <a class="nav-link disabled" aria-disabled="true"><?php echo $_SESSION['name']; ?></a>
                <span class="navbar-text" id="currentDateTime"><?php echo date('Y-m-d H:i:s'); ?></span>
            </div>
            <div class="navbar-nav ms-auto" id="profile-logout">
                <a class="nav-link" href="user-profile.php" id="profileButton">Profile</a>
                <a class="nav-link" href="logout.php" id="logoutButton">Log-out</a>
            </div>
        </div>
      </div>
      </nav>

          
          <script>
    // Update every 1000ms (1 second)
    function updateDateTime() {
        var currentDateTimeElement = document.getElementById('currentDateTime');

        function update() {
            var now = new Date();
            
            // Create options object for formatting
            var options = {
                timeZone: 'Asia/Singapore', // Set your desired time zone here
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false // Use 24-hour format
            };

            var formattedDateTime = now.toLocaleString('en-US', options);

            currentDateTimeElement.innerHTML = formattedDateTime;
        }

        update();
        setInterval(update, 1000);
    }

    updateDateTime();
</script>

    </nav>

    <h2 class="text-center" >Hello! <?= ucfirst($_SESSION['name'])?></h2>
    <br>
    <div class="container text-center ">
      <div class="row align-item-start">
        <div class='col'>
          <h2>Shopping Cart</h2>
          <br>
            <div class="container-fluid">
                <button class="btn btn-primary" id="itemButton" onclick="addToCart('Product 1', 10.99)">Product 1</button>
                <button class="btn btn-primary" id="itemButton" onclick="addToCart('Product 2', 12.49)">Product 2</button>
                <button class="btn btn-primary" id="itemButton" onclick="addToCart('Product 3', 8.75)">Product 3</button>
                <button class="btn btn-primary" id="itemButton" onclick="addToCart('Product 4', 15.99)">Product 4</button>
                <button class="btn btn-primary" id="itemButton" onclick="addToCart('Product 5', 30.49)">Product 5</button>
                <!-- Add more buttons for other products as needed -->
            </div>
              <br>
            <div class="container-fluid" id="content">
            <div class="d-grid gap-2 col-3    as mx-auto">
                <button class="btn btn-danger" onclick="showVoidConfirmation()">Void Items</button>
            </div>




    





            <h3>Purchases</h3>
            <table class="table" id="cartTable">
                <thead>
                <tr class="table-primary">
                    <th>Item</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="cart">
                <!-- Cart items will be displayed here -->
                </tbody>
                
            </table>
            
          </div>
            <!-- Display total amount -->
            <br>
            <div class="container" id='check-out'>
            <h4>Total: <span id="totalAmount">Php 0.00</span></h4>

            <!-- Payment Stuff here-->
            <div>

                <label for="cashInput">Cash: </label>
                
                <input type="number" id="cashInput" step="0.01" placeholder="Enter cash amount" name='payment'>
            </div>
              <br>
            <div class ='d-grid gap-2 col-6 mx-auto'>
            <!--Checkout button -->
            <button class="btn btn-info" onclick="checkout()">Checkout</button>
            </div>  
            
          </div>

        </div>

        <div class="col">
          <h3>Previous Recent Transactions</h3>
          <form action = "sales.php" method = "post">
          <button class="btn btn-info" >Show More Transaction</button>
          </form>
          
          <hr>

          <!--Recent Transactions-->
          <table class="table table-striped table-hover">
            <tr class="table-secondary"> 
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
            $limit = 21; // Set the desired limit for the loop
            $counter = 0; // Initialize the counter
            
            // Fetch data from the database before entering the loop
            // Assuming $result contains your query result
            while ($counter < $limit &&  $row = mysqli_fetch_assoc($result)) {
                $report = '<tr>';
                $report .= '<td>' . $row['currentDate'] . '</td>';
                $report .= '<td>' . $row['product_name'] . '</td>';
                $report .= '<td>' . $row['price'] . '</td>';
                $report .= '</tr>';

                // Echo the content within the loop
                echo $report;

                // Increment the counter
                $counter++;
            }
            ?>
            
        
      </table>
          
          
         </div>
  
      </div>  
  </div>

    <script>
  
        let cartItems = [];
        let totalAmount = 0;
        let cashInput = 0;
        let changeAmount = 0;

        // Function to add items to the cart
        function addToCart(productName, price) {
        const cartTable = document.getElementById('cart');
        const row = cartTable.insertRow(-1);

        const itemCell = row.insertCell(0);
        itemCell.textContent = productName;

        const priceCell = row.insertCell(1);
        priceCell.textContent = `Php${price.toFixed(2)}`;

        // Create a delete button
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'btn btn-warning'; // Apply Bootstrap classes
        deleteButton.addEventListener('click', () => {
          // Get the current row index
          const rowIndex = row.rowIndex - 1;

          // Remove the item from the cart
          cartItems.splice(rowIndex, 1);

          // Update the total amount
          totalAmount -= price;
          updateTotalDisplay();

          // Remove the row from the cart table
          cartTable.deleteRow(rowIndex);
        });

        row.appendChild(deleteButton);

        // Save the item details to the cartItems array
        cartItems.push({ productName, price });

        // Update total amount
        totalAmount += price;
        updateTotalDisplay();
      }

      function showVoidConfirmation() {
        const confirmation = confirm("You're going to remove all the Items, this can't be undone. Still want to proceed?");
        if (confirmation) {
            voidCart(); // Call the voidCart function if user confirms
            }
        }

        function voidCart() {
          // Clear the cart content and update the total amount to zero
          document.getElementById('cart').innerHTML = '';
          totalAmount = 0; // Reset the totalAmount to zero
          updateTotalDisplay(); // Update the displayed total
          cartItems = []; // Reset the cartItems array
      }

        function updateTotalDisplay() {
            const totalAmountElement = document.getElementById('totalAmount');
            totalAmountElement.textContent = `Php${totalAmount.toFixed(2)}`;
        }

        function checkout() {
        // Get cash input
        cashInput = parseFloat(document.getElementById('cashInput').value);
        if (isNaN(cashInput)) {
            alert("Please enter a valid cash amount.");
            return;
        }



        // Check if amount is enough
        const changeAmount = cashInput - totalAmount;
        if (changeAmount < 0) {
            alert("Insufficient cash. Please enter a higher amount.");
            return;
        }

        // Show change amount to the user
        alert(`Change: Php${changeAmount.toFixed(2)}`);

        const data = {
            cashInput: cashInput,
            payment: cashInput // Use the totalAmount as the payment value
        };

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'checkout.php', true);
        xhr.setRequestHeader('Content-type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Redirect to receipt.php if checkout is successful
                    window.location.href = 'receipt.php';
                } else {
                    // Handle any other response if needed
                    alert('Checkout was not successful.');
                }
            }
        };
        

        xhr.send(JSON.stringify({ cartItems: cartItems , data: data}));

        // Clear the cart and cartItems array AFTER sending the AJAX request
        const cartTable = document.getElementById('cart');
        while (cartTable.rows.length > 1) {
            cartTable.deleteRow(1);
        }
        cartItems = []; // Reset the cartItems array
        totalAmount = 0; // Reset the totalAmount
        cashInput = 0; // Reset cash input
        updateTotalDisplay(); // Update total display
    }


    






    
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
