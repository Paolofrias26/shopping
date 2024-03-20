<?php 
// Include the Twilio PHP library
require_once 'vendor/autoload.php';

// Twilio API credentials
$account_sid = 'ACa748f438558aba174105f4f51960f7f9';
$auth_token = '3871b7428a50e3f79c5b45370db34020';
$twilio_phone_number = '+15168304506';

session_start();
error_reporting(0);
include('includes/config.php');

// Check if the Resend OTP button was clicked
if (isset($_POST['resendOTP'])) {
    // Generate a new OTP
    $otp = rand(1000, 9999);
    $_SESSION['registration_otp'] = $otp;
    $_SESSION['registration_contactno'] = $contactno;
    // Send the OTP via SMS using Twilio
    $twilio = new Twilio\Rest\Client($account_sid, $auth_token);
    $recipient_phone_number = $contactno;
    $message = $twilio->messages->create(
        $recipient_phone_number,
        array(
            'from' => $twilio_phone_number,
            'body' => "Hello, Your OTP is: $otp"
        )
    );

    // Display a message indicating that the OTP has been resent
    echo "<script>alert('OTP has been resent');</script>";
}

// Redirect back to verify_otp.php
header("Location: verify_otp.php");
exit;
?>
