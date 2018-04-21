<?php
namespace app\interfaces;
interface IModel
{
    public function getAll();

    public function getTableName();

    public static function getByID($id);

    public function initialize($params);

}