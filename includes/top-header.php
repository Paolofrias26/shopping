<?php
//session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Unique Design</title>
    
      

       
</head>
<body>

<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="">
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <?php if(strlen($_SESSION['login'])) { ?>
                        <li><i class=""></i> Welcome <?php echo htmlentities($_SESSION['username']);?></li>
                    <?php } ?>

                    <li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
                    <li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                    <?php if(strlen($_SESSION['login'])==0) { ?>
                        <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
                    <?php } else { ?>
                        <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
                    <?php } ?>
                </ul>
            </div><!-- /.cnt-account -->

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small">
                        <a href="track-orders.php" class="dropdown-toggle"><span class="key">Track Order</span></a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->

</body>
</html>
