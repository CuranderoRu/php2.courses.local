<?php
namespace app\models;
use app\services\Db;
use app\interfaces\IDbModel;
abstract class DbModel extends Model implements IDbModel
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

    public static function getByID($id)
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //return $db->selectOne($sql, [':id' => $this->id]);
        return $db->queryObject($sql, [':id' => $id], get_called_class());
    }

    public static function getAll($filter = [])
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        if (count($filter)>0){
            $sql .= " WHERE 1=1 ";
            foreach ($filter as $key => $value) {
                $key = str_replace(':','', $key);
                $sql .= "AND {$key} = :{$key}";
            }
        }
        return $db->queryObjects($sql, $filter ,get_called_class());
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

    public function getStructure(){
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

    public function save(){
        echo '<h3>save </h3>';
        $modify_indicator = $this->isExists();
        var_dump($modify_indicator);
        $params = $this->getStructure();
        $tableName = $this->getTableName();
        foreach ($this as $key => $value) {
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
            $params[':id'] = $this->id;
        }
        $this->db->execute($sql, $params);

        if (!$modify_indicator){
            $this->id = $this->db->lastInsertId();
        }
        return true;
    }

    protected function isExists(){
        echo '<h3>isExists </h3>';
        $tableName = $this->getTableName();
        $res = $this->db->selectOne("SELECT id FROM {$tableName} WHERE id = :id", [':id' => $this->id]);
        if (is_null($res)){
            return false;
        }else{
            return true;
        }

    }

}