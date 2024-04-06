<?php
// Include necessary files and start session if required

// Check if 'status' parameter is set in the URL
if(isset($_GET['status'])) {
    $status = $_GET['status'];

    // Depending on the status value, retrieve and display corresponding orders
    switch($status) {
        case 'shipping':
            // Retrieve and display orders with shipping status
            break;
        case 'completed':
            // Retrieve and display completed orders
            break;
        case 'canceled':
            // Retrieve and display canceled orders
            break;
        default:
            // Handle invalid status value
            break;
    }
} else {
    // Default behavior if 'status' parameter is not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <!-- Your CSS stylesheets and other meta tags here -->
</head>
<body>

<nav>
    <ul>
        <li><a href="orders.php?status=shipping">Shipping</a></li>
        <li><a href="orders.php?status=completed">Completed</a></li>
        <li><a href="orders.php?status=canceled">Canceled</a></li>
    </ul>
</nav>

<!-- Your main content here -->

</body>
</html>
