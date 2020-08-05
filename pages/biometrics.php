<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
	header ( 'location:../index.php' );
}
if(isset($_GET['msg']) && ($_GET['msg']=="deleted")){
                ?>
                <script type='text/javascript'>alert("Patient Successfully Deleted");</script>
                <?php
            }
            if(isset($_GET['msg']) && ($_GET['msg']=="exists")){
                            ?>
                            <script type='text/javascript'>alert("Patient's Fingerprint is already enrolled!");</script>
                            <?php
                        }
    include('../config/DbFunction.php');
    $obj=new DbFunction();
	$rs=$obj->showPatients();
	if(isset($_GET['del']))
    {
        $obj->delPatient(intval($_GET['del']));
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
    <title>Enroll Fingerprint</title>
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
     <?php include('leftbar.php')?>;
        <nav>
        <div style="background:#008CBA" id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <h4 style="color:white" class="page-header"> Biometrics </h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div style="background:#008CBA; color:white" class="panel-heading">
                            Select Patient to Enroll Fingerprint
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Mobile</th>
                                            <th>Blood Group</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                         $sn=1;
                                     while($res=$rs->fetch_object()){?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlentities( strtoupper($res->id));?></td>
                                            <td><?php echo htmlentities( strtoupper($res->firstname));?></td>
                                            <td><?php echo htmlentities( strtoupper($res->lastname));?></td>
                                            <td><?php echo htmlentities( strtoupper($res->age))." "."Yrs";?></td>
                                            <td><?php echo htmlentities( strtoupper($res->gender));?></td>
                                            <td><?php echo htmlentities( strtoupper($res->phoneNumber));?></td>
                                            <td><?php echo htmlentities(strtoupper($res->bloodGroup));?></td>
                                            <td><?php echo htmlentities(strtoupper($res->address));?></td>
                                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             <a href="addfinger.php?cid=<?php echo htmlentities($res->id);?>"> <p class="fa fa-plus-circle"></p>
                                             </td>
                                        </tr>
                                    <?php $sn++;}?>
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
