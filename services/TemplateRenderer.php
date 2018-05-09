<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 19:12
 */

namespace app\services;


use app\base\App;
use app\interfaces\IRenderer;

class TemplateRenderer implements IRenderer
{
    public function render($template, $params = []){
        ob_start();
        extract($params);
        $templatePath = App::call()->config['templates_dir'] . DS . $template . ".php";
        include $templatePath;
        return ob_get_clean();
    }

}