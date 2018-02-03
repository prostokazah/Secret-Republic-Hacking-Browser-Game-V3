<?php
 /**
 
 */

if (!defined('cardinalSystem')) exit;	



  if (isset($_GET["component"]))
{
	
	  if ($_POST)
	{
		$db->where("component_id", $_GET['component'])->update("components", $_POST, 1);
		  $cardinal->redirect($url);
	}
	  
	$component = $db->Where("component_id", $_GET["component"])->getOne("components");
	
	$templateVariables['component'] = $component;
	$templateVariables["display"] = 'admin/servers/hardware/edit_hardware.tpl';
}
else
{

  if($_POST)
  {
    $new = $db->insert("components", array("name" => rand(1,23423)));
	if ($new)
	{
		$cardinal->redirect(URL."admin/view/hardware/component/".$new);
	} else $errors[] = "Could not create";
    
  } // update group
  
  $components = $db->get("components");
    
  $templateVariables["components"] = $components;
  $templateVariables["display"] = 'admin/servers/hardware/hardware_list.tpl';
  

}