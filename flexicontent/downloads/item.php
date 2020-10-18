<?php
/**********************************************/
/**   Beitragslayout für Downloads           **/  
/**   Stand: 07 / 2017                       **/   
/**********************************************/


defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$file  =  JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_html5.php';
$echofile = 'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_html5.php';
if ( JFile::exists($file) == true ) {
			include($file);
} else { echo 'Templatedatei: ' . $echofile . ' nicht angelegt.';}
?>
