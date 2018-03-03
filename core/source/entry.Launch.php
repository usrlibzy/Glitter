<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//** entry-file:ent.launch.php **

if (!defined('G')) die('Hay , there ! This is a part of the main Glitter application :)');

class Launch
{
  function __construct()
  {
    $this->go();
  }
  private function go()
  {
    global $g;
    
    //##### ESSENCIAL CODE START , SHOULD BE INCLUDED IN ALL CONDITIONS

    //***1.https_required redirect
    
    if (($g->config('site.forceHttps') == true) && ($g->isHttps() != true))
    {
      $g->redirect($g->url());
    }
    
    //***2.set default timezone

    if ($g->config('site.timezone') != null)
    {

      //if setted,use the configed timezone setting

      date_default_timezone_set($g->config("site.timezone"));
    }
    else
    {

      //by default,set GMT as default timezone

      date_default_timezone_set("GMT");
    }

    //***3.maintenace mode exit

    if ($g->config('site.maintenance') == true)
    {
      echo $g->config('site.meta')['siteMaintenanceNotice'];
      $g->response(503);
      exit;
    }

    //***4.debug mode error display

    if ($g->config('site.debug') == true)
    {

    //if debug mode setted true,difplay all errors

      ini_set('display_errors', 'On');
      error_reporting(E_ALL & ~E_STRICT);
    }
    else
    {
  
      //if not,only display important errors (no warnings or notices)

      error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR);
    }

    //##### ESSENCIAL CODE END

    //now way home

    require(PATH_CORE.DS.'controller'.DS.'default.php');
  }
}