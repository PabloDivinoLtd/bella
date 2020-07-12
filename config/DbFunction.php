
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
			header('location:login.php');
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
//end of class
}

?>



