<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Manila');
include('includes/config.php');

// Check if the action is to add a product to the cart
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);

    // Check if the user is logged in
    if (empty($_SESSION['login'])) {
        // Redirect to the login page with a message
        header('Location: login.php?message=signin');
        exit;
    } else {
        // Check if the product ID is valid
        $sql_p = "SELECT * FROM products WHERE id = $id";
        $query_p = mysqli_query($con, $sql_p);

        if (mysqli_num_rows($query_p) != 0) {
            // Fetch product details
            $row_p = mysqli_fetch_array($query_p);
            $product_name = $row_p['productName'];
            $product_price = $row_p['productPrice'];

            // Add the product to the session cart
            if (isset($_SESSION['cart'][$id])) {
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
            // Product ID is invalid
            $message = "Product ID is invalid";
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

	    <title>988 Home Page</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

	    <!-- Customizable CSS -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=FontName">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/blue.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!-- <link rel="stylesheet" href="assets/css/owl.theme.css"> -->
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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/988logo.ico">

		<!-- script -->
		<script>
    function addToCart(productId) {
        // AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addToCart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response if needed
                alert(xhr.responseText); // Just for testing, you can remove this line
            }
        };
        // Send the productId as data
        xhr.send("productId=" + productId);
    }
</script>

	</head>
	
    <body class="cnt-home">	



		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>

</header>
<?php include('includes/trylang.php');?>


<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	
	<div class="container">
	
		<div class="furniture-container homepage-container">
		<div class="row">
			
			<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
				<!-- ================================== TOP NAVIGATION ================================== -->
	<?php include('includes/side-menu.php');?>
<!-- ================================== TOP NAVIGATION : END ================================== -->
			</div><!-- /.sidemenu-holder -->

			<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
				<!-- ========================================== SECTION – HERO ========================================= -->

<div id="hero" class="homepage-slider3">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		<div class="full-width-slider">
			<div class="item" style="background-image: url(assets/images/sliders/plastic.jpg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

		<div class="full-width-slider">
			<div class="item" style="background-image: url(assets/images/sliders/fans.jpg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->
		
		<div class="full-width-slider">
			<div class="item" style="background-image: url(assets/images/sliders/xmasstree2.jpg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

		<div class="full-width-slider">
			<div class="item" style="background-image: url(assets/images/sliders/hm.jpg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

		<div class="full-width-slider">
			<div class="item" style="background-image: url(assets/images/sliders/staffs2.jpg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

	    <div class="full-width-slider">
			<div class="item full-width-slider" style="background-image: url(assets/images/sliders/mayor.jpg);">
			</div>
			<!-- /.item -->
		</div><!-- /.full-width-slider -->
		<div class="full-width-slider">
			<div class="item full-width-slider" style="background-image: url(assets/images/sliders/ricecookers.jpg);">
			</div>
			<!-- /.item -->
		</div>
	</div><!-- /.owl-carousel -->
	
</div>

<!-- ========================================= SECTION – HERO : END ========================================= -->
				<!-- ============================================== INFO BOXES ============================================== -->
				<div class="info-boxes wow fadeInUp text-center">
				<?php include('includes/designInfo.php');?>
</div>


<!-- ============================================== INFO BOXES : END ============================================== -->
			</div><!-- /.homebanner-holder -->

		</div><!-- /.row -->

		<!-- ============================================== SCROLL TABS ============================================== -->
		<div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
			<div class="more-info-tab clearfix">
			   <h3 class="new-product-title pull-left">Featured Products</h3>
				<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
					<li class="active"><a href="#all" data-toggle="tab">All</a></li>
					<li><a href="#Kids" data-toggle="tab">Daily</a></li>
					<li><a href="#Decoration" data-toggle="tab">Decoration</a></li>
				</ul><!-- /.nav-tabs -->
			</div>

			<div class="tab-content outer-top-xs">
				<div class="tab-pane in active" id="all">
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
<?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret))
{
	# code...


?>


<div class="item item-carousel" style="box-shadow: 0px 15px 15px rgba(0, 0, 0, 0.2);">
    <div class="products" style="box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); padding: 10px; border-radius: 5px;">
       

	<div class="product">
		<div class="product-image" style="width: 100%;">
			<div class="image" style="width: 98%;">
				<a style="width: 100%;" href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img style="width: 90%;" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div><!-- /.image -->


		</div><!-- /.product-image -->


		<div class="product-info text-left">
		<h4 class="name" style="font-size: 10px;">
   		 <a style="font-size: 10px;" href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
        <?php echo htmlentities($row['productName']);?>
   		 </a>
		</h4>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">
			<span class="price">₱ <?php echo number_format($row['productPrice'], 2); ?></span>
<span class="price-before-discount">₱ <?php echo number_format($row['productPriceBeforeDiscount'], 2); ?></span>


			</div><!-- /.product-price -->

		</div><!-- /.product-info -->
		<?php if($row['productAvailability']=='In Stock'){?>
			<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>
				<?php } else {?>
						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
			</div><!-- /.product -->

			</div><!-- /.products -->
		</div><!-- /.item -->
	<?php } ?>

			</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div>




	<div class="tab-pane" id="Kids">
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		<?php
$ret=mysqli_query($con,"select * from products where category=8");
while ($row=mysqli_fetch_array($ret))
{
	# code...


?>


		<div class="item item-carousel">
			<div class="products">

	<div class="product">
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div><!-- /.image -->


		</div><!-- /.product-image -->


		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">
			<span class="price">₱ <?php echo number_format($row['productPrice'], 2); ?></span>
<span class="price-before-discount">₱ <?php echo number_format($row['productPriceBeforeDiscount'], 2); ?></span>


			</div><!-- /.product-price -->

		</div><!-- /.product-info -->
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>

						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
			</div><!-- /.product -->

			</div><!-- /.products -->
		</div><!-- /.item -->
	<?php } ?>


								</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div>






		<div class="tab-pane" id="Decoration">
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		<?php
$ret=mysqli_query($con,"select * from products where category=13");
while ($row=mysqli_fetch_array($ret))
{
?>


		<div class="item item-carousel">
			<div class="products">

	<div class="product">
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div>


		</div>


		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">
			<span class="price">₱ <?php echo number_format($row['productPrice'], 2); ?></span>
<span class="price-before-discount">₱ <?php echo number_format($row['productPriceBeforeDiscount'], 2); ?></span>


			</div>

		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>

				<?php } else {?>
						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
			</div>

			</div>
		</div>
	<?php } ?>


								</div>
					</div>
				</div>
			</div>
		</div>


         <!-- ============================================== TABS ============================================== -->
			<div class="sections prod-slider-small outer-top-small">
				<div class="row">
					<div class="col-md-6">
	                   <section class="section">
	                   	<h3 class="section-title">Personal Care</h3>
	                   	<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">

<?php
$ret=mysqli_query($con,"select * from products where category=20 and subCategory=22");
while ($row=mysqli_fetch_array($ret))
{
?>



		<div class="item item-carousel">
			<div class="products">

	<div class="product">
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300"></a>
			</div><!-- /.image -->
		</div><!-- /.product-image -->


		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">
			<span class="price">₱ <?php echo number_format($row['productPrice'], 2); ?></span>
<span class="price-before-discount">₱ <?php echo number_format($row['productPriceBeforeDiscount'], 2); ?></span>


			</div>

		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>

				<?php } else {?>
						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
			</div>
			</div>
		</div>
<?php }?>


			                   	</div>
	                   </section>
					</div>
					<div class="col-md-6">
						<section class="section">
							<h3 class="section-title">Kids</h3>
		                   	<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="8">
	<?php
$ret=mysqli_query($con,"select * from products where category=8 and subCategory=15");
while ($row=mysqli_fetch_array($ret))
{
?>



		<div class="item item-carousel">
			<div class="products">

	<div class="product">
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="300" height="300"></a>
			</div><!-- /.image -->
		</div><!-- /.product-image -->


		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">
			<span class="price">₱ <?php echo number_format($row['productPrice'], 2); ?></span>
<span class="price-before-discount">₱ <?php echo number_format($row['productPriceBeforeDiscount'], 2); ?></span>


			</div>

		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>

				<?php } else {?>
						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
			</div>
			</div>
		</div>
<?php }?>



				                   	</div>
	                   </section>

					</div>
				</div>
			</div>
		<!-- ============================================== TABS : END ============================================== -->



	<section class="section featured-product inner-xs wow fadeInUp">
		<h3 class="section-title">Appliances</h3>
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
			<?php
$ret=mysqli_query($con,"select * from products where category=9");
while ($row=mysqli_fetch_array($ret))
{
	# code...


?>
				<div class="item">
					<div class="products">




												<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-6">
										<div class="product-image">
											<div class="image">
												<a href="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													<div class="zoom-overlay"></div>
												</a>
											</div><!-- /.image -->

										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col col-xs-6">
										<div class="product-info">
											<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
											<div class="rating rateit-small"></div>
											<div class="product-price">
											<span class="price">
    ₱ <?php echo number_format($row['productPrice'], 2); ?>
</span>


											</div><!-- /.product-price -->
										<?php if($row['productAvailability']=='In Stock'){?>
											<div class="action">
    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</a>
</div>

				<?php } else {?>
						<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
										</div>
									</div><!-- /.col -->
								</div><!-- /.product-micro-row -->
							</div><!-- /.product-micro -->
						</div>


											</div>
				</div><?php } ?>
							</div>
		</section>
		

<?php include('includes/brands-slider.php');?>


</div>
</div>
<div>
	
</div>
<?php include('includes/semi-footer.php');?>
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
	<!-- For demo purposes – can be removed on production : End -->



</body>
</html>
