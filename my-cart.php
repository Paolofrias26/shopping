<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {
header('location:login.php');
}
else{

if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart hasbeen Updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){

				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) {
    if(strlen($_SESSION['login']) == 0) {
        header('location: login.php');
    } else {
        $quantity = $_POST['quantity'];
        $pdtid = $_SESSION['pid'];
        $value = array_combine($pdtid, $quantity);

        foreach($value as $pid => $qty) {
            // Fetch available quantity and product name from the database
            $fetchProductQuery = mysqli_query($con, "SELECT productName, quantity FROM products WHERE id='$pid'");
            $productRow = mysqli_fetch_assoc($fetchProductQuery);
            $productName = $productRow['productName'];
            $availableQuantity = $productRow['quantity'];

            // Check if available quantity is greater than or equal to purchased quantity
            if ($availableQuantity >= $qty) {
                // Subtract purchased quantity from available quantity
                $newQuantity = $availableQuantity - $qty;

                // Update the quantity in the products table
                $updateQuantityQuery = mysqli_query($con, "UPDATE products SET quantity='$newQuantity' WHERE id='$pid'");
                if (!$updateQuantityQuery) {
                    // Handle the error if the update fails
                    echo "<script>alert('Error updating quantity in the database.');</script>";
                }

                // Insert the order into the orders table with productName
                mysqli_query($con, "INSERT INTO orders(userId, productId, productName, quantity, orderStatus) VALUES('" . $_SESSION['id'] . "','$pid','$productName','$qty', 'in process')");
                header('location: payment-method.php');
            } else {
                // If available quantity is less than purchased quantity, show an error
                echo "<script>alert('Insufficient quantity available for product ID: $pid.');</script>";
            }
        }
    }
}
}


// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bbarangay=$_POST['barangay'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',barangay='$bbarangay' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$sbarangay=$_POST['barangay'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',barangay='$sbarangay' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>My Cart</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/blue.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->


		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/988logo.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

	</head>
    <body class="cnt-home">



		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
	<div class="table-responsive">
<form name="cart" method="post">
<?php
if(!empty($_SESSION['cart'])){
	?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="cart-select item">Select</th>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>

					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Price Per unit</th>
					<th class="cart-sub-total item">Shipping Charge</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<input type="submit" name="submit" value="Update shopping cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
 <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
	?>
				
				<tr>
					<td class="cart-select item"><input type="checkbox" name="selected_items[]" value="<?php echo htmlentities($row['id']);?>" /></td>
					<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
						    <img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];

$_SESSION['sid']=$pd;
						 ?></a></h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="rating rateit-small"></div>
							</div>
							<div class="col-sm-8">
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>
								<div class="reviews">
									( <?php echo htmlentities($num);?> Reviews )
								</div>
								<?php } ?>
							</div>
						</div><!-- /.row -->

					</td>
					<td class="cart-product-quantity">
						<div class="quant-input">
				                <div class="arrows">
				                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
				                </div>
				             <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">

			              </div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "₱"." ".$row['productPrice']; ?></span></td>
<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "₱"." ".$row['shippingCharge']; ?>.00</span></td>

					<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</span></td>
				</tr>

				<?php } }
$_SESSION['pid']=$pdtid;
				?>

			</tbody><!-- /tbody -->
		</table><!-- /table -->

	</div>
</div><!-- /.shopping-cart-table -->			<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
<?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>

<div class="form-group">
					    <label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billingAddress'];?></textarea>
					  </div>



					  <div class="form-group">
    <label class="info-title" for="Billing State">Billing State <span>*</span></label>
    <input style="backgroundcolor: white" type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate" value="Pangasinan" disabled>
    <input type="hidden" name="bilingstate" value="Pangasinan"> <!-- Hidden field to pass the value -->
</div>

<div class="form-group">
    <label class="info-title" for="Billing City">Billing City <span>*</span></label>
    <input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" value="Basista" disabled>
    <input type="hidden" name="billingcity" value="Basista"> <!-- Hidden field to pass the value -->
</div>


<div class="form-group">
    <label class="info-title" for="Barangay">Barangay <span>*</span></label>
    <input type="text" class="form-control unicase-form-control text-input" id="barangay" name="barangay" required="required" value="<?php echo $row['barangay'];?>" >
</div>


					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>

					<?php } ?>

						</div>

					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>

<!-- /table -->
</div>
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>

			<tr>
				<th>

					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
									<button type="submit" name="ordersubmit" class="btn btn-primary" onclick="return validateCheckout()">PROCEED TO CHECKOUT</button>  

						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php } else {
echo "Your shopping Cart is empty";
		}?>
</div>			</div>
		</div>
		</form>
<?/*php echo include('includes/brands-slider.php');*/?>
</div>
</div>
<?php include('includes/footer.php');?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>

	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>

	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
		$(document).ready(function(){
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<script type="text/javascript">
    function validateCheckout() {
        var checkboxes = document.getElementsByName('selected_items[]');
        var checked = false;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = true;
                break;
            }
        }
        if (!checked) {
            alert("Please select at least one item to proceed to checkout.");
            return false;
        }
        return true;
    }
</script>

	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>
