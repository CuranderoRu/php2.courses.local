<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 28.04.2018
 * Time: 23:20
 */

namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex(){
        $filter = [];
        if (isset($_GET['category_id'])){
            $filter = [':category'=>$_GET['category_id']];
        }
        $products = Product::getAll($filter);
        echo $this->render('card', ['products'=>$products]);
    }

    public function actionDisplay(){
        echo 'actionDisplay';
    }

    public function actionCard(){
        $products = [];
        $id = $_GET['id'];
        $products[] = Product::getByID($id);
        echo $this->render('card', ['products'=>$products]);
    }


}