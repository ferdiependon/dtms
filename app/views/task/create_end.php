<?php $title = "Add New Task" ?>
<?php header("refresh: 3; url=/task/view?d=$task->date") ?>

<h1>Task Creation Successful</h1>

<p class="alert alert-success">
    Task successfully created. Please wait while you are being redirected to
    <a href="<?php eh(url('task/view', array('d'=>$task->date))) ?>">Daily View</a>.
</p>
