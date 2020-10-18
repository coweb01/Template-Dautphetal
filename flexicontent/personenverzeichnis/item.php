<?php
/**
 * @version 1.5 stable $Id: item.php 1370 2012-07-08 01:24:53Z ggppdk $
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
 * Beitragsansicht Personenverzeichnis
 */
 

defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name
$tmpl      = $this->tmpl; // for backwards compatiblity
$app       = JFactory::getApplication();
$template  = $app->getTemplate(); 

//require_once(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'bookmark_icons.php');

if($this->item->state!=-2){

echo $this->loadTemplate('html5');

?>

<?php } /*endif state!=papierkorb*/  ?>
