<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/shop.php";

$item_id = $_GET['item_id'];
if(!isset($_POST['operation'])){
    displayCart();
    exit;
}
changeCart($item_id, $_POST['operation']);


?>
