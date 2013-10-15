<?php
class UserController extends AppController
{
    public function login()
    {
        $user = new User;
        $user->username = Param::get('username');
        $user->password = Param::get('password');
        $user->rpt_password = $user->password;
        $page = Param::get('page_next');

        if ($page) {
            $user->login();
        }

        $this->set(get_defined_vars());
    }
    
    public function logout()
    {
        User::logout();
    }
    
    public function register()
    {
        $user = new User;
        $page = Param::get('page_next', 'register');
                
        switch ($page) {
            case 'register' :
                break;
            case 'register_end' :
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                $user->rpt_password = Param::get('rpt_password');
                try {
                    $user->register();
                } catch (ValidationException $e) {
                    $page = 'register';
                }
                break;
            default :
                break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }
}
