<?php
/**
 * @version 1.5 stable $Id: category_category.php 171 2010-03-20 00:44:02Z emmanuel.danan $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright (C) 2009 Emmanuel Danan - www.vistamedia.fr
 * @license GNU/GPL v2
 * 
 * FLEXIcontent is a derivative work of the excellent QuickFAQ component
 * @copyright (C) 2008 Christoph Lukes
 * see www.schlu.net for more information
 *
 * FLEXIcontent is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * Anzeige der gleichranginge Kategorien
 * Template Downloadverzeichniss
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$template  = $app->getTemplate(); 
// If customizing via CSS rules or JS scripts is not enough, then please copy the following file here to customize the HTML too
include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'category_peercategories_html5.php');
?>