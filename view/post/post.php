<?php
/** @var \db\entity\Post $post */
/** @var \db\entity\User $author */
/** @var \db\entity\Category $category */
/** @var array $comments */
/** @var array $authorsOfComments */
?>
<div>
    <div class="container-fluid">
        <?= $category->getTitle() ?><br>
        <?= $author->getLogin() ?><br>
        <?= $post->getTitle() ?><br>
        <?= $post->getContent() ?><br>
        <?= $post->getPubdate() ?><br>
    </div>
    <?php if (\core\helper\AuthSessionHelper::isLoggedIn()):?>
<!--    action="/post/show/?id="--><?//=$post->getId()?>
    <form class="form-comment"  method="post" role="form">
        <h2 class="form-comment-heading">Add comment if u want</h2>
        <input type="text" name="comment" class="form-control" placeholder="Comment . . .">
        <button class="btn btn-lg btn-primary btn-block" name="show" type="submit">Add</button>
    </form>
    <?php endif ?>
    <ul class="list-group">
        <?php foreach ($comments as $comment): ?>
            <a class="list-group-item"><?= $comment->getContent() ?><br><?= $authorsOfComments[$comment->getId()]?></a>
            <?php if (\core\helper\AuthSessionHelper::isAdmin()): ?>
            <form class="form-delete-comment" method="post" role="form">
                <button class="btn btn-lg btn-primary btn-block" name="id" type="submit" value=<?= $comment->getId()?>>Delete comment</button>
            </form>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>