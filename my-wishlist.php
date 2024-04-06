<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if(isset($_GET['del'])) {
        $wid = intval($_GET['del']);

        // Delete product from wishlist
        $query = mysqli_query($con, "DELETE FROM wishlist WHERE id = '$wid'");
    }

    if(isset($_GET['action']) && $_GET['action'] == "add") {
        $id = intval($_GET['id']);
		$query=mysqli_query($con,"delete from wishlist where productId='$id'");
        // Check if product exists
        $sql_p = "SELECT * FROM products WHERE id = $id";
        $query_p = mysqli_query($con, $sql_p);
        if(mysqli_num_rows($query_p) != 0) {
            // Fetch product details
            $row_p = mysqli_fetch_array($query_p);
            $product_name = $row_p['productName'];
            $product_price = $row_p['productPrice'];

            // Add the product to the session cart
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id] = array("quantity" => 1, "price" => $product_price);
            }

            // Insert data into the addtocart table
            $user_id = $_SESSION['id'];
            $quantity = 1;
            $added_at = date('Y-m-d H:i:s');

            $sql_insert = "INSERT INTO addtocart (userId, productId, product_name, quantity, product_price, added_at)
                           VALUES ('$user_id', '$id', '$product_name', '$quantity', '$product_price', '$added_at')";
            
            // Execute the query
            if(mysqli_query($con, $sql_insert)) {
                // Redirect to the cart page with a success message
                $_SESSION['success_message'] = 'Added to cart successfully!';
                header('Location: my-cart.php?message=added');
                exit;
            } else {
                // Handle database insertion error
                echo "Error: " . mysqli_error($con);
                exit;
            }
        } else {
            // Product does not exist
            $message = "Product ID is invalid";
            header('Location: my-wishlist.php?error=' . urlencode($message));
            exit;
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

	    <title>My Wishlist</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

	    <!-- Customizable CSS -->
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
		<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
		<link rel="shortcut icon" href="assets/images/988logo.ico">
	</head>
    <body class="cnt-home">
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Wishlish</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="my-wishlist-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4">my wishlist</th>
				</tr>
			</thead>
			<tbody>
<?php
$ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,wishlist.productId as pid,wishlist.id as wid from wishlist join products on products.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
$num=mysqli_num_rows($ret);
	if($num>0)
	{
while ($row=mysqli_fetch_array($ret)) {

?>

				<tr>
					<td class="col-md-2"><img src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" alt="<?php echo htmlentities($row['pname']);?>" width="60" height="100"></td>
					<td class="col-md-6">
						<div class="product-name"><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><?php echo htmlentities($row['pname']);?></a></div>
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>

						<div class="rating">
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star non-rate"></i>
							<span class="review">( <?php echo htmlentities($num);?> Reviews )</span>
						</div>
						<?php } ?>
						<div class="price">₱
							<?php echo htmlentities($row['pprice']);?>
							<span>₱900.00</span>
						</div>
					</td>
					<td class="col-md-2">
					<a href="product-details.php?page=product&action=add&id=<?php echo $row['pid']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>

					</td>
					<td class="col-md-2 close-btn">
						<a href="my-wishlist.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')" class=""><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php } } else{ ?>
				<tr>
					<td style="font-size: 18px; font-weight:bold ">Your Wishlist is Empty</td>

				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	<?php include('includes/brands-slider.php');?>
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
</body>
</html>
<?php } ?>
