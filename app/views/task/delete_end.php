<?php $title = "Delete Task" ?>
<?php header("refresh: 3; url=/task/view?d=$task->date") ?>

<h1>Task Deletion Successful</h1>

<p class="alert alert-success">
    Task successfully deleted. Please wait while you are being redirected to
    <a href="<?php eh(url('task/view', array('d'=>$task->date))) ?>">Daily View</a>.
</p>
