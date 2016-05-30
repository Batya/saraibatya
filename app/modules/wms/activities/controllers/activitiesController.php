<?php

class ActivitiesController extends SEVEN_THUNDERS
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('activities_activities');
	}

	public function indexAction()
	{
		$this->loadPage('activities_index');
	}

	public function calendarAction()
	{
		$this->loadPage('activities_calendar');
	}

	public function timelineAction()
	{
		$this->loadPage('activities_timeline');
	}

	public function mediaAction()
	{
		$url = $this->parseUrl();
		if(isset($url[2])) {
			$this->loadPage('activities_'.$url[2]);
		}else{
			$this->loadPage('activities_media');
		}
	}

	public function awardsAction()
	{
		$this->loadPage('activities_awards');
	}
}