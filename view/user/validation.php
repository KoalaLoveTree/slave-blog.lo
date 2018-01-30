<?php
/** @var string $message */
?>

<style>
    .text {
        text-align:  center;
    }
</style>
<div class="text">
    <?= $message?><br>
    U've been redirect to home page 5 sec.
</div>
<?php header('Refresh: 5; URL=http://slave-blog.lo');?>
