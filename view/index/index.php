<?php
/** @var $first \db\entity\Post */
/** @var $second \db\entity\Post */
/** @var $third \db\entity\Post */
?>

<ul class="list-group">
  <a href="http://slave-blog.lo/post/show/<?= $first->getId()?>" class="list-group-item"><?= $first->getTitle()?></a>
  <a href="http://slave-blog.lo/post/show/<?= $second->getId()?>" class="list-group-item"><?= $second->getTitle()?></a>
  <a href="http://slave-blog.lo/post/show/<?= $third->getId()?>" class="list-group-item"><?= $third->getTitle()?></a>
</ul>
