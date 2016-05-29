<?php

class DeedsController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('deeds_deeds');
	}

	public function indexAction()
	{
		$this->loadPage('deeds_index');
	}
}