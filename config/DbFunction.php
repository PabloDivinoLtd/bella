
<?php
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();
class DbFunction{
	function login($loginid,$password){
      if(!ctype_alpha($loginid) || !ctype_alpha($password)){
        echo "<script>alert('Either LoginId or Password is Missing')</script>";
      }		
   else{		
	$db = Database::getInstance();
	$mysqli = $db->getConnection();
	$query = "SELECT loginid, password FROM tbl_login where loginid=? and password=? ";
	$stmt= $mysqli->prepare($query);
	if(false===$stmt){
		trigger_error("Error in query: " . mysqli_connect_error(),E_USER_ERROR);
	}
	else{
		$stmt->bind_param('ss',$loginid,$password);
		$stmt->execute();
		$stmt -> bind_result($loginid,$password);
		$rs=$stmt->fetch();
		if(!$rs)
		{
			echo "<script>alert('Invalid Details')</script>";
			header('location:index.php?msg=fail');
		}
		else{
			header('location:admin-home.php');
		}
	}
	}
	}

function showSession(){
	$db = Database::getInstance();
	$mysqli = $db->getConnection();
	$query = "SELECT * FROM session  ";
	$stmt= $mysqli->query($query);
	return $stmt;
}

function addPatient($fname, $lname, $age, $gender, $mobno, $blood, $address){
    include_once('config.php');
    if($gender==""){
                echo "<script>alert('Gender cannot be empty')</script>";
    }
    else if($blood==""){
            echo "<script>alert('Blood Group cannot be empty')</script>";
    }
    else{
        $insert = "insert into patients (id, firstname, lastname, age, gender, phoneNumber, bloodGroup, address) values(0, '$fname', '$lname', '$age', '$gender', '$mobno', '$blood', '$address' ) ";
        mysqli_query($db1, $insert);
        //echo "<script>alert('Patient Added Successfully')</script>";
        header('location:../pages/admin-home.php?msg=registered');
    }
}
function showPatients(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM patients ";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function showPatientsBio(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM prints where status = 1 ";
    $stmt= $mysqli->query($query);
    return $stmt;
}

function showInvoices(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM invoices ";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function showInvoices1(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $stats = false;
    $query = "SELECT * FROM invoices where paymentStatus = '$stats'";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function showPayments(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $stats = false;
    $query = "SELECT * FROM payments";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function patientName($id){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "select * from patients where id = '$id'";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function delPatient($id){
    //  echo $id;exit;
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query="delete from patients where id=?";
        $stmt= $mysqli->prepare($query);
        $stmt->bind_param('s',$id);
    	$stmt->execute();
        echo "<script>alert('Patient Record has been deleted')</script>";
        echo "<script>window.location.href='viewpatients.php'</script>";
}
function addInsurer($name, $address){
    include_once('config.php');
    $add = "insert into insurers (id, insurerName, address) values (0, '$name', '$address') ";
    mysqli_query($db1, $add) or die("Could not add the insurer");
    header('location:../pages/addinsurer.php?msg=added');
}
function showInsurers(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM insurers ";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function delInsurer($id){
     //echo $id;exit;
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query="delete from insurers where id=?";
        $stmt= $mysqli->prepare($query);
        $stmt->bind_param('i',$id);
    	$stmt->execute();
        echo "<script>alert('Insurer has been deleted')</script>";
        echo "<script>window.location.href='viewinsurers.php'</script>";
}

function payment($invoiceId, $pid, $amount, $patId) {
$today = date('Y-m-d');
$invoice = $invoiceId;
$patient = $patId;
$policy = $pid;
$amount = $amount;
$paymentS = true;

$host = "localhost";
    $user  = "root";
    $password =  "";
    $database = "patients";
    $db1 = new mysqli($host, $user, $password, $database);
    if($db1->connect_errno > 0){
        die('Unable to connect to database' . $db1->connect_error);
    }else{
        //echo "Database is connected.";
    }
//Deduct balance from account
$query = mysqli_query($db1, "select balance from subscriptions where patientID = '$patient' and policyID = '$policy' ") or die();
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
if(($result>0)){
$accountBal = $result['balance'];
$newBal = $accountBal - $amount;
}
$insert = "insert into payments (id, patientID, policyID, amountPaid, date) values (0, '$patient', '$policy', '$amount', '$today') ";
mysqli_query($db1, $insert) or die("Could not insert payment");

$alter2 = mysqli_query($db1, " update subscriptions set balance = '$newBal' where patientID = '$patient' and policyID = '$policy' ") or die("Cant ");
$alter3 = mysqli_query($db1, " update invoices set paymentStatus = '$paymentS' where id ='$invoice' ") or die("Cant set initial fingerprint");
header('location:../pages/payment.php?msg=added');
//echo "<script>alert('Down here')</script>";
}

function initialpPrint($theeId){
    $id = $theeId;
    $defaultStatus = false;
    $host = "localhost";
    $user  = "root";
    $password =  "";
    $database = "patients";
    $db1 = new mysqli($host, $user, $password, $database);
    if($db1->connect_errno > 0){
        die('Unable to connect to database' . $db1->connect_error);
    }else{
        //echo "Database is connected.";
    }
    $loginQuery =mysqli_query($db1, "select * from prints where patientID = '$id'  ") or die("Could not fetch");
    $result = mysqli_fetch_array($loginQuery, MYSQLI_ASSOC);
    if($result>0){ //there is a record
        $theId = $result['id'];
        if( ($result['status']) == 0 ){ //there is a record, but the value is 0 at status. Dont write new record, update it
            echo "Updating: ";
            $alter = mysqli_query($db1, " update prints set patientID = '$id' where id ='$theId' ") or die("Cant set initial fingerprint");
            $alter1 = mysqli_query($db1, " update prints set status = '$defaultStatus' where id ='$theId' ") or die("Cant set initial fingerprint details with printID details");
            header('location:../pages/biometrics.php?msg=exist');
            break;
        }
        else if( ($result['status']) == 1 ){
        header('location:../pages/biometrics.php?msg=exists');
        break;
        }
    }
    else //No record at all
    echo "New Record: ";
    $insert = " insert into prints (id, patientID, printID, status) values (0, '$id', 0, '$defaultStatus') ";
    mysqli_query($db1, $insert) or die("Could not insert the record");
}
function addPolicy($name, $insurer, $description, $premium, $sum){
    include_once('config.php');
    $insert = "insert into insurancePolicy (id, policyName, insurerID, description, premiumAmount, sumInsured) values(0, '$name', '$insurer', '$description', '$premium', '$sum') ";
    mysqli_query($db1, $insert) or die("Could not insert policy");
    header('location:../pages/policies.php?msg=added');
}
function showPolicies(){
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM insurancePolicy ";
        $stmt= $mysqli->query($query);
        return $stmt;
}
function showPoliciesPerUser($theeId){
$p = $theeId;
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM subscriptions where patientID = '$p' ";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function delPolicy($id){
            //echo $id;exit;
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query="delete from insurancePolicy where id=?";
            $stmt= $mysqli->prepare($query);
            $stmt->bind_param('i',$id);
        	$stmt->execute();
            echo "<script>alert('Insurance Policy has been deleted')</script>";
            echo "<script>window.location.href='viewpolicies.php'</script>";
}
function addSubscription($patientID, $policyID){
    include('config.php');
    //First check if user is already enrolled for that insurance package
    $qq = "select * from subscriptions where patientID = '$patientID' and policyID = '$policyID'  ";
    $myquery = mysqli_query($db1, $qq) or die("Could'nt fetch policy ID");
    $myresult = mysqli_fetch_array($myquery, MYSQLI_ASSOC);
    if(($myresult>0) && ($myresult['balance'] >0)){
    //if registered, revoke
        header('location:../pages/viewsubscriptions.php?msg=exists');
    }
    //If not registered, insert new registration
    else
    $q = "select sumInsured from insurancePolicy where id = '$policyID' ";
    $myQuery = mysqli_query($db1, $q) or die("Could'nt fetch policy ID");
    $result = mysqli_fetch_array($myQuery, MYSQLI_ASSOC);
    $sumIns = $result['sumInsured'];
    $currentTime = date('Y-m-d');
    $insert = "insert into subscriptions (id, patientID, policyID, subscriptionDate, balance) values (0, '$patientID', '$policyID', '$currentTime', '$sumIns') ";
    mysqli_query($db1, $insert);
    header('location:../pages/viewsubscriptions.php?msg=added');
}
function showSubs(){
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "SELECT * FROM subscriptions ";
    $stmt= $mysqli->query($query);
    return $stmt;
}
function addInvoice($id, $amount, $description){
include_once('config.php');
    $today = date('Y-m-d');
    $defaultStatus = false;
    $insert = "insert into invoices (id, patientID, invoiceDate, amount, paymentStatus, serviceDescription) values (0, '$id', '$today', '$amount', '$defaultStatus', '$description') ";
    mysqli_query($db1, $insert) or die("Could not insert the record");
    //$alter = "update subscription set balance = '$newBalance' where id ='' ;
    header('location:../pages/addinvoice.php?msg=added');
}

function finalpPrint($userId){
    include_once('config.php');
    $qq = "select * from prints where patientID = '$userId' ";
        $myquery = mysqli_query($db1, $qq) or die("Could'nt fetch policy ID");
        $myresult = mysqli_fetch_array($myquery, MYSQLI_ASSOC);
        if(($myresult>0) && ($myresult['balance'] >0)){
        //if registered, revoke
            header('location:../pages/viewsubscriptions.php?msg=exists');
        }
        //If not registered, insert new registration
        else

    $newStatus = true;
    $alter = mysqli_query($db1, " update prints set printID = '$userId' where patientID ='$userId' ") or die("Cant set initial fingerprint details with printID details");
    $alter1 = mysqli_query($db1, "update prints set status = '$newStatus' where patientID ='$userId' ") or die("Cant set initial fingerprint details with status details");
    //echo "<script>alert('Successfully Registered Fingerprint')</script>";
    header('location:../pages/biometrics.php?msg=added');
}


//end of class
}

?>



