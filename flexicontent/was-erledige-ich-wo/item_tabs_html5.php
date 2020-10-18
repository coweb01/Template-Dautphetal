<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$file      =  JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_tabs_html5.php';
$echofile  = 'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_tabs_html5.php';
if ( JFile::exists($file) == true ) {
      include($file);
} else { echo 'Templatedatei: ' . $echofile . ' nicht angelegt.';}

?>
