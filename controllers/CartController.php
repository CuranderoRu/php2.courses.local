<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 1:43
 */

namespace app\controllers;


class CartController extends Controller
{
    public function actionIndex(){
//        $products = Product::getAll();
//        echo $this->render('card', ['products'=>$products]);
    }

    public function actionAdd(){
        $id = $_GET['id'];
//        $products[] = Product::getByID($id);
//        echo $this->render('card', ['products'=>$products]);
    }

}