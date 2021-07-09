<?php
/************************************************************
/*
/*    Blogtemplate Flexicontent Webconcept
/*
/*    Author: C.Oerter
/*    Stand:  05 / 2017
/*	  Version: 1.0
/*    www.das-webconcept.de  
/*    Anzeigen von Unterkategorien HTML5 Template
/*	
/************************************************************/

defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$file      =  JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'category_subcategories_html5.php';
$echofile  = 'templates'.DS.$template.DS.'tmpl_common'.DS.'category_subcategories_html5.php';
if ( JFile::exists($file) == true ) {
			include($file);
} else { 
 include(JPATH_SITE.DS.'components'.DS.'com_flexicontent'.DS.'tmpl_common'.DS.'category_subcategories_html5.php');
}


?>