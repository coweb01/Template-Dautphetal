<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="reset-confirm <?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.confirm'); ?>" method="post" class="form-validate form-horizontal well">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset>
				<?php if (isset($fieldset->label)) : ?>
					<p><?php echo JText::_($fieldset->label); ?></p>
				<?php endif; ?>
				<?php foreach ($this->form->getFieldset($fieldset->name) as $field) : ?>
				<div class="form-group row">	
					<div class="col-12 col-sm-2 col-form-label-sm"><?php echo $field->label; ?></div>
					<div class="col-12 col-sm-9"><?php echo $field->input; ?></div>
				</div>
				<?php endforeach; ?>
			</fieldset>
		<?php endforeach; ?>
		<div class="form-group">
				<button type="submit" class="btn btn-outline-primary validate">
					<?php echo JText::_('JSUBMIT'); ?>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
