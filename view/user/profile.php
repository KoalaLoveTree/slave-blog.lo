<?php
/** @var \db\entity\User $u */
/** @var array $usersPosts */
?>
<div class="container-fluid">
    Login: <?= $u->getLogin() ?>
    <br>
    Email: <?= $u->getEmail() ?>
</div>
<ul class="list-group">
        <?php foreach ($usersPosts as $post) : ?>
                <a href="http://slave-blog.lo/post/show/?id=<?= $post->getId() ?>"
                   class="list-group-item"><?= $post->getTitle() ?></a>
            <?php endforeach ?>
</ul>
<form action="/user/createnewpost" method="post" role="presentation">
<button class=" btn btn-lg btn-primary btn-block" name="createNewPostAction" type="submit">Create New Post</button>
</form>
