<?php

// Include the Twilio PHP library
require_once 'vendor/autoload.php';

// Twilio API credentials
$account_sid = 'ACa748f438558aba174105f4f51960f7f9';
$auth_token = '47edc33f3969b45e62bd596a767486f0';
$twilio_phone_number = '++15168304506';

session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactno = $_POST['contactno'];
    $password = $_POST['password'];

    // Password validator
    if (strlen($password) < 7 || !preg_match('/[A-Z]/', $password)) {
        echo "<script>alert('Password must be at least 7 characters long and contain at least one capital letter');</script>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

		// Clear existing registration-related session variables
		session_unset();

        // Generate a random OTP
        $otp = rand(1000, 9999);
		// $otp = 1234;

        // Store the OTP in the session variable
        $_SESSION['registration_otp'] = $otp;

        // Store other user data in session variables
        $_SESSION['registration_name'] = $name;
        $_SESSION['registration_email'] = $email;
        $_SESSION['registration_contactno'] = $contactno;
        $_SESSION['registration_hashedpassword'] = $hashedPassword;

        // Initialize the Twilio client
        $twilio = new Twilio\Rest\Client($account_sid, $auth_token);

        // Recipient's phone number (the user's phone number)
        $recipient_phone_number = $contactno;

        // Send the OTP via SMS
        $message = $twilio->messages->create(
            $recipient_phone_number,
            array(
                'from' => $twilio_phone_number,
                'body' => "Hello! $name Your OTP is: $otp"
            )
        );

        // Redirect to the OTP verification page
        header("Location: verify_otp.php");
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

	    <title>Shopping Portal | Signi-in | Signup</title>

	    <!-- Bootstrap Core CSS -->
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

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/988logo.ico">

<script>
function valid() {
    var name = document.getElementById("fullname").value;
    var email = document.getElementById("email").value;
    var contactno = document.getElementById("contactno").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmpassword").value;

    // Check if required fields are empty
    if (name === "" || email === "" || contactno === "" || password === "" || confirmPassword === "") {
        alert("All fields are required");
        return false;
    }

    // Check if email is valid
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address");
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    return true;
}
</script>




	</head>
    <body class="cnt-home">



		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<!-- ============================================== TOP MENU : END ============================================== -->
	<!-- ============================================== NAVBAR ============================================== -->
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<img src="" alt="">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Authentication</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="sign-in-page inner-bottom-sm">
			<div class="row">
				<!-- Sign-in -->
<!-- <div class="col-md-6 col-sm-6 sign-in">
	<h4 class="">sign in</h4>
	<p class="">Hello, Welcome to your account.</p>
	<form class="register-form outer-top-xs" method="post">
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>


<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">create a new account</h4>
	<p class="text title-tag-line">Create your own Shopping account.</p>
	<form class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();">
    <div class="form-group">
        <label class="info-title" for="fullname">Full Name <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" id="fullname" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>">
    </div>

    <div class="form-group">
        <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
        <input type="email" class="form-control unicase-form-control text-input" id="email" onBlur="userAvailability()" name="emailid" value="<?php echo isset($_POST['emailid']) ? $_POST['emailid'] : ''; ?>">
        <span id="user-availability-status1" style="font-size:12px;"></span>
    </div>

    <div class="form-group">
        <label class="info-title" for="contactno">Contact No. <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" maxlength="14" value="+63">
    </div>


    <div class="form-group">
        <label class="info-title" for="password">Password. <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" id="password" name="password">
    </div>

    <div class="form-group">
        <label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword">
    </div>

    <div class="radio outer-xs">
        <a href="login.php" class="forgot-password pull-left">May Account na? Mag Sign in dito.</a>
    </div>

    <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Sign Up</button>
</form>

	<span class="checkout-subtitle outer-top-xs">Mag Sign Up Na! </span>
	<div class="checkbox">
	  	<label class="checkbox">
		  	Para Mapabilis ang Pag-Checkout.
		</label>
		<label class="checkbox">
		Para Mapadali ang Pagbili.
		</label>
		<label class="checkbox">
 		Basta Mag SignUp kana.
		</label>
	</div>
</div>
<!-- create a new account -->			</div><!-- /.row -->
		</div>
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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">

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
