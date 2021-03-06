<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$icon_class  	= $item->anchor_css ? 'class="'.$item->anchor_css.'" ' : '';
$title 			= $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title sr-only sr-only-focusable" >' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$item->params->get('menu_text', 1) ?
	$linktype = $item->title :
	$linktype = '<span class="sr-only sr-only-focusable">'.$item->title.'</span>'; 
}

switch ($item->browserNav)
{
	default:
	case 0:
?><div class="d-inline-block"><a class="nav-link" href="<?php echo $item->flink; ?>" <?php echo $title; ?>><span  <?php echo $icon_class; ?>></span> <?php echo $linktype; ?><?php echo ( $subtitle ) ? '<span class="subtitle">'. $subtitle.  '</span>' : ''; ?></a></div><?php
		break;
	case 1:
		// _blank
?><div class="d-inline-block" ><a class="nav-link" href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><span <?php echo $icon_class; ?>></span><?php echo $linktype; ?><?php echo ( $subtitle ) ? '<span class="subtitle">'. $subtitle.  '</span>' : ''; ?></a></div><?php
		break;
	case 2:
	// Use JavaScript "window.open"
?><div class="d-inline-block" ><a class="nav-link" href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><span <?php echo $icon_class; ?>></span> <?php echo $linktype; ?></a></div>
<?php
		break;
}
