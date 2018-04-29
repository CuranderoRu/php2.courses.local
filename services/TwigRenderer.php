<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 19:28
 */

namespace app\services;


use app\interfaces\IRenderer;

class TwigRenderer implements IRenderer
{

    public function render($template, $params = [])
    {

        $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR);
        $twig = new \Twig_Environment($loader, array(
            'cache' => TWIG_CACHE_DIR,
            'auto_reload' => true
        ));
        return $twig->render('itempage.html', $params);

    }
}