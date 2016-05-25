<?php

## FOR LOGIN FUNCIONALITY
session_start();
ini_set("session.cookie_lifetime","18000");

## PULL XML CONFIGURATION INFORMATION
$con = simplexml_load_file(PUBLIC_INDEX."/core/etc/config.xml") or die("Error: Cannot create XML object");

# DIRECTORY SEPARATOR
define("DS", DIRECTORY_SEPARATOR);

## SET TIMEZONE
date_default_timezone_set($con->core->timezone);
define("CUR_DATETIME", date("Y-m-d H:i:s"));
define("CUR_TIME", date("H:i:s"));
define("CUR_DATE", date("Y-m-d"));
define("DATE", date('m/d/Y'));
define("TIME", date('h:i a'));
define("FULL_DATE", date('l, F d, Y'));
define("FULL_DATE_ABRV", date('D, M d, Y'));
define("TODAY", date('m/d/Y'));
define("TOMORROW", date('m/d/Y', strtotime(TODAY."+1 days")));
define("YESTERDAY", date('m/d/Y', strtotime(TODAY."-1 days")));

## DATABASE CONNECTION CREDENTIALS - LIVE
define("DB_HOST", $con->dblive->host);
define("DB_NAME", $con->dblive->name);
define("DB_USER", $con->dblive->user);
define("DB_PASS", $con->dblive->pass);

## DATABASE CONNECTION CREDENTIALS - LOCAL
define("DB_HOST_LOCAL", $con->dblocal->host);
define("DB_NAME_LOCAL", $con->dblocal->name);
define("DB_USER_LOCAL", $con->dblocal->user);
define("DB_PASS_LOCAL", $con->dblocal->pass);



## URL DEFINITIONS
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$variable = substr($actual_link, 5, strpos($actual_link, ".com/"));
$url = 'http:'.$variable;
define("URL", $url);

## PROPER LIVE HOME URL
define("LIVE_URL", $con->url->live);


## CONSTANTS USED IN SITE

define('THEME', 'wms');
define('LAYOUTS', PUBLIC_INDEX.DS.'layouts'.DS);

//WMS
define('MODULES', APP_ROOT.DS.'modules'.DS.THEME.DS);
define('CTRLS','controllers'.DS);
define('MODELS','Models'.DS);
define('VIEWS','views'.DS);
define('JS','js'.DS);


//API
define('API_MODULE', $con->route->wms->api->module);
define('API_CTRL', $con->route->wms->api->controllers);
define('API_MOD', $con->route->wms->api->models);



## CORE FILES REQUIRED (IN THIS ORDER) TO HAVE
## FULL FUNCTIONALITY
require APP_ROOT.DS.'configs'.DS.'Database.php';
require APP_ROOT.DS.'configs'.DS.'Thunders.php';
require APP_ROOT.DS.'configs'.DS.'_Routing.php';
$routing = new _Routing();