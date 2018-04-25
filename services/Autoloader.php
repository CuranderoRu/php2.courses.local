<?php
namespace app\services;

class Autoloader
{

    private $fileextension = ".php";

    public function loadClass($className)
    {
        $filename = str_replace(['\\', 'app/'],['/', ROOT_DIR . '/'],$className);
        $filename .= $this->fileextension;
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