<?php

/**
 * Beliefs Controller
 */
class BeliefsController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('beliefs_beliefs');
	}

	public function indexAction()
	{
		$this->loadPage('beliefs_index');
	}
}