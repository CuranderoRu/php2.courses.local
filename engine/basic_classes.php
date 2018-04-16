<?php
class SQL{
    static $conn;
    public function __construct()
    {
        if($this->conn==null){
            $this->conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
        }
    }
    public function checkParam($param){
        return mysqli_real_escape_string($this->conn, $param);
    }
    public function executeSQL($stmt){
        return mysqli_query($this->conn, $stmt);
    }

    function selectAll($sql){
        $res = $this->executeSQL($sql);
        //var_dump($res);
        if(count($res)>0){
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }else{
            return [];
        }

    }

    function selectOne($sql){
        $res = $this->executeSQL($sql);
        //var_dump($res);
        return mysqli_fetch_array($res, MYSQLI_ASSOC);
    }


}


class Product{
    protected $id;
    protected $image_name;
    protected $name;
    protected $description;
    protected $price;
    protected $category;

    public static function getProductByID($id){
        $sql = new SQL();
        $id = $sql->checkParam($id);
        $params = $sql->selectOne("SELECT * FROM items WHERE id = {$id}");
        if (is_null($params['id'])){
            return null;
        }else{
            $p = new Product();
            $p->initializeProduct($params);
            return $p;
        }
    }

    public function initializeProduct($params){
        $this->obtainParams($params['id'], $params);
    }

    public function __construct($id=null)
    {
        $this->initialized = false;
        if (!is_null($id)){
            $this->id = $this->obtainParams($id);
        }
    }

    public function isInit(){
        return !is_null($this->id);
    }

    private function obtainParams($id, $params = null){
        if (is_null($params)){
            $sql = new SQL();
            $id = $sql->checkParam($id);
            $params = $sql->selectOne("SELECT * FROM items WHERE id = {$id}");
        }
        $this->id = $params['id'];
        $this->image_name = $params['image'];
        $this->name = $params['name'];
        $this->description = $params['comment'];
        $this->price = $params['price'];
        $this->category = $params['category'];
        return $params['id'];
    }

    /**
     * @param mixed $image_name
     */
    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    public function save(){
        //сохранить свойства в ИБ и присвоить id товару
        return true;
    }

}

class User{
    private $id;
    private $name;
    private $login;
    private $authenticated = false;

    public static function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function __construct($login)
    {
        $this->login = $login;
    }

    public function authenticate($password){
        $sql = new SQL();
        $login = $sql->checkParam($this->login);
        $password = $sql->checkParam($password);
        if($user = $sql->selectOne("SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'")){
            $this->id = $user['id'];
            $this->name = $user['name'];
            $_SESSION['user'] = $this;
            $sql->executeSQL("UPDATE users SET last_login = '{date('c')}' WHERE id={$user['id']}");
            $this->authenticated = true;
        }
    }

    public function isAuthenticated(){
        return $this->authenticated;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}

class Order extends User {
    private $id;
    private $user;
    private $productList = [];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save(){
        if (parent::isAuthenticated()){
            //сохранить свойства в ИБ и присвоить id заказу
            return true;
        }else{
            return false;
        }
    }

    public function addProduct(Product $product, $quantity = 1){
        if ($quantity==0){
            return;
        }
        if (!$product->isInit()){
            return;
        }
        $currentProduct = $this->productList[$product->getId()];
        if (is_null($currentProduct)){
            $this->productList[$product->getId()] = new OrderItem($product,$quantity);
        }else{
            $currentProduct->setQuantity($currentProduct->getQuantity()+$quantity);
        }
    }

}

class OrderItem extends Product {
    private $product;
    private $quantity = 0;
    /**
     * OrderItem constructor.
     * @param $product
     */
    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}

class Category{
    private $id;
    private $user;

}

