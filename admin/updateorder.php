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
        echo "<script>alert('Order updated sucessfully...');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Compliant</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS can be added here */
        /* Custom CSS for your PHP page */

/* Update Order section */
.container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #5a6268;
}

/* Order details section */
.row {
    margin-bottom: 10px;
}

.col p {
    margin-bottom: 5px;
}

.col p b {
    font-weight: bold;
}

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
        <?php 
        $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
        while($row=mysqli_fetch_array($ret)) {
        ?>
        <div class="row">
            <div class="col">
                <p><b>At Date:</b> <?php echo $row['postingDate'];?></p>
                <p><b>Status:</b> <?php echo $row['status'];?></p>
                <p><b>Remark:</b> <?php echo $row['remark'];?></p>
            </div>
        </div>
        <?php } ?>
        <?php 
        $st='Delivered';
        $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
        while($num=mysqli_fetch_array($rt)) {
            $currrentSt=$num['orderStatus'];
        }
        if($st==$currrentSt) { ?>
            <div class="row">
                <div class="col">
                    <p><b>Product Delivered</b></p>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="in Process">In Process</option>
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
        <?php } ?>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
