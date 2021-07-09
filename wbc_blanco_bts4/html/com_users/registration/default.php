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
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
?>


<div class="registration <?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>
	<div class="text-secondary"><?php echo JText::_('INFOTEXT'); ?></div>


	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate row" enctype="multipart/form-data">
      	<div class="col-sm">
			<fieldset class="profil mb-3">
				<div class="form-row">			
	 				<div class="form-group mb-2">
	 					
		 				<?php 	echo $this->form->getLabel('username'); ?>	
		 				<?php 	echo $this->form->getInput('username'); ?>
		 				
	 				</div>
	 				<div class="form-group mb-2">
	 					
		 				<?php  	echo $this->form->getLabel('email1'); ?>	
		 				<?php  	echo $this->form->getInput('email1'); ?>
		 				
	 				</div>
	 				<div class="form-group mb-2">
	 					
		 				<?php 	echo $this->form->getLabel('email2'); ?>	
		 				<?php 	echo $this->form->getInput('email2'); ?>
	 					
	 				</div>
	 				<div class="form-group mb-2">
	 					
	 					<?php 	echo $this->form->getLabel('password1'); ?>	
						<?php 	echo $this->form->getInput('password1'); ?>
						
					</div>
					<div class="form-group mb-2">
						
						<?php 	echo $this->form->getLabel('password2'); ?>	
						<?php 	echo $this->form->getInput('password2'); ?>
						
					</div>

 				</div>
			</fieldset>


	 		<?php if( $this->form->getInput('captcha') ) { ?>

				<div class="form-group mb-2">
					<?php  //echo $this->form->renderFieldset('privacyconsent'); ?>
					<?php 	echo $this->form->getLabel('captcha'); ?>	
					<?php 	echo $this->form->getInput('captcha'); ?>
				</div>

	 		<?php } ?>
			

			<div class="form-group">
				
					<button type="submit" class="btn btn-primary validate">
						<?php echo JText::_('JREGISTER'); ?>
					</button>
					<a class="btn" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
					</a>
					
				
			</div>
			
		</div>

      	<div class="col-sm">
	

			<fieldset class="adress mb-3 ">
				
					<div class="form-group mb-2">
						
						<?php 	echo $this->form->getLabel('name'); ?>	
						<?php 	echo $this->form->getInput('name'); ?>	
						
					<div class="form-group mb-2">
						
						<?php  	echo $this->form->getLabel('address1','profile');  ?>
		 				<?php  	echo $this->form->getInput('address1','profile');  ?>
	 					
	 					
	 				</div>
	 				<div class="form-group mb-2">
	 					<div class="form-row">
		 					<div class="col-4">
		 						<?php  	echo $this->form->getLabel('postal_code','profile'); 		 ?> 
		 						<?php  	echo $this->form->getInput('postal_code','profile'); 		 ?> 
		 					</div>
		 					<div class="col-8">
		 						<?php  	echo $this->form->getLabel('city','profile'); 		 ?> 
		 						<?php  	echo $this->form->getInput('city','profile'); 		 ?> 
		 					</div>
		 				</div>
		 			</div>
	 				
	 				<div class="form-group mb-2">
						
	 				<?php  	echo $this->form->getLabel('phone','profile'); 		 ?>	
	 				<?php  	echo $this->form->getInput('phone','profile'); 		 ?>
	 						
	 			    </div>
	 			    
					<?php if ($this->form->getFieldset('privacyconsent')) { ?>
						<div class="form-group mb-2">

	 					<?php  echo $this->form->renderFieldset('privacyconsent'); ?>

			 			</div>
			 		<?php } ?>
 				

			</fieldset>
		</div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="registration.register" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
