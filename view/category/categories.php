<?php
/** @var array $categories * */
?>
<ul class="list-group">
        <?php foreach ($categories as $category) : ?>
                <a href="/category/allposts/?id=<?= $category->getId() ?>"
                   class="list-group-item"><?= $category->getTitle() ?></a>
            <?php endforeach ?>
</ul>