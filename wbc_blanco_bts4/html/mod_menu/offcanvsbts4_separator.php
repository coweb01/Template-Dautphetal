<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$image_class   = '';

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? ' title="' . $item->anchor_title . '" ' : '';

$linktype = $item->title;


?>
<span class="separator"<?php echo $title; ?>>
	<?php echo $linktype; ?>
</span><span class="subtitle"><?php echo $subtitle;?> </span>
