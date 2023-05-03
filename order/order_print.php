
<!DOCTYPE html>

<?php

 require_once('../vendor/autoload.php');


 $mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 16,
	'default_font' => 'sarabun']);

include "../config.php";  
$order_no=$_GET['order_no'];
include "../config.php";
$conn = mysqli_connect($servername,$username,
    $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }
$result = mysqli_query($conn," SELECT * FROM sale_order LEFT JOIN seat_table on sale_order.table_no=seat_table.table_no  WHERE sale_order.order_no='".$order_no."'"); 
$row = mysqli_fetch_array($result);
ob_start();
?>

<!-- qrcode -->
<h1 style="text-align: center;">แสกน QRCODE เพื่อสั่งอาหาร</h1>
<div style="text-align: center;">
<b>Order No.</b> <?php echo  $row['order_no'];?>&nbsp; &nbsp;&nbsp; &nbsp;
   <b>Table</b> <?php echo  $row['table_no'];?><br>
   <b>Date </b>  <?php 
    $newDate = date("d-m-Y", strtotime($row['order_date']));
    echo $newDate;?>&nbsp; &nbsp;&nbsp; &nbsp;
    <b>Time</b>  <?php 
    $newDate = date("H:i:s", strtotime($row['order_time']));
    echo $newDate;?></div>

    <br>
 <div style="text-align: center;">   
<b style="text-align: center;">สั่งอาหาร</b></div>
<div align="center">   
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://localhost/project/order/menuweb/4a-shop.php?order_no=<?php echo $order_no;?>" title="4a-shop.php?order_no=<?php echo $order_no;?>"/>
 </div><hr>
 <br><br>
 <div style="text-align: center;">
<b style="text-align: center;">เช็ครายการอาหาร</b> </div>
<div align="center">
    
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://localhost/project/order/menuweb/order_check.php?order_no=<?php echo $order_no;?>" title="4a-shop.php?order_no=<?php echo $order_no;?>"/>
</div>

<?php
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output();


?>
</body>
</html>
