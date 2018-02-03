<?php
  if (!defined('cardinalSystem')) exit;	


    $cardinal->mustLogin();

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



    if ($GET['org'] && $user['organization'])
		$templateVariables['orgChat'] = true;

	$templateVariables['articles'] = $db->orderBy('created', 'desc')->get('blog_articles', 9, 'article_id, title');
    $templateVariables["display"] = "chat/chatFull.tpl";
  

  	
 
  

  
  ?>