<?php
// Start the session and suppress error reporting
session_start();
error_reporting(0);

// Include configuration file
include('includes/config.php');

// Check if the user is logged in
if (strlen($_SESSION['login']) == 0) {
    // Redirect to login page if not logged in
    header('location:login.php');
} else {

	if (isset($_SESSION['success_message'])) {
		// Display the success message in an alert box
		echo "<script>alert('" . $_SESSION['success_message'] . "')</script>";
		
		// Remove the session variable to prevent displaying the message again on page refresh
		unset($_SESSION['success_message']);
	}

	
	// Include configuration file
	include('includes/config.php');

	



    // Update cart quantity upon submission
  


// Remove product from cart and database
if (isset($_POST['remove_item'])) {
    $item_id = $_POST['remove_item'];
    // Check if cart is not empty
	echo "<script>
	var confirmRemove = confirm('Are you sure you want to remove this item to cart?');
	if (confirmRemove) {
		// If user confirms, proceed with removal
		window.location.href = 'remove_item.php?item_id=$item_id';
	} else {
		// If user cancels, do nothing
	}
 </script>";
}





   // Insert product into order table
   if (isset($_POST['ordersubmit'])) {
    // Check if the user is logged in
    if (strlen($_SESSION['login']) == 0) {
        // Redirect to login page if not logged in
        header('location:login.php');
        exit; // Stop further execution
    } else {
        // Check if any products are selected for ordering
        if (!empty($_POST['remove_code'])) {
            // Iterate over the selected products
            foreach ($_POST['remove_code'] as $productId) {
                // Get the quantity of the selected product
                $quantity = $_POST['quantity'][$productId];

                // Insert order into orders table
                $insertOrderQuery = mysqli_query($con, "INSERT INTO orders(userId, productId, quantity, orderStatus) VALUES('" . $_SESSION['id'] . "','$productId','$quantity', 'in process')");
                
                if (!$insertOrderQuery) {
                    // Display error if insertion fails
                    echo "<script>alert('Error placing the order. Please try again.');</script>";
                    // You might want to handle the error more gracefully
                }
            }
            // Redirect to payment method page after successfully placing the order
            header('location: payment-method.php');
            exit; // Stop further execution
        } else {
            // Display error if no products are selected
            echo "<script>alert('Please select at least one product to proceed to checkout.');</script>";
            // You might want to handle the error more gracefully
        }
	}
   }

    // Update billing address
    if (isset($_POST['update'])) {
        $baddress = $_POST['billingaddress'];
        $bstate = $_POST['bilingstate'];
        $bcity = $_POST['billingcity'];
        $bbarangay = $_POST['barangay'];
        $query = mysqli_query($con, "update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',barangay='$bbarangay' where id='".$_SESSION['id']."'");
        if ($query) {
            // Display success message
            echo "<script>alert('Billing Address has been updated');</script>";
        }
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
$ret=mysqli_query($con,"select products.shippingCharge as shippingCharge,products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,addtocart.productId as pid,addtocart.quantity as quantity,addtocart.id as wid from addtocart join products on products.id=addtocart.productId where addtocart.userId='".$_SESSION['id']."'");  
$num=mysqli_num_rows($ret);
	if($num>0)
	{ 
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
		<?php
while ($row=mysqli_fetch_array($ret)) {

?>
			
			
				<tbody>

     
					<tr>
					<td class="cart-select item">
					<input type="checkbox" 
       name="selected_items[]" 
       value="<?php echo htmlentities($row['wid']);?>" 
       data-price="<?php echo htmlentities($row['pprice']); ?>" 
       data-quantity="<?php echo htmlentities($row['quantity']); ?>" 
       onchange="updateGrandTotal(); updateCheckoutButton();" />
    </td>

					<td class="romove-item"><button type="submit" name="remove_item" value="<?php echo htmlentities($row['wid']);?>" class="btn btn-danger btn-xs">Remove</button></td>

						<td class="col-md-2"><img src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" alt="<?php echo htmlentities($row['pname']);?>" width="60" height="100"></td>
						<td class="cart-product-name-info">
							<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><?php echo htmlentities($row['pname']);?></a></h4>
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
								<input type="text" value="<?php echo $row['quantity']?>">

							</div>
						</td>
						<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "₱"." ".$row['pprice']; ?></span></td>
	<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "₱"." ".$row['shippingCharge']; ?>.00</span></td>

						<td class="cart-product-grand-total"><span class="cart-grand-total-price"> ₱ <?php echo ($row['quantity']*$row['pprice']+$row['shippingCharge']); ?></span></td>
					</tr>

					<?php  }
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

					<!-- Update the HTML for the grand total -->
<div class="cart-grand-total" id="grandTotal">
    Grand Total<span class="">₱0.00</span>
</div>

				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
						<button type="submit" name="ordersubmit" class="btn btn-primary" id="checkoutBtn" onclick="return validateCheckout()" disabled>PROCEED TO CHECKOUT</button> 

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
	<script>
		<script>
    // Function to calculate and update the grand total
    function updateGrandTotal() {
        // Initialize grand total variable
        var grandTotal = 0;

        // Iterate over the selected checkboxes
        var checkboxes = document.getElementsByName('remove_code[]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                // Get the price and quantity of the selected item
                var price = parseFloat(checkboxes[i].getAttribute('data-price'));
                var quantity = parseInt(checkboxes[i].getAttribute('data-quantity'));

                // Calculate subtotal for the selected item (price * quantity)
                var subtotal = price * quantity;

                // Add the subtotal to the grand total
                grandTotal += subtotal;
            }
        }

        // Update the grand total display
        document.getElementById('grandTotal').innerHTML = 'Grand Total<span class="inner-left-md">₱' + grandTotal.toFixed(2) + '</span>';
    }

    // Attach event listener to checkboxes to update grand total when they change
    var checkboxes = document.getElementsByName('remove_code[]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', updateGrandTotal);
    }

    // Update grand total initially
    updateGrandTotal();
</script>

	</script>
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
	<script>
		function updateCheckoutButton() {
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
    var checkoutBtn = document.getElementById('checkoutBtn');
    var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    checkoutBtn.disabled = !isChecked;
}

function updateGrandTotal() {
    // Add your code to update the grand total based on selected items
}

function validateCheckout() {
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
    var checked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    if (!checked) {
        alert("Please select at least one item to proceed to checkout.");
        return false;
    }
    return true;
}

	</script>

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
	function updateGrandTotal() {
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
    var total = 0;
    checkboxes.forEach(function(checkbox) {
        var price = parseFloat(checkbox.dataset.price);
        var quantity = parseInt(checkbox.dataset.quantity);
        total += price * quantity;
    });
    document.getElementById('grandTotal').innerText = 'Grand Total  ' + '   ₱' + total.toFixed(2); // Format as decimal
}


function updateCheckoutButton() {
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
    var checkoutBtn = document.getElementById('checkoutBtn');
    var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    checkoutBtn.disabled = !isChecked;
}

	</script>
	

	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>
