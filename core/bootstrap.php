<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//** bootstrap file **

//***1.set the definitions

define('G',TRUE);
define('DS',DIRECTORY_SEPARATOR);

//You can modify the content folder where to keep the data of the pages in ' PATH_CONTENT ' .

define('PATH_MODULE',PATH_BASE.DS.'module'.DS);
define('PATH_CONTENT',PATH_BASE.DS.'content'.DS);

define('PATH_SOURCE',PATH_BASE.DS.'core'.DS.'source'.DS);
define('PATH_CONFIG',PATH_BASE.DS.'module'.DS.'config'.DS);

//***2.require the essential files

require(PATH_SOURCE.DS.'class.Site.php');
require('vendor/autoload.php');

//***3.welcome home

$g = new Glitter();
$h = $g->helper();
$g->launch();
