<?php
class User extends AppModel
{
    public $isRegistered;
    public $rpt_password;
    
    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', 1, 32,
            ),
        ),
        'password' => array(
            'length' => array(
                'validate_between', 1, 32,
            ),
        ),
        'rpt_password' => array(        // separated because logging in performs this
            'match' => array(           // matching check on the password field
                'password_match',
            ),
        ),
    );
    
    public static function getId($username)
    {
        $db = DB::conn();
        
        $row = $db->value(
            'SELECT id FROM user WHERE username = ?',
            array($username)
        );

        return $row;
    }
    
    public function login()
    {
        // manually add password as argument to match check
        $this->validation['rpt_password']['match'][] = $this->password;

        if (!$this->validate()) {
            //throw new ValidationException('Invalid login credentials!');
        }

        $db = DB::conn();
        $md5 = md5($this->password);
        $row = $db->row(
            'SELECT 1 FROM user WHERE username = ? AND password = ?',
            array($this->username, $md5)
        );
        
        if ($row) {
            $this->isRegistered = true;
            $_SESSION['username'] = $this->username;
        }
        else {
            $this->validation_errors['username']['notfound'] = true;
        }
    }
    
    public static function logout()
    {
        $_SESSION = array();
        session_destroy();
    }
    
    public function register()
    {
        $this->validation['rpt_password']['match'][] = $this->password;
        $this->isRegistered = self::getId($this->username);
        if (!$this->validate() || $this->isRegistered) {
            throw new ValidationException('Invalid registration info!');
        }
        
        $db = DB::conn();
        $md5 = md5($this->password);

        $db->query(
            'INSERT INTO user SET username = ?, password = ?',
            array($this->username, $md5)
        );
    }
}
