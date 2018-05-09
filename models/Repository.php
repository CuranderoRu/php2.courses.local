<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 20:38
 */

namespace app\models;

use app\base\App;
use app\services\Db;

abstract class Repository
{

    /** @var  Db */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = App::call()->db;
    }

    public function getByID($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, [':id' => $id], $this->getEntityClass());
    }

    public function getAll($filter = [])
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        if (count($filter)>0){
            $sql .= " WHERE 1=1 ";
            foreach ($filter as $key => $value) {
                $key = str_replace(':','', $key);
                $sql .= "AND {$key} = :{$key}";
            }
        }
        return $this->db->queryObjects($sql, $filter , $this->getEntityClass());
    }



    public function delete(DataEntity $entity)
    {
        if(is_null($entity->getId())){
            return false;
        }else{
            $tableName = $this->getTableName();
            $sql = "DELETE FROM {$tableName} WHERE id = :id";
            $this->db->execute($sql, [':id'=>$entity->getId()]);
            $entity->setId(null);
            return true;
        }
    }

    public function getStructure(DataEntity $entity){
        $tableName = $this->getTableName();
        $sql = "SHOW COLUMNS FROM {$tableName}";
        $arr = array();
        foreach ($this->db->selectAll($sql) as $key => $value) {
            if ($value['Field']=='id'){
                continue;
            }
            $arr[':' . $value['Field']] = $value['Field'];
        }
        return $arr;
    }

    public function save(DataEntity $entity){
        $modify_indicator = $this->isExists($entity);
        $params = $this->getStructure($entity);
        $tableName = $this->getTableName();
        foreach ($entity as $key => $value) {
            if (is_null($params[":{$key}"])){
                continue;
            }
            $params[":{$key}"] = $value;
        }
        unset($value);
        if (!$modify_indicator){
            $placeholders = implode(", ", array_keys($params));
            $columns = "`" . implode("`, `", array_keys($params)) . "`";
            $columns = str_replace(':',"", $columns);
            $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        }else{
            $sql = "UPDATE {$tableName} SET ";
            foreach ($params as $key => $value) {
                $key = str_replace(':','', $key);
                $sql .= "`{$key}` = :{$key}, ";
            }
            $sql = substr($sql,0, strlen($sql)-2);
            $sql .= " WHERE id = :id";
            $params[':id'] = $entity->getId();
        }
        $this->db->execute($sql, $params);

        if (!$modify_indicator){
            $entity->setId($this->db->lastInsertId());
        }
        return true;
    }

    protected function isExists(DataEntity $entity){
        echo '<h3>isExists </h3>';
        $tableName = $this->getTableName();
        $res = $this->db->selectOne("SELECT id FROM {$tableName} WHERE id = :id", [':id' => $entity->getId()]);
        if (is_null($res)){
            return false;
        }else{
            return true;
        }

    }

    abstract public function getTableName();

    abstract public function getEntityClass();

}