<?php
require_once('../includes/vendor/autoload.php');

if(!ob_start("ob_gzhandler")) ob_start();
error_reporting(E_ALL ^E_NOTICE);
ini_set( 'display_errors','1');

date_default_timezone_set("Europe/London");

define('cardinalSystem', true);

require_once('../includes/class/cardinal.php');

$cardinal = new Cardinal();
$url = $cardinal->config['url'];

$pageURL = explode('/', stripslashes($_SERVER['PHP_SELF']));

define("URL_C", stripslashes('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '/');

$pageURL = implode ("/", $pageURL);
$GETQuery = urldecode($_SERVER['PHP_SELF']);
$GETQuery = explode("/", $GETQuery);

for ($i = 0; $i < count($GETQuery); $i++) {
  if ($GETQuery[$i] == 'index.php') {
    $include = $GETQuery[$i + 1];
    unset ($GETQuery[$i]);
  }
  unset($GETQuery[0]);
}

$GETQuery = array_values($GETQuery);
for ($i = 0; $i < count($GETQuery); $i += 2)
  $GET[$GETQuery[$i]] = isset( $GETQuery[$i + 1]) ? $GETQuery[$i + 1] : "" ;


$include = ctype_alpha(str_replace(array('-','_'), '', $include)) ? $include : "main";

if ($include != "404" && !file_exists("../includes/modules/" . $include . ".php"))
  $include .= is_dir("../includes/modules/" . $include) ? "/" . $include : $include = "main/main";

$GET["currentPage"] = $include;


$_GET = array_merge(array("GET" => $_GET), $GET);


require_once('../includes/header.php');


if ($include == "404")
  $cardinal->show_404();
else include("../includes/modules/" . $include . ".php");


$tVars["GET"] = $GET;

if (!$tVars["json"])
{

  if ($tVars["show_404"])
  {
    $tVars["audio"] = "eve/404.mp3";

    $tVars["display"] = 'pages/404.tpl';
  }

  if (isset($tVars["display"]))
  {
	/** HANDLE NOTICES DISPLAYED AFTER REDIRECTS **/
	if ($_SESSION["success"])
		$success[]  = $_SESSION["success"];

	if ($_SESSION["info"])
		$info[]  = $_SESSION["info"];

	if ($_SESSION["error"])
		$errors[]  = $_SESSION["error"];

	if ($_SESSION["warning"])
		$warnings[]  = $_SESSION["warning"];

	if ($_SESSION["voice"])
		$voice = $_SESSION["voice"];

	if ($_SESSION["messenger"])
	  $messenger[] = $_SESSION["messenger"];

	if ($_SESSION["myModal"])
	  array_unshift($myModals, $_SESSION["myModal"]);

	unset($_SESSION['myModal'], $_SESSION["success"], $_SESSION["error"], $_SESSION["warning"], $_SESSION["voice"], $_SESSION['info'], $_SESSION["messenger"]);
    /** //HANDLE NOTICES DISPLAYED AFTER REDIRECTS **/

	errors_success();
    $smarty->assign($tVars);
    $smarty->display($tVars["display"]);
    $smarty->display("footer_home.tpl");
  }
}

  $getContent = ob_get_contents();
  ob_end_clean();
  echo $getContent;
