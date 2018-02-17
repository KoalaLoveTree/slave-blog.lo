<?php
/** @var \db\entity\Post[] $posts */
?>
<ul class="list-group">
        <?php foreach ($posts as $post) : ?>
                <a href="http://slave-blog.lo/post/show/?id=<?= $post->getId() ?>"
                   class="list-group-item"><?= $post->getTitle() ?></a>
        <button class="btn btn-lg btn-primary btn-block" name="id" type="submit" value=<?= $post->getId()?>>Delete post</button>
            <?php endforeach ?>
</ul>
