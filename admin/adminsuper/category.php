<?php
session_start();
include('include/config.php');

if(strlen($_SESSION['alogin']) == 0) {    
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // Change according to timezone
    $currentTime = date('Y-m-d H:i:s'); // Current timestamp in the correct format for MySQL
    
    if(isset($_POST['submit'])) {
        $category = $_POST['category'];
        $description = $_POST['description'];
        
        // Inserting category
        $sql = mysqli_query($con, "INSERT INTO category (categoryName, categoryDescription) VALUES ('$category', '$description')");
        if($sql) {
            $_SESSION['msg'] = "Category Created !!";
            
            // Fetching admin email
			$admin_username = $_SESSION['alogin'];
			$admin_query = mysqli_query($con, "SELECT * FROM admin WHERE username = '$admin_username'");
			$admin_row = mysqli_fetch_assoc($admin_query);
			$admin_email = $admin_row['email'];
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$category_details = "Creating Category named . $category";
            
            // Logging admin action
            $action = "insert a category";
            
            // Inserting into admin logs
            $log_sql = mysqli_query($con, "INSERT INTO adminlogs (admin_email, action, timestamp,  IP_Address, details) VALUES ('$admin_email', '$action', '$currentTime' , '$ip_address', '$category_details')");
            
            
        } else {
            // Category insertion failed, handle the error
            $_SESSION['error'] = "Failed to create category!";
        }
    }

    if(isset($_GET['del'])) {
      
		// Fetching admin email
$admin_username = $_SESSION['alogin'];
$admin_query = mysqli_query($con, "SELECT * FROM admin WHERE username = '$admin_username'");
$admin_row = mysqli_fetch_assoc($admin_query);
$admin_email = $admin_row['email'];
$ip_address = $_SERVER['REMOTE_ADDR'];
  // Fetching category name
  $category_id = $_GET['id'];
  $category_query = mysqli_query($con, "SELECT * FROM category WHERE id = '$category_id'");
  $category_row = mysqli_fetch_assoc($category_query);
  $category_name = $category_row['categoryName'];
$category_details = "Deleting Category named : ".$category_name; // Provide appropriate details about the category being deleted

// Logging admin action
$action = "delete a category";

// Inserting into admin logs
$log_sql = mysqli_query($con, "INSERT INTO adminlogs (admin_email, action, timestamp, IP_Address, details) VALUES ('$admin_email', '$action', '$currentTime', '$ip_address', '$category_details')");

mysqli_query($con, "DELETE FROM category WHERE id = '".$_GET['id']."'");
$_SESSION['delmsg'] = "Category deleted !!";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Category</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Category</h3>
							</div>
							<div class="module-body">
							<?php 
    if(isset($_SESSION['msg'])) {
        echo '<script>alert("Category Updated !");</script>';
        unset($_SESSION['msg']); // Clear the session variable after displaying the alert
    }
    ?>

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="Category" method="post" >
									
<div class="control-group">
<label class="control-label" for="basicinput">Category Name</label>
<div class="controls">
<input type="text" placeholder="Enter category Name"  name="category" class="span8 tip" required>
</div>
</div>


<div class="control-group">
											<label class="control-label" for="basicinput">Description</label>
											<div class="controls">
												<textarea class="span8" name="description" rows="5"></textarea>
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
								<h3>Manage Categories</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Category</th>
											<th>Description</th>
											<th>Creation date</th>
											<th>Last Updated</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from category");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td><?php echo htmlentities($row['categoryDescription']);?></td>
											<td> <?php echo htmlentities($row['creationDate']);?></td>
											<td><?php echo htmlentities($row['updationDate']);?></td>
											<td>
											<a href="edit-category.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
											<a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

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
<?php } ?>