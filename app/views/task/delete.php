<?php $title = 'Delete Task' ?>

<h1>Delete Task</h1>

<a href="<?php eh(url('task/view', array('d'=>$task->date))) ?>">&laquo; Return to Day View</a>

<form method="post" class="task-view">
    <div class="left">
        <label><b>Project Title:</b></label>
        <label><?php eh($task->title) ?></label>
        <label><b>Task Summary:</b></label>
        <label><?php eh($task->summary) ?></label>
        <label><b>Completed:</b></label>
        <label><?php eh($task->complete) ?>%</label>
    </div>
    
    <div class="right">
        <label><b>Date:</b></label>
        <label><?php eh(date("F d, Y", strtotime($task->date))) ?></label>
        <label><b>Hours:</b></label>
        <label><?php eh($task->hours) ?></label>
        <label><b>Status:</b></label>
        <label><?php eh($task->status) ?></label>
    </div>
    
    <label><b>Details:</b></label>
    <label><?php eh($task->details) ?></label>
    
    <br/>
    <input type="hidden" name="page_next" value="delete_end">
    <button type="submit" class="btn btn-primary">Delete Task</button>
</form>
