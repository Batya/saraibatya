<?php

class HomeController extends SEVEN_THUNDERS
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('home_home');
    }
    
    public function indexAction()
    {
        $this->loadPage('home_index');
    }
}