<?php

class LoginController extends SEVEN_THUNDERS
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('login_login');
    }
    
    public function indexAction()
    {
        if(!isset($_SESSION['user_id'])){
            $this->loadPage('login_index');
        }else{
            $this->name = $this->currentUserInfo('f_name');
            $this->loadPage('login_loggedIn');
        }
    }
    
    public function loginAction()
    {
        $this->model->login();
    }
    
    public function logoutAction()
    {
        $this->model->logout();
    }
    
    // @TODO: ADD REGISTER FUNCTIONS
    // @TODO: ADD FORGOT PASSWORD
    // @TODO: ADD FORGOT USERNAME
}