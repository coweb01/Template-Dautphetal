<?php /**
 * @version 1.5 stable $Id: item.php 1538 2012-11-05 02:44:34Z ggppdk $
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
 * Beitragsansicht Tabs was erledige ich wo Vezeichniss
 */

// first define the template name
defined( '_JEXEC' ) or die( 'Restricted access' );
$app       = JFactory::getApplication();
$file  =  JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_html5.php';
$echofile = 'templates'.DS.$template.DS.'tmpl_common'.DS.'standard_tabs'.DS.'item_html5.php';
if ( JFile::exists($file) == true ) {
			include($file);
} else { echo 'Templatedatei: ' . $echofile . ' nicht angelegt.';}
?>