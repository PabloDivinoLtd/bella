<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
if(isset($_GET['msg']) && ($_GET['msg']=="registered")){
                ?>
                <script type='text/javascript'>alert("Patient Successfully Registered");</script>
                <?php
            }

if(isset($_POST['submit'])){
	include('../config/DbFunction.php');
	$obj=new DbFunction();
	$obj->addPatient($_POST['fname'],$_POST['lname'],$_POST['age'],$_POST['gender'],$_POST['mobno'],$_POST['blood'],$_POST['address']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Reports</title>

<!-- Bootstrap Core CSS -->
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../bower_components/metisMenu/dist/metisMenu.min.css"
	rel="stylesheet">

<!-- Custom CSS -->
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body >
<form  method="post" >
	<div  id="wrapper">

<!-- Navigation -->
<?php include('leftbar.php')?>;
<!--nav-->
		<div style="background:#008CBA" id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h4 style="color:white" class="page-header"> <?php echo strtoupper("REPORTS");?></h4>
				</div>

        <div class="panel panel-default">
            <div style="background:#008CBA; color:white"  class="panel-heading">BASIC REPORTS</div>
                <div  class="panel-body">
                    <div class="row">
                            <div class="col-lg-6"><br>
                            <?php
                                include_once('../config/config.php');
                                $result1 = mysqli_query($db1, "select * from patients " );
                                $rows1 = mysqli_num_rows($result1);
                                ?>
                                  <a <input class="btn btn-primary" href = "viewpatients.php" > Total Registered Patients  <?php echo "(". $rows1 . ")"; ?>  </a>
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php
                                   include_once('../config/config.php');
                                      $result1 = mysqli_query($db1, "select * from prints where status = 1" );
                                      $rows2 = mysqli_num_rows($result1);
                                      ?>
                                   <a <input class="btn btn-primary" href = "registeredbio.php" > Fingerprint Registered Patients <?php echo "(". $rows2 . ")";  ?>
                                    </a>
                            </div>
                            <div class="col-lg-6"><br><br>
                            <br><br>
                    </div>
                </div>
            </div>

            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div style="background:#008CBA; color:white" class="panel-heading">Insurance Reports</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                	    <div class="col-lg-12">
                                                			<div class="form-group">
                                                            	<div class="col-lg-6"><br>
                                                            	<?php
                                                                    include_once('../config/config.php');
                                                                     $result1 = mysqli_query($db1, "select * from insurers " );
                                                                     $rows3 = mysqli_num_rows($result1);
                                                                     ?>
                                                            		<a <input class="btn btn-primary" href = "viewinsurers.php" > Total Insurers <?php echo "(". $rows3 . ")";  ?>
                                                                    </a>
                                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                          <?php
                                                                             include_once('../config/config.php');
                                                                             $result1 = mysqli_query($db1, "select * from insurancePolicy " );
                                                                             $rows2 = mysqli_num_rows($result1);
                                                                          ?>
                                                                    <a <input class="btn btn-primary" href = "viewpolicies.php" > Total Insurance Policies <?php echo "(". $rows2 . ")";  ?>
                                                                    </a>
                                                            	</div>
                                                            </div>


                                               			    <br><br>
                                              			</div>
                                                		<br><br>
                                                	</div>
            						            </div>
            				            	</div>
            				            </div>
            			            </div>
            		            </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div style="background:#008CBA; color:white" class="panel-heading">Invoice Reports</div>
                                    <div class="panel-body">
                                        <div class="row">
                                    	    <div class="col-lg-12">
                                    			<div class="form-group">
                                                	<div class="col-lg-6"><br>
                                                	<?php
                                                        include_once('../config/config.php');
                                                         $result1 = mysqli_query($db1, "select * from invoices " );
                                                         $rows3 = mysqli_num_rows($result1);
                                                         ?>
                                                		<a <input class="btn btn-primary" href = "viewinvoices.php" > Total Patient Invoices <?php echo "(". $rows3 . ")";  ?>
                                                        </a>
                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              <?php
                                                                 include_once('../config/config.php');
                                                                 $result1 = mysqli_query($db1, "select * from invoices where paymentStatus = 0 " );
                                                                 $rows2 = mysqli_num_rows($result1);
                                                              ?>
                                                        <a <input class="btn btn-primary" href = "payment.php" > Unpaid Patient Invoices <?php echo "(". $rows2 . ")";  ?>
                                                        </a>
                                                	</div>
                                                </div>


                                   			    <br><br>
                                  			</div>
                                    		<br><br>
                                    	</div>
						            </div>
				            	</div>
				            </div>
			            </div>
		            </div>
	    </div>

	<script src="../bower_components/jquery/dist/jquery.min.js"
		type="text/javascript"></script>
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"
		type="text/javascript"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../bower_components/metisMenu/dist/metisMenu.min.js"
		type="text/javascript"></script>
	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>
</form>
</body>
</html>
