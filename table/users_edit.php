<!DOCTYPE html>
<?php
$module="admin";
include "../users/checkmodule.php"
?>
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
          <h1>โต๊ะ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">Table Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">แก้ไขโต๊ะ</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              include "../config.php";
              $table_no = $_GET["table_no"];
              $conn = mysqli_connect($servername,$username,$password,$dbname);
              if(!$conn) { die("error".mysqli_connect_error());}
              $sql = "SELECT * FROM seat_table WHERE table_no='$table_no'";
              $result = mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($result);
              ?>
              <form action="table_save.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">                      
                        <div class="form-group">
                            <label for="table_no">เลขที่โต๊ะ</label>
                            <input type="textbox" disabled class="form-control" name="table_no" id="imput_table_no" placeholder="enter table_no" autofocus value='<?php echo $row["table_no"];?>'>
                            <input type="hidden"  name="old_table_no" value='<?php echo $row["table_no"];?>'>
                         </div>
                        <div class="form-group">
                          <label for="item_name">จำนวนที่นั่ง</label>
                          <input type="textbox" class="form-control" name="seat" id="seat" placeholder="enter seat" value='<?php echo $row["seat"];?>'>
                        </div>
                                                                       
                      </div>
                    </div>               
                  </div>               
                <div class="card-footer">
                          <button type="submit" class="btn btn-primary">ยืนยัน</button>
                </div>
             </form>
            </div>
         </div>
       </div>
      </div>
    </section>
  </div>
         
  <!-- /.content-wrapper -->
  <?php
  include "../comp/footer.php";
  ?>

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
    function PreviewImage()
    {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("exampleInputFile").files[0]);
      oFReader.onload = function(oFREvent){
        document.getElementById("uploadPreview").src=oFREvent.target.result;
      }
    }
     
</script>
</body>
</html>
