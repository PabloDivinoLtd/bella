<?php
session_start ();
include('../config/DbFunction.php');
	$theId = $_GET['cid'];
	$obj=new DbFunction();
    $rs=$obj->patientName($theId);
    $rs1=$obj->patientName($theId);

if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
if(isset($_GET['msg']) && ($_GET['msg']=="added")){
                ?>
                <script type='text/javascript'>alert("Policy Successfully Registered");</script>
                <?php
            }
  if(isset($_POST['submit'])){
	$obj=new DbFunction();
	$obj->addInvoice($theId, $_POST['amount'], $_POST['description']);
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
<title>Add Invoice</title>
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" >
	<div id="wrapper">

		<!-- Navigation -->
		<?php include('leftbar.php')?>;

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?> </h4>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Add Patient Subscription</div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">

						 	<div class="form-group">
                                 <div class="col-lg-4">
                                     <label>PATIENT NAME</label>
                                 </div>
                            <div class="col-lg-6">
                            <?php
                  			while($res=$rs->fetch_object()){?>
                            <input VALUE="<?php echo htmlentities($res->firstname)?>"  class="form-control">
                             <?php }?>
                             </div>
                             </div>
                             <br><br>

								<div class="form-group">
                                <div class="col-lg-4">
                                <label>Amount Charged </label>
                                </div>
                                <div class="col-lg-6">
                                <input name="amount" required="required" class="form-control">
                                </div>
                                </div>
                                <br><br>

                                <div class="form-group">
                                <div class="col-lg-4">
                                <label>Service Description </label>
                                </div>
                                <div class="col-lg-6">
                                <textarea name="description" required="required" class="form-control"> </textarea>
                                </div>
                                </div>
                                <br><br>

	<br>
	<div class="form-group">
											<div class="col-lg-4">

											</div>
											<div class="col-lg-6">
	<input type="submit" class="btn btn-primary" name="submit" value="Add Invoice"></button>
											</div>

										</div>
				</div>
					</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="../bower_components/jquery/dist/jquery.min.js"
		type="text/javascript"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"
		type="text/javascript"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../bower_components/metisMenu/dist/metisMenu.min.js"
		type="text/javascript"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>

	<script>
function coursefullAvail() {
	$("#loaderIcon").show();
jQuery.ajax({
url: "course_availability.php",
data:'cfull1='+$("#cfull").val(),
type: "POST",
success:function(data){
$("#course-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function courseAvailability() {
	$("#loaderIcon").show();
jQuery.ajax({
url: "course_availability.php",
data:'cshort1='+$("#cshort").val(),
type: "POST",
success:function(data){
$("#course-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script>
</form>
</body>

</html>
