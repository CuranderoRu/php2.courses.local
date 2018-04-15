<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/shop.php";

$id = $_GET['item_id'];
displayItem($id);

?>
