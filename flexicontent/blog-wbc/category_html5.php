<?php
/************************************************************
/*
/*    Blogtemplate Flexicontent Webconcept
/*
/*    Author: C.Oerter
/*    Stand:  05 / 2017
/*	  Version: 1.0
/*    www.das-webconcept.de  
/*    category_html5
/*	
/**************************************************************/

defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$template  = $app->getTemplate(); 

// If customizing via CSS rules or JS scripts is not enough, then please copy the following file here to customize the HTML too

include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'category_html5.php');
?>