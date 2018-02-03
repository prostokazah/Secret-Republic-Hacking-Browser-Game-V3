<?php
 
		$attack['money'] = 5 * $zoneDistance + $clusterDistance;
	  $attack['totalSeconds'] = $zoneDistance * 20 + 3 * $clusterDistance;
	  $attack['dataPoints'] = $zoneDistance * 100 + 15 * $clusterDistance;
		$attack['energy'] = 10 * $zoneDistance + $clusterDistance;

	  $attack['totalSeconds'] *= 60;
	
		$attack['cant'] = $uclass->hasEnoughResources($user, $attack) ? false : true;

		$servers = $uclass->getAvailableServersForAttack();

    $templateVariables['servers'] = $servers;

  if (!$attack['cant'] && $_POST["initiate"])
  {
      if (!is_array($_POST['servers']))
        $selectedServers = explode(",", $_POST['servers']);
      else $selectedServers = $_POST['servers'];

      $servers = verifySelectedServers($selectedServers, $servers);
      

      include("includes/class/class.battleSystem.php");
      $battleSystem = new BattleSystem();
      $stats = array();
      $stats['spyAttack'] =  
      	$battleSystem->computePlayerStats($user['id'], false, true, false, false, $servers)['spyAttack'];

    



      $templateVariables['stats'] = $stats;
      $servers = implode(",", $servers);
      $templateVariables['servers'] = $servers;

      if ($_POST['start'])
        if (!there_are_errors())
        {
	  			initiateAttack(1, $sender, $receiver, $user['id'], $node['user_id'], $attack, $servers);
	  		}
	
  }

  $templateVariables['display'] = "grid/spy.tpl";
