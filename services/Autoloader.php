<?php
namespace app\services;

class Autoloader
{
    private $paths = [
        'models',
        'services'
    ];

    public function __construct()
    {
        define("ROOT_DIR", __DIR__ . "/..");
        define("PUBLIC_DIR", ROOT_DIR . "/public");
        define("PICS_DIR", ROOT_DIR . "/public/img");
        define("TUMBS_DIR", ROOT_DIR . "/public/img/tumbs");
        define("UPLOADS_DIR", ROOT_DIR . "/uploads");
        define("MYSQL_ADDRESS", "localhost");
        define("MYSQL_LOGIN", "root");
        define("MYSQL_PSW", "");
        define("MYSQL_DBNAME", "Megashop");
    }


    public function loadClass($className)
    {
        $filename = ROOT_DIR . "/{$className}.php";
        $filename = str_replace('\\','/',$filename);
        $filename = str_replace('app/','',$filename);
        //var_dump($filename);
        if(file_exists($filename)){
               include $filename;
        }
    }

    public function forceLoad($className)
    {
        include $className;
    }
}