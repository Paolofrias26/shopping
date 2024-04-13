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

// Handle form submission for adding new admin
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Consider using more secure encryption methods
    $role = $_POST['role'];

    // Insert admin details into the database
    $query = "INSERT INTO admin (email, firstname, lastname, gender, username, password, role, creationDate) VALUES ('$email', '$firstname', '$lastname', '$gender', '$username', '$password', '$role', '$currentTime')";
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
    $_SESSION['msg'] = "Admin Account Deleted Successfully!";
    
    // Redirect back to the same page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Handle form submission for updating admin details
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update admin details in the database
    $query = "UPDATE admin SET email='$email', firstname='$firstname', lastname='$lastname', gender='$gender', username='$username', role='$role' WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['msg'] = "Admin updated successfully!";
    } else {
        $_SESSION['msg'] = "Failed to update admin. Please try again.";
    }

    // Redirect back to the same page after form submission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Handle edit action to populate form with admin data
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($con, "SELECT * FROM admin WHERE id='$edit_id'");
    $edit_row = mysqli_fetch_assoc($edit_query);
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
                                    <div class="module">
                                        <div class="module-head">
                                        <h3>
    <?php
    if(isset($_GET['edit'])) {
        echo "Update Admin";
    } else {
        echo '<a href="?add" >Add Admin</a>';
    }
    ?>
</h3>

                                        </div>
                                        <div class="module-body">
                                        <?php if(isset($_GET['edit']) || isset($_GET['add'])): ?>
                                            <br />
                                            
                                            <!-- Check if edit or add action is being performed -->
    <form class="form-horizontal row-fluid" name="AdminForm" method="post">
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input type="text" placeholder="Enter Email" name="email" class="span8 tip" required value="<?php if(isset($_GET['edit'])) { echo $edit_row['email']; } ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="firstname">First Name</label>
        <div class="controls">
            <input type="text" placeholder="Enter First Name" name="firstname" class="span8 tip" required value="<?php if(isset($_GET['edit'])) { echo $edit_row['firstname']; } ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lastname">Last Name</label>
        <div class="controls">
            <input type="text" placeholder="Enter Last Name" name="lastname" class="span8 tip" required value="<?php if(isset($_GET['edit'])) { echo $edit_row['lastname']; } ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="gender">Gender</label>
        <div class="controls">
            <select name="gender" class="span8 tip" required>
                <option value="">Select Gender</option>
                <option value="Male" <?php if(isset($_GET['edit']) && $edit_row['gender'] == 'Male') { echo "selected"; } ?>>Male</option>
                <option value="Female" <?php if(isset($_GET['edit']) && $edit_row['gender'] == 'Female') { echo "selected"; } ?>>Female</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls">
            <input type="text" placeholder="Enter Username" name="username" class="span8 tip" required value="<?php if(isset($_GET['edit'])) { echo $edit_row['username']; } ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
        <input type="password" placeholder="Enter Password" name="password" class="span8 tip" required <?php if(isset($_GET['edit'])) { echo 'value="' . $edit_row['password'] . '" disabled'; } ?>>

        </div>
    </div>
    <?php if(isset($_GET['edit'])): ?>
        <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
    <?php endif; ?>
    <hr>
    <div class="control-group">
        <label class="control-label" for="role">Role</label>
        <div class="controls">
            <select name="role" class="span8 tip" required>
                <option value="">Select Role</option>
                <option value="admin" <?php if(isset($_GET['edit']) && $edit_row['role'] == 'admin') { echo "selected"; } ?>>Admin</option>
                <option value="superadmin" <?php if(isset($_GET['edit']) && $edit_row['role'] == 'superadmin') { echo "selected"; } ?>>Super Admin</option>
            </select>
        </div>
    </div>
    <div class="control-group">
    <div class="controls">
        <button type="submit" name="<?php if(isset($_GET['edit'])) { echo "update"; } else { echo "submit"; } ?>" class="btn btn-primary"><?php if(isset($_GET['edit'])) { echo "Update"; } else { echo "Create"; } ?></button>
        <?php if(isset($_GET['edit'])): ?>
            <a href="adminchangepassword.php?id=<?php echo $edit_row['id']; ?>" class="btn btn-danger">Change Password</a>
        <?php endif; ?>
    </div>
</div>

    </div>
    </form>
<?php endif; ?>

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
