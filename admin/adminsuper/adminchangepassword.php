<?php
session_start();
include('include/config.php');

if (empty($_SESSION['alogin'])) {
    header('location:index.php');
    exit();
}

if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];
}

if (isset($_POST['changepass'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new password and confirm password match
    if ($new_password === $confirm_password) {
        // Hash the new password
        $new_password_hashed = md5($new_password);

        // Update the admin password in the database
        $query = "UPDATE admin SET password='$new_password_hashed' WHERE id='$admin_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['msg'] = "Password changed successfully!";
            header("Location: manage-admin.php?edit=".$admin_id);
        } else {
            $_SESSION['msg'] = "Failed to change password. Please try again.";
        }
    } else {
        $_SESSION['errmsg'] = "New password and confirm password do not match.";
        header("Location: ".$_SERVER['PHP_SELF']."?id=".$admin_id);
    }

    // Redirect back to the manage-admin.php page with the admin ID
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-6cf3tmQyM0+Mu5nLdgb0cmz9sBmUSwgJFFK1PjzvFvl8OtRnQrfWLvP+WOMXJKyF" crossorigin="anonymous">



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
</head>
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
                                <?php if(isset($_SESSION['msg'])): ?>
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Success!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                                                </div>
                                                
                                                <?php unset($_SESSION['msg']); // Clear the message after displaying it ?>
                                            <?php endif; ?>
                                <?php if(isset($_SESSION['errmsg'])): ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Error!</strong> <?php echo htmlentities($_SESSION['errmsg']); ?>
                                    </div>
                                    
                                    <?php unset($_SESSION['errmsg']); // Clear the error message after displaying it ?>
                                <?php endif; ?>
                                    <div class="module">
                                        <div class="module-head">
                                        <h3>
    <?php
    if(isset($_GET['edit'])) {
        echo "Update Admin";
    } else {
        echo '<a href="?id='.$_SESSION['alogin'].'" >Change Password</a>';
    }
    ?>
</h3>

                                        </div>
                                        <div class="module-body">
                                       
                                            <br />
                                            
                                            <!-- Check if edit or add action is being performed -->
                                            <form class="form-horizontal row-fluid" method="post">
    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
    </div>
    <button type="submit" name="changepass" class="btn btn-primary">Change Password</button>
</form>



                                        </div>
                                    </div>

                                    <div class="module">
                                        <div class="module-head">
                                            <h3>Admin List</h3>    
                            
                                        </div>
                                        <div class="module-body">
                                            <?php if(isset($_GET['del'])): ?>
                                                <div class="alert alert-error" style="color: green">
                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                                </div>
                                            <?php endif; ?>
                                            <br />
                                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Email</th>
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
                                                            <td><?php echo htmlentities($row['email']); ?></td>
                                                            <td><?php echo htmlentities($row['firstname']); ?></td>
                                                            <td><?php echo htmlentities($row['lastname']); ?></td>
                                                            <td><?php echo htmlentities($row['gender']); ?></td>
                                                            <td><?php echo htmlentities($row['username']);?></td>
                                                            <td><?php echo htmlentities($row['role']); ?></td>
                                                            <td style="display: flex; justify-content: space-between;">
    <a href="?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">
    <i style="color: red" class="icon-trash"></i> <!-- Bootstrap trash icon -->
    </a>
    <a href="?edit=<?php echo $row['id']; ?>">
 
        <i class="icon-edit"></i><!-- Bootstrap pencil icon -->
    </a>
</td>



                                                        </tr>
                                                    <?php
                                                        $cnt = $cnt + 1;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div><!--/.content-->
                                    </div><!--/.span9-->
                                </div>
                            </div><!--/.container-->
                        </div><!--/.wrapper-->
                    </div>
                </div>
            </div>
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
        });
    </script>
    
</body>
</html>
