<?php
session_start();

include_once 'include/config.php';

$oid = intval($_GET['oid']);

// Fetch order details based on $oid
$orderQuery = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
$orderDetails = mysqli_fetch_assoc($orderQuery);

// Fetch product details for the order
$productQuery = mysqli_query($con, "SELECT * FROM products WHERE id='{$orderDetails['productId']}'");
$productDetails = mysqli_fetch_assoc($productQuery);

// Fetch user details based on the user ID associated with the order
$userQuery = mysqli_query($con, "SELECT * FROM users WHERE id='{$orderDetails['userId']}'");
$userDetails = mysqli_fetch_assoc($userQuery);

// Calculate total price
$totalPrice = $orderDetails['quantity'] * $productDetails['productPrice'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 10px;
            background-color: #fff;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h3 {
            margin-bottom: 10px;
            color: #000;
        }

        .receipt-content {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .receipt-content p {
            margin: 5px 0;
        }

        .receipt-footer {
            text-align: center;
        }

        .btn-print {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-print:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container mt-5">
<div class="receipt-header">
    <img src="assets/images/988logo.png" alt="Company Logo" class="img-fluid" style="max-width: 150px;">
    <h3>988 Online Shop</h3>
</div>

    <div class="receipt-content">
        <!-- <div class="row">
            <div class="col-md-4">
                <img src="productimages/<?php echo $productDetails['id'];?>/<?php echo $productDetails['productImage1'];?>" alt="<?php echo $productDetails['productName']; ?>" class="img-fluid">
            </div> -->
            <div class="col-md-8">

     <!-- Add user details -->
     <p><b>User Order</b></p>
    <hr>
    <p><b>Name:</b> <?php echo $userDetails['name']; ?></p>
    <hr>
    <p><b>Address:</b> <?php echo $userDetails['billingAddress']; ?></p>
    <hr>
    <p><b>City:</b> <?php echo $userDetails['billingCity']; ?></p>
    <hr>
    <p><b>State:</b> <?php echo $userDetails['billingState']; ?></p>
    <hr>
    <!-- Add more details as needed -->

    <p><b>Order ID:</b> <?php echo $orderDetails['id']; ?></p>
    <hr>
    <p><b>Product Name:</b> <?php echo $productDetails['productName']; ?></p>
    <hr>
    <p><b>Quantity:</b> <?php echo $orderDetails['quantity']; ?></p>
    <hr>
    <p><b>Unit Price:</b> <?php echo $productDetails['productPrice']; ?></p>
    <hr>
    <p><b>Total Price:</b> <?php echo number_format($totalPrice, 2); ?></p>
    <hr>
   
</div>

        </div>
    </div>
    <div class="receipt-footer">
        <button class="btn btn-print" onclick="window.print()">Print</button>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
