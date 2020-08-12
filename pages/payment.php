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
if(isset($_GET['msg']) && ($_GET['msg']=="added")){
                ?>
                <script type='text/javascript'>alert("Payment Successfully Added");</script>
                <?php
            }
    include('../config/DbFunction.php');
    $obj=new DbFunction();
	$rs=$obj->showInvoices1();
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
    <title>Patient Invoices</title>
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
        <div style="background:#008CBA; " id="page-wrapper">
            <div class="row">
                <div style="background:#008CBA; color:white" class="col-lg-12">
                   <h4 class="page-header"> Invoices Info</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div style="background:#008CBA; color:white" class="panel-heading">
                            Select Invoice to be paid:
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
                                            <th>Invoice Date</th>
                                            <th>Service Description</th>
                                            <th>Amount Charged</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                         $sn=1;
                                     while($res=$rs->fetch_object()){
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlentities( strtoupper($res->id));?></td>
                                            <td><?php
                                             include_once('../config/config.php');
                                                 $pid = $res->patientID;
                                                 $q = "select firstname, lastname from patients where id = '$pid'";
                                                 $r = mysqli_query($db1, $q) or die("Cant get pid details from db");
                                                 $result = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                                 if($result>0){
                                                    $firstname = $result['firstname'];
                                                    $lastname = $result['lastname'];
                                                  }
                                                    echo htmlentities(strtoupper($firstname));?></td>
                                            <td><?php echo htmlentities( strtoupper($lastname));?></td>

                                            <td><?php echo htmlentities( strtoupper($res->invoiceDate));?></td>
                                            <td><?php echo htmlentities( strtoupper($res->serviceDescription));?></td>
                                            <td><?php echo "KSh " . htmlentities( strtoupper($res->amount));?></td>
                                            <td><?php
                                            if($res->paymentStatus){
                                                $ps = "PAID";
                                            }else $ps = "Not Paid";
                                            echo htmlentities(strtoupper($ps));

                                            ?></td>
                                             <td>&nbsp;&nbsp;
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              &nbsp;&nbsp;
                                             <a href="accept.php?did=<?php echo htmlentities($res->id); ?>&cid=<?php echo htmlentities($pid); ?>&amount=<?php echo htmlentities($res->amount); ?>&pid=<?php echo htmlentities($pid); ?>"> <p class="fa fa-plus-circle"></p>
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
