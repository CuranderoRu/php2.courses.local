<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/shop.php";

$item_id = $_GET['item_id'];
$quantity = $_POST['quantity'];
addToCart($item_id, $quantity);

?>
