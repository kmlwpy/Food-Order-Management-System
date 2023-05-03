<!DOCTYPE html>
<html>
  <head>
    <title>NK Restaurant</title>
    <meta charset="utf-8"  >
    <link rel="stylesheet" href="4a-shop.css">
    <script src="6b-cart.js"></script>
  </head>

  <body >
  <?php
              include "../../config.php";
              $order_no = $_GET["order_no"];
              $currentDate = date('d-m-Y');
              $conn = mysqli_connect($servername,$username,$password,$dbname);
              if(!$conn) { die("error".mysqli_connect_error());}
              $sql = "SELECT * FROM sale_order WHERE order_no='$order_no'";
              $result = mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($result);
              ?>
  <div class="form-group">
                            <label for="order_no"><?php echo "<h3>เลขที่ออเดอร์ ".$order_no."<h3>";?></label> 
                            
</div>


    <!-- (A) PRODUCTS + SHOPPING CART -->
    <div id="wrap"  >
      <!-- (A1) HEADER -->
      <div id="head" style="background-color:#E95C00; ">
        <div id="iCart" onclick="cart.show()">
          ดูตะกร้า <span id="cCart" >0</span>
        </div>
      </div>

<style>
    .btn {
        position: fixed;
        right: 40px;
        bottom: 20px;
        background-color: #fff;

        color: white;
        padding: 30px 0px;
        text-align: center;
        border-radius: 50%;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        padding: 0rem;
        height: 80px;
        -webkit-box-shadow: 0 30px 50px rgba(0,0,0,.2);
box-shadow: 0 30px 50px rgba(0,0,0,.2);
    }
</style>
<img class="btn" src="images/cart1.png" id="iCart"   onclick="cart.show()">
<!-- <input class="btn" id="iCart" value="ดูตะกร้า"  onclick="cart.show()"> -->

      <!-- (A2) PRODUCTS -->
      <div id="products"><?php
        require "2-lib-cart.php";
        $products = $_CART->getProducts();
        foreach ($products as $i=>$p) { ?>
        <div class="pCell">
          <img class="pImg"  src="images/<?=$p["image"]?>">
          <div class="pName"><?=$p["name"]?></div>
          <div class="pPrice">฿<?=$p["price"]?></div>
          <input class="pAdd button" style="background-color:#FFC77A;"  type="button" value="เพิ่มลงตะกร้า" onclick="cart.add(<?=$i?>)">
        </div>
        <?php } ?>
      </div>

      <!-- (A3) CART ITEMS -->
      <div id="wCart" style="background-color:#FFF; position: fixed;" >
        <span id="wCartClose" class="button" style="background-color:#E95C00;" onclick="cart.toggle(cart.hWCart, false)">&#8678;</span>
        <h2>รายการ</h2>
        <div id="cart"></div>
      </div>
    </div>

    <!-- (B) CHECKOUT FORM -->
    <div id="checkout"><form onsubmit="return cart.checkout()">
      <div id="coClose"  class="button" onclick="cart.toggle(cart.hCO, false)">X</div>
      <label>วันที่ใช้บริการ</label>
      <input type="text" id="coName" required value="<?php echo "$currentDate";?>">
      <label>เลขที่ออเดอร์</label>
      <input type="text" id="coEmail" required value="<?php echo "$order_no";?>">
      <input class="button" type="submit" style="background-color:#235D3A;" value="ยืนยัน">
    </form></div>
  </body>
</html>