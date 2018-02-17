<?php
/** @var \db\entity\Post $post */
?>
<div>
    <div class="container-fluid">
        <?= $post->getCategory()->getTitle() ?><br>
        <?= $post->getAuthor()->getLogin() ?><br>
        <?= $post->getTitle() ?><br>
        <?= $post->getContent() ?><br>
        <?= $post->getPubdate() ?><br>
    </div>
    <?php if (\core\helper\AuthSessionHelper::isLoggedIn()):?>
    <form action="/comment/addcomment" class="form-comment" method="post" role="form">
        <h2 class="form-comment-heading">Add comment if u want</h2>
        <input type="text" name="comment" class="form-control" placeholder="Comment . . .">
        <input type="hidden" name="postId" value="<?= $post->getId()?>">
        <button class="btn btn-lg btn-primary btn-block" name="show" type="submit">Add</button>
    </form>
    <?php endif ?>
    <ul class="list-group">
        <?php foreach ($post->getComments() as $comment): ?>
        <a class="list-group-item"><?= $comment->getContent() ?>
        <br><?= $comment->getAuthor()->getLogin() ?> <?= $comment->getPubtime() ?></a>
        <?php if (\core\helper\AuthSessionHelper::isAdmin()): ?>
        <form action="/comment/deletecomment" class="form-comment" method="post" role="form">
            <input type="hidden" name="id" value="<?= $comment->getId()?>">
            <input type="hidden" name="postId" value="<?= $comment->getId()?>">
            <input type="hidden" name="path" value="0">
            <button class="btn btn-lg btn-primary btn-block" name="show" type="submit">Delete comment</button>
        </form>
        <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>