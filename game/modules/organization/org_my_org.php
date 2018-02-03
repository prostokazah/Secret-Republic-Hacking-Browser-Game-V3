<?php
// can user manager wars?
    if ($oclass->perms['manage_wars']) {
      // check of any war requests have been sent to org
      $warRequests = 
      $db->where('status = 1')->wherE('org2=?', array($oclass->organization['id']))
         ->getOne('org_wars_reqs', 'count(id)');

      $oclass->organization['war_requests'] = $warRequests['requests'];
      
    } // if wars
    
    
    if ($GET['view'] == 'members' && $oclass->perms['viewMembers']) {
      
      $pages = new Paginator;
      $pages->items_total = $oclass->organization["nrm"];
      $pages->mid_range = 5; 
      $pages->items_per_page = 15;
      $pages->paginate();
      
      $templateVariables['load']    = 'members';
      $members                      = $oclass->get_members($pages->limit);
      $templateVariables['members'] = $members;
      
    } //$GET['view'] == 'members' && $oclass->perms['viewMembers']
    else if ($GET['view'] == 'messageAll' && $oclass->perms['messageAll']) {
      $templateVariables['load'] = 'messageAll';
      
      $oclass->mes_all();
      
      $ranks = $db->where('org_id', $oclass->organization['id'])->get('org_ranks', null, 'name, rank_id');
      
      $members = $oclass->get_members($oclass->organization);
      
      $templateVariables['ranks']   = $ranks;
      $templateVariables['members'] = $members;
    } //$GET['view'] == 'messageAll' && $oclass->perms['messageAll']
    else if ($GET['view'] == 'manageMembers' && $oclass->perms['manageMembers']) {
      $templateVariables['load'] = 'manageMembers';
      
      if ($user_id = $_POST['kickMember']) {
        $member = $db->where('organization', $oclass->organization['id'])->where('id', $user_id)->join('org_ranks', 'rank_id = org_group', 'left outer')->where('owner_rank', 0)->getOne('users', 'username, id');
       
        if ($_POST['do']) {
          $oclass->kickMember($member);
          $cardinal->redirect($url);
        } //$_POST['do']
        
        $templateVariables['load']   = 'kick_member';
        $templateVariables['member'] = $member;
      } //$user_id = $_POST['kickMember']
      
      
      if ($templateVariables['load'] == 'manageMembers') {
        if ($_POST['rank']) {
          $member = $db->where('organization', $oclass->organization['id'])->where('id', $user_id)->join('org_ranks', 'rank_id = org_group', 'left outer')->where('owner_rank', 0)->getOne('users', 'username, id');
          if ($member['id']) {
            $oclass->updateMemberRank($_POST['member'], $_POST['rank']);
            $success = $member['username'] . '\'s rank updated';
          } //$member['id']
        } //$_POST['rank']
        
        
        $pages = new Paginator;
        $pages->items_total = $oclass->organization["nrm"];
        $pages->items_per_page = 15;
        $pages->paginate();
      
        $members = $oclass->get_members($pages->limit);
        
        $ranks = $db->where('org_id', $oclass->organization['id'])->where('owner_rank', 0)->get('org_ranks', null, 'name, rank_id');
        
        
        $templateVariables['ranks']   = $ranks;
        $templateVariables['members'] = $members;
      } //$templateVariables['load'] == 'manageMembers'
    } //$GET['view'] == 'manageMembers' && $oclass->perms['manageMembers']
    else if ($GET['view'] == 'manageRanks' && $oclass->perms['manageRanks']) {
      $templateVariables['load'] = 'manageRanks';
      
      $oclass->editRanks();
      
      
    } //$GET['view'] == 'manageRanks' && $oclass->perms['manageRanks']
    else if ($GET['view'] == 'core' && $oclass->perms['manageOrganization']) {
      $templateVariables['load'] = 'edit_org';
      
      $oclass->manageOrganization();
      
    } //$GET['view'] == 'core' && $oclass->perms['manageOrganization']
    else if ($GET['view'] == 'changeOwner' && $oclass->perms['owner']) {
      $templateVariables['load'] = 'change_owner';
      
      if ($_POST)
      {
        $member = $db->where('organization', $oclass->organization['id'])->where('id', $_POST['member'])
                     ->getOne('users', 'id, username');
        if ($member['id'])
        {
          $title = 'Organization ownership changed';
          $message = 'I, '.$user['username'].', have decided to surrender the position of organization owner to '.$member['username'].'.';
          $oclass->updateOrganization(array('owner' => $member['id']));
          $defaultRank = $db->where('org_id', $oclass->organization['id'])->where('default_rank', 1)->getOne('org_ranks', 'rank_id');
          
          $uclass->updatePlayer(array('org_group' => $user['org_group']), $member['id']);
          $uclass->updatePlayer(array('org_group' => $defaultRank['rank_id']));
          $oclass->sendMessageToEveryone($message, $title);
          $cardinal->redirect($url);
          
        }
      }
      $members = $oclass->get_members("", true);
      
      $templateVariables['members'] = $members;
    } //$GET['view'] == 'core' && $oclass->perms['manageOrganization']
    else if ($GET['view'] == 'forum') {
      //$templateVariables['load']='forum';
      
      $oclass->organizationForum();
    
    } //$GET['view'] == 'forum'
    else if ($GET['view'] == 'disband' && $oclass->perms['owner']) {
      $templateVariables['load'] = 'disband';
      
      if ($GET['do'] && $oclass->organization['nrm'] == 1)
        $oclass->disband_org();
      
    } //$GET['view'] == 'disband' && $oclass->perms['owner']
    else if ($GET['view'] == 'applications' && $oclass->perms['manageApplications']) {
      $templateVariables['load'] = 'applications';
      
      $oclass->manageApplications();
      
    } //$GET['view'] == 'applications' && $oclass->perms['manageApplications']
    else if ($GET['view'] == 'chat') {
      $templateVariables['load'] = 'chat';
      
      if (!$_SESSION['org'])
        $_SESSION['org'] = $user['organization'];
      
      $templateVariables['orgChat'] = true;
      
    } //$GET['view'] == 'chat'
    else if ($GET['view'] == 'leave' && !$oclass->perms['owner']) {
      $templateVariables['load'] = 'quit';
      
      if ($_POST['quit']) {
        
        $oclass->kickMember($user, true);
        $cardinal->redirect($url);
      } //$_POST['quit']
    } //$GET['view'] == 'leave' && $oclass->perms['quit']
    elseif($GET['view'] == 'hackingPoints')
    {
    include ("org_hacking_points.php");
    
    }
    
    
    $templateVariables['access'] = $oclass->perms;