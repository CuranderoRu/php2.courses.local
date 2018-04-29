<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 20:52
 */

namespace app\services;


use app\interfaces\IRenderer;

class Renderer implements IRenderer
{
    private $defaultRenderer = "app\services\TemplateRenderer";
    private $dependecies = [
        "itempage" => "app\services\TwigRenderer"
        ];

    public function render($template, $params = [])
    {
        /** @var IRenderer $currentRenderer */
        $currentRenderer = new $this->defaultRenderer();
        if(!is_null($this->dependecies[$template])){
            $currentRenderer = new $this->dependecies[$template];
        };
        return $currentRenderer->render($template, $params);
    }

}