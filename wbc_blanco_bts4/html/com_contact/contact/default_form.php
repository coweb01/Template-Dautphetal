<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator'); ?>

<div class="contact-form col-12 col-md-8">
<?php 
if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>


	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" role="form">
		<fieldset>
			<legend class="sr-only"><?php echo JText::_('COM_CONTACT_FORM_LABEL'); ?></legend>
			
			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('anrede','com_fields'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('anrede','com_fields'); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('vorname','com_fields'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('vorname','com_fields'); ?>
				</div>
			
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('nachname','com_fields'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('nachname','com_fields'); ?>
				</div>
			</div>


			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo($this->form->getLabel('strasse','com_fields')); ?>
				</div>
				<div class="col">
					<?php echo($this->form->getInput('strasse','com_fields')); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo($this->form->getLabel('ort','com_fields')); ?>
				</div>
				<div class="col">
					<?php echo($this->form->getInput('ort','com_fields')); ?>
				</div>
			</div>


			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('contact_email'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('contact_email'); ?>
				</div>
			</div>

			<?php // custom field Telefon formular ?>
			
			
			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo($this->form->getLabel('phone','com_fields')); ?>
				</div>
				<div class="col">
					<?php echo($this->form->getInput('phone','com_fields')); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('contact_subject'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('contact_subject'); ?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 control-label">
					<?php echo $this->form->getLabel('contact_message'); ?>
				</div>
				<div class="col">
					<?php echo $this->form->getInput('contact_message'); ?>
				</div>
			</div>
			<div class="alert alert-light" role="alert"><?php echo JText::_('WBC_CUSTOM_MESSAGE_CONTACT'); ?>
				
			</div>

			<?php if ($this->params->get('show_email_copy')) : ?>
				<div class="form-group row">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
                        <label>
						<?php echo $this->form->getInput('contact_email_copy'); ?><?php echo $this->form->getLabel('contact_email_copy'); ?>
                        </label>
                        </div>
					</div>
				</div>
			<?php endif; ?>

			<?php // joomla core checkbox privacy ?>
			
			<?php if ( $this->form->getInput('consentbox') ) : ?>
			<div class="form-group private-policy">
				<div class="col-sm-12">
					<?php echo($this->form->renderField('consentbox')); ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="form-actions form-group">
				<button class="btn btn-primary validate" type="submit"><i class="fa fa-envelope"></i> <?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="task" value="contact.submit" />
				<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
				<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</fieldset>
	</form>
</div>
