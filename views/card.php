<?php /** @var \app\models\Product $product */ ?>

<?php foreach ($products as &$product): ?>

<a href="../product/display?id=<?=$product->getId()?>" class="item">
    <div class="item_top">
        <img src="../img/tumbs/<?=$product->getImage()?>" alt="">
            <div class="item_desr"><?=$product->getName()?></div>
                </div>
                    <div class="item_comment"><?=$product->getDescription()?></div>
                    <div class="item_comment item_price"><?=$product->getPrice()?></div>
                    <form action="../cart/add" item_id = <?=$product->getId()?> method="post" class = "item_form add_to_cart_form <?=$shop_actions_visibility?>">
                        Количество<input type="number" name="quantity" value=1 max=10 min=0>
                        <button type="submit" >Купить</button>
                    </form>
                    <!--<form action="../shop/changecart.php?item_id={item_id}" method="post" class="item_form {cart_actions_visibility}">-->
                    <form action="../cart/change" item_id = <?=$product->getId()?> class="item_form change_cart_item <?=$cart_actions_visibility?>">
                        <input type="submit" name = "operation" value="-">
                        <input type="number" name = "quantity" value=1 max=10 min=0>
                        <input type="submit" name = "operation" value="+">
                        <input type="submit" name = "operation" value="X">
                    </form>

</a>

<?php endforeach;?>