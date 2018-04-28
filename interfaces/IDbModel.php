<?php
namespace app\interfaces;
interface IDbModel
{
    public static function getAll();

    public static function getByID($id);

    public static function getTableName();

    public function save();

    public function delete();

}