<?php
namespace app\models;
use app\services\Db;
use app\interfaces\IModel;
abstract class Model implements IModel
{
    protected $db;
    protected $id;

    private function getConnected(){
        if(is_null($this->db)){
            $this->db = new Db();
        }
    }

    public function getOne($id)
    {
        $this->getConnected();
        $id = $this->db->checkParam($id);
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->db->selectOne($sql);
    }

    public function getAll()
    {
        $this->getConnected();
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->selectAll($sql);
    }

    public function getId()
    {
        return $this->id;
    }

    public function initialize($params){
        $this->obtainParams($params['id'], $params);
    }


}