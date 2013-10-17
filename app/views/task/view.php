<?php $title = "Daily View" ?>

<script type="text/javascript">
    function selectRow(id)
    {
        var row = document.getElementById(id);
        row.checked = true;
        var cells = document.forms[0].getElementsByTagName("div");
        for (i=0; i<cells.length; i++) {
            cells[i].className = "cell";
        }
        document.getElementById("edit").href = "edit?id=" + row.value;
        document.getElementById("delete").href = "delete?id=" + row.value;
        document.getElementById(id).parentNode.className = "cell cell-active";   
    }
</script>

<h1><?php eh($full_date . ' - ' . $name) ?></h1>

<a href="<?php eh(url('/', array('d'=>$date))) ?>">&laquo; Return to Week View</a>
<br/><br/>
<a href="<?php eh(url('task/create', array('d'=>$date))) ?>" class="btn btn-primary">Add New Task</a>

<div class="task-list">
    <div class="header">
        <span>Project</span>
        <span>Task Summary</span>
        <span>Details</span>
        <span class="short">Status</span>
        <span class="short">Percentage</span>
        <span class="short">Hours</span>
    </div>
    <form method="post">
        <?php $total = 0 ?>
        <?php foreach ($tasks as $t) : ?>
            <div class="cell" onclick="selectRow('row-'+<?php eh($t->id) ?>)">
                <span><?php eh($t->title) ?></span>
                <span><?php eh($t->summary) ?></span>
                <span><?php eh($t->details) ?></span>
                <span class="short"><?php eh($t->status) ?></span>
                <span class="short"><?php eh($t->complete) ?>%</span>
                <span class="short"><?php eh($t->hours) ?></span>
                <input type="radio" id="row-<?php eh($t->id) ?>" name="id" value="<?php eh($t->id) ?>">
            </div>
            <?php $total += $t->hours ?>
        <?php endforeach ?>
        <span class="total"><b>Total:</b> <?php eh($total) ?> hours</span>
        <br/>
        <a href="" class="btn btn-primary" id="edit">Edit Task</a>
        <a href="" class="btn btn-primary" id="delete">Delete Task</a>
    </form>
</div>
