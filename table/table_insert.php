<?php
$module="admin";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
 $table_no = $_POST["table_no"];
 $seat = $_POST["seat"];
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }
 $sql = "INSERT INTO seat_table (seat,table_no)
         VALUES('$seat','$table_no')";
 if(mysqli_query($conn,$sql))
 {
      header("Refresh:1;url=table_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
