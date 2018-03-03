<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//** class-file:Helper **

if (!defined('G')) die('Hay , there ! This is a part of the main Glitter application :)');

class Helper
{
  /*
    function : assign_var($array)
    assign the page contents to the object
  */

  public function assign_var($array)
  {
    if (isset($array))
    {
      $this->fetch = $array;
    }
    else
    {
      $this->fetch = NULL;
    }
  }

  /*
    function : fetch($type = 'var')
    get the page content value by index
  */

  public function fetch($type = 'var')
  {
    if (isset($this->fetch[$type]))
    {
      if ($this->fetch[$type] != null)
      {
        return $this->fetch[$type];
      }
      else
      {
        return null;
      }
    }
    else
    {
      return null;
    }
  }

  //do more with Markdown
  //saying thanks to erusev@github for your project : Parsedown !

  /*
    function : load_markdown($content)
    parse the markdown text to html
  */
  public function load_markdown($content)
  {
    if (isset($content))
    {
      $parsedown = new Parsedown;
      return $parsedown->text($content);
    }
    else
    {
      return NULL;
    }
  }

  //do more with YAML
  //saying thanks to mustangostang@github for your project : spyc !

  /*
    function : load_yaml($content)
    parse the yaml text to array
  */

  public function load_yaml($content)
  {
    if (isset($content))
    {
      $return = Spyc::YAMLLoad($content);
      return $return;
    }
    else
    {
      return NULL;
    }
  }

  /*
    function : dump_yaml($content)
    dump array to text in yaml format
  */

  public function dump_yaml($content)
  {
    $return = Spyc::YAMLDump($content);
    return $return;
  }

  /*
    function : isHttps()
    return bool on whether is https
  */

  public function isHttps()
  {
    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on')
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  /*
    function : get($var_name)
    the GET data
  */

  public function get($var_name)
  {
    if (isset($_GET[$var_name]))
    {
      $this->get = $_GET[$var_name];
      return $this->get;
    }
    else
    {
      $this->get = null;
      return $this->get;
    }
  }

  /*
    function : post($var_name)
    the POST data
  */

  public function post($var_name)
  {
    if (isset($_POST[$var_name]))
    {
      $this->post = $_POST[$var_name];
      return $this->post;
    }
    else
    {
      $this->post = null;
      return $this->post;
    }
  }

  /*
    function : url()
    get the current url
  */

  public function url()
  {
    if (isset($_SERVER['HTTP_REFERER']))
    {
      return $_SERVER['HTTP_REFERER'];
    }
    else
    {
      return null;
    }
  }
  
  /*
    function : baseUrl()
    get the base url
  */

  public function baseUrl()
  {
    if ($this->config('site.baseUrl') != null)
    {
      return $this->config('site.baseUrl');
    }
    else
    {
      return null;
    }
  }
  
  /*
    function : uri()
    get the current uri
  */
  
  public function uri()
  {
    if (isset($_SERVER['PATH_INFO']))
    {
      $uri = $_SERVER['PATH_INFO'];
    }
    else
    {
      $uri = "";
    }
    return $uri;
  }
  
  /*
    function : stage($depth = null)
    get the directory name by index (0.1.2...)
  */

  public function stage($depth = null)
  {
    if ($depth == null)
    {
      return $this->uri();
    }
    else
    {
      $uri_steps = explode('/',$this->uri());
      if (!isset($uri_steps[$depth]))
      {
        return null;
      }
      else
      {
        return $uri_steps[$depth];
      }
    }
  }

  /*
    function : response($status_code)
    modify the response code to send
  */

  public function response($status_code)
  {
    switch ($status_code)
    {
      case 401:
      header('HTTP/1.1 401 Unauthorized');
      break;
      case 403:
      header('HTTP/1.1 403 Forbidden');
      break;
      case 404:
      header('HTTP/1.1 404 Not Found');
      break;
      case 500:
      header('HTTP/1.1 500 Internal Server Error');
      break;
      case 503:
      header('HTTP/1.1 503 Service Temporarily Unavailable');
      break;
    }
  }

  /*
    function : redirect($url,$status_code)
    redirect to url with status-code 301 or 302
  */

  public function redirect($url,$status_code = '302')
  {
    if (!preg_match('/^^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+$/',$url))
    {
      if ($this->config('site.forceHttps') == true)
      {
        $url = "https://".$this->baseUrl()."/".$url;
      }
      else
      {
        $url = "http://".$this->baseUrl()."/".$url;
      }
    }
    else
    {
      $url = "http://".$url;
    }
    switch ($status_code)
    {
      case 301:
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: '.$url);
      break;
      case 302:
      header('HTTP/1.1 302 Move Temporarily');
      header('Location: '.$url);
      break;
    }
  }

}