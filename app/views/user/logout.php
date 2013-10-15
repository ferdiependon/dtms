<?php $title = "Logout" ?>
<?php header("refresh: 3; url=/") ?>

<h1>Logged Out</h1>

<p class="alert alert-success">
    You have logged out successfully.
    Please wait while you are being redirected.
</p>
<a href="<?php eh(APP_URL) ?>">
    &larr; Go to Home
</a>
