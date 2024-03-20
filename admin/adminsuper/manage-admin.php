<?php
session_start();
include('include/config.php');

// Redirect user to login page if not logged in
if (empty($_SESSION['alogin'])) {
    header('location:index.php');
    exit();
}

// Set timezone
date_default_timezone_set('Asia/Kolkata');
$currentTime = date('Y-m-d H:i:s');

// Handle form submission
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Consider using more secure encryption methods
    $role = $_POST['role'];

    // Insert admin details into the database
    $query = "INSERT INTO admin (firstname, lastname, gender, username, password, role, creationDate) VALUES ('$firstname', '$lastname', '$gender', '$username', '$password', '$role', '$currentTime')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['msg'] = "Admin added successfully!";
    } else {
        $_SESSION['msg'] = "Failed to add admin. Please try again.";
    }

    // Redirect back to the same page after form submission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Handle deletion of admin account
if (isset($_GET['del'])) {
    mysqli_query($con, "DELETE FROM admin WHERE id = '" . $_GET['del'] . "'");
    $_SESSION['delmsg'] = "Admin Account Deleted Successfully!";
    
    // Redirect back to the same page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Manage Users</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<style>
		.footer {
    /* Add appropriate styling */
    position: relative; /* or static, depending on your layout */
    clear: both; /* Clear floats */
	z-index: 1;
}
.module-body {
    z-index: 2;
}


	</style>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">
						

	<div class="">
							<div class="">
								<h3>Manage Admins</h3>
							</div>
							<div class="module-body table">
							<div class="content">

<div class="module">
	<div class="module-head">
		<h3>Add Admin</h3>
	</div>
	<div class="module-body">

	<?php if(isset($_SESSION['msg'])): ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Success!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
</div>
<?php unset($_SESSION['msg']); // Clear the message after displaying it ?>
<?php endif; ?>

			<br />
			<form class="form-horizontal row-fluid" name="AdminForm" method="post">
    <div class="control-group">
        <label class="control-label" for="firstname">First Name</label>
        <div class="controls">
            <input type="text" placeholder="Enter First Name" name="firstname" class="span8 tip" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lastname">Last Name</label>
        <div class="controls">
            <input type="text" placeholder="Enter Last Name" name="lastname" class="span8 tip" required>
        </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="gender">Gender</label>
    <div class="controls">
        <select name="gender" class="span8 tip" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
</div>
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls">
            <input type="text" placeholder="Enter Username" name="username" class="span8 tip" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="password" placeholder="Enter Password" name="password" class="span8 tip" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="role">Role</label>
        <div class="controls">
            <select name="role" class="span8 tip" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>
    </div>

<div class="control-group">
					<div class="controls">
						<button type="submit" name="submit" class="btn">Create</button>
					</div>
				</div>
			</form>
	</div>
</div>

<div class="module">
<div class="module-head">
		<h3>Admin List</h3>
	</div>
	<div class="module-body">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error" style="color: green">
										<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											
											<th> First Name</th>
											<th>Last Name </th>
											<th>Gender</th>
											<th>Username</th>
											<th>Role</th>
											<th>Action</th>
										
										</tr>
									</thead>
									<tbody>
    <?php
    $query = mysqli_query($con, "SELECT * FROM admin");
    $cnt = 1;
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <tr>
            
            <td><?php echo htmlentities($row['firstname']); ?></td>
            <td><?php echo htmlentities($row['lastname']); ?></td>
            <td> <?php echo htmlentities($row['gender']); ?></td>
            <td><?php echo htmlentities($row['username']);?></td>
            <td><?php echo htmlentities($row['role']); ?></td>
            <td>
                <!-- Modify the following line for the delete button -->
                <a href="?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
    <?php
        $cnt = $cnt + 1;
    }
    ?>
</tbody>				

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
</div>
</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
	
</body>
