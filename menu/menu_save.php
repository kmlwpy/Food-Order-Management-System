<?php
 include "../config.php";
 $pid = $_POST["pid"];
 $name = $_POST["name"];
 $price = $_POST["price"];
 $old_pid = $_POST["old_pid"];
 $image = $_FILES["myfile"]["name"];
 $image_type= $_FILES["myfile"]["type"];
 if($image<>"")
 $image_data = addslashes(file_get_contents($_FILES["myfile"]["tmp_name"]));
 else
 $image_data="";

 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "  UPDATE menu SET pid='$pid',
            name='$name',price='$price'";
if($image<>"")
{ $sql = $sql.",image='$image',image_type='$image_type',image_data='$image_data'"; }
$sql = $sql. " WHERE pid='$old_pid'"; 

 if(mysqli_query($conn,$sql))
 $sql2 = "  UPDATE products SET pid='$pid',
 name='$name',price='$price'";
if($image<>"")
{ $sql = $sql.",image='$image',image_type='$image_type',image_data='$image_data'"; }
$sql = $sql. " WHERE pid='$old_pid'"; 

if(mysqli_query($conn,$sql2))

 {
   //  echo "Update successfully";
     header("Refresh:1;url=menu_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>