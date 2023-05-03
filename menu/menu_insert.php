<?php
 include "../config.php";
 $pid = $_POST["pid"];
 $name = $_POST["name"];
 $price = $_POST["price"];
 $image = $_FILES["myfile"]["name"];
 $image_type= $_FILES["myfile"]["type"];
 if($image<>"")
 $image_data = addslashes(file_get_contents($_FILES["myfile"]["tmp_name"]));
 else
 $image_data="";
 $conn = mysqli_connect($servername,$username,$password,$dbname);

 if(!$conn)
 { die("error".mysqli_connect_error()); }
 $sql = "INSERT INTO menu (pid,name,price,image,image_type,image_data)
         VALUES('$pid','$name','$price','$image','$image_type','$image_data')";
 if(mysqli_query($conn,$sql))
 
 $sql2 = "INSERT INTO products (pid,name,price,image)
VALUES('$pid','$name','$price','$image')";
if(mysqli_query($conn,$sql2))
 {
      header("Refresh:1;url=menu_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>
