<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 19:12
 */

namespace app\services;


use app\interfaces\IRenderer;

class TemplateRenderer implements IRenderer
{
    public function render($template, $params = []){
        ob_start();
        extract($params);
        $templatePath = TEMPLATES_DIR . DS . $template . ".php";
        include $templatePath;
        return ob_get_clean();
    }

}