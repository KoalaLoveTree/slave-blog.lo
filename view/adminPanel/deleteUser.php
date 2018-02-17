<?php
/** @var \db\entity\User[] $users */
?>
<ul class="list-group">
        <?php foreach ($users as $user) : ?>
                <a href="http://slave-blog.lo/category/allposts/?id=<?= $user->getId() ?>"
                   class="list-group-item"><?= $user->getLogin() ?></a>
        <button class="btn btn-lg btn-primary btn-block" name="id" type="submit" value=<?= $user->getId()?>>Delete user</button>
            <?php endforeach ?>
</ul>
