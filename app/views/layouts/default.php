<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DTMS - <?php eh($title) ?></title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/css/style.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>

<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?php eh(APP_URL) ?>">DietCake Daily Task Management System</a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['username'])) : ?>
            <span class="session">
                Welcome back, <b><?php eh($_SESSION['username']) ?></b>!
                <a href="<?php eh(url('user/logout')) ?>" class="btn btn-primary">Log Out</a>
            </span>
        <?php endif ?>

        <?php echo $_content_ ?>

    </div>

    <script>
        console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>

</body>
</html>
