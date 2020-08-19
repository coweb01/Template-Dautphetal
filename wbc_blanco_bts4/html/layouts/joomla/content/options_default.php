<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
?>

<fieldset class="<?php echo !empty($displayData->formclass) ? $displayData->formclass : 'form-horizontal'; ?>">
	<legend><?php echo $displayData->name; ?></legend>
	<?php if (!empty($displayData->description)) : ?>
		<p><?php echo $displayData->description; ?></p>
	<?php endif; ?>
	<?php $fieldsnames = explode(',', $displayData->fieldsname); ?>
	<?php foreach ($fieldsnames as $fieldname) : ?>
		<?php foreach ($displayData->form->getFieldset($fieldname) as $field) : ?>
			<?php $datashowon = ''; ?>
			<?php $groupClass = $field->type === 'Spacer' ? ' field-spacer' : ''; ?>
			<?php if ($field->showon) : ?>
				<?php JHtml::_('jquery.framework'); ?>
				<?php JHtml::_('script', 'jui/cms.js', array('version' => 'auto', 'relative' => true)); ?>
				<?php $datashowon = ' data-showon=\'' . json_encode(JFormHelper::parseShowOnConditions($field->showon, $field->formControl, $field->group)) . '\''; ?>
			<?php endif; ?>
			<div class="form-group <?php echo $groupClass; ?>"<?php echo $datashowon; ?>>
				<?php if (!isset($displayData->showlabel) || $displayData->showlabel) : ?>
					<?php echo $field->label; ?>
				<?php endif; ?>
				<?php echo $field->input; ?>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
</fieldset>
