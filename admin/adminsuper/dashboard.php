
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin|  Dashboard</title>
    <link type="text/css" href="css/ds.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <!-- Montserrat Font -->
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
     
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				


      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">

        <div class="card">
    <div class="card-inner">
        <h3 class="cardtitle">Products</h3>
        <span class="material-icons-outlined">inventory_2</span>
    </div>
    <?php
        // Fetch products from the database
        $query = mysqli_query($con, "SELECT COUNT(*) AS totalProducts FROM products");

        // Check if the query is successful
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            $totalProducts = $result['totalProducts'];
        } else {
            $totalProducts = 0; // Set a default value if the query fails
        }
    ?>
    <a href="manage-products.php"><h1 class="totalall"><?php echo htmlentities($totalProducts);?></h1></a>
    
</div>

          <div class="card">
            <div class="card-inner">
            <h3 class="cardtitle">Categories</h3>
              <span class="material-icons-outlined">category</span>
            </div>
            <?php
        // Fetch products from the database
        $query = mysqli_query($con, "SELECT COUNT(*) AS totalCategory FROM category");

        // Check if the query is successful
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            $totalCategory = $result['totalCategory'];
        } else {
            $totalCategory = 0; // Set a default value if the query fails
        }
    ?>
    <a href="category.php"><h1 class="totalall"><?php echo htmlentities($totalCategory);?></h1></a>
          </div>

          <div class="card">
            <div class="card-inner">
            <h3 class="cardtitle">Users</h3>
              <span class="material-icons-outlined">groups</span>
            </div>
            <?php
        // Fetch products from the database
        $query = mysqli_query($con, "SELECT COUNT(*) AS totalusers FROM users");

        // Check if the query is successful
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            $totalusers = $result['totalusers'];
        } else {
            $totalusers = 0; // Set a default value if the query fails
        }
    ?>
    <a href="manage-users.php"><h1 class="totalall"><?php echo htmlentities($totalusers);?></h1></a>
          </div>

          <div class="card">
            <div class="card-inner">
            <h3 class="cardtitle">Total Sale</h3>
            <span class="material-icons-outlined">shopping_cart</span>
            </div>
            <?php
if ($query) {
  $st = 'Delivered';
  $totalSaleQuery = mysqli_query($con, "SELECT SUM(orders.quantity * products.productPrice + products.shippingCharge) AS totalSale FROM orders JOIN users ON orders.userId = users.id JOIN products ON products.id = orders.productId WHERE orders.orderStatus = '$st'");
  
  // Check if there are results
  if ($totalSaleQuery) {
      $totalSaleRow = mysqli_fetch_assoc($totalSaleQuery);
      $totalSale = $totalSaleRow['totalSale'];
      
      // Format the total sale as a decimal
      $totalSale = number_format($totalSale, 2); // 2 decimal places
  } else {
      $totalSale = 0; 
  }
} else {
  $totalSale = 0; 
}
?>


            <h1 class="totalall">₱<?php echo htmlentities($totalSale); ?></h1>
          </div>

        </div>
       
        <div class="charts-card">
    <h2 class="chart-title">Top 5 Products</h2>
    <div id="bar-chart"></div>
</div>

<?php
// Fetch top 5 products based on delivered orders
$topProductsQuery = mysqli_query($con, "SELECT products.productName, COUNT(orders.productId) AS orderCount FROM orders
    JOIN products ON orders.productId = products.id
    WHERE orders.orderStatus = 'Delivered'
    GROUP BY orders.productId
    ORDER BY orderCount DESC
    LIMIT 5");

// Check if the query is successful
if ($topProductsQuery) {
    $productLabels = [];
    $orderCounts = [];

    // Fetch data from the result set
    while ($row = mysqli_fetch_assoc($topProductsQuery)) {
        $productLabels[] = $row['productName'];
        $orderCounts[] = $row['orderCount'];
    }
} else {
    // Set default values if the query fails
    $productLabels = ['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5'];
    $orderCounts = [0, 0, 0, 0, 0];
}
?>




        

          <div class="charts-card">
            <h2 class="chart-title">Purchase and Sales Orders</h2>
            <div id="area-chart"></div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    

</div>  
<!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    
    <script type="text/javascript">
      // SIDEBAR TOGGLE

var sidebarOpen = false;
var sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

// ---------- CHARTS ----------

// BAR CHART
var barChartOptions = {
        series: [{
            data: <?php echo json_encode($orderCounts); ?>,
            name: 'Orders',
        }],
        chart: {
            type: 'bar',
            background: 'transparent',
            height: 350,
            toolbar: {
                show: false,
            },
        },
        colors: ['#2962ff', '#d50000', '#2e7d32', '#ff6d00', '#583cb3'],
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 4,
                horizontal: true,
                columnWidth: '40%',
            },
        },
        dataLabels: {
            enabled: false,
        },
        fill: {
            opacity: 1,
        },
        grid: {
            borderColor: '#55596e',
            yaxis: {
                lines: {
                    show: true,
                },
            },
            xaxis: {
                lines: {
                    show: true,
                },
            },
        },
        legend: {
            labels: {
                colors: '#f5f7ff',
            },
            show: true,
            position: 'top',
        },
        stroke: {
            colors: ['transparent'],
            show: true,
            width: 2,
        },
        tooltip: {
            shared: true,
            intersect: false,
            theme: 'dark',
        },
        xaxis: {
            categories: <?php echo json_encode($productLabels); ?>,
            title: {
                style: {
                    color: '#f5f7ff',
                },
            },
            axisBorder: {
                show: true,
                color: '#55596e',
            },
            axisTicks: {
                show: true,
                color: '#55596e',
            },
            labels: {
                style: {
                    colors: '#f5f7ff',
                },
            },
        },
        yaxis: {
            title: {
                text: 'Count',
                style: {
                    color: '#f5f7ff',
                },
            },
            axisBorder: {
                color: '#55596e',
                show: true,
            },
            axisTicks: {
                color: '#55596e',
                show: true,
            },
            labels: {
                style: {
                    colors: '#f5f7ff',
                },
            },
        },
    };

    var barChart = new ApexCharts(
        document.querySelector('#bar-chart'),
        barChartOptions
    );
    barChart.render();

// AREA CHART
var areaChartOptions = {
  series: [
    {
      name: 'Purchase Orders',
      data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
      name: 'Sales Orders',
      data: [11, 32, 45, 32, 34, 52, 41],
    },
  ],
  chart: {
    type: 'area',
    background: 'transparent',
    height: 350,
    stacked: false,
    toolbar: {
      show: false,
    },
  },
  colors: ['#00ab57', '#d50000'],
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
  dataLabels: {
    enabled: false,
  },
  fill: {
    gradient: {
      opacityFrom: 0.4,
      opacityTo: 0.1,
      shadeIntensity: 1,
      stops: [0, 100],
      type: 'vertical',
    },
    type: 'gradient',
  },
  grid: {
    borderColor: '#55596e',
    yaxis: {
      lines: {
        show: true,
      },
    },
    xaxis: {
      lines: {
        show: true,
      },
    },
  },
  legend: {
    labels: {
      colors: '#f5f7ff',
    },
    show: true,
    position: 'top',
  },
  markers: {
    size: 6,
    strokeColors: '#1b2635',
    strokeWidth: 3,
  },
  stroke: {
    curve: 'smooth',
  },
  xaxis: {
    axisBorder: {
      color: '#55596e',
      show: true,
    },
    axisTicks: {
      color: '#55596e',
      show: true,
    },
    labels: {
      offsetY: 5,
      style: {
        colors: '#f5f7ff',
      },
    },
  },
  yaxis: [
    {
      title: {
        text: 'Purchase Orders',
        style: {
          color: '#f5f7ff',
        },
      },
      labels: {
        style: {
          colors: ['#f5f7ff'],
        },
      },
    },
    {
      opposite: true,
      title: {
        text: 'Sales Orders',
        style: {
          color: '#f5f7ff',
        },
      },
      labels: {
        style: {
          colors: ['#f5f7ff'],
        },
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
    theme: 'dark',
  },
};

var areaChart = new ApexCharts(
  document.querySelector('#area-chart'),
  areaChartOptions
);
areaChart.render();

    </script>

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