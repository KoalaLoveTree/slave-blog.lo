<?php
/** @var array $posts * */
?>
<ul class="list-group">
        <?php foreach ($posts as $post) : ?>
                <a href="/post/show/?id=<?= $post->getId() ?>"
                   class="list-group-item"><?= $post->getTitle() ?></a>
            <?php endforeach ?>
</ul>