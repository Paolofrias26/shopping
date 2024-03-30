<?php
// Include configuration file
include('includes/config.php');

// Check if item_id is set in the URL
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    // Remove the item from the session cart array
    unset($_SESSION['cart'][$item_id]);
    // Remove the item from the database
    $delete_query = "DELETE FROM addtocart WHERE id = '$item_id'";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        // Set success message
        $_SESSION['errmsg'] = "Item successfully removed from the cart";
    } else {
        // Display error message
        $_SESSION['errmsg'] = "Error removing item from the cart.";
    }
    // Redirect back to the cart page
    header('Location: my-cart.php');
    exit();
}
?>
