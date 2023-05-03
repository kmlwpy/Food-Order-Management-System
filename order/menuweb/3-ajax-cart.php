<?php
if (isset($_POST["req"])) {
  // (A) INIT SHOPPING CART
  session_start();
  if (!isset($_SESSION["cartI"])) {
    $_SESSION["cartI"] = []; // cart items
    $_SESSION["cartC"] = 0;  // total quantity
  }

  // (B) UPDATE CART COUNT
  function ccount () {
    $_SESSION["cartC"] = 0;
    if (count($_SESSION["cartI"])!=0) {
      foreach ($_SESSION["cartI"] as $id=>$qty) { $_SESSION["cartC"] += $qty; }
    }
  }

  // (C) STANDARD SYSTEM RESPONSE
  function respond ($status=1, $msg="OK") {
    echo json_encode(["status"=>$status, "msg"=>$msg, "count" => $_SESSION["cartC"]]);
  }

  // (D) CART ACTIONS
  switch ($_POST["req"]) {
    // (D1) GET COUNT
    case "count": respond(); break;

    // (D2) ADD / CHANGE QUANTITY / REMOVE
    // send id only to add item
    // send id and qty to set quantity
    // send id and 0 qty to remove item
    case "set":
      $max = 99; // max allowed quantity per item
      $item = &$_SESSION["cartI"][$_POST["id"]];
      if (isset($_POST["qty"])) { $item = $_POST["qty"]; }
      else { if (isset($item)) { $item++; } else { $item = 1; } }
      if ($item<=0) { unset($_SESSION["cartI"][$_POST["id"]]); }
      if ($item > $max) { $item = $max; }
      ccount(); respond(); break;

    // (D3) NUKE
    case "nuke":
      $_SESSION["cartI"] = [];
      $_SESSION["cartC"] = 0;
      respond(); break;

    // (D4) GET ALL ITEMS IN CART
    case "get":
      // (D4-1) CART IS EMPTY
      if ($_SESSION["cartC"]==0) { respond(1, null); break; }

      // (D4-2) GET ITEMS IN CART
      require "2-lib-cart.php";
      respond(1, $_CART->getProducts(true)); break;

    // (D5) CHECKOUT
    case "checkout":
      require "2-lib-cart.php";
      if ($_CART->checkout($_POST["name"], $_POST["email"])) { respond(); }
      else { respond(0, $_CART->error); }
      break;
  }
}