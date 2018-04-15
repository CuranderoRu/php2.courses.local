<?php
header('Content-Type: text/html;charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";

if(!$path = preg_replace(["#^/#", "#[?].*#"],"",$_SERVER['REQUEST_URI'])){
    $path = "shop/index.php";
}

$pageName =  PAGES_DIR . "/" .  $path;

if(file_exists(($pageName))){
    include $pageName;
}else{
    include PAGES_DIR . "/shop/index.php";
}
    
    