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
$result = mysqli_query($conn," SELECT * FROM sale_order INNER JOIN seat_table on sale_order.table_no=seat_table.table_no  WHERE sale_order.order_no='".$order_no."'"); 
$row = mysqli_fetch_array($result);
ob_start();
?>


<html>
   <h1 style="text-align: center;">ใบแจ้งค่าอาหาร</h1>
   <b>Order No.</b> <?php echo  $row['order_no'];?>&nbsp; &nbsp;&nbsp; &nbsp;
   <b>Table</b> <?php echo  $row['table_no'];?><br>
   <b>Date </b>  <?php 
    $newDate = date("d-m-Y", strtotime($row['order_date']));
    echo $newDate;?>&nbsp; &nbsp;&nbsp; &nbsp;
    <b>Time</b>  <?php 
    $newDate = date("H:i:s", strtotime($row['order_time']));
    echo $newDate;?>
 <br><br>                                
<?php 
    $sql2 = "SELECT * FROM orders_items INNER JOIN menu on orders_items.name=menu.name  WHERE order_status='serve'AND orders_items.order_no='".$order_no."'";
    $result2 = mysqli_query($conn,$sql2); 

    echo '<table>
    <tr>

    <th style="text-align:left;width:40%">product name</th>
    <th style="text-align:right;width:10%">quantity</th>
    <th style="text-align:right;width:20%">total</th>
    
    ';
  $nettotal=0;
  while($row2 = mysqli_fetch_array($result2))
      {  
      $total=  intval($row2['qty'])*intval($row2['price']);
      $nettotal+=$total;
    echo "<tr><td>".$row2['name']."<td align='right'>".number_format($row2['qty'])."<td align='right'>".number_format($total);
    
  }
  echo  "<tr ><th align='left' >Net Total<th  colspan='2' align='right'>".number_format($nettotal); 
  echo "</table>";
  ?>
                                                      

</div>
<hr width="100%"  size="20" >                                                   
                                                  
 
<?php
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output();


?>
</body>

</html>
