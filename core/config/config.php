<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//**site config file**

if (!defined('G')) die('Hay , there ! This is a part of the main Glitter application :)');

//site config data goes as below

return array(

  //**1.site config
  
  'site.maintenance' => false,
  'site.debug' => true,
  'site.timezone' => 'PRC',
  'site.forceHttps' => false,
  'site.baseUrl' => 'lab.twic.me',
  'site.meta' => array(
    'siteTitle' => 'Just another Glitter site',
    'siteAuthor' => 'Glitter',
    'siteAuthorEmail' => 'glitter@example.org',
    'siteUrl' => 'CHANGE HERE',
    'siteKeyword' => 'Glitter-powered,blog',
    'siteMaintenanceNotice' => 'Site under construction or maintenance , please visit later and expect my hard working on this!',
  ),
  
  //**2.page config
  
  'page.fetchSeparator.begin' => '{#',
  'page.fetchSeparator.end' => '#}',

);