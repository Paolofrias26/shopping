<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Default background color for the navigation bar */
        .header-nav {
            background: blue;
        }

        /* Background color for the active link in the navigation bar */
        .cnt-home .header-nav .navbar-nav > li.active a {
            background: yellow;
            color: red; /* Add the text color for the active link */
        }
    </style>
</head>
<body>
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
    <ul class="nav navbar-nav" id="navList">
                                <li class="dropdown yamm-fw">
                                    <a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
                                </li>
                                <?php
                                $sql = mysqli_query($con, "select id,categoryName from category limit 6");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <li class="dropdown yamm-fw">
                                        <a href="category.php?cid=<?php echo $row['id']; ?>" onclick="setActiveLink(this);"><?php echo $row['categoryName']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div>
</div>


            </div>
        </div>
    </div>
</div>

<script>
        // JavaScript to set the active link based on the clicked anchor
        function setActiveLink(clickedLink) {
            // Remove 'active' class from all list items
            var listItems = document.querySelectorAll('#navList .dropdown');
            listItems.forEach(function(item) {
                item.classList.remove('active');
            });

            // Add 'active' class to the parent list item of the clicked link
            clickedLink.parentNode.classList.add('active');
        }
    </script>
</body>
</html>

