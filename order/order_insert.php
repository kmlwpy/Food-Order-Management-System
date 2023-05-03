<?php
include "../config.php";

$order_no=$_POST['order_no'];
$table_no=$_POST['table_no'];
$order_date=$_POST['order_date'];
$order_time=$_POST['order_time'];

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()) 
{
    echo "Fail to connect to MySQL"; exit();
}

$sql= "INSERT INTO sale_order  (table_no,order_date,order_time,order_status) 
               VALUES ('$table_no','$order_date',
                        '$order_time','order_in')";
//echo $sql;exit();

if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

session_start();

Class MyStruct {
  public $id;
  public $q;
}
  
$item_session=$_SESSION["item_session"]; 
$output = "";


if($_SESSION["item_session"]!= "")
{
$nettotal=0;
foreach ($item_session as &$data)
{
echo $data->id."  ".$data->q."<br>";
$sql= "INSERT INTO sale_relations (order_no,m_no,qty)  
               VALUES ('$order_no','$data->id','$data->q')";
             echo $sql;
  
if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
} 
  mysqli_close($con);
  header( "location:order_list.php" );
?>