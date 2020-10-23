<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (!empty($images->image_intro)) : ?>
	<?php $imgfloat = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro; ?>
	<?php $margins = 'mb-3 ml-3 mr-3'; ?>
	<?php switch ( $imgfloat ) {
			case 'left':
				$margins = 'mr-3 mb-3';
				break;
			case 'right':
				$margins = 'ml-3 mb-3';
				break;
	} ?>

	<div class="float-<?php echo htmlspecialchars($imgfloat, ENT_COMPAT, 'UTF-8'); ?> <?php echo $margins; ?> item-image">
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>"><img class="img-fluid 
		<?php if ($images->image_intro_caption) : ?>
			<?php echo 'caption' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"'; ?>
		<?php endif; ?>" 
		src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl"/></a>
	<?php else : ?><img class="img-fluid
		<?php if ($images->image_intro_caption) : ?>
			<?php echo 'caption' . ' title="' . htmlspecialchars($images->image_intro_caption, ENT_COMPAT, 'UTF-8') . '"'; ?>
		<?php endif; ?>"
		src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl"/>
	<?php endif; ?>
	</div>
<?php endif; ?>
