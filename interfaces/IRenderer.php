<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 19:26
 */

namespace app\interfaces;


interface IRenderer
{
    public function render($template, $params = []);
}