<?php

/**
 * About Us Controller
 */
class AboutController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('about_about');
	}

	public function indexAction()
	{
		$this->loadPage('about_index');
	}
}