<title>NK Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@600&display=swap" rel="stylesheet">
<?php

include "../../config.php";  
$order_no=$_GET['order_no'];
include "../../config.php";
$conn = mysqli_connect($servername,$username,
    $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }
$result = mysqli_query($conn," SELECT * FROM sale_order INNER JOIN seat_table on sale_order.table_no=seat_table.table_no  WHERE sale_order.order_no='".$order_no."'"); 
$row = mysqli_fetch_array($result);
ob_start();
?>


<html align="center">
    <style>
body {
	height: 100%;
    font-family: 'Noto Sans Thai', sans-serif;
}

body {
	margin: 0;
	background: linear-gradient(45deg, lightblue, pink);
	font-family: sans-serif;
	font-weight: 100;
    font-family: 'Noto Sans Thai', sans-serif;
}

.container {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

table {
	width: 800px;
	border-collapse: collapse;
	overflow: hidden;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

th{
	padding: 15px;
	background-color: rgba(255,255,255,0.2);
	color:gray dark ;
    font-family: 'Noto Sans Thai', sans-serif;
}

td {
	padding: 15px;
	background-color: rgba(255,255,255,0.2);
	color:gray ;
    font-family: 'Noto Sans Thai', sans-serif;
}



thead {
	th {
		background-color: #55608f;
	}
}

tbody {
	tr {
		&:hover {
			background-color: rgba(255,255,255,0.3);
		}
	}
	td {
		position: relative;
		&:hover {
			&:before {
				content: "";
				position: absolute;
				left: 0;
				right: 0;
				top: -9999px;
				bottom: -9999px;
				background-color: rgba(255,255,255,0.2);
				z-index: -1;
			}
		}
	}
}
        </style>
    <body>
        <br><br><br>
   <h1 style="text-align: center;">รายการอาหาร</h1>
   <b>เลขที่ออเดอร์ <?php echo  $row['order_no'];?></b>&nbsp; &nbsp;&nbsp; &nbsp;
   <b>โต๊ะที่ <?php echo  $row['table_no'];?></b><br>
   <b>Date  <?php 
    $newDate = date("d-m-Y", strtotime($row['order_date']));
    echo $newDate;?></b> &nbsp; &nbsp;&nbsp; &nbsp;
    <b>Time <?php 
    $newDate = date("H:i:s", strtotime($row['order_time']));
    echo $newDate;?></b> 
 <br><br>                                
<?php 
    $sql2 = "SELECT * FROM orders_items INNER JOIN menu on orders_items.name=menu.name  WHERE orders_items.order_no='".$order_no."'";
    $result2 = mysqli_query($conn,$sql2); 

    echo '<table align="center">
    <tr>

    <th style="text-align:left;width:40%">รายการ</th>
    <th style="text-align:right;width:10%">จำนวน</th>
    <th style="text-align:right;width:20%">รวม</th>
    
    ';
  $nettotal=0;
  while($row2 = mysqli_fetch_array($result2))
      {  
      $total=  intval($row2['qty'])*intval($row2['price']);
      $nettotal+=$total;
    echo "<tr><td>".$row2['name']."<td align='right'>".number_format($row2['qty'])."<td align='right' >".number_format($total);
    
  }
  
  echo  "<tr ><th align='left' >ราคารวมทั้งหมด<th  colspan='2' align='right' >".number_format($nettotal); 
  echo "</table>";
  ?>
                                                      

</div>
</body>