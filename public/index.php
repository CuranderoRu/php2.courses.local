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
    
echo '<h2>Homework 1 ex 5 <br></h2>';

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
echo 'Статическая переменная определилась один раз при создании класса $a1, затем инкрементируется при каждом вызове. Поведение абсолютно нелогично (ожидаемо исключение или реинициализация переменной), но как есть. <br>';
echo '<h2>Homework 1 ex 6 <br></h2>';
class B {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class C extends B {
}
$a1 = new B();
$b1 = new C();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

echo 'В примере 6 классы разные, для каждого класса определяется своя статическая переменная. <br>';