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
<?php if (!empty($images->image_fulltext)) : ?>
	<?php $imgfloat = empty($images->float_fulltext) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<?php $margins = 'mb-3 ml-3 mr-3'; ?>
	<?php switch ( $imgfloat ) {
			case 'left':
				$margins = 'mr-3 mb-3';
				break;
			case 'right':
				$margins = 'ml-3 mb-3';
				break;
	} ?>

	<div class="float-<?php echo htmlspecialchars($imgfloat); ?> <?php echo $margins; ?>  item-image"> <img class="img-fluid 
		<?php if ($images->image_fulltext_caption) :
			echo 'caption' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"';
		endif; ?>"
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/> </div>
<?php endif; ?>
