<?php

/***********
	CARDINAL - ONE OF THE MAIN CLASSES OF THE SYSTEM - N.A.M.
************/


if (!defined('cardinalSystem')) exit;
/**
 * Contains everything needed to run the system
 */


//include('security.php');
include('alpha.class.php');

class Cardinal extends Alpha
{
	function Cardinal() {
    global $page, $smarty;

    parent::__construct();

    // find absolute path for future inclusions
    $path  =  dirname(__FILE__);
    $path  =  explode('/', $path);

    unset($path[count($path)-1],$path[count($path)-1]);

    define('ABSPATH', implode('/', $path).'/');


    $sek = md5(time().time().time());
		$db_file = ABSPATH.'includes/database_info.php';
		if (!file_exists($db_file)) die("Missing configuration file");
    include($db_file);

    $this->db =
      new Mysqlidb($database_server_name, $database_username, $database_password,
                   $database_name, $database_port, true);



    // get current page | not very secure method
    $page =  basename($_SERVER['PHP_SELF']);

    // debug statistics
    memory_get_usage(true);
    $this->beg_used_memory = memory_get_usage(true)/1024;

    $this->page_start = array_sum(explode(' ', microtime()));


  //  require(ABSPATH.'includes/vendor/smarty/smarty/Smarty.class.php');
    $smarty  =  new Smarty;
    $smarty->setTemplateDir(ABSPATH.'layout/templates');
    $smarty->setCompileDir(ABSPATH.'includes/templates_c');
    $smarty->setCacheDir(ABSPATH.'includes/cache');
    $smarty->setConfigDir(ABSPATH.'includes/vendor/smarty/smarty/configs');
    //$smarty->loadFilter('output', 'trimwhitespace');
    //$smarty->loadFilter('output', 'tidyrepairhtml');


    require (ABSPATH.'includes/constants/constants.php');
    $this->config =  $configs;

    $this->config['url'] = Cardinal::get_base_url();

    define('URL', $this->config['url']);
	}

  public static function get_base_url() {
    $base_url = '';
    if($_SERVER['HTTP_HOST'])
    {
      $base_url .= 'http://'.$_SERVER['HTTP_HOST'];
    }
    if ($_SERVER['SCRIPT_NAME'])
    {
      $common = static::get_common_path(array($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']));
      $base_url .= $common;
    }

    // Add a slash if it is missing and return it
    return rtrim($base_url, '/').'/';
  }

  static function get_common_path($paths)
	{
		$lastOffset = 1;
		$common = '/';
		while (($index = strpos($paths[0], '/', $lastOffset)) !== false)
		{
			$dirLen = $index - $lastOffset + 1;	// include /
			$dir = substr($paths[0], $lastOffset, $dirLen);
			foreach ($paths as $path)
			{
				if (substr($path, $lastOffset, $dirLen) != $dir)
				{
					return $common;
				}
			}
			$common .= $dir;
			$lastOffset = $index + 1;
		}
		return $common;
	}

	function loginSystem()
	{
	    global $logged;
require_once(ABSPATH.'includes/class/loginSystem.php');

        $this->loginSystem = new LoginSystem($this);

        $logged = $this->loginSystem->logged;


        if (isset($_SESSION['post_data']))
        {
            $_POST = $_SESSION['post_data'];
            unset($_SESSION['post_data']);
        }
	} // loginSystem

	function mustLogin()
	{
	  if(!$this->loginSystem->logged){
			//$_SESSION['messenger'] = array('message' => 'Access denied. Authentication required', 'type'=>'error');

            $_SESSION['afterLoginRedirect'] = $this->url;

			$this->errors[] = "Access denied. Authentication required";

			$this->redirect(URL);
		}
	}





}
?>
