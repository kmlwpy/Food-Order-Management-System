<?php
session_start();

$id = $_GET['m_no'];
$q = $_GET['q'];

Class MyStruct {
  public $id;
  public $q;
}
if(!isset($_SESSION["item_session"]))
  $_SESSION["item_session"] = "";
if($_SESSION["item_session"]=="")
{
 $cart = new MyStruct();
 $cart->id = $id;
 $cart->q = $q;
 $item_session[$id]=$cart;
 $_SESSION["item_session"]=$item_session;
 }
else
{  
 $item_session=$_SESSION["item_session"]; 
  if (isset($item_session[$id]->q)) { $old_q = $item_session[$id]->q; } else { $old_q=0;}
 $cart = new MyStruct();
 $cart->id = $id;
 $cart->q = $q+$old_q;
 $item_session[$id]=$cart;
 $_SESSION["item_session"]=$item_session;
}

if($id!=null)
{
include "../config.php";

$output = "";

$output .= "<table class='table' border='1'>
<tr>
<th>product no</th>
<th>product name</th>
<th style='text-align:right'>quantity</th>
<th style='text-align:right'>m_price</th>
<th style='text-align:right'>total</th>
";

if($_SESSION["item_session"]!= "")
{
$nettotal=0;
foreach ($item_session as &$data)
{
 $con = mysqli_connect($servername,$username,$password,$dbname);
 $key=$data->id;
 $sql =" SELECT * FROM menu WHERE m_no='$key'";
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);		 
 $output .= "<tr><td>".$row['m_no']; 
 $output .= "<td>".$row['m_name'];
 $output .= "<td align='right'>$data->q";
 $output .= "<td align='right'>".number_format($row['m_price']);
 $total=  intval($data->q)*intval($row['m_price']);
 $nettotal+=$total;
 $output .= "<td align='right'>".number_format($total);
}
$output .= "<tr><td colspan='4' align='right'>Net Total<td align='right'>".number_format($nettotal); 
$output .= "</table>";

}
 }

echo $output;

?>