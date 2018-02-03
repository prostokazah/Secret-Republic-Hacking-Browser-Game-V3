<?php

if (!defined('cardinalSystem')) exit;

if ($GET["key1"] != "MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=") $cardinal->show_404();

    $runTime = time();
	  $user = array();
    $insertLogs = true;

    if ($GET["daily"])
      include("daily.php");
    elseif ($GET["hackdown"])
      include("hackdown.php");
	elseif ($GET["hackdownEnd"])
      include("hackdownEnd.php");
    elseif ($GET["hourly"])
      include("hourly.php");
    elseif ($GET["monthly"])
      include("monthly.php");
    elseif ($GET["rankings"])
      include("rankings.php");
    elseif ($GET["attacks"])
      include("tasks_and_attacks.php");
	elseif ($GET["resources"])
      include("resources.php");

    $insertData = array(
      "data" => $report,
      "created" => $runTime,
      "type" => $type
    );
    if ($insertLogs)
      $db->insert("debug_cron_logs", $insertData);
