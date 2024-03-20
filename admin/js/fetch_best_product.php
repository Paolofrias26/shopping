<?php
$queryProducts = mysqli_query($con, "SELECT DISTINCT products.productName FROM orders
    INNER JOIN products ON orders.productId = products.id
    WHERE orders.orderStatus = 'Delivered'");

$productsData = array();
while ($rowProduct = mysqli_fetch_assoc($queryProducts)) {
    $productsData[] = $rowProduct['productName'];
}

echo json_encode($productsData);
?>
