<?php

$achievements = $db->where("visibleInList = 1")->getOne("achievements", "count(*) nra");
$pages = new Paginator;
$pages->items_total = $achievements['nra'];
$pages->items_per_page = 20;
$pages->paginate();

if ($user['id'])
	$db->join("user_achievements ua", "ua.user_id = ".$user['id']." and ua.achievement_id = a.achievement_id", "left outer");

$achievements = $db->where("visibleInList", 1)
	               ->orderBy("a.points", "desc")
	               ->get("achievements a", $pages->limit);

$templateVariables['achievements'] = $achievements;
$templateVariables['display'] = "achievements/achievements.tpl";