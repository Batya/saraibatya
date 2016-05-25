<?php

class Login_Model extends SEVEN_THUNDERS
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login()
    {
        $user_id = $this->select("
            select
                user_id
            from
                user
            where
                username = :u and password = :p
            ",array(
                "u"=>$_POST['username'],
                "p"=>sha1($_POST['password'])
            ));
        if(count($user_id[0]) === 1){
            $_SESSION['user_id'] = $user_id[0]['user_id'];
            return true;
        }else{return false;}
    }
    
    public function logout()
    {
        session_destroy();
    }
}