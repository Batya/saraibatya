<?php

/**
 * About Us Controller
 */
class AboutController extends SEVEN_THUNDERS
{
	public funciton __construct()
	{
		parent::__construct();
		$this->loadModel('about');
	}

	public function indexAction()
	{
		$this->loadPage('about_index');
	}
}