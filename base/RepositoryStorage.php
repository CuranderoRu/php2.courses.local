<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 09.05.2018
 * Time: 23:31
 */

namespace app\base;


class RepositoryStorage
{
    protected $items;

    public function set($key, $object)
    {
        $this->items[$key] = $object;

    }

    public function get($key)
    {
        if (!isset($this->items[$key])){
            //хранилище не должно создавать объекты
            $this->items[$key] = App::call()->createRepository($key);
        }
        return $this->items[$key];
    }

}