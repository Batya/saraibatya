<?php

class _Routing
{
	private $url = [];
	private $route = [];
	
    public function __construct()
    {
		self::__parseURL();
		$this->__setRoute();
		$this->__loadPath();
	}
	
	public function __getUrl(){return $this->url;}
	public function __getRoute($index = ''){
		if($index !== '')
		{
			return $this->route[$index];
		}else{
			return $this->route;
		}
	}
	private function __setUrl($url){$this->url = $url;}
	
	private function __getModule($module)
	{
		if(is_dir(MODULES.$module))
			return MODULES.$module.DS;
		else return false;
	}
	
	private function __setRoute()
	{
		$urlArr = $this->__getUrl();
		$this->route['module'] = strtolower(($urlArr[0] === '')?'home':$urlArr[0]);
		$this->route['action'] = strtolower((isset($urlArr[1]))?$urlArr[1]:'index');
		unset($urlArr[0],$urlArr[1]);
		if(count($urlArr) > 0) {
			$reIndex = array_values($urlArr);
			if(count($reIndex) >= 2) {
				$groups = array_chunk($reIndex,2);
				foreach($groups as $val)
					$this->route[strtolower($val[0])] = strtolower($val[1]);
			}
		}
	}

	/**
	 * 
	 */
	public function __parseURL()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null ;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->__setUrl($url);
	}
	
	private function __loadPath()
	{
		$module = self::__getRoute('module');
		$this->file = $this->__getModule($module);
		$controllerFile = $this->file.'controllers'.DS.$module.'Controller.php';
		if(file_exists($controllerFile))
		{
			$this->__loadController($controllerFile);
		}else{
			$this->__loadController(MODULES.'error'.DS.'controllers'.DS.'errorController.php');
		}
	}
	
	private function __loadController($file)
	{
		require_once $file;
		$controller = self::__getRoute('module').'Controller';
		if(class_exists($controller))
		{
			$_controller = new $controller();
			$_action = self::__getRoute('action').'Action';
			$params = self::__getRoute();
			unset($params['module'],$params['action']);
			$_controller->$_action($params);
		}else{
			$_controller = new ErrorController();
			$_controller->indexAction();
		}
	}
}