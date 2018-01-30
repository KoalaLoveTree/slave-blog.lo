<?php
/** @var \db\entity\Post $post */
/** @var \db\entity\User $author */
/** @var \db\entity\Category $category */
?>
<div class="container-fluid">
    <?=$category->getTitle()?><br>
    <?=$author->getLogin()?><br>
    <?=$post->getTitle()?><br>
    <?=$post->getContent()?><br>
    <?=$post->getPubdate()?><br>
</div>