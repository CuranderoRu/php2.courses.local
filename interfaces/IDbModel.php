<?php
namespace app\interfaces;
interface IDbModel
{
    public static function getAll();

    public static function getByID($id);

    public function save();

    public function delete();

}