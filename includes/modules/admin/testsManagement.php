<?php

if ($GET['market'])
{

	include('includes/class/class.market.php');
	$market = new Market();


	$testData = array();


	$testData = array();
	$task['uid'] = 1564;

	$skill = array();

	if ($GET['hardware'])
	$items = $db->get('applications');
	else
	$items = $db->get('components');
	foreach($items as $soft)
	{
		$testCase = array();

		for ($skill['level'] = 1; $skill['level'] <= 10; $skill['level'] = $skill['level'] + 3)
			for ($soft['damage'] = 5; $soft['damage'] <= 100; $soft['damage'] = $soft['damage'] + 30)
			{

				$testCase['succeededTests'][] = $market->hasRepairBeenSuccessfull($soft, $task, $skill);
				$failed = $succeeded = 0;
				$tests = 100;
				for ($i=1; $i<=$tests;$i++)
					if ($rate = $market->hasRepairBeenSuccessfull($soft, $task, $skill))
					{
						//$testCase['succeededTests'][] = $rate;
						$succeeded++;
					} else $failed++;

				$testCase['succeeded'] = $succeeded;
				$testCase['failed'] = $failed;
				$testCase['tests'] = $tests;
				$testCase['successPercent'] = $succeeded/($tests/100);
				$testCase['skill'] = $skill;
				$testCase['item'] = $soft;
				$testData[] = $testCase;
			}
		//echo "<pre>";
	//print_R($testData);
	//	die();
	}
	$tVars['testData'] = $testData;
	$tVars['display'] = 'admin/tests/market.tpl';
}
else 
	$tVars['display'] = 'admin/tests/tests.tpl';
