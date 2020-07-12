<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
    include('../config/DbFunction.php');
    $obje=new DbFunction();
    $rse=$obje->showPolicies();
    $rs1e=$obje->showPolicies();
    $rse = $obje->showPolicies();

    $obj=new DbFunction();
	$rs=$obj->showSubs();

	if(isset($_GET['del']))
    {
          $obj->delSubs(intval($_GET['del']));
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

    <title>View Subscriptions</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
      <?php include('leftbar.php')?>;
      <nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Subscriptions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Patient ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>

                                            <th>Policy Cover ID</th>
                                            <th>Subscription Date</th>
                                            <th>Sum Insured</th>

                                            <th>Balance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     while($res=$rs->fetch_object() ){
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlentities( strtoupper($res->id));?></td>

                                            <td><?php echo htmlentities(strtoupper($res->patientID));?></td>

                                            <td><?php
                                            include('../config/config.php');
                                            $idd = $res->patientID;
                                             $q = "select firstname, lastname from patients where id = '$idd'";
                                             $r = mysqli_query($db1, $q) or die("Not fetching f and l");
                                             $result = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                             if($result>0){
                                             $firstname = $result['firstname'];
                                             $lastname = $result['lastname'];
                                             }
                                             echo htmlentities(strtoupper($firstname));?></td>
                                            <td><?php echo htmlentities(strtoupper($lastname));?></td>


                                            <td><?php
                                            $iddd = $res->policyID;
                                            $qq = "select policyName from insurancePolicy where id = '$iddd'";
                                            $rr = mysqli_query($db1, $qq) or die("Not fetching f and l");
                                            $rresult = mysqli_fetch_array($rr, MYSQLI_ASSOC);
                                            if($rresult>0){
                                            $policyname = $rresult['policyName'];

                                            }
                                            echo htmlentities(strtoupper($policyname));?></td>

                                            <td><?php echo htmlentities(strtoupper($res->subscriptionDate));?></td>
                                            <td><?php
                                            $iddd = $res->policyID;
                                            $qq = "select sumInsured from insurancePolicy where id = '$iddd'";
                                            $rr = mysqli_query($db1, $qq) or die("Not fetching f and l");
                                            $rresult = mysqli_fetch_array($rr, MYSQLI_ASSOC);
                                            if($rresult>0){
                                            $sum = $rresult['sumInsured'];
                                            }
                                            echo htmlentities(strtoupper($sum));?> </td>
                                            <td><?php echo htmlentities(strtoupper($res->balance));?></td>


                                            <td>&nbsp;&nbsp;<a href="edit-sub.php?sid=<?php echo htmlentities($res->id);?>"><p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             <a href="view-subject.php?del=<?php echo htmlentities($res->id); ?>"> <p class="fa fa-times-circle"></p></td>
                                        </tr>
                                    <?php }?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
