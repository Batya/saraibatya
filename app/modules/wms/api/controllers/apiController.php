<?php

/*
 *  DPM API
 */
class ApiController extends SEVEN_THUNDERS
{
	private $access;
    public function __construct()
    {
        parent::__construct();
		$this->loadModel('api_api');
		$this->__setAccess();
		if(!count($this->__getAccess()) > 0){
			$this->returnJson(["status"=>"404","message"=>"you do not have access"]);
			die();
		}
    }
	
	private function __setAccess()
	{
		$access = $this->select("select user_id from user where user_id = :id",array("id"=>$_GET['access']));
		$this->access = $access[0];
	}
	
	private function __getAccess()
	{
		return $this->access;
	}
    
    public function getAction()
    {
		$this->returnJson($this->model->getAdvanced());
    }
    
    public function pushAction()
    {
		$this->returnJson($this->model->pushAdvanced());
    }
    
    public function updateAction()
    {
		$url = $this->parseURL();
		print_r($url);
		$this->model->updateTable($url[2], $_GET['where'], $_POST);
		$this->returnJson(array("success"=>200));
    }
    
    public function deleteAction()
    {
		$url = $this->parseURL();
		$this->model->deleteFrom($url[2], $_GET['where']);
		$this->returnJson(array("success"=>200));
    }
    
    public function restAction()
    {
        print_r($this->model->cKVP($_POST));
    }
	
	/**
	* @usage loadModel is a Model autoloader
	* @param $model is the model to load
	*/
// 	private function loadApiModel($model)
// 	{
// 		$mod = PUBLIC_INDEX.API_MOD.$model.'_model.php';
// 		if(file_exists($mod))
// 		{
// 			require $mod;
// 			$modelName = $model.'_Model';
// 			$this->model = new $modelName();
// 		}
// 	}
}