<?php

if (!defined('cardinalSystem')) exit;


function createParty()
{
  global $db, $uclass, $user;
  $party = array(
      'creator_id' => $user['id'],
      'created' => time(),
      'global_chat_active' => $_SESSION['premium']['partyChat'] ? 1 : 0
    );
  $party_id = $db->insert('parties', $party);
  $uclass->updatePlayer(array('in_party' => $party_id));
}

$page_title = 'Parties';

if (!$user['in_party'])
{
  if ($_POST['create'])
  {
    createParty();
    $cardinal->redirect($url);
  } 
  

    if ($_POST['invite'])
    { 
      $invite = $db->where('user_id', $user['id'])->where('invitation_id', $_POST['invite'])->getOne('party_invitations', 'party_id');
      if (!$invite['party_id']) $cardinal->redirect($url);

      
      unset($_SESSION['lastPartyCheck']);
      if ($_POST['accept'])
      {
        $uclass->updatePlayer(array('in_party' => $invite['party_id']));
      }
      $db->where('invitation_id', $_POST['invite'])->delete('party_invitations', 1);

      if ($_SESSION['premium']['partyChat'])
        $db->where('party_id', $invite['party_id'])->update('parties', array('global_chat_active' => 1));

      $cardinal->redirect($url);
    }
    
    $invitations = $db->join('users u', 'u.id = pi.from_user_id', 'left outer')
                      ->where('user_id', $user['id'])->get('party_invitations pi', null, 'invitation_id, u.username');
    $tVars['invitations'] = $invitations;
  
}
else
{
  
  $participants = $db->where('in_party', $user['in_party'])->get('users', null, 'username, lastActive');
  
  if ($_POST['leave'])
  {
    // disband party?
    if (count($participants) == 1)
    {
      $db->where('party_id', $user['in_party'])->delete('parties');
    }
    
    $uclass->updatePlayer(array('in_party' => 0));
    $cardinal->redirect($url);
  }        
  $invitees = $db->join('users u', 'u.id = pi.user_id', 'left outer')
                 ->where('party_id', $user['in_party'])
                 ->orderBy('created', 'desc')
                 ->get('party_invitations pi', null, 'username');
  
  if ($usernames = $_POST['usernames'])
  {
    $usedUsernames = array();
    foreach ($participants as $participant)
      $usedUsernames []= strtolower($participant['username']);

    foreach ($invitees as $invitee)
      $usedUsernames [] = strtolower($invitee['username']);

    $usernames = explode(',', str_replace(' ', '', $usernames));
    
    foreach ($usernames as $key => &$username)
      if (!$cardinal->loginSystem->validateUsername($username))
      {
        $errors [] = "Invalid username: ".$username.". ";
        unset($usernames[$key]);
      }
      elseif (in_array(strtolower($username), $usedUsernames))
      {
        $errors [] = 'Hacker '.$username.' already invited or in party. ';
        unset($usernames[$key]);
      } else $username = strtolower($username);
    
    $key = array_search(strtolower($user['username']), $usernames);
    if ($key !== false){
       unset($usernames[$key]);
       $errors [] = "You cannot invite yourself. ";
    }
    
    if (count($usernames))
    {
      
      foreach ($usernames as &$u)
        $u = '\''.$u.'\'';
        
        $in = implode(',', $usernames);
      $invite = $db->rawQuery('select id, username from users where username in ('.$in.')');
      
      $invitation = array(
        'party_id' => $user['in_party'],
        'from_user_id' => $user['id'],
        'created' => time()
      );
      $invited = array();
      foreach($invite as $i)
      {
        $invitation['user_id'] = $i['id'];
        $invited []= $i['username'];
        $db->insert('party_invitations', $invitation);
      }
      
      $invitees = array_merge($invitees, $invite);
      $success = 'Invitation sent to '.implode(',', $invited).' ('.count($invite).' hackers)';
    } 
	  
	 
	  $cardinal->redirect($url);
  }
  
  foreach ($participants as &$participant)
  {
      if ($participant["lastActive"] >= time() - 10 * 60)
        $participant["online"] = true;
  }
  
  $party = $db->where('party_id', $user['in_party'])->getOne('parties', 'created');
  $party['created'] = date('H:i', $party['created']);
  $tVars['participants'] = $participants;
  $tVars['invitees'] = $invitees;
  $tVars['party'] = $party;
  
}
$tVars['display'] = 'parties/parties.tpl';

