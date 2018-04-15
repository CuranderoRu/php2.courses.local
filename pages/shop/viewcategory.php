<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/shop.php";
$category = $_GET['category_id'];
displayShop($category);

?>
