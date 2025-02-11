<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if($_GET['delid']){
$sid=$_GET['delid'];
mysqli_query($con,"delete from tbluser where ID ='$sid'");
echo "<script>alert('Data Deleted');</script>";
echo "<script>window.location.href='customer-list.php'</script>";
          }

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Villa Arcadia | Homeowners</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<script>
        function filterStatus() {
            var status = document.getElementById('statusFilter').value;
            window.location.href = 'customer-list.php?statusFilter=' + status;
        }
    </script>
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Homeowner's Member</h3>

                    <div class="text-right">
                        <a href="../signup.php" class="btn btn-secondary" style="background-color: blue; color: white;">
                            <i class="bi bi-plus-circle-fill"></i> Add New
                        </a>
                    </div>

                    <form action="" method="get" class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search by name or email">
                            <select class="form-control" name="statusFilter" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="Owner">Owner</option>
                                <option value="Renter">Renter</option>
                            </select>
                            <button type="button" class="btn btn-primary" onclick="filterStatus()">Filter</button>
                            <a href="mail.php?addid=<?php echo $row['ID']; ?>" class="btn btn-primary">Mail</a>
                        </div>
                    </form>

                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Homeowner's List:</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>RegistrationDate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : '';

                                $query = "SELECT * FROM tbluser";
                                if (!empty($statusFilter)) {
                                    $query .= " WHERE status = '$statusFilter'";
                                }

                                $ret = mysqli_query($con, $query);

                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt; ?></th>
                                        <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                                        <td><?php echo $row['MobileNumber']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['RegDate']; ?></td>
                                        <td>
                                            <a href="add-customer-services.php?addid=<?php echo $row['ID']; ?>" class="btn btn-primary">Bill</a>
                                            <a href="customer-list.php?delid=<?php echo $row['ID']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                    $cnt = $cnt + 1;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include_once('includes/footer.php'); ?>
        <!--//footer-->
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
</body>

</html>
<?php } ?>