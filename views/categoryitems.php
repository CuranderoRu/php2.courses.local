<?php /** @var \app\models\Category $category */ ?>

<?php foreach ($categories as &$category): ?>

                                    <li class="category"><a href="../product?category_id=<?=$category->getId()?>"><?=$category->getName()?></a></li>


<?php endforeach;?>