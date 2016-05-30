<?php

class SEVEN_THUNDERS extends Database
{
	public function __construct()
	{
		/*
		** $usage A constructor for the Database class that is being extended
		*/
		if(URL != LIVE_URL)
			parent::__construct(DB_HOST_LOCAL, DB_NAME_LOCAL, DB_USER_LOCAL, DB_PASS_LOCAL);
		else parent::__construct(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	/**
	 *	URL Parser
	 */
	public function parseURL()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null ;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		return $url;
	}
	
	/**
	* @usage render is a View render function that will load in the requested view
	* @param $view is the view to be loaded: ex: 'index/index'
	*/
	public function render($view)
	{
		$view = explode("_",$view);
		$page = $view[0].DS.'views'.DS.$view[1].".phtml";
		$this->__require(MODULES,$page);
	}
	public function htmlBlock($view)
	{
		$view = explode("_",$view);
		$page = $view[0].DS.'Blocks'.DS.$view[1].".phtml";
		$this->__require(MODULES,$page);
	}
	
	public function getViewHtml($view)
	{
		$view = explode("_",$view);
		$page = MODULES.$view[0].DS.'views'.DS.$view[1].".phtml";
		return $page;
	}
	
	public function __require($files)
	{
		$files = func_get_args();
		$path = $files[0];
		unset($files[0]);
		foreach($files as $file)
			require $path.$file;
	}
	
	public function returnJson($value)
	{
		header("Content-Type: application/json");
		echo json_encode($value);
	}
	
	public function loadPage($layout)
	{
		$this->layout = $layout;
		$this->__require(LAYOUTS.THEME.DS,'index.phtml');
	}
	public function loadJS($module)
	{
		$module = explode("_",$module);
		echo '<script src="/app/modules/'.THEME.'/'.$module[0].'/js/'.$module[1].'.js"></script>';
	}
	public function loadCSS($module)
	{
		$module = explode("_",$module);
		echo '<link href="/app/modules/'.THEME.'/'.$module[0].'/css/'.$module[1].'.css" />';
	}
	
	/**
	* @usage loadModel is a Model autoloader
	* @param $model is the model to load
	*/
	public function loadModel($model)
	{
		$model = explode("_",$model);
		$mod = MODULES.$model[0].DS.'Models'.DS.$model[1]."_model.php";
		if(file_exists($mod))
		{
			require $mod;
			$modelName = $model[0].'_Model';
			$this->model = new $modelName();
		}
	}

	/*
	**	@public function
	**	upload files to the upload/ dir
	**	@multi-part form upload
	**
	*/
	public function uploadFile($file, $location)
	{
		if(isset($file))
		{
			if($file["error"] > 0)
			{
				echo "Return Code: ".$file["error"].'<br />';
				die;
			}else{
				$storagename = $file["name"];
				move_uploaded_file($file["tmp_name"], $location. $storagename);
			}
		}
	}

	/**
	 * 
	 */
	public function __adminAccess()
	{
		$admin = $this->select("SELECT admin FROM user WHERE user_id = :id", array("id" => $this->currentUserInfo('user_id')));
		if($admin[0]['admin'] === '0')
		{
			return false;
		}else{
			return true;
		}
	}
	
	public function __session()
	{
		return isset($_SESSION['user_id']);
	}

	/**
	 * 
	 */
	public function loggedInActive($userid)
	{
		$active = $this->returnRowCount("SELECT loggedin_id FROM loggedin WHERE user_id = :id", array("id" => $userid));
		$return = ($active) ? ' <span class="text-success" style="font-size: 1rem;"><i class="fa fa-circle fa-sm" style="font-size: 0.7rem;"></i> online</span>': null;
		return $return;
	}

	/**
	 * 
	 */
	public static function clean($data)
	{
		return htmlentities(strip_tags(trim($data)));
	}

	/**
	 * 
	 */
	public function matches($data, $value)
	{
		$data = explode(';', $data);
		if(in_array($value, $data))
			return true;
		else return false;
	}
	
	/**
	 *
	 */
	public function sendEmail($to, $sub, $body)
	{
		if(!empty($to) && !empty($sub) && !empty($body))
		{
			mail($to, $sub, $body, 'From: admin@projman.com');
		}
		return false;
	}
	/**
	 *
	 */
	public function currentUserInfo($data)
	{
		$userData = $this->select("SELECT $data FROM user WHERE user_id = :id", array("id" => $_SESSION['user_id']));
		return $userData[0][$data];
	}











	/*
	**
	**  @public function
	**  formats the given file size into bytes, kilobytes, megabytes, gigabytes, and terabytes
	**  @param $bytes 'given file size unformatted'
	**
	*/
	public function formatBytes($bytes, $precision = 2) { 
		$units = array('b', 'kb', 'mb', 'gb', 'tb');

		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		// Uncomment one of the following alternatives
		$bytes /= pow(1024, $pow);
		//$bytes /= (1 << (10 * $pow)); 

		return round($bytes, $precision) . ' ' . $units[$pow];
	}


	/*
	**
	** Output Error File
	**
	*/
/* 	public function outputErrorFile($user, $errorsArray = array())
	{
		if($user === $this->currentUserInfo('username'))
		{
			$file = "errorLog_output/errorLog_".date("Ymd_His").".txt";
			$myfile = fopen(PUBLIC_INDEX.DS.$file, "w") or die("Unable to open file!");
			$txt = "";
			foreach($errorsArray[0] as $k => $value){
				$txt .= $k.";";
			}
			$txt .= "\r\n";
			foreach($errorsArray as $k => $value){
				foreach($value as $key => $val) {
					$txt .= $val.";";
				}
				$txt .= "\r\n";
			}
			fwrite($myfile, $txt);
			fclose($myfile);
			die('<script>_d.messageBox(\'Your file is ready!<br><a href="'.URL.$file.'" target="_blank">Click here to view/download</a>\');</script>');
		}
	} */

	/*
	**
	** Debugging Tool
	** 
	** Required Parameters
	** @param 0 - username
	** @param 1 - object
	**
	*/
	public function debug($object = array())
	{
		echo '<pre>';
		print_r($object);
		echo '</pre>';
	}

	/*
	**
	** Table Debugging Tool
	**
	*/
	public function TABLEFORM($obj)
	{
		if($obj[0] === $this->currentUserInfo('username'))
		{
			echo '<table class="table">';
			echo '<thead>';
			echo '<tr>';
			echo '<td>#</td>';
			foreach($obj[1][0] as $k => $v)
			{
				echo '<td>'.$k.'</td>';
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$i = 1;
			foreach($obj[1] as $val)
			{
				echo '<tr>';
				echo '<td>'.$i.'.</td>';
				foreach($val as $v)
				{
					echo '<td>'.$v.'</td>';
				}
				echo '</tr>';
				$i++;
			}
			echo '</tbody>';
			echo '</table>';
			die;	
		}
	}
}