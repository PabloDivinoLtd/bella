<?php
session_start ();
include('../config/DbFunction.php');
	$obje=new DbFunction();
	$rse=$obje->showPolicies();
	$rs1e=$obje->showPolicies();
	$rse = $obje->showPolicies();

	$theId = $_GET['cid'];
	$obj=new DbFunction();
    $rs=$obj->patientName($theId);
    $rs1=$obj->patientName($theId);

if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
    $comPort = "/dev/cu.usbmodem35";
    include_once('PhpSerial.php');
   // $serial = new phpSerial();
    $msg = '';
  if(isset($_POST['submit'])){
       $serial = new phpSerial;
       $serial->deviceSet($comPort);
       $serial->confBaudRate(9600);
       $serial->confParity("none");
       $serial->confCharacterLength(8);
       $serial->confStopBits(1);
       $serial->deviceOpen();
       sleep(2); //arduino requires a 2 second delay in order to receive the message
       $serial->sendMessage($theId);
       $serial->deviceClose();
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
<title></title>
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

		<div style="background:#008CBA; color:white" id="page-wrapper">
			<div class="row">
				<div style="background:#008CBA; color:white" class="col-lg-12">
					<h4 class="page-header"> Fingerprint Registration </h4>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div  class="panel panel-default">
						<div style="background:#008CBA; color:white" class="panel-heading">Add Patient Subscription</div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">

						 	<div class="form-group">
                                 <div class="col-lg-4">
                                     <label style=" color:black">PATIENT NAME</label>
                                 </div>
                            <div class="col-lg-6">
                            <?php
                  			while($res=$rs->fetch_object()){?>
                            <input VALUE="<?php echo htmlentities($res->firstname)?>"  class="form-control">
                             <?php }?>
                             </div>
                             </div>
                             <br><br>

	<br>
	<div class="form-group">
			<div class="col-lg-4">
                </div>
                <div class="col-lg-6">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Fingerprint"></button>
                </div>
			</div>
	</div>
	</div>
	</div>
						</div>
						<br><br><br><br><br><br>
						<div class="form-group">
                            <div class="col-lg-4">
                                <label >Fingerprint Registration Progress Status:</label>
                            </div>
                            <div class="col-lg-6">
                            <?php
                                include_once('PhpSerial.php');
                                $serial1 = new phpSerial();
                                $statusText="Arduino Device Detected. Checking fingerprint Scanner... \n";
                                                            ?>
                                <textarea style=" color:red" class="form-control" rows="10"  name="description">
                                Fingerprint registration Progress... <?php
                                if(isset($_POST['submit'])){
                                    if($serial->deviceSet($comPort)){
                                        echo "Fingerprint Registration Status. Progress Initiated...\n\n";
                                        echo "Checking...\n\n";
                                        echo $statusText;
                                        echo "Please wait while we confirm...\n";
                                        $fingerprintScannerMessage = '';



                                    }else
                                    echo "Failed.";

                                }

                                ?>

                                </textarea>
                            </div>
                            </div>
                        </div>
                                                        	<br><br>
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
