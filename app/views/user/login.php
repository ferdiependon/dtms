<?php $title = 'Log In' ?>

<h1>Log In</h1>
<?php if (isset($_SESSION['username'])) : ?>
    <?php header("refresh: 3; url=/task/index") ?>
    <p class="alert alert-success">
        You have logged in successfully,
        <b><?php echo $_SESSION['username'] ?></b>.
        Please wait while you are being redirected.
    </p>
    <a href="<?php eh(url('task/index')) ?>">&larr; View Tasks</a>
    
<?php else : ?>
    <?php if ($user->hasError()) : ?>
        <div class="alert alert-block">
            <h4 class="alert-heading">Login Error:</h4>
            <?php if (!empty($user->validation_errors['username']['length'])) : ?>
                <div><em>Username</em> must be between
                    <?php eh($user->validation['username']['length'][1]) ?> and
                    <?php eh($user->validation['username']['length'][2]) ?>
                    characters in length.
                </div>
            <?php endif ?>
            <?php if (!empty($user->validation_errors['password']['length'])) : ?>
                <div><em>Password</em> must be between
                    <?php eh($user->validation['password']['length'][1]) ?> and
                    <?php eh($user->validation['password']['length'][2]) ?>
                    characters in length.
                </div>
            <?php endif ?>
            <?php if (!$user->validation_errors['username']['length'] &&
                      !$user->validation_errors['password']['length']) : ?>
                <div>Wrong <em>username</em> or <em>password</em>.</div>
            <?php endif ?>
        </div>
    <?php endif ?>

    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
        <label>Password:</label>
        <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
        <br/>
        <input type="hidden" name="page_next" value="login">
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>

    <h5>No account yet? <a href="<?php eh(url('user/register')) ?>">Sign up</a> now!</h5>
<?php endif ?>