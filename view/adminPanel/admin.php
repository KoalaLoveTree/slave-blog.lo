<?php
/** @var \db\entity\Comment[] $comments */
?>
<div>
    Welcome master! Admin it!!
    <?php foreach ($comments as $comment):?>
    <a class="list-group-item"><?=$comment->getContent()?><br><<?= $comment->getAuthor()->getLogin()?><?= $comment->getPubtime()?>></a>
        <form action="/comment/approvecomment" class="form-comment" method="post" role="form">
            <input type="hidden" name="id" value="<?= $comment->getId()?>">
            <input type="hidden" name="postId" value="<?= $comment->getId()?>">
            <button class="btn btn-lg btn-primary btn-block" name="show" type="submit">Approve comment</button>
        </form>
        <form action="/comment/deletecomment" class="form-comment" method="post" role="form">
            <input type="hidden" name="id" value="<?= $comment->getId()?>">
            <input type="hidden" name="postId" value="<?= $comment->getPostId()?>">
            <input type="hidden" name="path" value="1">
            <button class="btn btn-lg btn-primary btn-block" name="show" type="submit">Delete comment</button>
        </form>
    <?php endforeach;?>
</div>