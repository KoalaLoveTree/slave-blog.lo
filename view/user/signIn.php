<?php
/** @var string $message */
?>
<div class="container">
    <div class="text-center">
        <?= $message ?><br>
    </div>
    <form class="form-signin" action="/user/signin" method="post" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="signInAction" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->
