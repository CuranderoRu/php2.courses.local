<?php
namespace app\interfaces;
interface IModel
{
    public function getAll();

    public function getTableName();

    public function save();

    public function delete();

}