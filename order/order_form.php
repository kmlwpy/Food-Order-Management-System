<?php
$module="sale";
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
  <?php 
  include "../config.php";
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {  die("Error ".mysqli_connect_error()); }
  $result = mysqli_query($conn,' 
    SELECT AUTO_INCREMENT
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = "project"
    AND TABLE_NAME = "sale_order"
  '); 
  $row = mysqli_fetch_array($result);
  $next_order_no = $row["AUTO_INCREMENT"];
  $next_order_no = str_pad((string)$next_order_no,10, "0", STR_PAD_LEFT); 
  $currentDate = date('Y-m-d');
  $today = date('H:i:s'); //เวลาตัว H ไม่ตรง
  ?>
  
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ORDER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">TAKE ORDER</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <form action="order_insert.php" method="post">

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Order Data</h3> 
                      </div>
                      
                      <div class="col-12">
                          <div class="card-header">
                            <button class="btn btn-primary" type="submit">  Save order  </button>
                            <a class="btn btn-secondary" href="order_list.php" role="button"> Cancel </a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label class="col-form-label"><?php echo "<h3>เลขที่ออเดอร์ ".$next_order_no."<h3>";?></label> 
                                                        <input class="form-control" type="hidden" name="order_no" value="<?php echo $next_order_no;?>"> 
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Date</label> 
                                                        <input class="form-control" type="date" name="order_date" value="<?php echo $currentDate;?>"></div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Time</label> 
                                                        <input class="form-control" type="time" name="order_time" value="<?php echo $today;?>"></div>
                          </div>
                         <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label class="col-form-label">table</label> 
                                                          <?php 
                                                                include "../config.php";
                                                                $con = mysqli_connect($servername,$username,$password,$dbname);
                                                                if(mysqli_connect_errno()) 
                                                                 { echo "Fail to connect to MySQL"; exit();
                                                                  }
                                                                 $result = mysqli_query($con," SELECT * FROM seat_table"); ?>
                                                          
                                                          <select required name="table_no" onchange="showTable(this.value)" class="form-control select2"  style="width: 100%;">
                                                          
                                                          <?php 
                                                                echo "<option value=''>Please select table</option>";
                                                                while($row = mysqli_fetch_array($result))
                                                                 {  
                                                                echo "<option value='".$row['table_no']."'>เลขที่โต๊ะ ".$row['table_no']."&nbsp; &nbsp; &nbsp; &nbsp;   จำนวน ".$row['seat']." ที่นั่ง</option>";
                                                                
                                                             } ?>
                                                        
                                                      </select>
                          </div>

                    </div>  <!-- class row -->

                   

                    </div> 
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
                </div>

            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
    </form>
  </div>
  <!-- /.content-wrapper -->
  <?php include "../comp/footer.php";  //ใส่ข้อมูล footer ในไฟล์ footer.php
 ?>

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
