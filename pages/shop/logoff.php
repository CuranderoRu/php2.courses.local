<?php
require_once ENGINE_DIR . "/user.php";

closeSession();
header('Location: http://'.$_SERVER['HTTP_HOST'].'/shop/index.php');

?>
