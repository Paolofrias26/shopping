<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['verify'])) {
    $enteredOTP = $_POST['otp'];

    // Check if the entered OTP matches the stored OTP
    if ($enteredOTP == $_SESSION['registration_otp']) {
        // OTP is correct, you can proceed with user registration
        // Remove the OTP from the session to prevent reuse
        unset($_SESSION['registration_otp']);

        // Insert user data into the database (you can modify this as needed)
        $name = $_SESSION['registration_name'];
        $email = $_SESSION['registration_email'];
        $contactno = $_SESSION['registration_contactno'];
        $password = $_SESSION['registration_hashedpassword'];

        // Hash the password (if not already hashed)
        $hashedPassword = $password;

        // Insert the user into the database with the hashed password
        $query = mysqli_query($con, "INSERT INTO users(name, email, contactno, password) VALUES('$name', '$email', '$contactno', '$hashedPassword')");

        if($query) {
            // User is successfully registered
            echo "<script>alert('" . htmlspecialchars('Registration successful. You can now log in.') . "');</script>";
            // Redirect to the login page or any other desired page
            echo "<script>window.location.href = 'login.php';</script>";
            exit;
            
        } else {
            echo "<script>alert('Registration failed. Please try again later.');</script>";
        }
    } else {
        // Incorrect OTP, display an error message
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #777;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: calc(100% - 20px);
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 0 auto; /* Center the input horizontally */
            display: flex;
            align-items: center; /* Center the content vertically */
            text-align:center;
            justify-content: center; /* Center the content horizontally */
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 auto; /* Center the button */
            box-sizing: border-box; /* Ensure the button width is 100% without extra padding */
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (min-width: 768px) {
            /* Adjust styles for larger screens if needed */
            .container {
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <p>Please enter the OTP sent to your phone to complete the registration process.</p>
        <form method="post">
            <div class="form-group">
                <label for="otp">OTP:</label>
                <input type="text" id="otp" name="otp" placeholder="Enter 4 digit number here" required>
            </div>
            <button type="submit" name="verify">Verify OTP</button>
        </form>
    </div>
</body>
</html>
