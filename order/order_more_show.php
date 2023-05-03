<?php
$module="kitchen";
include "../users/checkmodule.php";
$_SESSION["item_session"] = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NK Restaurant</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php
  include "../comp/preloader.php";
  ?>

  <!-- Navbar -->
  <?php
  include "../comp/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
   include "../comp/aside.php";
  ?>
  


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SALE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">Quatation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <?php 
            $order_no=$_GET['order_no'];
            include "../config.php";
 
            $conn = mysqli_connect($servername,$username,
              $password,$dbname);
            if(!$conn)
            { die("error".mysqli_connect_error()); }
            $result = mysqli_query($conn," SELECT * FROM sale_order LEFT JOIN seat_table on sale_order.table_no=seat_table.table_no  WHERE sale_order.order_no='".$order_no."'"); 
            $row = mysqli_fetch_array($result);
    ?>
                        



    <form action="order_insert.php" method="post">

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">order Data</h3> 
                      </div>
                      
                      <div class="col-12">
                          <div class="card-header">
                            <a class="btn btn-secondary" href="order_more_list.php" role="button"> Cancel </a>
                            <a class="btn btn-primary" href="order_more_confirm.php?order_no=<?php echo $order_no;?>" role="button">ครัว Confirm เสิร์ฟอาหาร</a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                                        <div class="form-group">
                                                        <!-- <label class="col-form-label">order Number</label>  -->
                                                        <label class="col-form-label"><h3>เลขที่ออเดอร์ <?php echo $row["order_no"];?></h3></label> 
                                                        
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Date</label> 
                                                        <div><?php 
                                                        $newDate = date("d-m-Y", strtotime($row['order_date']));
                                                        echo $newDate;?>                                                       
                                                        </div> </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Time</label> 
                                                        <div><?php 
                                                        $today = date("H:i:s", strtotime($row['order_time']));
                                                        echo $today;?>                                                       
                                                        </div> </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Table</label> 
                                                        <div id="txtHint"><?php echo $row['table_no'];?></div>

                                                       
                                                        
                                                        
                          </div>
                         <div class="col-md-6">
                                                        
                          </div>
                    </div>  <!-- class row -->

                   

                    </div> 
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="card">
                    <div class="form-group">
                                                     
                                                          <?php 
                                                                
                                                                $sql2 = "SELECT * FROM orders_items INNER JOIN menu on orders_items.name=menu.name AND order_status='order_in'  WHERE orders_items.order_no='".$order_no."'";
                                                                //echo $sql2;exit();
                                                                $result2 = mysqli_query($conn,$sql2); 
                                                          
                                                               echo "<table class='table' border='1'>
                                                                <tr>
                                                                
                                                                <th>ชื่อเมนู</th>
                                                                <th style='text-align:right'>จำนวน</th>
                                                                <th style='text-align:right'>ราคา</th>
                                                                <th style='text-align:right'>ราคารวม</th>
                                                                
                                                                ";
                                                             $nettotal=0;
                                                             while($row2 = mysqli_fetch_array($result2))
                                                                 {  
                                                                  $total=  intval($row2['qty'])*intval($row2['price']);
                                                                  $nettotal+=$total;
                                                                echo "<tr><td>".$row2['name']."<td align='right'>".number_format($row2['qty'])."<td align='right'>".number_format($row2['price'])."<td align='right'>".number_format($total);
                                                                
                                                             } 
                                                             echo  "<tr><td colspan='3' align='right'>ราคารวมสุทธิ<td align='right'>".number_format($nettotal); 
                                                             echo "</table>";
                                                             ?>
                                                                                                           
                                                      
                                                      </div>
                                                      
                                                        
                                                        

                    </div>
                    </div>
                    </div>
                <!-- /.col -->
              </div>
                            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
    </form>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
