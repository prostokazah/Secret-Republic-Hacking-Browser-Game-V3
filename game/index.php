<?php
if(!ob_start("ob_gzhandler")) ob_start();

// set system default time zone GMT + 0
date_default_timezone_set("Europe/London");

error_reporting(E_ALL ^E_NOTICE);
ini_set( 'display_errors','1');

define('cardinalSystem', true);

require_once('includes/class/Uri.class.php');
Uri::init();

$url = Uri::current();


// Make page URL
$pageURL = explode("/", $url);
if ($pageURL[count($pageURL) - 1] == "/") unset($pageURL[count($pageURL) - 1]);

if ($url[strlen($url) - 1] != "/") $url .= "/";

define("URL_C", $url);

foreach ($pageURL as $key => $value)
  if ($value == "page")
  {
    unset($pageURL[$key], $pageURL[$key+1]);
    break;
  }
$pageURL = implode ("/", $pageURL);

$GETQuery = urldecode($_SERVER['REQUEST_URI']);
$GETQuery = explode("/", $GETQuery);
$GETQuery =($GETQuery);

$include = $GETQuery[1];


unset ($GETQuery[0], $GETQuery[1]);

$GETQuery = array_values($GETQuery);

for ($i = 0; $i < count($GETQuery); $i += 2)
  $GET[$GETQuery[$i]] = isset( $GETQuery[$i + 1]) ? $GETQuery[$i + 1] : "" ;


$include = ctype_alpha(str_replace(array('-','_'), '', $include)) ? $include : "main";


if ($include != "404")
if (!file_exists("modules/" . $include . ".php"))
  if (is_dir("modules/" . $include))
    $include .= "/" . $include;
   else $include = "main/main";

$GET["currentPage"] = $include;



$_GET = array_merge(array("GET" => $_GET), $GET);


  require_once('includes/header.php');



if ($include == "404")
  $cardinal->show_404();
else

include("modules/" . $include . ".php");


$templateVariables["GET"] = $GET;



$randRecordPageStats = rand (1,20) % 5 == 0;
if ( isset($user["view_debug"]) || $randRecordPageStats)
{
  $used_memory=(memory_get_usage(true)-$cardinal->beg_used_memory)/1024;
	//Count page view and other data

  $finish = array_sum(explode(' ', microtime()));
  $total_time = round(($finish - $cardinal->page_start), 6);
  $dataInsert = array(
      "total_time"=>$total_time,
      "page"=>$GET["currentPage"],
      "used_memory"=>$used_memory,
      "nr_queries"=>$db->_nrQueries
    );

  if ($randRecordPageStats)
  {
    $dataInsert["user_id"] = $user["id"];
    $dataInsert["user_ip"] = $cardinal->getRealIP();
    $dataInsert["created"] = time();
    $dataInsert["url"] = URL_C;
    $db->insert("debug_page_stats", $dataInsert);

  }
  if(isset($user["view_debug"])){
    $dataInsert["mysql_queries"] = $db->_queries;

    $templateVariables= array_merge($templateVariables, $dataInsert);
	}
}

if (!$templateVariables["json"])
{




  if ($templateVariables["show_404"])
  {
    $templateVariables["audio"] = "eve/404.mp3";

    $templateVariables["display"] = 'pages/404.tpl';
  }



  if (isset($templateVariables["display"]))
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
    $smarty->assign($templateVariables);
    $smarty->display($templateVariables["display"]);
    $smarty->display("footer_home.tpl");
  }
}

// Get value of buffering so far
  $getContent = ob_get_contents();

  // Stop buffering
  ob_end_clean();

  // Do stuff to $getContent as needed

  // Use it
  echo $getContent;
