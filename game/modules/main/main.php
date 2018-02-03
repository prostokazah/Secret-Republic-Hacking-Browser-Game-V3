<?php
if (!defined('cardinalSystem'))
  exit;

$page_title = 'Home';

/* HACKDOWN */
if (date('w') == 6)
{
$lastSaturday = strtotime("this Saturday");

$hackDownId = $lastSaturday;
$lastSaturdayEnd = $lastSaturday + 24*60*60;

$templateVariables['hackdownRemaining'] = $lastSaturdayEnd - time();
}
else
{
	$hackDownId = strtotime("last Saturday");
	$templateVariables['nextSaturdayRemaining'] = strtotime("Saturday") - time();
}




if (!$cardinal->loginSystem->logged) {
  include('visitor.php');
} //!$cardinal->loginSystem->logged



if ($cardinal->loginSystem->logged) {
	include("player.php");
} //$cardinal->loginSystem->logged

