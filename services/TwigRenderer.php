<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 19:28
 */

namespace app\services;


use app\base\App;
use app\interfaces\IRenderer;

class TwigRenderer implements IRenderer
{

    protected $twig;
    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(App::call()->config['templates_dir']);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => App::call()->config['twig_cache_dir'],
            'auto_reload' => true
        ));

    }

    public function render($template, $params = [])
    {

        return $this->twig->render($template . '.html', $params);

    }
}