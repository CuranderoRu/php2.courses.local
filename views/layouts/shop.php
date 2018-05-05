<?php /** @var \app\models\Product $product */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Megashop</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/shop.css">
</head>

<body>
    <div class="header"><a href="index.php">My shop</a></div>
    <nav>
        <ul class="main_menu">
            <li><a href="../../">Главная</a></li>
            <li class="cart_button"><a href="../cart">Корзина (0)</a>
                <div class="cart_menu" id="cart_menu">
                    <?php foreach ($cart_menu_items as $item_text=>$item_link): ?>
                        <div class="cart_menu__item"><a href="<?=$item_link?>"><?=$item_text?></a></div>
                    <?php endforeach;?>
                </div>
            </li>
            <li><a href="../admin">Админка</a></li>
        </ul>
    </nav>
    <div class="container">
        <ul class="categories">
            <?=$shopcategories?>
        </ul>
        <div class="items_area">
            <?=$itemscontent?>
        </div>
    </div>
    <script src="./js/shop.js"></script>
</body>

</html>
