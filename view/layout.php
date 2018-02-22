<?php
/**
 * @var $content
 */

use core\helper\AuthSessionHelper;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slave Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="col-md-8">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://slave-blog.lo/">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if (AuthSessionHelper::isLoggedIn()): ?>
                        <li><a href="/user/profile">Profile</a></li>
                        <li><a href="/wall">Wall</a></li>
                    <?php endif ?>
                    <li><a href="/category">Category</a></li>
                    <?php if (AuthSessionHelper::isAdmin()): ?>
                        <li><a href="http://slave-blog.lo/admin/adminPanel">Admin Panel</a></li>
                    <?php endif ?>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
    <?php if (!AuthSessionHelper::isLoggedIn()): ?>
        <div class="col-md-4">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="http://slave-blog.lo/user/signup">Sign Up</a></li>
                    <li><a href="http://slave-blog.lo/user/signin">Sign In</a></li>
            </div><!-- /.navbar-collapse -->
        </div>
    <?php else: ?>
        <div class="col-md-4">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="http://slave-blog.lo/user/exit">Exit</a></li>
            </div><!-- /.navbar-collapse -->
        </div>
    <?php endif ?>
</nav>

<?php if (\core\helper\ErrorsCheckHelper::isErrorsExist()) : ?>
    <?php foreach (\core\helper\ErrorsCheckHelper::getErrors() as $error): ?>
        <script type="text/javascript">
            alert('<?=$error?>');
        </script>
    <?php endforeach ?>
<?php endif ?>

<div class="container-fluid">
    <?= $content ?>
</div>
</body>
</html>
