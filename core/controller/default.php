<?PHP
/*
------ Glitter application file -----
copyright 2017 (By Twikor)
This file is a part of Glitter.
*/
//**controller : default file**

if (!file_exists(PATH_PAGE.DS.$g->stage().DS.'content.yaml'))
{
  $h->redirect('error?=404');
  exit;
}
else
{
  $content_file = file_get_contents(PATH_PAGE.DS.$g->stage().DS.'content.yaml');
}

//check for enabled plugins 

$g->plugin();

//start parsing yaml content file

$to_fetch = $h->parse_yaml($content_file);

//assign the parsed content to the object

$h->assign_var($to_fetch);

//load template (temp)

if (($h->fetch('temp') == null) || (!file_exists(PATH_MODULE.DS.'themes'.DS.'templates'.DS.$h->fetch('temp').'.tpl')))
{
  $content = file_get_contents(PATH_MODULE.DS.'themes'.DS.'templates'.DS.'default.tpl');
}
else
{
  $content = file_get_contents(PATH_MODULE.DS.'themes'.DS.'templates'.DS.$h->fetch('temp').'.tpl');
}

$fsb = $g->config('page.fetchSeparator.begin');
$fse = $g->config('page.fetchSeparator.end');

//fetch snippet (snip) replaces:

$replacement = array();
$replacebase = array();
$snippets = (array)$h->fetch('snip');

foreach ($snippets as $var => $value)
{
  if (file_exists(PATH_MODULE.DS.'themes'.DS.'snippets'.DS.$value.'.tpl'))
  {
    $snippet_file = file_get_contents(PATH_MODULE.DS.'themes'.DS.'snippets'.DS.$value.'.tpl');
  }
  $replacement[] = $snippet_file;
  $value = $fsb."snip:".$value.$fse;
  $replacebase[] = $value;
}

$content = str_replace($replacebase,$replacement,$content);

//fetch variable (vari) replaces:

$replacement = array();
$replacebase = array();

$variables = array_merge((array)$g->config('page.meta'),(array)$h->fetch('vari'));

foreach ($variables as $var => $value)
{
  $replacement[] = $value;
  $var = $fsb."vari:".$var.$fse;
  $replacebase[] = $var;
}

$content = str_replace($replacebase,$replacement,$content);

//happily enjoy

echo $content;