<?php $title = "Week View" ?>

<script type="text/javascript">
    function jumpToDate()
    {
        window.location = "?d=" + document.getElementById("calendar").value;
    }
</script>

<h1>Week View</h1>

<div class="week">
    <a href="<?php eh(url('', array('d'=>$prev_week))) ?>" class="btn btn-primary">Previous Week</a>
    <span class="middle">
        Select Date: <input type="date" id="calendar" onchange="jumpToDate()">
        <span class="sign-up"><a href="<?php eh(APP_URL) ?>">Current Week</a></span>
    </span>
    <a href="<?php eh(url('', array('d'=>$next_week))) ?>" class="btn btn-primary right">Next Week</a>
    <h4>Tasks for <em><?php eh($days[1]['full']) ?></em> to <em><?php eh($days[5]['full']) ?></em></h4>
    <?php foreach ($days as $day) : ?>
        <a href="<?php eh(url('task/view', array('d'=>$day['url']))) ?>">
            <div class="day">
                <div class="date">
                    <div class="full-date"><?php eh($day['full']) ?></div>
                    <br/>
                    <div class="day-name"><?php eh($day['name']); ?></div>
                </div>
                <?php foreach ($day['tasks'] as $task) : ?>
                    <div class="tasks">
                        <span class="title"><b><?php eh($task->title) ?></b></span>
                        <span class="summary"><?php eh($task->summary) ?></span>
                    </div>
                <?php endforeach ?>
                <div class="circle"></div>
            </div>
        </a>
    <?php endforeach ?>
</div>
