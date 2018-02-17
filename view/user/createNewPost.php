<?php
/** @var array $categories */
?>
<div class="container">
    <form action="/user/createnewpost" method="post" role="presentation">
        <input type="text" name="title" class="form-control" placeholder="Post title">
        <p><select name="categoryId">
                <option value=<?= null ?>>Chose category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value=<?= $category->getId() ?>><?= $category->getTitle() ?></option>
                        <?php endforeach ?>
            </select></p>
        <textarea name="content" class="form-control" placeholder="Content" style="height:200px"></textarea>
        <button class="btn btn-lg btn-primary btn-block" name="createnewpost" type="submit">Crate</button>
    </form>

</div> <!-- /container -->

