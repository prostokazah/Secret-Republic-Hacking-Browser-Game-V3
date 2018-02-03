<?php

if (!defined('cardinalSystem')) exit;	

$cardinal->mustLogin();


$referrals = $db->where('master_user_id', $user['id'])->getOne('user_referrals', 'count(*) nrr');
$templateVariables["referrals_count"] = $referrals['nrr'];

$pages                 = new Paginator;
$pages->items_total    = $referrals['nrr'];
$pages->paginate();

$referrals = $db->join('users u', 'u.id = ur.slave_user_id', 'left outer')
	            ->where('master_user_id', $user['id'])
	            ->orderBy('created', 'desc')
	            ->get('user_referrals ur', $pages->limit, 'ur.*, u.username, u.level');

$templateVariables['referrals'] = $referrals;
$templateVariables['display'] = "referrals/referrals.tpl";