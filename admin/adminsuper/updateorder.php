<?php
session_start();

include_once 'include/config.php';
if(strlen($_SESSION['alogin'])==0) { 
    header('location:index.php');
} else {
    $oid=intval($_GET['oid']);
    if(isset($_POST['submit2'])) {
        $status=$_POST['status'];
        $remark=$_POST['remark'];//space char

        $query=mysqli_query($con,"insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
        $sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$oid'");
        echo "<script>alert('Order updated successfully...');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS can be added here */
        /* Custom CSS for your PHP page */
    </style>
</head>
<body>

<div class="container mt-5">
    <form name="updateticket" id="updateticket" method="post"> 
        <div class="row">
            <div class="col">
                <h3 class="font-weight-bold">Update Order</h3>
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
        <!-- Order details -->
        <?php 
        $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
        while($row=mysqli_fetch_array($ret)) {
        ?>
        <div class="row">
            <div class="col">
                <p><b>At Date:</b> <?php echo date('g:i a', strtotime($row['postingDate']));?></p>
                <p><b>Status:</b> <?php echo $row['status'];?></p>
                <p><b>Remark:</b> <?php echo $row['remark'];?></p>
                <hr style="border-top: 3px dashed red">
            </div>
        </div>
        <?php } ?>
        <?php 
        $st='Delivered';
        $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
        while($num=mysqli_fetch_array($rt)) {
            $currentSt=$num['orderStatus'];
        }
        if($st==$currentSt) { ?>
            <div class="row">
                <div class="col">
                    <p><b>Product Delivered</b></p>
                    <button type="button" class="btn btn-primary" onclick="editOrder()">Edit</button>
                </div>
                <button type="button" class="btn btn-primary" onclick="viewReceipt()">View Receipt</button>
            </div>
            <hr>
        <?php } else { ?>
            <!-- Form to update order -->
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
                    <div class="form-group">
                        <label for="remark">Remark:</label>
                        <textarea class="form-control" id="remark" name="remark" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="submit2" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="window.close();">Close this Window</button>
                </div>
            </div>
            <!-- Button to view receipt -->
            <div class="row mt-3">
                <div class="col">
                    <button type="button" class="btn btn-success" onclick="viewReceipt()">View Receipt</button>
                </div>
            </div>
        <?php } ?>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript to open receipt in new window -->
<script>
    function viewReceipt() {
        var receiptWindow = window.open('view-receipt.php?oid=<?php echo $oid; ?>', '_blank');
        receiptWindow.focus();
    }

    function editOrder() {
        window.location.href = 'edit-order.php?oid=<?php echo $oid; ?>';
    }
</script>

</body>
</html>
