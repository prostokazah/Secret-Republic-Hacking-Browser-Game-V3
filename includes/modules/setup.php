<?php


if (file_exists(ABSPATH . 'includes/database_info.php')) {
    die('Must delete database_info.php first for security reasons');
}

if ($_POST['DB_HOST']) {
    $configs = file_get_contents(ABSPATH . '/includes/database_info.php.template');
    echo $configs;
    foreach($_POST as $k => $v) {
        $configs = str_replace($k, $v, $configs);
    }
    file_put_contents(ABSPATH . '/includes/database_info.php', $configs);

    $sqls = explode(";\n", file_get_contents(ABSPATH . '/includes/DB.sql'));


    $db = require(ABSPATH . '/includes/database_info.php');
    $db = new Mysqlidb($db['server_name'], $db['username'], $db['password'], $db['name'], $db['port'], true);

    foreach($sqls as $sql) {
            $db->rawQuery($sql);
    }

    require("../includes/class/registrationSystem.php");
    $cardinal = new Cardinal();
    $registrationSystem = new RegistrationSystem;
    $uid = $registrationSystem->addUser($_POST['ADMIN_USER'], $_POST['ADMIN_PASS'], $_POST['ADMIN_EMAIL'], 1, 1, false);
    $db->where('uid', $uid)->update('user_credentials', array(
        'group_id' => 1
      ));
    $cardinal->redirect(URL);
}

$tVars['display'] = "setup.tpl";
