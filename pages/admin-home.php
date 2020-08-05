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

<title>Add patient</title>

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
					<h4 style="color:white" class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
				</div>

        <div class="panel panel-default">
            <div style="background:#008CBA; color:white"  class="panel-heading">Personal Informations</div>
                <div  class="panel-body">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label>First Name<span id="" style="font-size:11px;color:red">*</span>	</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input class="form-control" name="fname" required="required">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input required="required" class="form-control" name="lname">
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label>Age</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input required="required" class="form-control" name="age" >
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="radio" name="gender" id="male" value="Male"> &nbsp; Male &nbsp;
                                        <input type="radio" name="gender" id="female" value="female"> &nbsp; Female &nbsp;
                                        <input type="radio" name="gender" id="other" value="other"> &nbsp; Other &nbsp;
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label>Blood Group<span id="" style="font-size:11px;color:red">*</span></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="blood"  id="income"required="required" >
                                            <option VALUE="">SELECT</option>
                                            <option VALUE="A">A</option>
                                            <option value="B">B</option>
                                            <option value="B+">B+</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <br><br>
                    </div>
                </div>
            </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div style="background:#008CBA; color:white" class="panel-heading">Contact Informations</div>
                                    <div class="panel-body">
                                        <div class="row">
                                    	    <div class="col-lg-12">
                                    			<div class="form-group">
                                    		        <div class="col-lg-2">
                                    			        <label>Mobile Number<span id="" style="font-size:11px;color:red">*</span>	</label>
                                    			    </div>
                                    			    <div class="col-lg-4">
                                    			        <input class="form-control" type="text" name="mobno" required="required" maxlength="10">
                                    			    </div>
                                    			    <div class="col-lg-2">
                                    			        <label>Address</label>
                                    			    </div>
                                    			    <div class="col-lg-4">
                                    			        <input required="required" class="form-control"  type="text" name="address">
                                    			    </div>
                                    			</div>
                                    			<br><br>


                                    			<div class="form-group">
                                                	<div class="col-lg-6"><br><br>
                                                		<input type="submit" class="btn btn-primary" name="submit" value="Add Patient"></button>
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
