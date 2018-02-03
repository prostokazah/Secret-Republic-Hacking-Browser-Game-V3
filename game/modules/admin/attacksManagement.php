<?php

if ($GET['logs'])
{
  $db->join("users sender", "sender.id = a.sender_id", "left outer");
  $db->join("users receiver", "receiver.id = a.receiver_id", "left outer");
  if ($GET['hacker']) $db->where('a.sender_id = ? or a.receiver_id = ?', array($GET['hacker'], $GET['hacker']));
	
  $attacks = $db->get('attack_logs a', null, "a.*, sender.username sender_username, receiver.username receiver_username");

 
  $templateVariables["attacks"] = $attacks;
	
  $templateVariables["display"] = 'admin/attacks/attacks_logs_list.tpl';
}
else
{
  
  $db->join("users sender", "sender.id = a.sender_id", "left outer");
  $db->join("users receiver", "receiver.id = a.receiver_id", "left outer");
  if ($GET['hacker']) $db->where('a.sender_id = ? or a.receiver_id = ?', array($GET['hacker'], $GET['hacker']));
	
  $attacks = $db->get('attacks_inprogress a', null, "a.*, sender.username sender_username, receiver.username receiver_username");

  $templateVariables["attacks"] = $attacks;

  $templateVariables["display"] = 'admin/attacks/attacks_inprogress_list.tpl';
}