<?php $title = 'Add New Task' ?>

<script type="text/javascript">
    function printCompleted()
    {
        var slider = document.getElementById('slider').value;
        document.getElementById('completed').innerHTML = slider;
        if (slider == 100) {
            document.getElementById('status').value = "Completed";
        }
        else if (slider == 0) {
            document.getElementById('status').value = "Pending";
        }
        else {            
            document.getElementById('status').value = "Ongoing";
        }
    }
</script>

<h1>Add New Task</h1>

<a href="<?php eh(url('task/view', array('d'=>$task->date))) ?>">&laquo; Return to Day View</a>

<?php if ($task->hasError()) : ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Task Creation Error:</h4>
        <?php if (!empty($task->validation_errors['title']['length'])) : ?>
            <div><em>Project Title</em> must be between
                <?php eh($task->validation['title']['length'][1]) ?> and
                <?php eh($task->validation['title']['length'][2]) ?>
                characters in length.
            </div>
        <?php endif ?>
        <?php if (!empty($task->validation_errors['summary']['length'])) : ?>
            <div><em>Task Summary</em> must be between
                <?php eh($task->validation['summary']['length'][1]) ?> and
                <?php eh($task->validation['summary']['length'][2]) ?>
                characters in length.
            </div>
        <?php endif ?>
    </div>
<?php endif ?>

<form method="post" class="task-view">
    <div class="left">
        <label>Project Title:</label>
        <input type="text" name="title" value="<?php eh(Param::get('title')) ?>">
        <label>Task Summary:</label>
        <input type="text" name="summary" value="<?php eh(Param::get('summary')) ?>">
        <label>Completed: <span id="completed">0</span>%</label> 
        <input type="range" name="complete" id="slider" value="<?php eh(Param::get('complete', 0)) ?>"
            onchange="printCompleted()">
    </div>
    
    <div class="right">
        <label>Date:</label>
        <input type="text" name="date" value="<?php eh($full_date) ?>" readonly>
        <label>Hours:</label>
        <input type="number" name="hours" value="<?php eh(Param::get('hours', 1)) ?>" min=0.1 max=8 step=0.1>
        <label>Status:</label>
        <input type="text" name="status" id="status" value="<?php eh(Param::get('status', 'Pending')) ?>" readonly>
    </div>
    
    <label>Details:</label>
    <textarea name="details" maxlength="128"><?php eh(Param::get('details')) ?></textarea>
    
    <br/>
    <input type="hidden" name="page_next" value="create_end">
    <button type="submit" class="btn btn-primary">Create Task</button>
</form>
