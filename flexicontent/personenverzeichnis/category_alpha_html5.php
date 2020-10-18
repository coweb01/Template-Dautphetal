<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$template  = $app->getTemplate(); 


	// If customizing via CSS rules or JS scripts is not enough, then please copy the following file here to customize the HTML too
	include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'category_alpha_html5.php');
?>