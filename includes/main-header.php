<?php

 if(isset($_Get['action'])){
	if (strlen($_SESSION['login']) == 0) {
        // Display alert for not signed in
        echo "<script>alert('You need to sign in first!')</script>";
        // Redirect to login page
        echo "<script type='text/javascript'>document.location ='login.php';</script>";
        exit; // Terminate script execution after redirection
    } else {
	
	}


 }
?>
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="index.php">

		<div>
			<img style="width: 50%; margin-bottom: 15px;" src="assets/images/988logo.png" alt="">
		</div>

	</a>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
<div class="search-area">
    <form name="search" method="post" action="search-result.php">
        <div class="control-group">

            <input class="search-field" placeholder="Search here..." name="product" required="required" />

            <button class="search-button" type="submit" name="search"></button>

        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					
					<span class="total-price">
						
						<span class="value">Cart Table</span>

					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count"><?php echo $_SESSION['cartItemCount']; ?></span></div>


		    </div>
		</a>
		<ul class="dropdown-menu">

		 <?php
 $ret = mysqli_query($con, "SELECT products.shippingCharge as shippingCharge, 
 products.productName as pname,
 products.id as proid,
 products.productImage1 as pimage,
 products.productPrice as pprice,
 addtocart.productId as pid,
 addtocart.quantity as quantity,
 addtocart.id as wid 
FROM addtocart 
JOIN products ON products.id = addtocart.productId 
WHERE addtocart.userId = '".$_SESSION['id']."'");

$totalprice = 0; // Initialize total price
$totalqunty = 0; // Initialize total quantity

if(mysqli_num_rows($ret) > 0) {
while($row = mysqli_fetch_array($ret)) {
// Calculate subtotal for each item and add to total price
$subtotal = $row['pprice'] * $row['quantity'] + $row['shippingCharge'];
$totalprice += $subtotal;
// Add quantity to total quantity
$totalqunty += $row['quantity'];

	?>


			<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="product-details.php?pid=<?php echo $row['id'];?>"><img  src="admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimage'];?>" width="35" height="50" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">

							<h3 class="name"><a href="product-details.php?pid=<?php echo $row['proid'];?>"><?php echo $row['pname']; ?></a></h3>
							<div class="price">₱<?php echo number_format(($row['pprice'] + $row['shippingCharge']), 2); ?>
 X <?php echo $row['quantity']; ?></div>
						</div>

					</div>
					<hr class="my-4" style="border-top: 1px solid #ccc;">

				</div><!-- /.cart-item -->

				<?php } ?>
				<div class="clearfix"></div>
			<hr>

			<div class="clearfix cart-total">
				<div class="pull-right">

				<span class='price'>₱<?php echo number_format($_SESSION['tp'] = $totalprice, 2); ?></span>


				</div>

				<div class="clearfix"></div>

				<a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
			</div><!-- /.cart-total-->


		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->
<?php } else { ?>
<div class="dropdown dropdown-cart">
<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-12">
							No products yet <?php if(strlen($_SESSION['login']))
		{   ?>
		 <?php echo htmlentities($_SESSION['username']);?>
					<?php } ?>.
						</div>


					</div>
				</div><!-- /.cart-item -->


			<hr>

			<div class="clearfix cart-total">

				<div class="clearfix"></div>

				<a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shopping</a>
			</div><!-- /.cart-total-->


		</li>
		




		
	
	</div>
	<?php }?>




<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div>
