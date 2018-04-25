<?php
namespace app\models;
use app\services\Db;
use app\interfaces\IModel;
abstract class Model implements IModel
{
    protected $id;

    public function getOne()
    {
        $db = Db::getInstance();
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $db->selectOne($sql, [':id' => $this->id]);
    }

    public function getAll()
    {
        $db = Db::getInstance();
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $db->selectAll($sql);
    }

    public function getId()
    {
        return $this->id;
    }

    public function delete()
    {
        if(is_null($this->id)){
            return false;
        }else{
            $db = Db::getInstance();
            $tableName = $this->getTableName();
            $sql = "DELETE FROM {$tableName} WHERE id = :id";
            $db->execute($sql, [':id'=>$this->id]);
            $this->id = null;
            return true;
        }
    }


    protected function createRecord($fieldsArray){
        echo 'createRecord <br>';
        $db = Db::getInstance();
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} (";
        foreach ($fieldsArray as $key => $value) {
            $key = str_replace(':', '', $key);
            $sql .= "{$key}, ";
        }
        $sql = substr($sql,0, strlen($sql)-2) . ") VALUES (";
        foreach ($fieldsArray as $key => $value) {
            $sql .= "{$key}, ";
        }
        $sql = substr($sql,0, strlen($sql)-2) . ");";
        $res = $db->execute($sql, $fieldsArray);
        $sql = "SELECT MAX(id) AS id FROM {$tableName}";
        $res = $db->selectOne($sql);
        $this->id = $res['id'];
    }

    protected function updateRecord($fieldsArray){
        echo 'updateRecord <br>';
        $db = Db::getInstance();
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET ";
        foreach ($fieldsArray as $key => $value) {
            $key = str_replace(':', '', $key);

            $sql .= "{$key} = :{$key}, ";
        }
        $sql = substr($sql,0, strlen($sql)-2);
        $sql .= " WHERE id = :id";
        return $db->execute($sql, $fieldsArray);
    }

    protected function isExists(){
        $res = $this->getOne();
        if (is_null($res)){
            return false;
        }else{
            return true;
        }

    }

}