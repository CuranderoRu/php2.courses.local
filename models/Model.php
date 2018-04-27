<?php
namespace app\models;
use app\services\Db;
use app\interfaces\IModel;
abstract class Model implements IModel
{
    protected $id;

    /** @var  Db */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function isInit(){
        return !is_null($this->id);
    }


    public static function getByID($id)
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //return $db->selectOne($sql, [':id' => $this->id]);
        return $db->queryObject($sql, [':id' => $id], get_called_class());
    }

    public static function getAll()
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
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
        $res = $this->db->execute($sql, $fieldsArray);
        $this->id = $this->db->lastInsertId();
    }

    protected function updateRecord($fieldsArray){
        echo 'updateRecord <br>';
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET ";
        foreach ($fieldsArray as $key => $value) {
            $key = str_replace(':', '', $key);

            $sql .= "{$key} = :{$key}, ";
        }
        $sql = substr($sql,0, strlen($sql)-2);
        $sql .= " WHERE id = :id";
        return $this->db->execute($sql, $fieldsArray);
    }

    protected function isExists(){
        $tableName = $this->getTableName();
        $res = $this->db->selectOne("SELECT id FROM {$tableName} WHERE id = :id", [':id', $this->id]);
        if (is_null($res)){
            return false;
        }else{
            return true;
        }

    }

}