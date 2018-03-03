<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//** class-file:Glitter **

if (!defined('G')) die('Hay , there ! This is a part of the main Glitter application :)');

class Glitter
{
  function __construct()
  {
    //import config
    $config = require(PATH_CONFIG.DS.'config.php');
    $this->config = $config;
  }

  /*
    variable : helper
  */
  private $helper;

  /*
    function : config()
    get config value by index
  */

  public function config($config_tag)
  {
    return $this->config[$config_tag];
  }

  /*
    function : launch()
    to launch the whole application
  */

  public function launch()
  {
    if (!isset($this->launch))
    {
      if (!file_exists(PATH_SOURCE.DS.'entry.Launch.php'))
      {
        return false;
      }
      else
      {
        require_once(PATH_SOURCE.DS.'entry.Launch.php');
        $this->launch = new Launch();
        return $this->launch;
      }
    }
    else
    {
      return false;
    }
  }

  /*
    function : helper()
    include the helper file
  */

  public function helper()
  {
    if (!isset($this->helper) || ($this->helper == null))
    {
      if (!file_exists(PATH_SOURCE.DS.'class.Helper.php'))
      {
        return false;
      }
      else
      {
        require_once(PATH_SOURCE.DS.'class.Helper.php');
        $this->helper = new Helper();
        return $this->helper;
      }
    }
    else
    {
      return $this->helper;
    }
  }

  /*
    function : plugin($name)
    handle the plugin
  */

  public function plugin($name)
  {
    if (file_exists(PATH_MODULE.DS.'plugins'.DS.$name.DS.'controller.php'))
    {
      require_once(PATH_MODULE.DS.'plugins'.DS.$name.DS.'controller.php');
    }
    else
    {
      return false;
    }
  }
}
