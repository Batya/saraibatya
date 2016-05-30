<?php

/**
 * About Us Controller
 */
class IntroductionController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('introduction_introduction');
	}

	public function indexAction()
	{
		$this->loadPage('introduction_index');
	}
}