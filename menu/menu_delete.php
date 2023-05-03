<?php
$module="admin";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
 $pid = $_GET["pid"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM menu WHERE pid='$pid'";
 if(mysqli_query($conn,$sql))
 $sql = "DELETE FROM products WHERE pid='$pid'";
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=menu_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
