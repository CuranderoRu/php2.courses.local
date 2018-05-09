<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.05.2018
 * Time: 16:28
 */

namespace app\services;

use app\base\App;
use app\models\entities\Order;
use app\models\entities\Product;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;

use app\models\entities\User;

class Session
{
    /** @var  User $user*/
    private $user;
    /** @var Order $order*/
    private $order;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $this->user = $_SESSION['user'];
        $this->order = $_SESSION['order'];
        if(is_null($this->user)){
            //$this->user = new User();
            $this->user = App::call()->user;
            $_SESSION['user'] = $this->user;
            //$this->order = new Order();
            $this->order = App::call()->order;
            $this->order->setUser($this->user);
            $_SESSION['order'] = $this->order;
        }
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function authenticate($login, $password){
        $this->user = new User($login);
        (new UserRepository())->authenticate($this->user, $password);
        $_SESSION['user'] = $this->user;
        $this->order->setUser($this->user);
        return $this->user->isAuthenticated();
    }

    public function isAuthenticated(){
        return $this->user->isAuthenticated();
    }

    public function close(){
        session_destroy();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    public function finalizeOrder()
    {
        if (!$this->isAuthenticated()) return false;
        $this->order->finalizeOrder();
        $this->order = new Order();
        $_SESSION['order'] = $this->order;
    }

    public function getCartItems(){
        return $this->order->getCartItems();
    }

    public function getCartQuantity()
    {
        return $this->order->getItemsQuantity();
    }

    public function addToCart(Product $product, $quantity)
    {
        $res = $this->order->addProduct($product, $quantity);
        $_SESSION['order'] = $this->order;
        return $res;
    }


}