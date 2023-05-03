<?php


$order_no=$_GET['order_no'];


include "../config.php";
$conn = mysqli_connect($servername,$username,
   $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }

$sql2 = "UPDATE orders_items SET order_status='serve' WHERE order_no='$order_no'";
if(mysqli_query($conn,$sql2))

 {
   //  echo "Update successfully";
     header("Refresh:0;url=order_more_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>