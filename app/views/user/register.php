<?php $title = 'Register' ?>

<h1>Register</h1>

<?php if ($user->hasError() || $user->isRegistered) : ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Registration Error:</h4>
        <?php if ($user->isRegistered) : ?>
            <div><em>Username</em> already exists!</div>
        <?php endif ?>
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
        <?php if (!empty($user->validation_errors['rpt_password']['match'])) : ?>
            <div><em>Passwords</em> do not match.</div>
        <?php endif ?>
    </div>
<?php endif ?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
    <label>Password:</label>
    <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
    <label>Repeat Password:</label>
    <input type="password" name="rpt_password" value="<?php eh(Param::get('rpt_password')) ?>">
    <br/>
    <input type="hidden" name="page_next" value="register_end">
    <button type="submit" class="btn btn-primary">Create Account</button>
</form>
