<?php
class TaskController extends AppController
{
    public function create() {
        $task = new Task;
        $task->date = Param::get('d');
        $full_date = date("F d, Y", strtotime($task->date));
        $page = Param::get('page_next', 'create');
        
        switch ($page) {
            case 'create' :
                break;
            case 'create_end' :
                $task->user_id = User::getId($_SESSION['username']);
                $task->title = Param::get('title');
                $task->summary = Param::get('summary');
                $task->details = Param::get('details');
                $task->status = Param::get('status');
                $task->complete = Param::get('complete');
                $task->hours = Param::get('hours');
                try {
                    $task->create();
                } catch (ValidationException $e) {
                    $page = 'create';
                }
                break;
            default :
                break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }
    
    public function delete()
    {
        $task = Task::getTask(Param::get('id'));
        $page = Param::get('page_next', 'delete');
        
        switch ($page) {
            case 'delete' :
                break;
            case 'delete_end' :
                try {
                    $task->delete();
                } catch (ValidationException $e) {
                    $page = 'delete';
                }
                break;
            default :
                break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }
    
    public function edit()
    {
        $task = Task::getTask(Param::get('id'));
        $page = Param::get('page_next', 'edit');
        
        switch ($page) {
            case 'edit' :
                break;
            case 'edit_end' :
                $task->title = Param::get('title');
                $task->summary = Param::get('summary');
                $task->details = Param::get('details');
                $task->status = Param::get('status');
                $task->complete = Param::get('complete');
                $task->hours = Param::get('hours');
                try {
                    $task->edit();
                } catch (ValidationException $e) {
                    $page = 'edit';
                }
                break;
            default :
                break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }
    
    public function index()
    {
        $task = new Task;
        $task->curr_id = User::getId($_SESSION['username']);
        $week = Param::get('d', date("Y-m-d"));
        $prev_week = date("Y-m-d", strtotime($week . '-1 week sunday'));
        $next_week = date("Y-m-d", strtotime($week . '+1 week sunday'));
        
        if (!$task->curr_id) {
            header("Location:user/login");
        }
        
        $days = Task::getDays($week);
        foreach ($days as $k => $day) {
            $days[$k]['tasks'] = Task::getTasks($task->curr_id, $day['url']);
        }
        
        $this->set(get_defined_vars());
    }
    
    public function view()
    {        
        $user_id = User::getId($_SESSION['username']);
        $date = Param::get('d');
        $full_date = date("F d, Y", strtotime($date));
        $name = date("l", strtotime($date));
        
        $tasks = Task::getTasks($user_id, $date);
        
        $this->set(get_defined_vars());
    }
}
