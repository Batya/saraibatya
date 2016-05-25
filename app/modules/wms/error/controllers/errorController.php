<?php

class ErrorController extends SEVEN_THUNDERS
{
    public function __construct()
    {
        parent::__construct();
//         $this->loadModel('error');
    }
    
    public function indexAction()
    {
        $this->loadPage('error_index');
    }
}