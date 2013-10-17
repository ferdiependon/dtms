<?php
class Task extends AppModel
{
    public $curr_id;
    
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_between', 1, 32,
            ),
        ),
        'summary' => array(
            'length' => array(
                'validate_between', 1, 64,
            ),
        ),
    );
    
    public function create() {
        if (!$this->validate()) {
            throw new ValidationException('Task creation failed!');
        }
        
        $db = DB::conn();

        $db->query(
            'INSERT INTO task SET
                user_id = ?,
                date = ?,
                title = ?,
                summary = ?,
                details = ?,
                status = ?,
                complete = ?,
                hours = ?',
            array(
                $this->user_id,
                $this->date,
                $this->title,
                $this->summary,
                $this->details,
                $this->status,
                $this->complete,
                $this->hours,
            )
        );
    }
    
    public function delete() {
        $db = DB::conn();

        $db->query(
            'DELETE FROM task WHERE id = ?',
            array(
                $this->id,
            )
        );
    }
    
    public function edit() {
        if (!$this->validate()) {
            throw new ValidationException('Task update failed!');
        }
        
        $db = DB::conn();

        $db->query(
            'UPDATE task SET
                title = ?,
                summary = ?,
                details = ?,
                status = ?,
                complete = ?,
                hours = ?
            WHERE id = ?',
            array(
                $this->title,
                $this->summary,
                $this->details,
                $this->status,
                $this->complete,
                $this->hours,
                $this->id,
            )
        );
    }
    
    public static function getTask($id) {        
        $db = DB::conn();

        $row = $db->row(
            "SELECT * FROM task WHERE id = ?",
            array($id)
        );
        
        return new self($row);
    }
    
    public static function getTasks($id, $date) {
        $tasks = array();
        
        $db = DB::conn();

        $row = $db->rows(
            "SELECT * FROM task WHERE user_id = ? AND date = ? ORDER BY title, summary",
            array($id, $date)
        );
        foreach ($row as $v) {
            $tasks[] = new Task($v);
        }
                
        return $tasks;
    }
    
    public static function getDays($week) {
        $days = array();
        
        for ($i = 1; $i <= 5; $i++) {
            $day = strtotime($week . '-1 week sunday +'. $i . ' day');
            $days[$i]['url'] = date('Y-m-d', $day);
            $days[$i]['full'] = date('M d, Y', $day);
            $days[$i]['name'] = date('D', $day);
        }
        
        return $days;
    }
}
