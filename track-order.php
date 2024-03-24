<?php
session_start();
include_once 'includes/config.php';
$oid=intval($_GET['oid']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Tracking Details</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
 <form name="updateticket" id="updateticket" method="post"> 
<table class="table">
    <thead class="thead-dark">
    <tr>
      <th colspan="2"><div class="fontpink2"><b>Order Tracking Details</b></div></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td class="fontkink1"><b>Order Id:</b></td>
      <td class="fontkink"><?php echo $oid;?></td>
    </tr>
    <?php 
    $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
    $num=mysqli_num_rows($ret);
    if($num>0) {
        while($row=mysqli_fetch_array($ret)) {
    ?>
    <tr>
      <td class="fontkink1" ><b>At Date:</b></td>
      <td class="fontkink"><?php echo $row['postingDate'];?></td>
    </tr>
    <tr>
      <td class="fontkink1"><b>Status:</b></td>
      <td class="fontkink"><?php echo $row['status'];?></td>
    </tr>
    <tr>
      <td class="fontkink1"><b>Remark:</b></td>
      <td class="fontkink"><?php echo $row['remark'];?></td>
    </tr>
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
    <?php } }
    else{
    ?>
    <tr>
      <td colspan="2">Order Not Process Yet</td>
    </tr>
    <?php  }
    $st='Delivered';
    $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
    while($num=mysqli_fetch_array($rt)) {
        $currrentSt=$num['orderStatus'];
    }
    if($st==$currrentSt) { ?>
    <tr>
        <td colspan="2"><b>Product Delivered successfully</b></td>
    </tr>
    <?php } ?>
    </tbody>
    
</table>
</form>
</div>

<!-- Bootstrap JS if needed -->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>-->
</body>
</html>
