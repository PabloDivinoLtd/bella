<?php
session_start ();
include('../config/DbFunction.php');
	$obje=new DbFunction();
	$theId = $_GET['cid'];
	$patId = $_GET['pid'];
	$theAmount = $_GET['amount'];
	$one; $two; $three; $four;
	$obj=new DbFunction();
    $rs=$obj->patientName($theId);
    $rs1=$obj->patientName($theId);
    $rse = $obje->showPoliciesPerUser($theId);

if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
    $comPort = "/dev/cu.usbmodemFD141";
    include_once('PhpSerial.php');
   // $serial = new phpSerial();
    $msg = '';
    if(isset($_POST['submit'])){

    }

  if(isset($_POST['submit'])){
       $path = "../Arduino/enroll.ino";
       $fp = fopen($path, "w");
       sleep(2);
       fwrite($fp, $theId);

       $serial = new phpSerial;
       $serial->deviceSet($comPort);
       $serial->confBaudRate(115200);
       $serial->confParity("none");
       $serial->confCharacterLength(8);
       $serial->confStopBits(1);
       $serial->deviceOpen();
       sleep(2); //arduino requires a 2 second delay in order to receive the message
       $serial->sendMessage($theId);
       fclose($fp);
       $serial->deviceClose();
}
	?>
	 <?php
                                    include_once('PhpSerial.php');
                                    $serial1 = new phpSerial();
                                    $pid;
                                    $statusText="Arduino Device Detected.... \n";
                                                                 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Accept Payment</title>
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
					<h4 class="page-header"> Biometric Payment </h4>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div  class="panel panel-default">
						<div style="background:#008CBA; color:white" class="panel-heading">Add Patient Payment</div>
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

                             <div class="form-group">
                                 <div class="col-lg-4">
                                    <label style=" color:black">INVOICE AMOUNT</label>
                                 </div>
                             <div class="col-lg-6">


                                    <input VALUE="<?php echo htmlentities($theAmount)?>"  class="form-control">

                              </div>
                              </div>
                              <br><br>

                             <div class="form-group">
                                  <div class="col-lg-4">
                                      <label style="color:black"> Select Insurance Cover <span id="" style="font-size:11px;color:Red">*</span>	</label>
                                  </div>
                                  <div class="col-lg-6">
                                     <select class="form-control" id="selec" name="policy"  required="required" >
                                        <option VALUE="">SELECT</option> <?php
                                           while($rese=$rse->fetch_object()){?>
                                        <option VALUE="<?php echo htmlentities($rese->id);?>" >
                                        <?php
                                         include_once('../config/config.php');
                                          $pid = $rese->policyID;
                                           $q = "select policyName from insurancePolicy where id = '$pid'";
                                           $r = mysqli_query($db1, $q) or die("Cant get pid details from db");
                                          $result = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                           if($result>0){
                                               $name = $result['policyName'];
                                           }
                                         echo htmlentities($name)?></option>
                                        <?php }
                                        ?>
                                        </div>
                                     </select>
                                         <span id="course-availability-status" style="font-size:12px;"></span>
                                  </div>
                             </div>
                             <br>
	<br>
	<div class="form-group">
			<div class="col-lg-4">
                </div>
                <div class="col-lg-6">
                    <input type="submit" id="firstB" class="btn btn-primary" name="submit" value="Verify Patient"></button>
                    <?php
                                        if(isset($_POST['submit'])){?>
                                                "<script> const b = document.getElementById("firstB"); b.disabled = true; </script>";
                                                "<script> const a = document.getElementById("selec"); a.disabled = true; </script>";
                                                <?php
                                        } ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          <input type="submit" id="secondB" class="btn btn-primary" name="complete" value="Complete Payment"></button>
                                          <?php
                                             if(isset($_POST['complete'])){
                                              $invoiceId = $_GET['cid'];
                                              $amount = $_GET['amount'];
                                              $obj->payment($invoiceId, $pid, $amount, $patId);
                                              //echo "Sending";
                                          } ?>
                </div>
			</div>
	</div>
	</div>
	</div>
						</div>
						<br><br><br>
						<div class="form-group">
                            <div class="col-lg-4">
                                <label >Biometric Payment Progress Status:</label>
                            </div>
                            <div class="col-lg-6">

                                <textarea style=" color:red" class="form-control" rows="15"  name="description">
                                Fingerprint Verification Progress...
<?php
if(isset($_POST['submit'])){
echo "Confirming Cutomer Balance...\n\n";
include_once('../config/config.php');
$mymy = $_POST['policy'];
$query = mysqli_query($db1, "select balance from subscriptions where id = '$mymy' ") or die();
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
if(($result>0)){ //there is a record
    if($result['balance'] >0){
        $bal = $result['balance'];
        $one = "Customer balance: Ksh." . $bal."\n\n" ;
        echo $one;
        if($bal > $theAmount){
            if($serial->deviceSet($comPort)){
                echo "Fingerprint Registration Status. Progress Initiated...\n\n";
                echo "Checking...\n\n";
                echo $statusText;
                echo "Waiting for Arduino fingerprint Verification. \n\n";
                echo "PRESS 'Complete Payment' BUTTON when you Authenticate Fingerprint";
             }else{
             echo "Failed.";
              }
            }
        }else  echo "Insufficient Balance to cover this invoice\n\n" ;
    } else echo "Insufficient Balance to cover this invoice\n\n" ;
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
