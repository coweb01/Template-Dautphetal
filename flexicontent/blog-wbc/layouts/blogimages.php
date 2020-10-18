<?php 
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * displaydata: 
 * 		img_position 
 * 		link_image
 *		link_url
 *		img_class
 *		title_encoded
 *		img_style
 *		tumb
 *      tooltip_class
 */

defined('JPATH_BASE') or die;



?>

<figure class="image <?php echo $displayData['img_position']; ?>" >
	<?php if ($displayData['link_image']) : ?>
	<a href="<?php echo $displayData['link_url']; ?>">
		<img src="<?php echo $displayData['thumb']; ?>" alt="<?php echo $displayData['title_encoded']; ?>" class="mootools-noconflict <?php echo $displayData['tooltip_class']; ?> <?php echo $displayData['img_class'] . $displayData['img_style']; ?>  " title="<?php echo flexicontent_html::getToolTip($displayData['_read_more_about'], $displayData['title_encoded'], 0, 0); ?>"  />
	</a>
	<?php else : ?>
		<img src="<?php echo $displayData['thumb']; ?>" class="mootools-noconflict <?php echo $displayData['tooltip_class']; ?> <?php echo $displayData['img_class'] . $displayData['img_style']; ?>" alt="<?php echo $displayData['title_encoded']; ?>" title="<?php echo $displayData['title_encoded']; ?>"  />
	<?php endif; ?>
</figure>
