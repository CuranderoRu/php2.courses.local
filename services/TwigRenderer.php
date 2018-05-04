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

    protected $twig;
    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => TWIG_CACHE_DIR,
            'auto_reload' => true
        ));

    }

    public function render($template, $params = [])
    {

        return $this->twig->render($template . '.html', $params);

    }
}