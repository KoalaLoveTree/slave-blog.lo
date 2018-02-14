<?php
/** @var array $posts **/
?>
<ul class="list-group">
        <?php foreach ($posts as $post) : ?>
                <a href="http://slave-blog.lo/post/show/?id=<?= $post->getId() ?>"
                   class="list-group-item"><?= $post->getTitle() ?></a>
            <?php endforeach ?>
</ul>