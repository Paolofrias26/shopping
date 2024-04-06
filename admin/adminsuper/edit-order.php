<?php
session_start();

include_once 'include/config.php';

// Check if user is logged in
if(strlen($_SESSION['alogin']) == 0) { 
    header('location:index.php');
    exit();
}

// Check if order id is provided in the URL
if (!isset($_GET['oid'])) {
    header('location:index.php');
    exit();
}

// Get order id from the URL
$oid = intval($_GET['oid']);

// Check if form is submitted
if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    $remark = $_POST['remark'];

    // Update order status and add to order track history
    $query = mysqli_query($con, "INSERT INTO ordertrackhistory(orderId, status, remark) VALUES ('$oid', '$status', '$remark')");
    $sql = mysqli_query($con, "UPDATE orders SET orderStatus='$status' WHERE id='$oid'");
    
    // Display success message
    echo "<script>alert('Order updated successfully...');</script>";
    echo "<script>window.location.href='updateorder.php?oid=$oid';</script>";
}

// Fetch existing order details
$orderDetails = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
$order = mysqli_fetch_assoc($orderDetails);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS can be added here */
        /* Custom CSS for your PHP page */
    </style>
</head>
<body>

<div class="container mt-5">
    <form name="editOrderForm" id="editOrderForm" method="post"> 
        <div class="row">
            <div class="col">
                <h3 class="font-weight-bold">Edit Order</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="orderId">Order Id:</label>
                    <input type="text" class="form-control" id="orderId" value="<?php echo $oid;?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="In Process">In Process</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="remark">Remark:</label>
                    <textarea class="form-control" id="remark" name="remark" rows="5" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
