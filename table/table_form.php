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
  
  <?php 
  include "../config.php";
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {  die("Error ".mysqli_connect_error()); }
  $result = mysqli_query($conn,' 
    SELECT AUTO_INCREMENT
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = "project"
    AND TABLE_NAME = "seat_table"
  '); 
  $row = mysqli_fetch_array($result);
  $next_table_no = $row["AUTO_INCREMENT"];
  $next_table_no = str_pad((string)$next_table_no,2, "0", STR_PAD_LEFT); 
  $currentDate = date('Y-m-d');
  ?>
  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>เพิ่มโต๊ะ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">Seat Table Form</li>
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
                <h3 class="card-title">แบบฟอร์มเพิ่มโต๊ะใหม่</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="table_insert.php" method="post" onsubmit ="return validateForm()" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">เลขที่โต๊ะ</label> 
                      <label class="col-form-label"><?php echo "<h3>".$next_table_no."<h3>";?></label> 
                      <input class="form-control" type="hidden" name="table_no" value="<?php echo $next_table_no;?>"> 
                    </div>
                  </div>
                  <div class="col-md-8">  
                    <div class="form-group">
                      <label for="seat_table">จำนวนที่นั่ง</label>
                      <input required type="textbox" class="form-control" name="seat" id="seat" placeholder="enter seat">
                    </div>                    
                  </div>
                 
                                                                             
                      </div>
                    </div>               
                  </div>               
                <div class="card-footer">
                          <button type="submit" class="btn btn-primary">ยินยัน</button>
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

<script>
function validateForm() {
    //collect form data in JavaScript variables
    var pw1 = document.getElementById("user_password").value;
    var pw2 = document.getElementById("confirm_user_password").value;
    //check empty password field
    
    //minimum password length validation
    if(pw1.length < 8) {
      document.getElementById("message1").innerHTML = "**Password length must be atleast 8 characters";
      return false;
    } 
    if(pw1 != pw2) {
      document.getElementById("message2").innerHTML = "**Passwords are not same";
      return false;
    } 
 }
</script>


</body>
</html>
