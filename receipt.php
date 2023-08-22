<?php
session_start();

// Retrieve the receipt and payment data from the session
$receiptData = $_SESSION['receiptData'];
$paymentData = $_SESSION['paymentData'];

// Calculate the total amount of items in the receipt
$total = 0;
foreach ($receiptData as $item) {
    $total += $item['price'];
}

// Calculate the payment value
$payment = number_format($paymentData['cashInput'], 2, '.', ''); // Assuming you stored the payment value as 'cashInput'

// Calculate the amount change
$amountChange = $payment - $total;

// Clear the session variables
unset($_SESSION['receiptData']);
unset($_SESSION['paymentData']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel = "stylesheet" type = "text/css" href="receipt.css">


    <title>Receipt</title>
    <style>
        @media print {
            /* Hide the Print button during printing */
            #printButton {
                display: none;
            }
        }
    </style>
</head>
<body>
        <div id="container" class = "text-center">
            <img src="images/mpposlogo.png" width="200">
            <div id="no-line-spacing">
            <h4>AMA University QC</h4>
            <p>Maximina St., Villa Arca Subdivision Project 8, Quezon City</p>
            <p>Hotline: (02) 8656-0654 / 88443225</p>
            <p>Mobile:  0995 721 1749 / 0921 861 9122</p>
         </div>

        <br>

        <div class="input-group">
        <span class="input-group-text">Sold to</span>
        <input type="text" aria-label="First name" class="form-control">
        <input type="text" aria-label="Last name" class="form-control">
        </div>
        <div class="input-group">
        <span class="input-group-text">Address</span>
        <input type="text" aria-label="First name" class="form-control">
        </div>
        <div class="input-group">
        <span class="input-group-text">Business Style</span>
        <input type="text" aria-label="First name" class="form-control">
        </div>
        <div class="input-group">
        <span class="input-group-text">Tax / Registration ID</span>
        <input type="text" aria-label="First name" class="form-control">
        </div>

        <hr>    

        <h5 id="currentDate"></h5>
        <script>
    function updateCurrentDate() {
        const currentDateElement = document.getElementById('currentDate');
        const currentDate = new Date();
        const formattedDate = currentDate.toDateString(); // You can adjust the date format as needed

        currentDateElement.textContent = formattedDate;
    }

            // Call the function to update the date immediately and then at regular intervals
            updateCurrentDate();
            setInterval(updateCurrentDate, 1000); // Update every 1000ms (1 second)
        </script>



        <table class="table" id="receiptTable">
            <thead class="table-primary">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="receiptData">
                <!-- Receipt items will be displayed here -->
                <?php
                // Assuming you have stored the receipt data in $receiptData array
                $total = 0;
                foreach ($receiptData as $item) {
                    echo "<tr>";
                    echo "<td>{$item['productName']}</td>";
                    echo "<td>Php{$item['price']}</td>";
                    echo "</tr>";
                    echo "<tr><td colspan='2' style='border-top: 1px solid #000;'></td></tr>";
                    $total += $item['price'];
                }

                ?>
                <tr class="table-info total-row">
                    <td>Total</td>
                    <td>Php<?php echo $total; ?></td>
                </tr>
                <tr class="table-success total-row">
                    <td>Payment</td>
                    <td>Php<?php echo $payment; ?></td>
                </tr>
                <tr class="table-success total-row">
                    <td>Amount Change</td>
                    <td>Php<?php echo $amountChange; ?></td>
                </tr>
                


            </tbody>
        </table>

        <h6 class="text-start">Cashier: <?= ucfirst($_SESSION['name'])?></h6>
        <br>
        <br>
        <p>Received the above goods in good condition:</p>
        <br>
        <br>
        <div class="signature-line"></div>
        <div class="printed-name">Printed Name and Signature</div>
                <br>
                <br>
        <!-- Add a Print button -->
        <button class="btn btn-primary" id="printButton" onclick="printAndRedirect()">Print Receipt</button>
    </div>


    



    <script>



        function printAndRedirect() {

            // Trigger the print functionality
            window.print();
            // Redirect back to user.php after printing
            window.location.href = 'user.php';
        }
    </script>
    </div>
</body>
</html>
