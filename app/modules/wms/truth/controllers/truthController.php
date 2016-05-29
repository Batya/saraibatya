<?php

/**
 * Truth Controller
 */
class TruthController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('truth_truth');
	}

	public function indexAction()
	{
		$this->loadPage('truth_index');
	}
}