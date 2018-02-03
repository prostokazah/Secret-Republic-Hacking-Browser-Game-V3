<?php

if (!defined('cardinalSystem')) exit;	

$cardinal->mustLogin();

require_once("includes/constants/skills.php");
//require_once("includes/class/class.battleSystem.php");
	
  if ($user["skillPoints"])
    if(submitted_form("add_points"))
    {
      $filteredSkills = array();

      foreach($_POST['skills'] as $skill_id => $points)
      {
        if (!isset($theskills[$skill_id]))  {add_alert("Incorrect data"); continue; }
        $points = intval($points);
        if ($points)
        {
        $user['skillPoints'] -= $points;

        $fileteredSkills[$skill_id] = $points;
        }
      }

      if ($user['skillPoints'] < 0)
        add_alert("Not enough Skill Points available. Used " . number_format(abs($user['skillPoints'])) . " too many.");

      if (!there_are_errors())
      {
        foreach($fileteredSkills as $skill_id => $points)
          $uclass->addSkillExperience($user["id"], $skill_id, $points);

        $uclass->updatePlayer(array("skillPoints" => $user["skillPoints"]));
        add_alert("Completed successfully", "success");
        $_POST = array();
      }

      $cardinal->redirect(URL_C);
    }
  
	$skillsToFetch = array_keys($theskills);
	$skills = $uclass->getUserSkills($user["id"], $skillsToFetch);
	
	//$battleSystem = new BattleSystem();
	
	
	$templateVariables["commandActions"] = $commandActions;
	$templateVariables["userSkills"] = $skills;
	$templateVariables["theskills"] = $theskills;

	
	
  $templateVariables["display"] = "skills_and_abilities/skills.tpl";
	

?>
